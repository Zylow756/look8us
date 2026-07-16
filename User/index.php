<?php
declare(strict_types=1);

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../thecaptcha/captcha.function.php';

/* Part 1: secure bootstrap. This is a public registration page. */
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'secure' => !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
        'httponly' => true,
        'samesite' => 'Lax',
    ]);
    session_start();
}

if (!isset($con) || !($con instanceof mysqli)) {
    http_response_code(500);
    exit('Database connection is unavailable.');
}
mysqli_set_charset($con, 'utf8mb4');

if (empty($_SESSION['registration_csrf'])) {
    $_SESSION['registration_csrf'] = bin2hex(random_bytes(32));
}

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function value(string $name): string
{
    return trim((string) ($_POST[$name] ?? ''));
}

/* Part 2: form processing and server-side validation. */
$errors = [];
$flag = 0;
$userId = '';
$captchaText = "Please tell me you're not a spambot";
$form = ['compname' => '', 'mname' => '', 'city' => '', 'mobile' => '', 'txtmail' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    foreach ($form as $field => $_) {
        $form[$field] = value($field);
    }
    $email = strtolower($form['txtmail']);
    $password = (string) ($_POST['pass'] ?? '');
    $confirmation = (string) ($_POST['pass1'] ?? '');

    if (!hash_equals($_SESSION['registration_csrf'], (string) ($_POST['csrf_token'] ?? ''))) {
        $errors[] = 'Your form session has expired. Please submit the form again.';
    }
    if ($form['compname'] === '') $errors[] = 'Company/Firm/Shop Name is required.';
    if ($form['mname'] === '') $errors[] = 'Owner/Contact Person is required.';
    if ($form['city'] === '') $errors[] = 'City is required.';
    if (!preg_match('/^[0-9+() .-]{7,25}$/', $form['mobile'])) $errors[] = 'Enter a valid mobile number.';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Enter a valid email address.';
    if (strlen($password) < 6) $errors[] = 'Password must be at least 6 characters long.';
    if (!hash_equals($password, $confirmation)) $errors[] = 'Password and confirmation do not match.';
    if (!$errors && !captcha_verify_word()) {
        $errors[] = 'Wrong image code.';
        $captchaText = 'Wrong image code. Please try again.';
    }

    if (!$errors) {
        try {
            /* Part 3: prepared duplicate-email check. */
            $check = $con->prepare('SELECT mid FROM member WHERE email = ? LIMIT 1');
            if (!$check) throw new RuntimeException('Email lookup could not be prepared.');
            $check->bind_param('s', $email);
            $check->execute();
            $exists = $check->get_result()->num_rows > 0;
            $check->close();

            if ($exists) {
                $flag = 1;
                $errors[] = 'This email address is already registered.';
            } else {
                /* Preserves the original name-prefix user-ID convention. */
                $prefix = strtoupper(substr(preg_replace('/[^a-z0-9]/i', '', $form['mname']), 0, 3));
                $prefix = $prefix !== '' ? $prefix : 'USR';

                /*
                 * The explicit column list matches User/index-agent.php's member schema.
                 * The short transaction makes the legacy sequential user-ID generation safer.
                 */
                $con->begin_transaction();
                $last = $con->prepare('SELECT mid FROM member ORDER BY mid DESC LIMIT 1 FOR UPDATE');
                if (!$last) throw new RuntimeException('Member-ID lookup could not be prepared.');
                $last->execute();
                $lastMember = $last->get_result()->fetch_assoc();
                $last->close();
                $nextMemberId = $lastMember ? ((int) $lastMember['mid'] + 1) : 1;
                $userId = $prefix . $nextMemberId;

                $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                if ($passwordHash === false) throw new RuntimeException('Password could not be secured.');
                $dash = '-';
                $zero = '0';
                $plan = 'Demo';
                $registrationDate = date('d-m-Y');
                $expiryDate = '2000-01-01';

                /* Part 4: parameterised member insert (41 values; mid is auto-increment). */
                $insert = $con->prepare(
                    'INSERT INTO member (
                        mid, uname, pass, mname, compname, tagline, shopno, address, area, city,
                        state1, pin, phone, phone1, mobile, mobile1, email, web, remark, remark1,
                        mtyp, logo, catelog, rating, estyear, x, y, z, mstatus, mplan, mdate,
                        ytube, facebook, twiter, linken, expdate, gmap, verify, acode, a, b, c
                    ) VALUES (
                        NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
                    )'
                );
                if (!$insert) throw new RuntimeException('Registration could not be prepared.');

                $memberValues = [
                    $userId, $passwordHash, ucwords($form['mname']), ucwords($form['compname']),
                    $dash, $dash, $dash, $dash, ucwords($form['city']), $dash, $dash, $dash, $dash,
                    $form['mobile'], $dash, $email, $dash, $dash, $dash, $zero, $dash, $dash, $zero,
                    $dash, $dash, $dash, $dash, $zero, $plan, $registrationDate, $dash, $dash, $dash,
                    $dash, $expiryDate, $dash, $dash, $dash, $dash, $dash, $dash
                ];
                $insert->bind_param(str_repeat('s', count($memberValues)), ...$memberValues);
                if (!$insert->execute()) throw new RuntimeException('Member registration failed.');
                $newMemberId = $insert->insert_id;
                $insert->close();
                $con->commit();

                session_regenerate_id(true);
                $_SESSION['user'] = $email;
                $_SESSION['mtyp'] = '0';
                $_SESSION['mid'] = $newMemberId;
                $_SESSION['mplan'] = $plan;

                /* Do not expose the plaintext password in the old email URL. */
                header('Location: ../email1.aspx?mid=' . rawurlencode((string) $newMemberId)
                    . '&us=' . rawurlencode($userId) . '&mplan=' . rawurlencode($plan));
                exit;
            }
        } catch (Throwable $exception) {
            try { $con->rollback(); } catch (Throwable) { }
            error_log('Member registration error: ' . $exception->getMessage());
            $errors[] = 'Registration could not be completed. Please try again later.';
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Online Directory - Registration</title>
    <link rel="stylesheet" href="../akc.css">
    <style>
        :root { --brand:#165a9d; --text:#20242a; --muted:#58616c; --border:#d7dce2; --danger:#b42318; }
        * { box-sizing:border-box; } body { margin:0; color:var(--text); font-family:Arial,Helvetica,sans-serif; background:#f5f7fa; }
        .registration { width:min(calc(100% - 2rem), 900px); margin:2rem auto; overflow:hidden; background:#fff; border:1px solid var(--border); border-radius:.6rem; box-shadow:0 3px 15px rgb(0 0 0 / .08); }
        h1 { margin:0; padding:1rem 1.25rem; font-size:1.25rem; text-align:center; background:#e2e2e2; } form { padding:1.25rem; }
        .form-row { display:grid; grid-template-columns:minmax(12rem,1fr) minmax(16rem,1.3fr) minmax(10rem,1fr); gap:.75rem 1rem; align-items:center; margin-bottom:1rem; }
        label { text-align:right; font-weight:700; } input { width:100%; min-height:2.7rem; padding:.55rem .7rem; border:1px solid #abb5bf; border-radius:.3rem; font:inherit; }
        input:focus { outline:3px solid rgb(22 90 157 / .22); border-color:var(--brand); } .hint { margin:0; color:var(--muted); font-size:.9rem; }
        .alert { margin:1.25rem 1.25rem 0; padding:.85rem 1rem; border:1px solid #fecdca; border-radius:.3rem; color:#7a271a; background:#fef3f2; } .alert ul { margin:0; padding-left:1.25rem; }
        .captcha { max-width:100%; height:auto; } .actions { text-align:center; } button { min-height:2.7rem; min-width:9rem; padding:.5rem 1rem; border:0; border-radius:.3rem; color:#fff; background:var(--brand); font:inherit; font-weight:700; cursor:pointer; } button:hover { background:#0d477e; }
        </style>
</head>
<body>
    <header><?php require_once __DIR__ . '/../header.php'; ?></header>
    <main class="registration">
        <h1>Register Your Firm / Shop / Company</h1>
        <?php if ($errors): ?><section class="alert" role="alert"><ul><?php foreach ($errors as $error): ?><li><?= e($error) ?></li><?php endforeach; ?></ul></section><?php endif; ?>
        <form id="frmhlp" method="post" action="index.php">
            <input type="hidden" name="csrf_token" value="<?= e($_SESSION['registration_csrf']) ?>">
            <div class="form-row"><label for="compname">Company / Firm / Shop Name</label><input class="txtbox" type="text" name="compname" id="compname" value="<?= e($form['compname']) ?>" maxlength="150" required autocomplete="organization"><p class="hint">Required.</p></div>
            <div class="form-row"><label for="mname">Owner / Contact Person</label><input class="txtbox" type="text" name="mname" id="mname" value="<?= e($form['mname']) ?>" maxlength="150" required autocomplete="name"><p class="hint">Required.</p></div>
            <div class="form-row"><label for="city">City</label><input class="txtbox" type="text" name="city" id="city" value="<?= e($form['city']) ?>" maxlength="100" required autocomplete="address-level2"><p class="hint">Required.</p></div>
            <div class="form-row"><label for="mobile">Mobile Number</label><input class="txtbox" type="tel" name="mobile" id="mobile" value="<?= e($form['mobile']) ?>" maxlength="25" required autocomplete="tel"><p class="hint">7–25 digits and common phone symbols.</p></div>
            <div class="form-row"><label for="txtmail">Email Address</label><input class="txtbox" type="email" name="txtmail" id="txtmail" value="<?= e($form['txtmail']) ?>" maxlength="254" required autocomplete="email"><p class="hint">Required.</p></div>
            <div class="form-row"><label for="pass">Password</label><input class="txtbox" type="password" name="pass" id="pass" minlength="6" required autocomplete="new-password"><p class="hint">At least 6 characters.</p></div>
            <div class="form-row"><label for="pass1">Confirm Password</label><input class="txtbox" type="password" name="pass1" id="pass1" minlength="6" required autocomplete="new-password"><p class="hint">Must match the password.</p></div>
            <div class="form-row"><label for="magicword">Captcha Code</label><div><img class="captcha" src="../thecaptcha/captcha.image.php?nocache=<?= e(bin2hex(random_bytes(8))) ?>" alt="Captcha characters"><input class="txtbox" type="text" name="magicword" id="magicword" required autocomplete="off"></div><p class="hint"><?= e($captchaText) ?></p></div>
            <p class="actions"><button class="subbox" type="submit" name="submit" value="1">Submit</button></p>
        </form>
    </main>
    <footer><?php require_once __DIR__ . '/../footer.php'; ?></footer>
</body>
</html>

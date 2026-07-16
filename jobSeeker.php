<?php
declare(strict_types=1);

require_once __DIR__ . '/config.php';

/*
|--------------------------------------------------------------------------
| Secure Session
|--------------------------------------------------------------------------
*/
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_set_cookie_params([
        'lifetime' => 0,
        'path'     => '/',
        'domain'   => '',
        'secure'   => (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'),
        'httponly' => true,
        'samesite' => 'Lax'
    ]);
    session_start();
}

/*
|--------------------------------------------------------------------------
| MySQLi Error Reporting
|--------------------------------------------------------------------------
*/
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

/*
|--------------------------------------------------------------------------
| Security Headers
|--------------------------------------------------------------------------
*/
header('X-Frame-Options: SAMEORIGIN');
header('X-Content-Type-Options: nosniff');
header('Referrer-Policy: strict-origin-when-cross-origin');

/*
|--------------------------------------------------------------------------
| Escape Helper
|--------------------------------------------------------------------------
*/
function h(?string $value): string
{
    return htmlspecialchars(
        $value ?? '',
        ENT_QUOTES | ENT_SUBSTITUTE,
        'UTF-8'
    );
}

/*
|--------------------------------------------------------------------------
| CSRF Token
|--------------------------------------------------------------------------
*/
if (empty($_SESSION['jobseeker_csrf'])) {
    $_SESSION['jobseeker_csrf'] = bin2hex(random_bytes(32));
}

/*
|--------------------------------------------------------------------------
| Status Variables
|--------------------------------------------------------------------------
*/
$msg = 0;
$error = '';

/*
|--------------------------------------------------------------------------
| Default Values
|--------------------------------------------------------------------------
*/
$atitle = '';
$cate = 'IT Services/Development';
$discr = '';
$jtype = 'Full Time';
$yname = '';
$mobile = '';
$email = '';
$city = '';
$qual = '';
$expr = '';
$expsalary = '';

/*
|--------------------------------------------------------------------------
| Process Form
|--------------------------------------------------------------------------
*/
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {

    /*
    |---------------------------------------------------------------
    | CSRF Validation
    |---------------------------------------------------------------
    */
    if (
        empty($_POST['csrf_token']) ||
        !hash_equals(
            $_SESSION['jobseeker_csrf'],
            $_POST['csrf_token']
        )
    ) {
        die('Invalid CSRF token.');
    }

    /*
    |---------------------------------------------------------------
    | Collect Inputs
    |---------------------------------------------------------------
    */
    $atitle = trim($_POST['atitle'] ?? '');
    $cate = trim($_POST['cate'] ?? '');
    $discr = trim($_POST['discr'] ?? '');
    $jtype = trim($_POST['jtype'] ?? '');
    $yname = trim($_POST['yname'] ?? '');
    $mobile = trim($_POST['mobile'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $city = trim($_POST['city'] ?? '');
    $qual = trim($_POST['qual'] ?? '');
    $expr = trim($_POST['expr'] ?? '');
    $expsalary = trim($_POST['expsalary'] ?? '');

    /*
    |---------------------------------------------------------------
    | Length Limits (same as original)
    |---------------------------------------------------------------
    */
    $atitle = mb_substr($atitle, 0, 35);
    $discr = mb_substr($discr, 0, 35);
    $yname = mb_substr($yname, 0, 35);
    $mobile = mb_substr($mobile, 0, 35);
    $email = mb_substr($email, 0, 35);
    $city = mb_substr($city, 0, 35);
    $qual = mb_substr($qual, 0, 35);
    $expr = mb_substr($expr, 0, 35);
    $expsalary = mb_substr($expsalary, 0, 35);

    /*
    |---------------------------------------------------------------
    | Validation
    |---------------------------------------------------------------
    */
    if ($atitle === '') {
        $error = 'Ads Title is required.';
    } elseif ($discr === '') {
        $error = 'Description is required.';
    } elseif ($yname === '') {
        $error = 'Your Name is required.';
    } elseif (
        $email !== '' &&
        !filter_var($email, FILTER_VALIDATE_EMAIL)
    ) {
        $error = 'Please enter a valid Email Address.';
    }
/*
|--------------------------------------------------------------------------
| Save Record
|--------------------------------------------------------------------------
*/
if ($error === '') {
    $today = date('d-m-Y');
    $sql = "
        INSERT INTO postcv
        (
            atitle,
            cate,
            discr,
            jtype,
            yname,
            phone,
            email,
            city,
            qual,
            exper,
            expsal,
            x,
            y,
            pdate
        )
        VALUES
        (
            ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '-', '0', ?
        )
    ";

    try {
        $stmt = $con->prepare($sql);
        $stmt->bind_param(
            "ssssssssssss",
            $atitle,
            $cate,
            $discr,
            $jtype,
            $yname,
            $mobile,
            $email,
            $city,
            $qual,
            $expr,
            $expsalary,
            $today
        );

        $stmt->execute();
        $stmt->close();

        $msg = 1;

        /*
        |--------------------------------------------------------------------------
        | Prevent Form Resubmission
        |--------------------------------------------------------------------------
        */
        $_SESSION['jobseeker_success'] = true;

        header("Location: jobSeeker.php?success=1");
        exit;

    } catch (mysqli_sql_exception $e) {
        error_log($e->getMessage());
        $error = 'Unable to save your CV. Please try again later.';
    }
}
}

/*
|--------------------------------------------------------------------------
| Success Message after Redirect
|--------------------------------------------------------------------------
*/
if (isset($_GET['success'])) {
    $msg = 1;
    unset($_SESSION['jobseeker_success']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>
Look8US : Business Directory Kota, Rajasthan, India | Post Your CV | Jobs Portal
</title>

<meta name="description"
      content="Post your CV online on Look8US. Search jobs in Kota, Rajasthan including IT, Marketing, Sales, Education, Hotel, Finance, Manufacturing and many more opportunities.">

<meta name="keywords"
      content="Look8US, Job Portal, Kota Jobs, Rajasthan Jobs, Post CV, Online CV, IT Jobs, Marketing Jobs, Business Directory">

<meta name="author" content="Look8US">
<meta name="robots" content="index,follow">

<link rel="canonical"
      href="https://www.look8us.com/jobSeeker.php">

<!-- Existing Website CSS -->
<link rel="stylesheet"
      href="akc.css">

<!-- Optional Site Icon -->
<link rel="icon"
      href="images/favicon.ico"
      type="image/x-icon">

<style>
*,
*::before,
*::after{
    box-sizing:border-box;
    margin:0;
    padding:0;
}

:root{
    --primary:#0b5ed7;
    --secondary:#f3f4f6;
    --border:#d9d9d9;
    --text:#333333;
    --heading:#222222;
    --success:#198754;
    --danger:#dc3545;
    --radius:8px;
    --shadow:
        0 10px 25px rgba(0,0,0,.08);
}

html{
    font-size:16px;
    scroll-behavior:smooth;
}

body{
    margin:0;
    font-family:
        Arial,
        Helvetica,
        sans-serif;
    color:var(--text);
    background:
        #f5f5f5
        url("images/bg.png")
        repeat;
    line-height:1.5;
    min-height:100vh;
}

img{
    max-width:100%;
    height:auto;
    display:block;
}

a{
    color:var(--primary);
    text-decoration:none;
    transition:.25s;
}

a:hover{
    text-decoration:underline;
}

.page-wrapper{
    width:min(1200px,96%);
    margin:0 auto;
}

.page-banner{
    background:#d2d2d2;
    padding:
        1.25rem
        1rem;
    margin-bottom:1rem;
}

.page-banner h1{
    font-size:
        clamp(
            1.5rem,
            3vw,
            2.2rem
        );
    color:#333;
    font-weight:600;
}

.content-card{
    background:#fff;
    border:
        1px solid
        var(--border);
    border-radius:
        var(--radius);
    box-shadow:
        var(--shadow);
    padding:
        clamp(
            18px,
            3vw,
            32px
        );
    margin-bottom:30px;
}

.alert{
    width:100%;
    padding:15px;
    border-radius:6px;
    margin-bottom:20px;
    font-size:15px;
}

.alert-success{
    background:#eaf8ef;
    color:var(--success);
    border:1px solid #bfe5cb;
}

.alert-danger{
    background:#fff3f3;
    color:var(--danger);
    border:1px solid #f0bcbc;
}

.form-table{
    width:100%;
    border-collapse:collapse;
}

.form-table tr{
    border-bottom:
        1px solid
        #efefef;
}

.form-table td{
    padding:
        14px
        10px;
    vertical-align:middle;
}

.form-table td:first-child{
    width:28%;
    font-weight:600;
    color:#333;
}

.txtbox1,
.selbox{
    width:100%;
    max-width:650px;
    padding:
        11px
        14px;
    border:
        1px solid
        #cccccc;
    border-radius:6px;
    font-size:15px;
    transition:.25s;
    background:#fff;
}

.txtbox1:focus,
.selbox:focus{
    outline:none;
    border-color:
        var(--primary);
    box-shadow:
        0 0 0 3px
        rgba(13,110,253,.15);
}

.subbox{
    display:inline-block;
    background:var(--primary);
    color:#fff;
    border:none;
    border-radius:6px;
    padding:12px 30px;
    font-size:15px;
    cursor:pointer;
    transition:.30s;
}

.subbox:hover{
    background:#084298;
}

.subbox:disabled{
    opacity:.6;
    cursor:not-allowed;
}

.required{
    color:#dc3545;
    font-weight:bold;
}

.back-link{
    font-size:14px;
    font-weight:600;
}

.success-image{
    margin:25px auto;
    max-width:420px;

}

@media print{
    body{
        background:#fff;
    }
    .subbox{
        display:none;
    }
}

</style>

</head>
<body>
<div class="page-wrapper">
<?php require_once __DIR__ . '/header.php'; ?>
<section class="page-banner">
    <h1>Post Your CV Detail</h1>
</section>
<main class="content-card">
<?php if ($msg === 1): ?>
<div class="alert alert-success">
    <h3>Your CV has been submitted successfully.</h3>
    <p>
        Thank you for posting your CV on Look8US.
        Employers can now review your profile.
    </p>
    <div style="text-align:center;margin-top:20px;">
        <img
            src="images/cvupload.jpg"
            alt="Your CV Submitted Successfully"
            class="success-image">
    </div>
    <div style="text-align:center;margin-top:25px;">
        <a href="jobSeeker.php" class="subbox"
           style="text-decoration:none;">
            Post Another CV
        </a>
    </div>
</div>

<?php else: ?>

<?php if ($error !== ''): ?>

<div class="alert alert-danger">
    <?= h($error) ?>
</div>

<?php endif; ?>

<form
    action="jobSeeker.php"
    method="post"
    id="jobSeekerForm"
    autocomplete="on"
    novalidate>
<input
    type="hidden"
    name="csrf_token"
    value="<?= h($_SESSION['jobseeker_csrf']) ?>">
<table class="form-table">
<tr>
    <td>
        Ads Title
        <span class="required">*</span>
    </td>
    <td>
        <input
            type="text"
            name="atitle"
            id="atitle"
            class="txtbox1"
            maxlength="35"
            required
            value="<?= h($atitle) ?>">
    </td>
</tr>
<tr>
    <td>
        Category
    </td>
    <td>
        <select
            name="cate"
            id="cate"
            class="selbox">
		<option value="IT Services/Development"
    <?= ($cate === 'IT Services/Development') ? 'selected' : '' ?>>
    IT Services/Development
</option>

<option value="DTP-Data Entry/Online"
    <?= ($cate === 'DTP-Data Entry/Online') ? 'selected' : '' ?>>
    DTP-Data Entry/Online
</option>

<option value="Marketing"
    <?= ($cate === 'Marketing') ? 'selected' : '' ?>>
    Marketing
</option>

<option value="Customer Service"
    <?= ($cate === 'Customer Service') ? 'selected' : '' ?>>
    Customer Service
</option>

<option value="Advertising &amp; PR"
    <?= ($cate === 'Advertising & PR') ? 'selected' : '' ?>>
    Advertising &amp; PR
</option>

<option value="Sales"
    <?= ($cate === 'Sales') ? 'selected' : '' ?>>
    Sales
</option>

<option value="Clerical &amp; Administration"
    <?= ($cate === 'Clerical & Administration') ? 'selected' : '' ?>>
    Clerical &amp; Administration
</option>

<option value="Human Resource"
    <?= ($cate === 'Human Resource') ? 'selected' : '' ?>>
    Human Resource
</option>

<option value="Education/School/Coaching"
    <?= ($cate === 'Education/School/Coaching') ? 'selected' : '' ?>>
    Education / School / Coaching
</option>

<option value="Hotel & Tourisim"
    <?= ($cate === 'Hotel & Tourisim') ? 'selected' : '' ?>>
    Hotel &amp; Tourism
</option>

<option value="Hospital-Nursing"
    <?= ($cate === 'Hospital-Nursing') ? 'selected' : '' ?>>
    Hospital / Nursing
</option>

<option value="Account & Finance"
    <?= ($cate === 'Account & Finance') ? 'selected' : '' ?>>
    Account &amp; Finance
</option>

<option value="Industry/Manufacturing"
    <?= ($cate === 'Industry/Manufacturing') ? 'selected' : '' ?>>
    Industry / Manufacturing
</option>

<option value="Other"
    <?= ($cate === 'Other') ? 'selected' : '' ?>>
    Other
</option>
</select>
    </td>
</tr>
<tr>
    <td>
        Description
        <span class="required">*</span>
    </td>
    <td>
        <input
            type="text"
            id="discr"
            name="discr"
            class="txtbox1"
            maxlength="35"
            required
            value="<?= h($discr) ?>">
    </td>
</tr>
<tr>
    <td>
        Job Type
    </td>
    <td>
        <select
            name="jtype"
            id="jtype"
            class="selbox">
            <option value="Full Time"
                <?= ($jtype === 'Full Time') ? 'selected' : '' ?>>
                Full Time
            </option>

            <option value="Part Time"
                <?= ($jtype === 'Part Time') ? 'selected' : '' ?>>
                Part Time
            </option>

            <option value="Contract"
                <?= ($jtype === 'Contract') ? 'selected' : '' ?>>
                Contract
            </option>
        </select>
    </td>
</tr>
<tr>
    <td>
        Your Name
        <span class="required">*</span>
    </td>
    <td>
        <input
            type="text"
            id="yname"
            name="yname"
            class="txtbox1"
            maxlength="35"
            required
            value="<?= h($yname) ?>">
    </td>
</tr>
<tr>
    <td>
        Contact No.
    </td>
    <td>
        <input
            type="text"
            id="mobile"
            name="mobile"
            class="txtbox1"
            maxlength="35"
            value="<?= h($mobile) ?>">
    </td>
</tr>
<tr>
    <td>
        Email ID
    </td>
    <td>
        <input
            type="email"
            id="email"
            name="email"
            class="txtbox1"
            maxlength="100"
            value="<?= h($email) ?>">
    </td>
</tr>
<tr>
    <td>
        City / State
    </td>
    <td>
        <input
            type="text"
         id="city"
            name="city"
            class="txtbox1"
            maxlength="35"
            value="<?= h($city) ?>">
    </td>
</tr
<tr>
    <td>
        Qualification
    </td>
    <td>
        <input
            type="text"
            id="qual"
            name="qual"
            class="txtbox1"
            maxlength="35"
            value="<?= h($qual) ?>">
    </td>
</tr>
<tr>
    <td>
        Experience (Years)
    </td>
    <td>
        <input
            type="text"
            id="expr"
            name="expr"
            class="txtbox1"
            maxlength="35"
            value="<?= h($expr) ?>">
    </td>
</tr>
<tr>
    <td>
        Expected Salary
    </td

    <td>
        <input
            type="text"
            id="expsalary"
            name="expsalary"
            class="txtbox1"
            maxlength="35"
            value="<?= h($expsalary) ?>">
    </td>
</tr>
<tr>

    <td></td>
    <td>
        <button
            type="submit"
            name="submit"
            class="subbox">
            Submit CV
        </button>
        &nbsp;
        <button
            type="reset"
            class="subbox"
            style="background:#6c757d;">
            Reset
        </button>
    </td>
</tr>
</table>
</form>
<?php endif; ?>
</main>
	<footer>
<?php require_once __DIR__ . '/footer.php'; ?>
</footer>
</div>

<script>
'use strict';

document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('jobSeekerForm');
    if (!form) {
        return;
    }

    const title = document.getElementById('atitle');
    const description = document.getElementById('discr');
    const name = document.getElementById('yname');
    const email = document.getElementById('email');

    form.addEventListener('submit', function (e) {

        if (title.value.trim() === '') {
            alert('Please enter Ads Title.');
            title.focus();
            e.preventDefault();
            return;
        }

        if (title.value.length > 35) {
            alert('Ads Title must not exceed 35 characters.');
            title.focus();
            e.preventDefault();
            return;
        }

        if (description.value.trim() === '') {
            alert('Please enter Description.');
            description.focus();
            e.preventDefault();
            return;
        }

        if (description.value.length > 35) {
            alert('Description must not exceed 35 characters.');
            description.focus();
            e.preventDefault();
            return;
        }

        if (name.value.trim() === '') {
            alert('Please enter Your Name.');
            name.focus();
            e.preventDefault();
            return;
        }

        if (name.value.length > 35) {
            alert('Your Name must not exceed 35 characters.');
            name.focus();
            e.preventDefault();
            return;
        }

        if (email.value.trim() !== '') {
            const pattern =
                /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!pattern.test(email.value.trim())) {
                alert('Please enter a valid Email Address.');
                email.focus();
                e.preventDefault();
                return;
            }
        }
    });
});
</script>
</body>
</html>
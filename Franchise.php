<?php
declare(strict_types=1);

require_once __DIR__ . '/config.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$msg = 0;
$error = '';

$fname  = trim($_POST['fname']  ?? '');
$mobile = trim($_POST['mobile'] ?? '');
$email  = trim($_POST['email']  ?? '');
$city   = trim($_POST['city']   ?? '');
$remark = trim($_POST['remark'] ?? '');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (
        !isset($_POST['csrf_token']) ||
        !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])
    ) {
        $error = 'Invalid request.';
    }

    if ($error === '') {

        if ($fname === '') {
            $error = 'Please enter your name.';
        } elseif ($mobile === '') {
            $error = 'Please enter your mobile number.';
        } elseif ($email === '') {
            $error = 'Please enter your email address.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 'Please enter a valid email address.';
        } elseif ($city === '') {
            $error = 'Please enter preferred location.';
        }

    }

    if ($error === '') {

        try {
$stmt = mysqli_prepare(
    $con,
    "INSERT INTO franch
    (
        fname,
        mobile,
        email,
        city,
        remark,
        cdate
    )
    VALUES
    (?, ?, ?, ?, ?, ?)"
);

$cdate = date('d-m-Y');
mysqli_stmt_bind_param(
    $stmt,
    "ssssss",
    $fname,
    $mobile,
    $email,
    $city,
    $remark,
    $cdate
);

mysqli_stmt_execute($stmt);

mysqli_stmt_close($stmt);

            $msg = 1;

            // clear values
            $fname = '';
            $mobile = '';
            $email = '';
            $city = '';
            $remark = '';

            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

        } catch (mysqli_sql_exception $e) {

            error_log($e->getMessage());

            $error = 'Unable to submit your details. Please try again later.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1">

<title>
Look8US : Business Directory Kota, Rajasthan
</title>

<meta name="description"
      content="Look8US Business Directory">

<meta name="keywords"
      content="Business Directory, Kota, Rajasthan">

<link rel="stylesheet" href="akc.css">

<style>
	*{
    box-sizing:border-box;
}

body{
    margin:0;
    padding:0;
    font-family:Arial, Helvetica, sans-serif;
    background:#ffffff;
    color:#333;
}

img{
    max-width:100%;
    height:auto;
}

table{
    max-width:100%;
}

input,
textarea,
select{
    width:100%;
    padding:10px;
    border:1px solid #ccc;
    border-radius:4px;
    font-size:14px;
    box-sizing:border-box;
}

textarea{
    resize:vertical;
    min-height:120px;
}

.subbox{

    background:#0066cc;
    color:#fff;
    border:none;
    padding:12px 25px;
    cursor:pointer;
    border-radius:4px;
    font-size:15px;

}

.subbox:hover{

    background:#004c99;

}

.success-message{

    background:#d4edda;
    color:#155724;
    padding:12px;
    margin:10px;
    border-radius:5px;
    border:1px solid #c3e6cb;

}

.error-message{

    background:#f8d7da;
    color:#721c24;
    padding:12px;
    margin:10px;
    border-radius:5px;
    border:1px solid #f5c6cb;

}

</style>

</head>

<body>
<?php require_once 'header.php'; ?>

<main class="franchise-page">
<section class="page-banner">
<div class="container">
<h1>
Franchise
</h1>
</div>
</section>
<section class="franchise-container">
<div class="container">
<div class="content-wrapper">
<div class="content-left">
<article class="franchise-content">

    <p>
        The service industry has shown new business horizons to the world.
        It is the service industry which has multiplied customer comforts
        and has churned immeasurable benefits for society.
        Education is one of the brightest stars of the service industry.
        Apart from monetary benefits, it is one of the few industries that
        contributes significantly to the development of society.
    </p>

    <p>
        In business terms, the investments required are simple and clean.
        The major investment is in human resources rather than tangible
        raw materials. Online marketing is one of the fastest-growing
        businesses in the service industry and continues to earn respect
        and recognition across different sectors.
    </p>

    <h2>Why Look8US?</h2>

    <p>
        Look8US is an umbrella brand that provides recognition while
        ensuring your investment continues to grow. With our support,
        guidance and nationwide presence, you can confidently establish
        yourself in this rapidly growing industry.
    </p>

    <ul class="feature-list">

        <li>
            Association with one of India's leading brand names.
        </li>

        <li>
            Membership of a nationwide business network.
        </li>

        <li>
            Detailed operating manuals and business processes.
        </li>

        <li>
            Updated study materials and curriculum.
        </li>

        <li>
            National-level advertising support.
        </li>

    </ul>

    <h2>Reach of Look8US</h2>

    <ul class="feature-list">

        <li>
            Customers from various cities across India.
        </li>

        <li>
            Large community of satisfied clients.
        </li>

        <li>
            Strong nationwide customer base.
        </li>

    </ul>

    <p class="highlight">

        <strong>
            Be a part of the movement called Look8US —
            follow the footprints of success.
        </strong>

    </p>

    <h2>Come to Look8US if you...</h2>

    <ul class="feature-list">

        <li>
            Have the passion to excel.
        </li>

        <li>
            Possess the right skills and attitude.
        </li>

        <li>
            Have experience in the education industry.
        </li>

        <li>
            Have innovative business ideas.
        </li>

        <li>
            Want to become a successful entrepreneur.
        </li>

    </ul>

    <h2>With Look8US You Will Find</h2>

    <ul class="feature-list">

        <li>
            Someone who believes in your vision.
        </li>

        <li>
            Someone who helps solve business challenges.
        </li>

        <li>
            Someone who helps you discover new opportunities.
        </li>

        <li>
            Someone who helps you achieve your personal goals.
        </li>

        <li>
            Someone who transforms your dreams into reality.
        </li>

    </ul>

</article>

</div>

<div class="content-right">
<form
    name="example"
    method="post"
    action="<?= htmlspecialchars($_SERVER['PHP_SELF'], ENT_QUOTES, 'UTF-8'); ?>"
    enctype="multipart/form-data"
    autocomplete="on"
>

    <!-- CSRF Protection -->
    <input
        type="hidden"
        name="csrf_token"
        value="<?= htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8'); ?>"
    >

    <div align="right">

        <table
            border="0"
            width="99%"
            id="table1"
            style="border-collapse:collapse;"
            bordercolor="#f2f2f2"
            class="franchise-form-table"
        >

            <tr>
                <td colspan="2" bgcolor="#969696" align="center" height="30">
                    <strong>Send your Detail</strong>
                </td>
            </tr>

            <?php if ($msg === 1): ?>

            <tr>

                <td colspan="2" align="center">

                    <div class="success-message">

                        Your details have been sent successfully.

                    </div>

                </td>

            </tr>

            <?php endif; ?>


            <?php if ($error !== ''): ?>

            <tr>

                <td colspan="2" align="center">

                    <div class="error-message">

                        <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?>

                    </div>

                </td>

            </tr>

            <?php endif; ?>


            <tr>

                <td width="35%">
                    Name
                </td>

                <td>

                    <input
                        type="text"
                        name="fname"
                        maxlength="35"
                        class="txtbox1"
                        required
                        value="<?= htmlspecialchars($fname, ENT_QUOTES, 'UTF-8'); ?>"
                    >

                </td>

            </tr>


            <tr>

                <td>
                    Mobile / Phone
                </td>

                <td>

                    <input
                        type="text"
                        name="mobile"
                        maxlength="35"
                        class="txtbox1"
                        required
                        value="<?= htmlspecialchars($mobile, ENT_QUOTES, 'UTF-8'); ?>"
                    >

                </td>

            </tr>


            <tr>

                <td>
                    Email ID
                </td>

                <td>

                    <input
                        type="email"
                        name="email"
                        maxlength="60"
                        class="txtbox1"
                        required
                        value="<?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?>"
                    >

                </td>

            </tr>


            <tr>

                <td>
                    Preferred Location
                </td>

                <td>

                    <input
                        type="text"
                        name="city"
                        maxlength="50"
                        class="txtbox1"
                        required
                        value="<?= htmlspecialchars($city, ENT_QUOTES, 'UTF-8'); ?>"
                    >

                </td>

            </tr>


            <tr>

                <td colspan="2">

                    Your Query / Remark

                </td>

            </tr>

            <tr>

                <td colspan="2">

                    <textarea
                        name="remark"
                        rows="6"
                        class="txtarea1"
                        required><?= htmlspecialchars($remark, ENT_QUOTES, 'UTF-8'); ?></textarea>

                </td>

            </tr>


            <tr>

                <td colspan="2" align="center">

                    <input
                        type="submit"
                        name="submit"
                        value="Send"
                        class="subbox"
                    >

                </td>

            </tr>

        </table>

    </div>

</form>

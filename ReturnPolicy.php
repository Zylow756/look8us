<?php
declare(strict_types=1);
require_once __DIR__ . '/config.php';

/*
|--------------------------------------------------------------------------
| Secure Session Configuration
|--------------------------------------------------------------------------
*/
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_set_cookie_params([
        'lifetime' => 0,
        'path'     => '/',
        'domain'   => '',
        'secure'   => !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
        'httponly' => true,
        'samesite' => 'Lax'
    ]);

    session_start();
}

/*
|--------------------------------------------------------------------------
| Security Headers
|--------------------------------------------------------------------------
*/
header('X-Frame-Options: SAMEORIGIN');
header('X-Content-Type-Options: nosniff');
header('Referrer-Policy: strict-origin-when-cross-origin');
header("Permissions-Policy: geolocation=(), microphone=(), camera=()");
?>
<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>
Look8US | Return & Refund Policy | Business Directory Kota Rajasthan India
</title>

<meta
    name="description"
    content="Read the Return and Refund Policy of Look8US. Learn about cancellations, refunds, subscriptions, and support information for products and services offered through Look8US."
>

<meta
    name="keywords"
    content="Look8US Return Policy, Refund Policy, Cancellation Policy, Business Directory Kota, Rajasthan, India, Yellow Pages, Manufacturers, Suppliers, Exporters"
>

<meta name="author" content="Look8US">

<meta name="robots" content="index, follow">

<link rel="canonical" href="https://www.look8us.com/ReturnPolicy.php">

<!-- Existing CSS -->
<link rel="stylesheet" href="akc.css">

<style>

/************************************************
    CSS RESET
************************************************/

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

html{
    scroll-behavior:smooth;
}

body{

    font-family:
        Arial,
        Helvetica,
        sans-serif;

    background:
        #f5f5f5
        url("images/bg.png")
        repeat;

    color:#333;

    line-height:1.7;
}

/************************************************
    PAGE WRAPPER
************************************************/

.wrapper{

    width:min(1020px,96%);
    margin:auto;
}

/************************************************
    PAGE TITLE
************************************************/

.page-title{

    background:#d2d2d2;
    padding:28px 15px;
    margin-bottom:25px;
}

.page-title h1{

    font-size:clamp(1.6rem,3vw,2.2rem);

    font-weight:600;

    color:#333;
}

/************************************************
    CONTENT BOX
************************************************/

.content-box{

    background:#ffffff;

    border:1px solid #dddddd;

    border-radius:8px;

    padding:35px;

    box-shadow:

        0 3px 12px rgba(0,0,0,.08);

    margin-bottom:30px;
}

/************************************************
    SECTION TITLE
************************************************/

.section-title{

    font-size:clamp(1.3rem,2vw,1.8rem);

    color:#222;

    margin-bottom:20px;

    font-weight:bold;
}

/************************************************
    PARAGRAPHS
************************************************/

.content-box p{

    font-size:16px;

    margin-bottom:18px;

    text-align:justify;
}

.content-box a{

    color:#0056b3;

    text-decoration:none;

    font-weight:600;
}

.content-box a:hover{

    text-decoration:underline;
}
</style>

<!-- Facebook SDK -->
<div id="fb-root"></div>

<script async defer crossorigin="anonymous"
src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v23.0">
</script>

</head>

<body>

<div class="wrapper">

<?php require_once __DIR__ . '/header.php'; ?>

<div class="page-title">

    <h1>Return &amp; Refund Policy</h1>

</div>
<div class="content-box">
	    <section aria-labelledby="refund-policy-heading">

        <h2 id="refund-policy-heading" class="section-title">
            Cancellation &amp; Refund Policy
        </h2>

        <p>
            As of now, Look8US does not provide any option for cancellation of
            products and/or services that have already been purchased or
            subscribed to.
        </p>

        <p>
            Once a product or service has been purchased, we are unable to
            provide a refund, either in full or in part. Therefore, we strongly
            recommend that users carefully review all available information,
            demonstrations, trial features, and free content before making any
            purchase or subscription.
        </p>

        <p>
            We encourage every customer to evaluate our products and services
            thoroughly before completing a transaction to ensure that they meet
            their requirements.
        </p>

        <p>
            If you require additional information regarding our Return and
            Refund Policy, or if you have any questions related to a purchase,
            subscription, or service, please feel free to contact our support
            team.
        </p>

        <p>

            <strong>Phone:</strong>

            <a href="tel:+918955989444">
                +91 8955989444
            </a>

        </p>

        <p>

            <strong>Email:</strong>

            <a href="mailto:look8us@yahoo.com">
                look8us@yahoo.com
            </a>

            <br><br>

            <strong>Support:</strong>

            <a href="mailto:support@look8us.com">
                support@look8us.com
            </a>

        </p>

        <hr style="margin:30px 0; border:0; border-top:1px solid #dddddd;">

        <p style="font-size:15px;color:#666666;">

            This Return and Refund Policy is applicable to all products,
            subscriptions, advertisements, listings, promotional services,
            digital services, and other offerings made available through
            Look8US unless explicitly stated otherwise in writing.

        </p>

    </section>

</div>
<?php require_once __DIR__ . '/footer.php'; ?>

</div>
</body>
</html>
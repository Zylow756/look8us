<?php
declare(strict_types=1);

require_once __DIR__ . "/config.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Language" content="en-us">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Contact Us | Look8US Business Directory Kota Rajasthan</title>

    <meta name="description" content="Contact Look8us.com, your local business directory and yellow pages service in Kota, Rajasthan.">
    <meta name="keywords" content="Look8us.com, yellow pages Kota Rajasthan, business directory Kota Rajasthan India, online business directory, contact Look8us">

    <link rel="stylesheet" type="text/css" href="akc.css">

    <style>
        body {
            margin: 0;
            font-family: Arial, Verdana, sans-serif;
            background: url("images/bg.png");
            color: #1f2933;
        }

        .page-title {
            background: #d2d2d2;
            padding: 26px 16px;
        }

        .page-title-inner {
            max-width: 1010px;
            margin: 0 auto;
        }

        .page-title h1 {
            margin: 0;
            font-size: 30px;
            font-weight: 500;
            color: #333;
        }

        .content-wrap {
            max-width: 1020px;
            margin: 0 auto;
            background: #fff;
            min-height: 420px;
            padding: 32px 20px;
            box-sizing: border-box;
        }

        .contact-grid {
            display: grid;
            grid-template-columns: 1.2fr 0.8fr;
            gap: 32px;
            align-items: start;
        }

        .brand-logo {
            max-width: 224px;
            height: auto;
            margin-bottom: 20px;
        }

        .contact-card {
            color: #0057ae;
            font-size: 14px;
            line-height: 1.8;
        }

        .contact-card h2 {
            margin: 0 0 16px;
            font-size: 22px;
            color: #003f7d;
        }

        .contact-row {
            margin-bottom: 10px;
        }

        .contact-label {
            font-weight: bold;
            display: inline-block;
            min-width: 75px;
        }

        .contact-card a {
            color: #0057ae;
            text-decoration: none;
        }

        .contact-card a:hover {
            text-decoration: underline;
        }

        .ad-box {
            border: 1px solid #e3e3e3;
            min-height: 309px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 24px;
            box-sizing: border-box;
            background: #fff;
        }

        .ad-box h2 {
            margin: 0 0 8px;
            color: #0066cc;
            font-size: 18px;
        }

        .ad-box strong {
            color: #ff3300;
            font-size: 22px;
        }

        .ad-box small {
            color: #ff3300;
        }

        .copyright {
            margin-top: 24px;
            color: #0057ae;
            font-size: 14px;
            font-weight: bold;
        }

        @media (max-width: 768px) {
            .contact-grid {
                grid-template-columns: 1fr;
            }

            .page-title h1 {
                font-size: 24px;
            }

            .content-wrap {
                padding: 24px 14px;
            }
        }
    </style>
</head>

<body>

<div align="center">
    <?php require_once __DIR__ . "/header.php"; ?>
</div>

<section class="page-title">
    <div class="page-title-inner">
        <h1>Contact Us</h1>
    </div>
</section>

<main class="content-wrap">
    <div class="contact-grid">
        <section class="contact-card">
            <img src="logo_small.jpg" alt="Look8US" class="brand-logo">

            <h2>Look8US.com</h2>

            <div class="contact-row">
                <span class="contact-label">Address:</span>
                309 Mahaveer Nagar-II, Kota<br>
                <span class="contact-label"></span>
                Pin - 324005, Rajasthan, INDIA
            </div>

            <div class="contact-row">
                <span class="contact-label">Phone:</span>
                8955989444
            </div>

            <div class="contact-row">
                <span class="contact-label">Email:</span>
                <a href="mailto:info@look8us.com">info@look8us.com</a>,
                <a href="mailto:support@look8us.com">support@look8us.com</a>,
                <a href="mailto:look8us@yahoo.com">look8us@yahoo.com</a>
            </div>

            <p class="copyright">
                Copyright &copy; <?php echo date("Y"); ?> Look8us.com. All rights reserved.
            </p>
        </section>

        <aside class="ad-box">
            <div>
                <h2>Place your Ads here</h2>
                <strong>Ads No. #02</strong><br>
                <small>(11cm * 8cm)</small>
                <p>Contact us for this space.</p>
            </div>
        </aside>
    </div>
</main>

<div align="center">
    <?php require_once __DIR__ . "/footer.php"; ?>
</div>

</body>
</html>
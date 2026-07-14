<?php
declare(strict_types=1);

require_once __DIR__ . '/config.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<link rel="stylesheet" href="akc.css">
 <style>
	.site-footer{
    width:100%;
    font-family:Arial, Helvetica, sans-serif;
    margin-top:20px;
}

.footer-top{
    background:#0066ff;
    color:#fff;
    display:flex;
    justify-content:space-between;
    align-items:center;
    flex-wrap:wrap;
    padding:12px 20px;
    gap:15px;
}

.footer-links{
    display:flex;
    flex-wrap:wrap;
    gap:10px;
    align-items:center;
}

.footer-links a{
    color:#fff;
    text-decoration:none;
    transition:.3s;
}

.footer-links a:hover{
    color:#ffe082;
}

.footer-counter{
    color:#fff;
    font-size:14px;
}

.footer-bottom{
    background:#000;
    color:#999;
    display:flex;
    justify-content:space-between;
    align-items:center;
    flex-wrap:wrap;
    padding:15px 20px;
    gap:15px;
    font-size:14px;
}

.footer-bottom a{
    color:#fff;
    text-decoration:none;
}

.footer-office{
    text-align:center;
    flex:1;
}

.footer-powered,
.footer-copy{
    white-space:nowrap;
}
 </style>

<footer class="site-footer">

    <div class="footer-top">

        <div class="footer-links">

            <a href="<?= htmlspecialchars($path, ENT_QUOTES, 'UTF-8'); ?>payment/subscribe.php">
                Subscribe
            </a>

            <span>|</span>

            <a href="<?= htmlspecialchars($path, ENT_QUOTES, 'UTF-8'); ?>ReturnPolicy.php">
                Refund Policy
            </a>

            <span>|</span>

            <a href="<?= htmlspecialchars($path, ENT_QUOTES, 'UTF-8'); ?>PrivacyPolicy.php">
                Privacy Policy
            </a>

            <span>|</span>

            <a href="<?= htmlspecialchars($path, ENT_QUOTES, 'UTF-8'); ?>terms.php">
                Terms of Use
            </a>

        </div>

        <div class="footer-counter">

            <strong>Hits :</strong>

            <!-- StatCounter -->
            <script>
                var sc_project = 9945831;
                var sc_invisible = 0;
                var sc_security = "57e02267";
                var scJsHost = (("https:" === document.location.protocol)
                    ? "https://secure."
                    : "http://www.");

                document.write(
                    "<script src='" +
                    scJsHost +
                    "statcounter.com/counter/counter.js'><\/script>"
                );
            </script>

            <noscript>
                <div class="statcounter">
                    <a href="https://statcounter.com/" target="_blank" rel="noopener">
                        <img
                            class="statcounter"
                            src="https://c.statcounter.com/9945831/0/57e02267/0/"
                            alt="Website statistics">
                    </a>
                </div>
            </noscript>

        </div>

    </div>

    <div class="footer-bottom">

        <div class="footer-powered">
            Powered by :
            <a href="#">
                WEBSOFT SOLUTIONS
            </a>
        </div>

        <div class="footer-office">
            <strong>Head Office :</strong>
            309 Mahaveer Nagar-II, Kota, Rajasthan |
            Email :
            <a href="mailto:support@look8us.com">
                support@look8us.com
            </a>
        </div>

        <div class="footer-copy">
            Copyright
            <a href="Admin/index.php">
                &copy; 2014
            </a>
        </div>

    </div>

</footer>
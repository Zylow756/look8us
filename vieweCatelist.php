<?php
declare(strict_types=1);/*
|--------------------------------------------------------------------------
| Configuration
|--------------------------------------------------------------------------
*/
require_once __DIR__ . "/config.php";
/*
|--------------------------------------------------------------------------
| Secure Session Handling
|--------------------------------------------------------------------------
*/
if (session_status() === PHP_SESSION_NONE) {    session_set_cookie_params([
        'lifetime' => 0,
        'path'     => '/',
        'secure'   => (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'),
        'httponly' => true,
        'samesite' => 'Lax'
    ]);    session_start();
}
/*
|--------------------------------------------------------------------------
| Security Headers
|--------------------------------------------------------------------------
*/
header("X-Frame-Options: SAMEORIGIN");
header("X-Content-Type-Options: nosniff");
header("Referrer-Policy: strict-origin-when-cross-origin");
/*
|--------------------------------------------------------------------------
| Helper Functions
|--------------------------------------------------------------------------
*/function escapeHtml(?string $value): string
{
    return htmlspecialchars(
        $value ?? '',
        ENT_QUOTES | ENT_SUBSTITUTE,
        'UTF-8'
    );
}
/*
|--------------------------------------------------------------------------
| Validate Category ID
|--------------------------------------------------------------------------
*/$categoryId = filter_input(
    INPUT_GET,
    'id',
    FILTER_VALIDATE_INT
);
if (!$categoryId || $categoryId <= 0) {    $categoryId = 0;}
/*
|--------------------------------------------------------------------------
| Fetch Category Details
|--------------------------------------------------------------------------
*/$category = null;
if ($categoryId > 0) {    $stmt = mysqli_prepare(
        $con,
        "
        SELECT 
            ecateid,
            catename,
            cateimg
        FROM ecate
        WHERE ecateid = ?
        LIMIT 1
        "
    );
    if ($stmt) {        mysqli_stmt_bind_param(
            $stmt,
            "i",
            $categoryId
        );
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if ($result) {            $category = mysqli_fetch_assoc($result);        }
        mysqli_stmt_close($stmt);    }}?>
<!DOCTYPE html>
<html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>
Look8US : Business Directory Kota Rajasthan India | Verified Businesses
</title>
<meta name="description"
content="Look8us.com from Kota Rajasthan is your local business directory. Find verified businesses, exporters, manufacturers, suppliers, products and services."
>
<meta name="keywords"
content="Look8us, Business Directory Kota Rajasthan, Yellow Pages Kota, Indian Business Directory, Manufacturers, Suppliers, Exporters, B2B Portal"
>
<link rel="stylesheet" href="akc.css">
<style>
* {
    box-sizing:border-box;
}
body {    margin:0;    padding:0;    background:#f5f5f5 url("images/bg.png");    font-family:
    Arial,
    Helvetica,
    sans-serif;    color:#333;}.page-container {    width:100%;    max-width:1200px;    margin:auto;    background:#ffffff;}.section-title {
    background:#d2d2d2;    padding:15px;    margin-top:10px;}.section-title h1 {
    margin:0;    font-size:clamp(22px,3vw,32px);    color:#333;}.category-box {
    width:95%;    max-width:850px;    margin:30px auto;    background:white;    border-radius:8px;    overflow:hidden;    box-shadow:
    0 3px 12px rgba(0,0,0,.15);}.category-header {
    background:
    rgba(0,90,180,0.9);    color:white;    padding:12px;    text-align:center;
}.category-header h2 {
    margin:0;    font-size:clamp(20px,3vw,28px);
}.category-content {
    display:flex;    gap:20px;    padding:20px;
}.category-image {
    flex:0 0 35%;    text-align:center;}.category-image img {
    width:100%;    max-width:280px;    height:auto;    border-radius:5px;    box-shadow:
    0 3px 8px rgba(0,0,0,.25);    opacity:.9;}.website-list {
    flex:1;}.website-item {
    padding:12px;    border-bottom:1px dotted #bbb;}.website-item a.big {
    font-size:18px;    color:#005ab4;    text-decoration:none;    font-weight:bold;
}.website-item a:hover {
    text-decoration:underline;}.website-info {
    font-size:14px;    margin-top:5px;
}</style>
</head>
<body>
<div class="page-container">
<?php require_once __DIR__ . "/header.php"; ?>
<div class="section-title"><h1>
Buy Product Now..
</h1></div>
<!--
|--------------------------------------------------------------------------
| Category Display Section
|--------------------------------------------------------------------------
--><div class="category-box">
    <div class="category-header">        <h2>
        <?php        if ($category !== null) {            echo escapeHtml(
                $category['catename']
            );        } else {            echo "Category Not Found";        }        ?>
        </h2>    </div>    <div class="category-content">
        <!--
        |--------------------------------------------------------------------------
        | Category Image
        |--------------------------------------------------------------------------
        -->        <div class="category-image">
            <?php            if (
                $category !== null &&
                !empty($category['cateimg'])
            ) {
                /*
                |--------------------------------------------------------------------------
                | Secure Image Filename Handling
                |--------------------------------------------------------------------------
                */
                $imageName = basename(
                    $category['cateimg']
                );
                $imagePath =
                "User/logo//" .
                $imageName;
            ?>                <img
                    src="<?= escapeHtml($imagePath); ?>"
                    alt="<?= escapeHtml($category['catename']); ?>"
                    loading="lazy"
                >
            <?php            } else {            ?>                <img
                    src="images/no-image.png"
                    alt="No Image Available"
                    loading="lazy"
                >            <?php            }            ?>
        </div>        <!--
        |--------------------------------------------------------------------------
        | Website Listing Section
        |--------------------------------------------------------------------------
        -->        <div class="website-list">
        <?php
        if ($categoryId > 0) {
            $websiteStmt = mysqli_prepare(
                $con,
                "
                SELECT
                    wname,
                    wlink,
                    mobile
                FROM eweblink
                WHERE cateid = ?
                ORDER BY wname ASC
                "
            );            if ($websiteStmt) {
                mysqli_stmt_bind_param(
                    $websiteStmt,
                    "i",
                    $categoryId
                );
                mysqli_stmt_execute(
                    $websiteStmt
                );
                $websiteResult =
                mysqli_stmt_get_result(
                    $websiteStmt
                );                if (
                    $websiteResult &&
                    mysqli_num_rows($websiteResult) > 0
                ) {                    while (
                        $website =
                        mysqli_fetch_assoc($websiteResult)
                    ) {
                        /*
                        |--------------------------------------------------------------------------
                        | Secure Website URL Processing
                        |--------------------------------------------------------------------------
                        */
                        $websiteLink =
                        trim(
                            $website['wlink']
                        );
                        /*
                        Add protocol if missing
                        */                        if (
                            !preg_match(
                                '#^https?://#i',
                                $websiteLink
                            )
                        ) {                            $websiteLink =
                            "https://" .
                            $websiteLink;                        }        ?>
            <div class="website-item">
                <a
                    class="big"
                    href="<?= escapeHtml($websiteLink); ?>"
                    target="_blank"
                    rel="noopener noreferrer"
                >
                    <?= escapeHtml($website['wname']); ?>
                </a>                <div class="website-info">
                    Website :                    <a
                        class="a1"
                        href="<?= escapeHtml($websiteLink); ?>"
                        target="_blank"
                        rel="noopener noreferrer"
                    >                    <?= escapeHtml($website['wlink']); ?>                    </a>
                    <br>
                    Contact No :                    <?= escapeHtml(
                        $website['mobile']
                    ); ?>
                </div>
            </div>        <?php
                    }
                } else {
        ?>
            <div class="website-item">                No website information available.            </div>
        <?php
                }
                mysqli_stmt_close(
                    $websiteStmt
                );
            }
        }
        ?>
        </div>
    </div>
</div>
<?php 
if (isset($con) && $con instanceof mysqli) {    mysqli_close($con);}?>
</div>
<footer>
	<?php
require_once __DIR__ . "/footer.php";?></footer></div>
</body></html>
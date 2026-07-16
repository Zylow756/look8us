<?php
declare(strict_types=1);
require_once __DIR__ . "/config.php";/*
|--------------------------------------------------------------------------
| Secure Session Configuration
|--------------------------------------------------------------------------
*/if (session_status() === PHP_SESSION_NONE) {    session_set_cookie_params([
        'lifetime' => 0,
        'path'     => '/',
        'domain'   => '',
        'secure'   => isset($_SERVER['HTTPS']),
        'httponly' => true,
        'samesite' => 'Lax'
    ]);    session_start();
}
/*
|--------------------------------------------------------------------------
| Security Headers
|--------------------------------------------------------------------------
*/header("X-Frame-Options: SAMEORIGIN");
header("X-Content-Type-Options: nosniff");
header("Referrer-Policy: strict-origin-when-cross-origin");
/*
|--------------------------------------------------------------------------
| Helper Functions
|--------------------------------------------------------------------------
*/
/**
 * Secure HTML output
 */
function e(?string $value): string
{
    return htmlspecialchars(
        $value ?? '',
        ENT_QUOTES | ENT_SUBSTITUTE,
        'UTF-8'
    );
}
/**
 * Safe database value check
 */
function validValue(?string $value): string
{
    return trim($value ?? '');
}
/**
 * Check empty old database values
 */
function showValue(?string $value): string
{
    if ($value === null || $value === '' || $value === '-') {
        return '';
    }    return ucwords(e($value));
}
/*
|--------------------------------------------------------------------------
| Validate Search Category ID
|--------------------------------------------------------------------------
*/$categoryId = filter_input(
    INPUT_GET,
    'id',
    FILTER_VALIDATE_INT
);
$category = null;
if ($categoryId !== false && $categoryId !== null) {
    $sql = "
        SELECT 
            category.cname,
            catedetail.cdname
        FROM category
        INNER JOIN catedetail
            ON category.cateid = catedetail.cateid
        WHERE catedetail.catdid = ?
        LIMIT 1
    ";
    $stmt = mysqli_prepare($con, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param(
            $stmt,
            "i",
            $categoryId
        );
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if ($result) {            $category = mysqli_fetch_assoc($result);        }
        mysqli_stmt_close($stmt);    }}
?>
<!DOCTYPE html>
<html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>
    Search Result - Online Directory Service
</title>
<meta name="description"
content="Search results from Online Directory Service">
<link rel="stylesheet" href="akc.css"><link rel="stylesheet" href="css/backbox.css">
<style>
* {
    box-sizing:border-box;
}
body {    margin:0;    padding:0;    font-family:
    Arial,
    Helvetica,
    sans-serif;    background:
    url("images/bg.png");    color:#121212;}
.container {    width:100%;    max-width:1200px;    margin:auto;    padding:15px;}
.page-title {    background:#d2d2d2;    padding:20px;    margin-bottom:20px;}
.page-title h1 {    margin:0;    font-size:clamp(24px,4vw,38px);    color:#333;}
.result-box {    background:#fff;    border:1px solid #ddd;    padding:15px;    width:100%;}
.search-header {    background:#0066ff;    color:#fff;    padding:12px;    font-weight:bold;    font-size:16px;}
.member-card {    border-bottom:5px solid #e3e3e3;    padding:15px 0;}
.member-top {    display:flex;    flex-wrap:wrap;    gap:20px;}
.member-logo {    width:110px;    text-align:center;}
.member-logo img {    max-width:90px;    height:auto;}
.company-name {    font-size:22px;    font-weight:bold;    color:#003399;}
.member-info {    flex:1;}
.details-grid {    display:grid;    grid-template-columns:
    repeat(auto-fit,minmax(280px,1fr));    gap:15px;}
.member-image img {    width:100%;    max-width:190px;}
.social-icons img {    width:25px;    height:25px;    margin-right:5px;}
.about-section {    margin-top:20px;    padding:15px;    background:#f8f8f8;    border-radius:8px;}
.about-section h3 {    margin-top:0;    color:#003399;}.social-section {    margin-top:15px;}
.social-icons {    display:flex;    gap:10px;    margin-top:10px;}.social-icons img {    width:28px;    height:28px;    object-fit:contain;}.member-footer {    display:flex;    justify-content:space-between;    align-items:center;    margin-top:15px;}.verified img {    width:90px;    height:auto;}.view-details-btn {
display:inline-block;background:#0066ff;color:#fff;padding:8px 18px;border-radius:5px;text-decoration:none;font-weight:bold;
}.view-details-btn:hover {
background:#004bb5;
}.no-result {    text-align:center;    padding:40px;    background:#fff;    border:1px solid #ddd;}
</style></head>
<body>
<?php
require_once __DIR__ . "/header.php";?>
<main class="container">
<section class="page-title">    <h1>
        Search Result
    </h1></section><section class="result-box">
<?php if ($categoryId !== false && $categoryId !== null): ?>
<div class="search-header">
    Search Results for :    <span style="color:#ffff00;">
    <?php    if ($category) {        echo e($category['cname']);        echo " &raquo; ";        echo e($category['cdname']);    } else {        echo "Category Not Found";    }    ?>
    </span>
</div>
<?php
$members = [];
if ($categoryId) {
    $memberSql = "        SELECT            member.*,
            memberdetail.*        FROM member        INNER JOIN memberdetail            ON member.mid = memberdetail.mid
        WHERE memberdetail.catdid = ?
        ORDER BY            member.rating ASC,            member.mname ASC    ";
    $memberStmt = mysqli_prepare(
        $con,
        $memberSql
    );
    if ($memberStmt) {
        mysqli_stmt_bind_param(
            $memberStmt,
            "i",
            $categoryId
        );
        mysqli_stmt_execute(
            $memberStmt
        );
        $memberResult =
            mysqli_stmt_get_result(
                $memberStmt
            );
        if ($memberResult) {
            while ($memberRow =
                mysqli_fetch_assoc($memberResult)
            ) {
                $members[] = $memberRow;
            }
        }
        mysqli_stmt_close(
            $memberStmt
        );
    }
}
?><?php if (!empty($members)): ?>
<?php foreach ($members as $row): ?>
<article class="member-card"><div class="member-top">
	<?php
$isPremium =
(
    $row['mplan'] === "Gold"
    ||
    $row['mplan'] === "Platinum"
);if (
    $isPremium
    &&
    !empty($row['logo'])
    &&
    $row['logo'] !== "-"
):?>
<div class="member-logo">
<a 
href="https://<?= e($row['web']) ?>"
target="_blank"
rel="noopener noreferrer"
>
<imgsrc="user/logo/<?= e($row['logo']) ?>"alt="<?= e($row['compname']) ?> Logo"loading="lazy"/>
</a>
</div>
<?php 
endif; 
?>
<div class="member-info">
<div class="company-name"><?= e($row['compname']) ?>
</div><p>
<strong>
Contact:
</strong>
<?= e(ucwords($row['mname'])) ?>
</p>
<?php
if (
    !empty($row['tagline'])
    &&
    $row['tagline'] !== "-"
):
?>
<p><em>
	<?= e($row['tagline']) ?></em></p>
<?php endif; ?>
</div></div>
<?php
$memberImage = null;
if ($isPremium) {
    $imageSql = "        SELECT img        FROM memberimage        WHERE mid = ?        LIMIT 1    ";
    $imageStmt = mysqli_prepare(
        $con,
        $imageSql
    );
    if ($imageStmt) {
        mysqli_stmt_bind_param(
            $imageStmt,
            "i",
            $row['mid']
        );
        mysqli_stmt_execute(
            $imageStmt
        );
        $imageResult =
            mysqli_stmt_get_result(
                $imageStmt
            );
        if ($imageResult) {            $memberImage =
                mysqli_fetch_assoc(
                    $imageResult
                );        }
        mysqli_stmt_close(
            $imageStmt
        );
    }
}$imagePath =
    "user/logo/no-images.jpg";
if (
    $memberImage
    &&
    !empty($memberImage['img'])
) {
    $imagePath =
        "user/logo/" .
        $memberImage['img'];}?><div class="details-grid"><?php if ($isPremium): ?>
<div class="member-image">
<a href="clientSlide.php?id=<?= e((string)$row['mid']) ?>">
<imgsrc="<?= e($imagePath) ?>"alt="Company Images"loading="lazy"/>
</a>
</div>
<?php endif; ?>
<div class="contact-details"><p><strong>
Address:
</strong>
<?php
$address = [];
if (
    !empty($row['shopno'])
    &&
    $row['shopno'] !== "-"
) {    $address[] =
        ucwords($row['shopno']);}
if (
    !empty($row['address'])
    &&
    $row['address'] !== "-"
) {    $address[] =
        ucwords($row['address']);}
echo e(
    implode(
        ", ",
        $address
    )
);
?>
</p>
<p><strong>
Area:
</strong>
<?=e(    (
        !empty($row['area'])
        &&
        $row['area'] !== "-"
    )    ?    ucwords($row['area'])    :    "")?>
</p>
<p><strong>
City / State:
</strong>
<?= e(ucwords($row['city'])) ?>
<?php
if (
    !empty($row['pin'])
    &&
    $row['pin'] !== "-"
) {    echo " - " .
    e($row['pin']);}
?>
,<?= e(ucwords($row['state1'])) ?>
</p><p><strong>
Phone:
</strong>
<?= e($row['phone']) ?>
<?php
if (
    !empty($row['phone1'])
    &&
    $row['phone1'] !== "-"
) {
    echo " , " .
    e($row['phone1']);}
?>
</p>
<p><strong>
Mobile:
</strong>
<?= e($row['mobile']) ?>
<?php
if (
    !empty($row['mobile1'])
    &&
    $row['mobile1'] !== "-"
) {
    echo " , " .
    e($row['mobile1']);}
?>
</p><p><strong>
Email:
</strong>
<a href="mailto:<?= e($row['email']) ?>">
<?= e($row['email']) ?>
</a>
</p><p><strong>
Website:
</strong>
<?php if (!empty($row['web'])): ?>
<ahref="https://<?= e($row['web']) ?>"target="_blank"rel="noopener noreferrer">
<?= e($row['web']) ?>
</a>
<?php endif; ?>
</p></div></div><?php if (!empty($row['remark']) && $row['remark'] !== "-"): ?>
<div class="about-section">
<h3>
    About Us
</h3>
<p><?= nl2br(e($row['remark'])) ?>
</p>
</div>
<?php endif; ?><?php if ($isPremium): ?>
<div class="social-section">
<strong>
Follow:
</strong>
<div class="social-icons"><?php if (
    !empty($row['twiter'])
    &&
    $row['twiter'] !== "-"
): ?>
<ahref="https://<?= e($row['twiter']) ?>"target="_blank"rel="noopener noreferrer"aria-label="Twitter"
>
<img
src="<?= e($path) ?>images/twitter-icon.png"
alt="Twitter"
loading="lazy"
>
</a>
<?php endif; ?>
<?php if (
    !empty($row['facebook'])
    &&
    $row['facebook'] !== "-"
): ?>
<a
href="https://<?= e($row['facebook']) ?>"
target="_blank"
rel="noopener noreferrer"
aria-label="Facebook"
>
<img
src="<?= e($path) ?>images/facebook-icon.png"
alt="Facebook"
loading="lazy">
</a>
<?php endif; ?>
<?php if (
    !empty($row['linken'])
    &&
    $row['linken'] !== "-"
): ?>
<a
href="https://<?= e($row['linken']) ?>"
target="_blank"
rel="noopener noreferrer"
aria-label="LinkedIn">
<img
src="<?= e($path) ?>images/linkedin-icon.png"
alt="LinkedIn"
loading="lazy"
>
</a>
<?php endif; ?>
<?php if (
    !empty($row['ytube'])
    &&
    $row['ytube'] !== "-"
): ?>
<a
href="https://<?= e($row['ytube']) ?>"
target="_blank"
rel="noopener noreferrer"
aria-label="YouTube"
>
<img
src="<?= e($path) ?>images/uTube.png"
alt="YouTube"
loading="lazy"
>
</a>
<?php endif; ?>
</div>
</div>
<?php endif; ?>
<div class="member-footer">
<div class="rating"><?php if (
    !empty($row['a'])
    &&
    $row['a'] !== "-"
): ?>
<strong>
Rating:
</strong>
<?= e($row['a']) ?>
<?php endif; ?>
</div>
<div class="verified">
<?php if (
    isset($row['verify'])
    &&
    $row['verify'] === "Verified"
): ?><img
src="images/VerifiedLogo.jpg"
alt="Verified Member"
loading="lazy"
>
<?php endif; ?>
</div>
</div>
<?php if (
    isset($row['mplan'])
    &&
    $row['mplan'] === "Platinum"
): ?>
<div class="premium-action">
<a
href="clientweb.php?id=<?= e((string)$row['mid']) ?>"
class="view-details-btn"
>
View More Details &raquo;
</a>
</div><?php endif; ?>
</article>
<?php endforeach; ?>
<?php else: ?>
<div class="no-result">
<h3>
    No Search Result Found
</h3>
<p>
    No business records were found for this category.
</p></div>
<?php endif; ?>
<?php else: ?>
<div class="no-result">
<h3>
    Invalid Search Request
</h3>
<p>
    Please select a valid category.
</p>
</div>
<?php endif; ?>
</section>
</main>
<?php
require_once __DIR__ . "/footer.php";
?>
<script 
src="js/customsignsfooter.js"
defer>
</script>
</body>
</html>
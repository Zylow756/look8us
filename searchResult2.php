<?php
declare(strict_types=1);
require_once __DIR__ . "/config.php";/*
|--------------------------------------------------------------------------
| Secure Session Handling
|--------------------------------------------------------------------------
*/
if (session_status() === PHP_SESSION_NONE) {    session_set_cookie_params([
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
| Helper Functions
|--------------------------------------------------------------------------
*/function e(?string $value): string
{
    return htmlspecialchars(
        $value ?? '',
        ENT_QUOTES | ENT_HTML5,
        'UTF-8'
    );
}
function valueOrEmpty(?string $value): string
{
    return ($value !== null && $value !== "-")
        ? e($value)
        : '';
}
function buildWebsiteUrl(?string $url): string
{
    if (empty($url) || $url === "-") {
        return '#';
    }    if (!preg_match('#^https?://#i', $url)) {
        return 'https://' . $url;
    }    return $url;
}/*
|--------------------------------------------------------------------------
| Search Processing
|--------------------------------------------------------------------------
*/$item = trim($_GET['item'] ?? '');
$loc  = trim($_GET['loc'] ?? '');$members = [];
try {   
	    if (
        $item === "Enter your search Product or Company" ||
        $item === ""
    ) {        if (
            $loc !== "" &&
            $loc !== "Location"
        ) {            $sql = "
                SELECT *
                FROM member
                WHERE city LIKE ?
                ORDER BY RAND()
                LIMIT 15
            ";            $stmt = mysqli_prepare($con, $sql);            $searchLoc = $loc . "%";            mysqli_stmt_bind_param(
                $stmt,
                "s",
                $searchLoc
            );        } else {            $sql = "
                SELECT *
                FROM member
                ORDER BY RAND()
                LIMIT 15
            ";            $stmt = mysqli_prepare($con, $sql);
        }
    } else {
        if (
            $loc !== "" &&
            $loc !== "Location"
        ) {            $sql = "
                SELECT *
                FROM member
                WHERE 
                (
                    mname LIKE ?
                    OR
                    compname LIKE ?
                )
                AND city LIKE ?
                ORDER BY rating, RAND()
                LIMIT 15
            ";            $stmt = mysqli_prepare($con, $sql);
            $searchItem1 = $item . "%";
            $searchItem2 = "%" . $item . "%";
            $searchLoc    = $loc . "%";
            mysqli_stmt_bind_param(
                $stmt,
                "sss",
                $searchItem1,
                $searchItem2,
                $searchLoc
            );
        } else {
            $sql = "
                SELECT *
                FROM member
                WHERE
                (
                    mname LIKE ?
                    OR
                    compname LIKE ?
                )
                ORDER BY rating, RAND()
                LIMIT 15
            ";
            $stmt = mysqli_prepare($con, $sql);
            $searchItem1 = $item . "%";
            $searchItem2 = "%" . $item . "%";
            mysqli_stmt_bind_param(
                $stmt,
                "ss",
                $searchItem1,
                $searchItem2
            );        }    }
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    while ($row = mysqli_fetch_assoc($result)) {        $members[] = $row;    }
    mysqli_stmt_close($stmt);
} catch (Throwable $error) {    error_log(
        "Search Error : " . $error->getMessage()
    );    $members = [];}
?>
<!DOCTYPE html>
<html lang="en"><head><meta charset="UTF-8"><meta name="viewport"
      content="width=device-width, initial-scale=1.0">
<title>
Online Directory Service - Search Result
</title>
<meta name="description"
      content="Search company and business listings in our online directory service">
<link rel="stylesheet"
      href="akc.css">
<style>
body {    margin:0;    padding:0;    background:#f4f4f4;    font-family:
    Arial,
    Helvetica,
    sans-serif;}
.page-container {    width:100%;    max-width:1200px;    margin:auto;}
.page-title {    background:#d2d2d2;    padding:20px;    margin-bottom:20px;}
.page-title h1 {    margin:0;    color:#333;    font-size:clamp(
        24px,
        4vw,
        38px
    );}
.search-wrapper {    background:#fff;    padding:20px;    border-radius:8px;    box-shadow:
    0 2px 8px rgba(
        0,
        0,
        0,
        .1
    );}.search-header {
    background:#0066ff;    color:white;    padding:12px;    font-size:16px;    font-weight:bold;    border-radius:5px 5px 0 0;}.member-card {
    background:white;    border-bottom:
    5px solid #e3e3e3;    padding:20px 10px;}
.member-card img {
    max-width:100%;    height:auto;}@media(max-width:768px){
.page-container{    padding:10px;}
.search-wrapper{    padding:10px;}
.member-card{    padding:15px 5px;}
}
.company-top {    display:flex;    flex-wrap:wrap;    gap:20px;    align-items:flex-start;}.company-logo {    width:120px;    text-align:center;}
.company-logo img {    width:90px;    height:85px;    object-fit:contain;    border-radius:5px;}.company-info {    flex:1;    min-width:250px;}
.company-info h2 {
    color:#003399;    font-size:clamp(
        20px,
        3vw,
        28px
    );    margin:0 0 10px;}
.company-info p {
    margin:5px 0;    line-height:1.6;}
.tagline {
    color:#cc3300;    font-weight:bold;}
.member-details {
    display:flex;    flex-wrap:wrap;    gap:20px;    margin-top:20px;}.company-gallery {
    flex:0 0 210px;    text-align:center;
}.company-gallery img {
    width:190px;    height:180px;    object-fit:cover;    border:1px solid #ddd;    border-radius:8px;}.company-contact {
    flex:1;    min-width:280px;}.contact-table {
    width:100%;    border-collapse:collapse;}
.contact-table td {
    padding:8px;    vertical-align:top;    color:#121212;}
.contact-extra {    width:100%;    margin-top:15px;}.contact-table td:first-child {
    width:120px;}.contact-table a {
    color:#003399;    text-decoration:none;}.contact-table a:hover {
    text-decoration:underline;}.social-section {
    margin-top:20px;    padding:10px 0;
}.social-icons {
    display:flex;    gap:10px;    margin-top:10px;
}.social-icons img {
    width:28px;    height:28px;    object-fit:contain;    transition:
    transform .2s ease;
}.social-icons img:hover {
    transform:scale(1.15);
}.about-company {
    margin-top:20px;    padding:15px;    background:#fafafa;    border-left:4px solid #0066ff;    line-height:1.7;
}.about-company p {
    margin:8px 0;    text-align:justify;
}
.rating-section {
    display:flex;    justify-content:space-between;    align-items:center;    padding:15px;    margin-top:15px;    border-top:1px solid #eee;
}.rating-box {
    color:#121212;    font-size:14px;
}.verified-logo {
    width:80px;    height:auto;
}.premium-detail {
    margin-top:15px;
}.detail-button {
    width:166px;    height:26px;    cursor:pointer;
}.more-search {
    text-align:center;    margin:25px 0;
}.more-button {
    background:#0066ff;    color:white;    border:none;    padding:10px 35px;    border-radius:5px;    font-size:16px;    cursor:pointer;
}.more-button:hover {
    background:#004dcc;
}
</style>
</head>
<body>
<div class="page-container">
<?php
 require_once "header.php"; ?><section class="page-title"><h1>
Search Result
</h1></section><section class="search-wrapper">
<form action="searchResult2.php" method="get"><?php if (!empty($item) || !empty($loc)) : ?>
<div class="search-header">Search Company Result For :
<?= e($item) ?></div>
<div class="results-container">
<?php
 foreach ($members as $row): ?>
<article class="member-card">
<div class="member-top">
<?php
$isPremium =
    ($row['mplan'] ?? '') === "Gold" ||
    ($row['mplan'] ?? '') === "Platinum";
?>
<?php
 if ($isPremium && !empty($row['logo']) && $row['logo'] !== "-") : ?>
<div class="company-logo"><a href="<?= e(buildWebsiteUrl($row['web'] ?? '')) ?>"
   target="_blank"
   rel="noopener noreferrer">
<img
src="user/logo/<?= e($row['logo']) ?>"
alt="<?= e($row['compname'] ?? 'Company Logo') ?>"
loading="lazy"
>
</a></div>
<?php
 endif; ?><div class="company-info">
<h2><?= e($row['compname'] ?? '') ?></h2><p><strong>
Contact :
</strong><?= e(
    ucwords($row['mname'] ?? '')
) ?>
</p><?php
if (
    !empty($row['tagline']) &&
    $row['tagline'] !== "-"
) : ?>
<p class="tagline"><u><?= e($row['tagline']) ?></u></p>
<?php 
endif; ?>
</div></div>
<div class="member-details">
<?php
 if ($isPremium): ?>
<?php
$image = "user/logo/no-images.jpg";
$imageQuery = "
SELECT img
FROM memberimage
WHERE mid = ?
LIMIT 1
";
$imageStmt = mysqli_prepare(
    $con,
    $imageQuery
);

$mid = (int)$row['mid'];
mysqli_stmt_bind_param(
    $imageStmt,
    "i",
    $mid
);
mysqli_stmt_execute(
    $imageStmt
);
$imageResult =
mysqli_stmt_get_result(
    $imageStmt
);if ($imageRow = mysqli_fetch_assoc($imageResult)) {
    if (
        !empty($imageRow['img']) &&
        $imageRow['img'] !== "-"
    ) {        $image =
        "user/logo/" .
        $imageRow['img'];    }}
mysqli_stmt_close($imageStmt);
?><div class="company-gallery">
<a href="clientSlide.php?id=<?= e($row['mid']) ?>">
<img
src="<?= e($image) ?>"alt="Company Image"loading="lazy">
</a>
</div>
<?php
 endif; ?><div class="company-contact">
<table class="contact-table">
<tr><td>
<strong>
Address :
</strong>
</td>
<td><?= 
valueOrEmpty(
    ucwords($row['shopno'] ?? '')
)
?>
<?= 
valueOrEmpty(
    ucwords($row['address'] ?? '')
)
?>
</td>
</tr><tr><td><strong>
Area :
</strong></td>
<td><?= 
valueOrEmpty(
    ucwords($row['area'] ?? '')
)
?>
</td>
</tr><tr><td><strong>
City/State :
</strong></td>
<td>
<?= 
e(
ucwords($row['city'] ?? '')
)
?>
<?php
 if (
    !empty($row['pin']) &&
    $row['pin'] !== "-"
): ?>-
<?= e($row['pin']) ?>
<?php
 endif; ?>
,<?= 
e(
ucwords($row['state1'] ?? '')
)
?>
</td>
</tr>
</table>
</div>
<div class="contact-extra">
<table class="contact-table">
<tr><td>
<strong>
Phone :
</strong>
</td>
<td><?= e($row['phone'] ?? '') ?>
<?php
 if (
    !empty($row['phone1']) &&
    $row['phone1'] !== "-"
): ?>,
<?= e($row['phone1']) ?><?php endif; ?>
</td></tr><tr><td>
<strong>
Mobile :
</strong>
</td>
<td><?= e($row['mobile'] ?? '') ?>
<?php
 if (
    !empty($row['mobile1']) &&
    $row['mobile1'] !== "-"
): ?>,
<?= e($row['mobile1']) ?><?php endif; ?>
</td></tr><tr><td>
<strong>
Email :
</strong>
</td>
<td>
<a href="mailto:<?= e($row['email'] ?? '') ?>"><?= e($row['email'] ?? '') ?></a>
</td>
</tr><tr><td>
<strong>
Website :
</strong>
</td>
<td>
<?php
 if (
    !empty($row['web']) &&
    $row['web'] !== "-"
): ?>
<a href="<?= e(buildWebsiteUrl($row['web'])) ?>"
   target="_blank"
   rel="noopener noreferrer">
<?= e($row['web']) ?>
</a>
<?php
 endif; ?>
</td>
</tr></table>
</div>
<?php 
if ($isPremium): ?>
<div class="social-section">
<strong>
Follow :
</strong>
<div class="social-icons">
<?php
 if (
    !empty($row['twiter']) &&
    $row['twiter'] !== "-"
): ?><a href="<?= e(buildWebsiteUrl($row['twiter'])) ?>"
   target="_blank"
   rel="noopener noreferrer">
<img 
src="<?= e($path) ?>images/twitter-icon.png"
alt="Twitter"
loading="lazy">
</a>
<?php
 endif; ?>
<?php
 if (
    !empty($row['facebook']) &&
    $row['facebook'] !== "-"
): ?>
<a href="<?= e(buildWebsiteUrl($row['facebook'])) ?>"
   target="_blank"
   rel="noopener noreferrer">
<img 
src="<?= e($path) ?>images/facebook-icon.png"
alt="Facebook"
loading="lazy">
</a>
<?php 
endif; ?>
<?php 
if (
    !empty($row['linken']) &&
    $row['linken'] !== "-"
): ?>
<a href="<?= e(buildWebsiteUrl($row['linken'])) ?>"
   target="_blank"
   rel="noopener noreferrer">
<img 
src="<?= e($path) ?>images/linkedin-icon.png"
alt="LinkedIn"
loading="lazy">
</a>
<?php
 endif; ?><?php if (
    !empty($row['ytube']) &&
    $row['ytube'] !== "-"
): ?>
<a href="<?= e(buildWebsiteUrl($row['ytube'])) ?>"
   target="_blank"
   rel="noopener noreferrer">
<img 
src="<?= e($path) ?>images/uTube.png"
alt="YouTube"
loading="lazy">
</a>
<?php
 endif; ?>
</div>
</div>
<?php
 endif; ?>
<?php 
if (
    !empty($row['remark']) &&
    $row['remark'] !== "-"
): ?>
<div class="about-company">
<strong>
About Us :
</strong>
<p><?= e($row['remark']) ?>
</p>
</div>
<?php 
endif; ?>
<div class="rating-section">
<div class="rating-box">
<?php
 if (
    !empty($row['a']) &&
    $row['a'] !== "-"
): ?>
<strong>
Rating :
</strong>
<?= e($row['a']) ?>
<?php
 endif; ?>
</div>
<div class="verification-box">
<?php 
if (
    ($row['verify'] ?? '') === "Verified"
): ?>
<img
src="images/VerifiedLogo.jpg"alt="Verified Business"loading="lazy"class="verified-logo">
<?php 
endif; ?>
</div>
</div>
<?php 
if (
    ($row['mplan'] ?? '') === "Platinum"
): ?>
<div class="premium-detail">
<a href="clientweb.php?id=<?= e($row['mid']) ?>">
<img
src="images/button22.jpg"alt="View more details"class="detail-button"
>
</a>
</div>
<?php 
endif; ?>
</div>
<!-- End member-details -->
</article>
<!-- End member-card -->
<?php endforeach; ?>
</div>
<!-- End results-container -->


<div class="more-search">

<input
type="hidden"
name="item"
value="<?= e($item) ?>"
>

<input
type="hidden"
name="loc"
value="<?= e($loc) ?>"
>


<button
type="submit"
class="more-button"
>
More
</button>

</div>


<?php endif; ?>


</form>


</section>


<footer class="site-footer">

<?php require_once "footer.php"; ?>

</footer>


</div>


</body>

</html>
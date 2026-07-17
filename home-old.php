<?php
declare(strict_types=1);

require_once __DIR__ . '/config.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$msg = 0;

/*
|--------------------------------------------------------------------------
| Feedback Form
|--------------------------------------------------------------------------
*/

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {

    $city = trim($_POST['city'] ?? '');
    $mname = trim($_POST['mname'] ?? '');
    $mobile = trim($_POST['mobile'] ?? '');
    $email = trim($_POST['txtmail'] ?? '');
    $remark = trim($_POST['remark'] ?? '');

    // Remove old placeholder values
    if ($city === 'City') {
        $city = '';
    }

    if ($mname === 'Member Name') {
        $mname = '';
    }

    if ($mobile === 'Mobile') {
        $mobile = '';
    }

    if ($email === 'Email ID') {
        $email = '';
    }

    // Validation

    $city = preg_replace("/[^a-zA-Z0-9 .,-]/", "", $city);
$mname = preg_replace("/[^a-zA-Z .'-]/", "", $mname);

$mobile = preg_replace('/[^0-9+\-\s]/', '', $mobile);
$mobile = mb_substr($mobile,0,20);

    $remark = mb_substr($remark, 0, 1000);

    if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email = '';
    }

    try {

        $stmt = mysqli_prepare(
            $con,
            "INSERT INTO feedback
            (
                city,
                mname,
                mobile,
                txtmail,
                remark,
                fdate
            )
            VALUES
            (
                ?, ?, ?, ?, ?, ?
            )"
        );

        $today = date('Y-m-d');

        mysqli_stmt_bind_param(
            $stmt,
            "ssssss",
            $city,
            $mname,
            $mobile,
            $email,
            $remark,
            $today
        );

        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        $msg = 1;

    } catch (mysqli_sql_exception $e) {

        error_log($e->getMessage());

        $msg = 0;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">

<meta
    name="viewport"
    content="width=device-width, initial-scale=1">

<meta
    http-equiv="X-UA-Compatible"
    content="IE=edge">

<title>
Look8US | Business Directory Kota Rajasthan
</title>

<meta
    name="description"
    content="Look8US Business Directory Kota Rajasthan India. Search verified manufacturers, suppliers, exporters and service providers.">

<meta
    name="keywords"
    content="Business Directory, Kota, Rajasthan, Manufacturers, Suppliers, Exporters">

<link rel="stylesheet" href="akc.css">
<link rel="stylesheet" href="css/style.css">

<link rel="stylesheet"
      href="js/jquery.simplyscroll.css">

<link rel="stylesheet"
      href="colorbox-master/example1/colorbox.css">

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script src="js/jquery.easing.1.3.js"></script>
<script src="js/jquery.timers-1.2.js"></script>
<script src="js/jquery.dualSlider.0.3.min.js"></script>
<script src="js/jquery.simplyscroll.js"></script>
<script src="colorbox-master/jquery.colorbox.js"></script>
<script>

$(function () {

    $("#scroller").simplyScroll({
        auto: false,
        speed: 10
    });

    $(".group1").colorbox({
        rel: "group1"
    });

    $(".inline").colorbox({
        inline: true,
        width: "60%"
    });

});

</script>

<style>
*,
*::before,
*::after{
    box-sizing:border-box;
}

html{
    scroll-behavior:smooth;
}

body{
    margin:0;
    padding:0;
    font-family:Arial, Helvetica, sans-serif;
    background:#f5f5f5;
    color:#222;
    line-height:1.5;
}

img{
    max-width:100%;
    height:auto;
    display:block;
}

a{
    text-decoration:none;
    transition:.25s;
}

a:hover{
    opacity:.9;
}

.container{
    width:min(1200px,95%);
    margin:auto;
}

.search-section{
    background:#fff;
    padding:30px;
    border-radius:8px;
    box-shadow:0 2px 12px rgba(0,0,0,.08);
    margin:25px 0;
}

.search-form{
    display:flex;
    gap:15px;
    flex-wrap:wrap;
}

.search-form input[type=text]{
    flex:1;
    min-width:220px;
    padding:14px;
    border:1px solid #ccc;
    border-radius:6px;
    font-size:15px;
}

.search-form button,
.search-form input[type=submit]{
    background:#0078d7;
    color:#fff;
    border:none;
    padding:14px 30px;
    border-radius:6px;
    cursor:pointer;
    font-size:15px;
}

.search-form button:hover,
.search-form input[type=submit]:hover{
    background:#005fb8;
}

.main-grid{
    display:grid;
    grid-template-columns:
        260px
        1fr
        300px;
    gap:25px;
    margin-top:25px;
}

.card{
    background:#fff;
    border-radius:8px;
    overflow:hidden;
    box-shadow:0 2px 8px rgba(0,0,0,.08);
}

.card-header{
    background:#0b6cc4;
    color:#fff;
    padding:14px 18px;
    font-size:18px;
    font-weight:bold;
}

.card-body{
    padding:18px;
}

.category-list{
    list-style:none;
    padding:0;
    margin:0;
}

.category-list li{
    border-bottom:1px solid #ececec;
}

.category-list li:last-child{
    border-bottom:none;
}

.category-list a{
    display:block;
    padding:10px 6px;
    color:#222;
}

.category-list a:hover{
    background:#f2f7fd;
    color:#0066cc;
}

.category-columns{
    display:grid;
    grid-template-columns:
        repeat(3,1fr);
    gap:20px;
}

.category-columns ul{
    list-style:none;
    margin:0;
    padding:0;
}

.category-columns li{
    margin-bottom:10px;
}

.category-columns a{
    color:#333;
}

.category-columns a:hover{
    color:#0078d7;
}

.feedback-form{
    display:flex;
    flex-direction:column;
    gap:12px;
}

.feedback-form input,
.feedback-form textarea{
    width:100%;
    padding:12px;
    border:1px solid #ccc;
    border-radius:6px;
    font-size:14px;
}

.feedback-form textarea{
    resize:vertical;
    min-height:120px;
}

.feedback-form button{
    background:#00aae8;
    color:#fff;
    border:none;
    padding:13px;
    border-radius:6px;
    cursor:pointer;
    font-size:15px;
}

.feedback-form button:hover{
    background:#008ac2;
}

.verified-business{
    margin-top:40px;
}

.section-title{
    margin-bottom:20px;
}

.section-title h2{
    margin:0;
    font-size:28px;
    color:#003366;
}

.business-slider{
    background:#fff;
    border-radius:8px;
    padding:20px;
    box-shadow:0 2px 8px rgba(0,0,0,.08);
}

#scroller{
    list-style:none;
    margin:0;
    padding:0;
    display:flex;
    gap:20px;
}

#scroller li{
    min-width:240px;
    text-align:center;
}

#scroller img{
    border-radius:6px;
    border:1px solid #ddd;
}

.verified-link span{
    display:block;
    margin-top:10px;
    color:#333;
    font-weight:bold;
}

.popular-boxes{
    margin:45px 0;
}

.popular-grid{
    display:grid;
    grid-template-columns:
        repeat(5,1fr);
    gap:18px;
}

.popular-card{
    background:#fff;
    border-radius:8px;
    padding:18px;
    box-shadow:0 2px 8px rgba(0,0,0,.08);
}

.popular-card h3{
    margin-top:0;
    color:#003366;
    font-size:18px;
}

.popular-card ul{
    list-style:none;
    margin:0;
    padding:0;
}

.popular-card li{
    margin-bottom:8px;
    color:#444;
}

.popup-grid{
    display:grid;
    grid-template-columns:
        repeat(2,1fr);
    gap:20px;
}

.popup-item img{
    width:100%;
    border-radius:8px;
    border:1px solid #ddd;
}

.success{
    padding:15px;
    margin:20px 0;
    background:#dff0d8;
    border:1px solid #b2dba1;
    color:#3c763d;
    border-radius:6px;
}
</style>

</head>

<body>

<a class="inline" href="#inline_content"></a>

<header>

<?php require_once __DIR__ . "/header.php"; ?>

</header>

<main class="container">

<section class="hero">

<div class="logo-wrapper">

<img
    src="logo.jpg"
    alt="Look8US Logo"
    class="main-logo">

</div>

<section class="search-section">

<form
    action="searchResult.php"
    method="post"
    class="search-form">

<div class="search-row">

<input
    type="search"
    name="item"
    id="item"
    class="txtsea"
    placeholder="Enter your search Product or Company"
    required>

<input
    type="text"
    name="loc"
    id="loc"
    class="txtloc"
    placeholder="Location">

<button
    class="subsea"
    type="submit"
    name="submit0">

Go

</button>

</div>

<div class="search-options">

<label>

<input
    type="radio"
    name="sea"
    value="0"
    checked>

Categories

</label>

<label>

<input
    type="radio"
    name="sea"
    value="1">

Company

</label>

</div>

</form>

<?php if ($msg === 1): ?>

<div class="success-message">

Your Message Sent Successfully.

</div>

<?php endif; ?>

</section>

</section>

<section class="page-content">
<div class="left-column">

    <aside class="sidebar-card">

        <div class="card-header blue">
            <h2>Popular Category</h2>
        </div>

        <div class="card-body">

            <ul class="category-list">

<?php

try {

    $sql = "
        SELECT
            cateid,
            cname
        FROM category
        ORDER BY cname
    ";

    $stmtCategory = mysqli_prepare($con, $sql);

    mysqli_stmt_execute($stmtCategory);

    $result = mysqli_stmt_get_result($stmtCategory);

    $count = 0;

    while (($row = mysqli_fetch_assoc($result)) && $count < 30) {

?>

<li>

    <a
        class="a1"
        href="searchresult.php?id=<?= (int)$row['cateid']; ?>">

        <?= htmlspecialchars(
            $row['cname'],
            ENT_QUOTES,
            'UTF-8'
        ); ?>

    </a>

</li>

<?php

        $count++;

    }

    mysqli_free_result($result);

    mysqli_stmt_close($stmtCategory);

} catch (mysqli_sql_exception $e) {

    error_log($e->getMessage());

?>

<li>

Unable to load categories.

</li>

<?php

}

?>

            </ul>

        </div>

    </aside>

</div>
<div class="center-column">

<section class="content-card">

<div class="card-header gray">
    <h2>Category Details</h2>
</div>

<div class="card-body">

<?php

$detailRows = [];
$rowsPerColumn = 1;

try {

    $sql = "
        SELECT
            catdid,
            cdname
        FROM catedetail
        ORDER BY cdname
    ";

    $stmtDetails = mysqli_prepare($con, $sql);

    mysqli_stmt_execute($stmtDetails);

    $result = mysqli_stmt_get_result($stmtDetails);

    while ($row = mysqli_fetch_assoc($result)) {
        $detailRows[] = $row;
    }

    mysqli_free_result($result);
    mysqli_stmt_close($stmtDetails);

    $totalRows = count($detailRows);

    $rowsPerColumn = (int)ceil($totalRows / 3);

    if ($rowsPerColumn < 1) {
        $rowsPerColumn = 1;
    }

} catch (mysqli_sql_exception $e) {

    error_log($e->getMessage());

    echo '<p>Unable to load category details.</p>';

}

?>

<div class="category-details-grid">

<?php

$pointer = 0;

for ($column = 1; $column <= 3; $column++) {

?>

<div class="detail-column">

<ul>

<?php

$count = 0;

while (
    isset($detailRows[$pointer]) &&
    $count < $rowsPerColumn
) {

?>

<li>

<a
    class="a5"
    href="searchresult1.php?id=<?= (int)$detailRows[$pointer]['catdid']; ?>">

<?= htmlspecialchars(
    $detailRows[$pointer]['cdname'],
    ENT_QUOTES,
    'UTF-8'
); ?>

</a>

</li>

<?php

    $pointer++;
    $count++;

}

?>

</ul>

</div>

<?php

}

?>

</div>

</div>

</section>

</div>
<div class="right-column">

    <aside class="sidebar-card feedback-card">

        <div class="card-header light-blue">
            <h2>Feedback &amp; Enquiry</h2>
        </div>

        <div class="card-body">

            <?php if ($msg === 1): ?>

                <div class="success">
                    Your message has been sent successfully.
                </div>

            <?php endif; ?>

            <form
                action="<?= htmlspecialchars($_SERVER['PHP_SELF'], ENT_QUOTES, 'UTF-8'); ?>"
                method="post"
                class="feedback-form"
                autocomplete="off">

                <div class="form-group">

                    <label for="city">
                        City
                    </label>

                    <input
                        type="text"
                        id="city"
                        name="city"
                        maxlength="100"
                        value="<?= htmlspecialchars($_POST['city'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                        placeholder="City">

                </div>

                <div class="form-group">

                    <label for="mname">
                        Name
                    </label>

                    <input
                        type="text"
                        id="mname"
                        name="mname"
                        maxlength="100"
                        value="<?= htmlspecialchars($_POST['mname'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                        placeholder="Member Name"
                        required>

                </div>

                <div class="form-group">

                    <label for="mobile">
                        Mobile
                    </label>

                    <input
                        type="tel"
                        id="mobile"
                        name="mobile"
                        maxlength="20"
                        pattern="[0-9+\-\s]{6,20}"
                        value="<?= htmlspecialchars($_POST['mobile'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                        placeholder="Mobile">

                </div>

                <div class="form-group">

                    <label for="txtmail">
                        Email ID
                    </label>

                    <input
                        type="email"
                        id="txtmail"
                        name="txtmail"
                        maxlength="150"
                        value="<?= htmlspecialchars($_POST['txtmail'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                        placeholder="Email ID">

                </div>

                <div class="form-group">

                    <label for="remark">
                        Message
                    </label>

                    <textarea
                        id="remark"
                        name="remark"
                        rows="5"
                        maxlength="1000"
                        placeholder="Enter your message"
                        required><?= htmlspecialchars($_POST['remark'] ?? '', ENT_QUOTES, 'UTF-8'); ?></textarea>

                </div>

                <div class="form-actions">

                    <button
                        type="submit"
                        name="submit"
                        class="subbox">

                        Submit

                    </button>

                </div>

            </form>

        </div>

    </aside>

</div>
</section>
<section class="verified-business">

    <div class="container">

        <div class="section-title">
            <h2>Verified Business &amp; Services</h2>
        </div>

        <div class="business-slider">

            <ul id="scroller">

<?php

try {

    $status = 'H';

    $sql = "
        SELECT
            aid,
            aname,
            img,
            website
        FROM advert
        WHERE astatus = ?
        ORDER BY aname
    ";

    $stmt = mysqli_prepare($con, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "s",
        $status
    );

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    while ($row = mysqli_fetch_assoc($result)) {

        $website = trim($row['website']);

        if (
            $website !== '' &&
            !preg_match('/^https?:\/\//i', $website)
        ) {
            $website = 'https://' . $website;
        }

?>

<li>

<a
    class="verified-link"
    href="<?= htmlspecialchars($website, ENT_QUOTES, 'UTF-8'); ?>"
    target="_blank"
    rel="noopener noreferrer">

<img
    src="User/logo//<?= htmlspecialchars($row['img'], ENT_QUOTES, 'UTF-8'); ?>"
    alt="<?= htmlspecialchars($row['aname'], ENT_QUOTES, 'UTF-8'); ?>"
    loading="lazy"
    width="240"
    height="145">

<span>

<?= htmlspecialchars(
        $row['aname'],
        ENT_QUOTES,
        'UTF-8'
); ?>

</span>

</a>

</li>

<?php

    }

    mysqli_free_result($result);

    mysqli_stmt_close($stmt);

} catch (mysqli_sql_exception $e) {

    error_log($e->getMessage());

?>

<li>

Unable to load verified businesses.

</li>

<?php

}

?>

            </ul>

        </div>

    </div>

</section>

<section class="popular-boxes">

<div class="container">

<div class="popular-grid">

<div class="popular-card">

<h3>Popular Finders</h3>

<ul>

<li>Bus Route Finder</li>

<li>Pin Code Finder</li>

<li>School Finder</li>

<li>Hotel Finder</li>

<li>Bank SWIFT Code Finder</li>

<li>Bank IFSC Code Finder</li>

<li>Railway Station Finder</li>

</ul>

</div>


<div class="popular-card">

<h3>Popular Brands</h3>

<ul>

<li>Symphony Air Cooler Dealers</li>

<li>Onida AC</li>

<li>Hitachi AC</li>

<li>Spice Mobile Dealers</li>

<li>Hero Cycles</li>

<li>Jet Airways Booking</li>

<li>More Brands...</li>

</ul>

</div>


<div class="popular-card">

<h3>Popular Businesses</h3>

<ul>

<li>DTDC Courier & Cargo Ltd.</li>

<li>Tirupati Travels</li>

<li>Hotel City Home</li>

<li>First Flight Courier</li>

<li>Adarsh Kutir Udyog</li>

<li>Wipro Ltd.</li>

</ul>

</div>


<div class="popular-card">

<h3>Popular Searches</h3>

<ul>

<li>Valentine Day Party Snacks</li>

<li>Valentine Dinner</li>

<li>Flower Wholesale</li>

<li>Candy Bouquet</li>

<li>Child Adoption</li>

<li>Birthday Party Restaurants</li>

</ul>

</div>


<div class="popular-card">

<h3>Popular Branches / Stores</h3>

<ul>

<li>Union Bank ATM</li>

<li>Thomas Cook</li>

<li>Fabindia</li>

<li>ICICI Prudential</li>

<li>Overnite Express</li>

<li>Tata Motor Finance</li>

</ul>

</div>

</div>

</div>

</section>
</main>
<?php require_once __DIR__ . '/footer.php'; ?>

<a
    href="<?= htmlspecialchars($path . 'payment/subscribe.php', ENT_QUOTES, 'UTF-8') ?>"
    class="demoTest">
</a>

<?php

$homeImages = [];

try {

    $sql = "
        SELECT
            aid,
            img,
            website
        FROM homeimg
        ORDER BY aid DESC
    ";

    $stmt = mysqli_prepare($con, $sql);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    while ($row = mysqli_fetch_assoc($result)) {
        $homeImages[] = $row;
    }

    mysqli_free_result($result);
    mysqli_stmt_close($stmt);

} catch (mysqli_sql_exception $e) {

    error_log($e->getMessage());

    $homeImages = [];
}

?>

<div style="display:none;">

<div id="inline_content">

<div class="popup-grid">

<?php

foreach (array_slice($homeImages, 0, 4) as $image) {

    if (
        empty($image['img']) ||
        $image['img'] === '-'
    ) {
        continue;
    }

    $website = trim($image['website'] ?? '');

    if (
        $website !== '' &&
        !preg_match('/^https?:\/\//i', $website)
    ) {
        $website = 'https://' . $website;
    }

?>

<div class="popup-item">

<?php if ($website !== ''): ?>

<a
    href="<?= htmlspecialchars($website, ENT_QUOTES, 'UTF-8'); ?>"
    target="_blank"
    rel="noopener noreferrer">

<?php endif; ?>

<img
    src="User/logo//<?= htmlspecialchars($image['img'], ENT_QUOTES, 'UTF-8'); ?>"
    alt="Advertisement"
    loading="lazy">

<?php if ($website !== ''): ?>

</a>

<?php endif; ?>

</div>

<?php

}

?>

</div>

</div>

</div>


</body>

</html>




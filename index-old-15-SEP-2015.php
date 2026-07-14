<?php
declare(strict_types=1);

require_once __DIR__ . '/config.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$msg = false;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    if (
        !isset($_POST['csrf_token']) ||
        !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])
    ) {
        die('Invalid CSRF Token');
    }

    $city   = trim($_POST['city'] ?? '');
    $mname  = trim($_POST['mname'] ?? '');
    $mobile = trim($_POST['mobile'] ?? '');
    $email  = trim($_POST['txtmail'] ?? '');
    $remark = trim($_POST['remark'] ?? '');

    if (
        $city === '' ||
        $mname === '' ||
        $mobile === '' ||
        $remark === ''
    ) {
        $error = 'Please fill all required fields.';
    } else {
        $date = date('d-m-Y');

        $stmt = $con->prepare("
            INSERT INTO feedback
            VALUES
            (
                NULL,
                ?,
                ?,
                ?,
                ?,
                ?,
                ?
            )
        ");

        $stmt->bind_param(
            "ssssss",
            $city,
            $mname,
            $mobile,
            $email,
            $remark,
            $date
        );

        $stmt->execute();
        $msg = true;
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>
Look8US : Business Directory Kota Rajasthan | Verified Businesses | Yellow Pages
</title>

<meta
name="description"
content="Look8US is a Business Directory of Kota Rajasthan with verified businesses, manufacturers, suppliers, exporters and services.">

<meta
name="keywords"
content="Business Directory Kota Rajasthan, Yellow Pages Kota, Look8US, Manufacturers, Suppliers, Exporters">

<link rel="stylesheet" href="akc.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/form.css">

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:Arial,Helvetica,sans-serif;
    background:#f5f5f5;
    color:#222;
    line-height:1.5;
}

.container{
    max-width:1200px;
    margin:auto;
    padding:15px;
}

.logo{
    text-align:center;
    margin:25px 0;
}

.logo img{
    max-width:100%;
    height:auto;
}

.search-box{
    background:#fff;
    padding:20px;
    border-radius:8px;
    box-shadow:0 2px 8px rgba(0,0,0,.08);
}

.search-row{
    display:flex;
    gap:10px;
    flex-wrap:wrap;
}

.search-row input{
    flex:1;
    min-width:220px;
    padding:12px;
}

.search-row button{
    padding:12px 30px;
}

.radio-row{
    margin-top:12px;
}

.success{
    color:green;
    font-weight:bold;
    text-align:center;
    margin-top:15px
}

.error{
    color:red;
    font-weight:bold;
    text-align:center;
    margin-top:15px;
}

.main-grid{
display:grid;
grid-template-columns: 25% 50% 25%;
gap:20px;
margin-top:25px;
}

.card{
background:#fff;
border-radius:8px;
box-shadow:0 2px 10px rgba(0,0,0,.08);
padding:15px;
}

.card h2{
font-size:20px;
margin-bottom:15px;
background:#0d6efd;
color:#fff;
padding:10px;
border-radius:6px;
}

.category-scroll{
max-height:500px;
overflow-y:auto;
}

.category-link,
.detail-link{
display:block;
padding:8px 0;
border-bottom:1px solid #eee;
text-decoration:none;
color:#222;
transition:.3s;
}

.category-link:hover,
.detail-link:hover{
padding-left:10px;
color:#0d6efd;
}

.category-columns{
display:grid;
grid-template-columns:
repeat(3,1fr);
gap:20px;
}

.more-link{
margin-top:20px;
text-align:right;
}

.more-link a{
background:#005888;
color:#fff;
padding:10px 15px;
border-radius:4px;
text-decoration:none;
}

.more-link a:hover{
background:#003d5c;
}

.form-group{
margin-bottom:15px;
}

.form-group label{
display:block;
font-weight:600;
margin-bottom:5px;
}

.txtbox{
width:100%;
padding:10px;
border:1px solid #ccc;
border-radius:4px;
}

textarea.txtbox{
resize:vertical;
}

.subbox{
width:100%;
padding:12px;
background:#0d6efd;
border:none;
color:#fff;
border-radius:4px;
cursor:pointer;
}

.subbox:hover{
background:#084298;
}

.verified-business{
margin-top:30px;
}

.advert-row{
display:grid;
grid-template-columns:repeat(5,1fr);
gap:20px;
margin-bottom:20px;
}

.advert-card{
background:#fff;
border:1px solid #ddd;
border-radius:8px;
padding:10px;
text-align:center;
transition:.3s;
}

.advert-card:hover{
transform:translateY(-4px);
box-shadow:0 4px 12px rgba(0,0,0,.12);
}

.advert-card img{
width:100%;
max-width:180px;
height:145px;
object-fit:contain;
margin:auto;
display:block;
}

.advert-card span{
display:block;
margin-top:10px;
font-weight:600;
color:#222;
}

.popular-section{
margin:40px 0;
}

.popular-grid{
display:grid;
grid-template-columns:repeat(5,1fr);
gap:20px;
}

.popular-grid h3{
background:#0d6efd;
color:#fff;
padding:10px;
font-size:16px;
border-radius:4px;
margin-bottom:10px;
}

.popular-grid ul{
list-style:none;
padding:0;
margin:0;
}

.popular-grid li{
padding:6px 0;
border-bottom:1px solid #eee;
}

.popup-grid{
display:grid;
grid-template-columns:repeat(2,1fr);
gap:20px;
padding:15px;
}

.popup-item{
text-align:center;
}

.popup-item img{
width:250px;
max-width:100%;
height:auto;
border:1px solid #ddd;
}
</style>
</head>
<body>
<?php require_once 'header.php'; ?>
<div class="container">
<div class="logo">
<img
src="logo.jpg"
alt="Look8US">
</div>
<div class="search-box">
<form
method="post"
action="searchResult.php"
autocomplete="off">

<div class="search-row">
<input
class="txtsea"
type="text"
name="item"
placeholder="Enter your search Product or Company"
required>
<input
class="txtloc"
type="text"
name="loc"
placeholder="Location">
<button
class="subsea"
type="submit"
name="submit0">
Go
</button>
</div>
<div class="radio-row">
<label>
<input
type="radio"
name="sea"
value="0"
checked>
Categories
</label>
&nbsp;&nbsp;
<label>
<input
type="radio"
name="sea"
value="1">
Company
</label>
</div>
</form>
<?php if($msg): ?>
<div class="success">
Your Message was sent successfully.
</div>
<?php endif; ?>
<?php if($error): ?>
<div class="error">
<?= htmlspecialchars($error) ?>
</div>
<?php endif; ?>
</div>
<?php
$popularCategories = [];

$sql = "
    SELECT cateid, cname
    FROM category
    WHERE cstatus = 1
    ORDER BY cname
    LIMIT 50
";

$result = $con->query($sql);

while ($row = $result->fetch_assoc()) {
    $popularCategories[] = $row;
}

$categoryDetails = [];

$sql = "
SELECT DISTINCT
    catdid,
    cdname
FROM catedetail
WHERE cdstatus=1
ORDER BY cdname
LIMIT 185
";

$result = $con->query($sql);

while ($row = $result->fetch_assoc()) {
    $categoryDetails[] = $row;
}
$total = count($categoryDetails);
$perColumn = (int) ceil($total / 3);

$columns = array_chunk(
    $categoryDetails,
    $perColumn
);
?>
<div class="main-grid">
    <aside class="left-panel">
        <div class="card">
            <h2>
                Popular Categories
            </h2>
            <div class="category-scroll">
                <?php foreach ($popularCategories as $category): ?>
                    <a
                        class="category-link"
                        href="searchresult.php?id=<?= (int)$category['cateid']; ?>">

                        <?= htmlspecialchars(
                            $category['cname'],
                            ENT_QUOTES,
                            'UTF-8'
                        ); ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </aside>
    <section class="center-panel">
        <div class="card">
            <h2>
                Category Details
            </h2>
            <div class="category-columns">
                <?php foreach ($columns as $column): ?>
                    <div class="column">
                        <?php foreach ($column as $item): ?>
                            <a
                                class="detail-link"
                                href="searchresult1.php?id=<?= (int)$item['catdid']; ?>">

                                <?= htmlspecialchars(
                                    $item['cdname'],
                                    ENT_QUOTES,
                                    'UTF-8'
                                ); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="more-link">
                <a
                    href="index-subcate.php">
                    More Categories >>
                </a>
            </div>
        </div>
    </section>
<aside class="right-panel">
    <div class="card">
        <h2>Feedback &amp; Enquiry</h2>
        <form method="post" action="index.php" autocomplete="off">
            <input
                type="hidden"
                name="csrf_token"
                value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
            <div class="form-group">
                <label for="city">City</label>
                <input
                    type="text"
                    id="city"
                    name="city"
                    class="txtbox"
                    value="<?= htmlspecialchars($_POST['city'] ?? '') ?>"
                    placeholder="City">
            </div>
            <div class="form-group">
                <label for="mname">Name</label>
                <input
                    type="text"
                    id="mname"
                    name="mname"
                    class="txtbox"
                    value="<?= htmlspecialchars($_POST['mname'] ?? '') ?>"
                    placeholder="Member Name">
            </div>
            <div class="form-group">
                <label for="mobile">Mobile</label>
                <input
                    type="text"
                    id="mobile"
                    name="mobile"
                    class="txtbox"
                    value="<?= htmlspecialchars($_POST['mobile'] ?? '') ?>"
                    placeholder="Mobile">
            </div>
            <div class="form-group">
                <label for="txtmail">Email</label>
                <input
                    type="email"
                    id="txtmail"
                    name="txtmail"
                    class="txtbox"
                    value="<?= htmlspecialchars($_POST['txtmail'] ?? '') ?>"
                    placeholder="Email">
            </div>
            <div class="form-group">
                <label for="remark">Message</label>
                <textarea
                    id="remark"
                    name="remark"
                    rows="4"
                    class="txtbox"
                    placeholder="Message"><?= htmlspecialchars($_POST['remark'] ?? '') ?></textarea>
            </div>
            <button
                class="subbox"
                type="submit"
                name="submit">
                Submit
            </button>
        </form>
    </div>
</aside>
</div>
<?php
$sql = "
SELECT
    aname,
    website,
    img
FROM advert
WHERE astatus='H'
ORDER BY aname
";

$result = $con->query($sql);
$advertisements = [];

while ($row = $result->fetch_assoc()) {
    if ($row['img'] !== '-') {
        $advertisements[] = $row;
    }
}
$advertChunks = array_chunk($advertisements, 5);
?>

<section class="verified-business">
    <div class="card">
        <h2>
            Verified Business &amp; Services
        </h2>
        <?php if (!empty($advertChunks)): ?>
            <?php foreach ($advertChunks as $chunk): ?>
                <div class="advert-row">
                    <?php foreach ($chunk as $advert): ?>
                        <?php
                        $website = trim($advert['website']);

                        if (
                            $website !== '' &&
                            !preg_match('/^https?:\/\//i', $website)
                        ) {
                            $website = 'http://' . $website;
                        }
                        ?>
                        <div class="advert-card">
                            <a
                                href="<?= htmlspecialchars($website) ?>"
                                target="_blank"
                                rel="noopener noreferrer">
                                <img
                                    src="user/logo/<?= rawurlencode($advert['img']) ?>"
                                    alt="<?= htmlspecialchars($advert['aname']) ?>">
                                <span>
                                    <?= htmlspecialchars($advert['aname']) ?>
                                </span>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No verified businesses available.</p>
        <?php endif; ?>
    </div>
</section>
<section class="popular-section">
    <div class="card">
        <div class="popular-grid">
            <div>
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
            <div>
                <h3>Popular Brands</h3>
                <ul>
                    <li>Symphony Air Cooler Dealers</li>
                    <li>Onida AC</li>
                    <li>Hitachi AC</li>
                    <li>Spice Mobile Dealers</li>
                    <li>Hero Cycles</li>
                    <li>Jet Airways Flight Booking</li>
                    <li>More Brands...</li>
                </ul>
            </div>
            <div>
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
            <div>
                <h3>Popular Searches</h3>
                <ul>
                    <li>Valentine Day Party Snacks</li>
                    <li>Valentine Day Dinner</li>
                    <li>Valentine Flowers Wholesale</li>
                    <li>Valentine Candy Bouquet</li>
                    <li>Child Adoption</li>
                    <li>Birthday Party Restaurants</li>
                </ul>
            </div>
            <div>
                <h3>Popular Branches / Stores</h3>
                <ul>
                    <li>Union Bank ATM</li>
                    <li>Thomas Cook</li>
                    <li>Fabindia</li>
                    <li>ICICI Prudential</li>
                    <li>Overnite Express Ltd.</li>
                    <li>Tata Motor Finance</li>
                </ul>
            </div>
        </div>
    </div>
</section>
</body>
</html>
<?php
declare(strict_types=1);

require_once __DIR__ . '/config.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

/*
|--------------------------------------------------------------------------
| CSRF Token
|--------------------------------------------------------------------------
*/

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$msg = 0;
$error = '';

/*
|--------------------------------------------------------------------------
| Feedback Form
|--------------------------------------------------------------------------
*/

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
        $email === '' ||
        $remark === ''
    ) {

        $error = 'Please fill all fields.';

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $error = 'Please enter a valid email address.';

    } else {

        $stmt = $con->prepare("
            INSERT INTO feedback
            (
                city,
                mname,
                mobile,
                txtmail,
                remark,
                cdate
            )
            VALUES
            (
                ?,?,?,?,?,?
            )
        ");

        $today = date('d-m-Y');

        $stmt->bind_param(
            'ssssss',
            $city,
            $mname,
            $mobile,
            $email,
            $remark,
            $today
        );

        $stmt->execute();
        $stmt->close();

        $msg = 1;
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

<meta
    http-equiv="X-UA-Compatible"
    content="IE=edge">

<title>
Look8US | Business Directory Kota Rajasthan
</title>

<meta
name="description"
content="Look8US Business Directory from Kota Rajasthan. Search trusted businesses, manufacturers, suppliers and exporters.">

<meta
name="keywords"
content="business directory,kota,rajasthan,yellow pages,b2b,suppliers,manufacturers">

<link rel="stylesheet" href="akc.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/form.css">

<link rel="preconnect" href="https://fonts.googleapis.com">

<link rel="preconnect"
href="https://fonts.gstatic.com"
crossorigin>

<link
href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap"
rel="stylesheet">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:'Roboto',sans-serif;
    background:#f5f5f5;
    color:#222;
    line-height:1.5;
}

.container{
    width:min(1200px,95%);
    margin:auto;
}

.logo{
    text-align:center;
    padding:30px 0;
}

.logo img{
    max-width:100%;
    height:auto;
}

.success{
    background:#d1fae5;
    color:#065f46;
    padding:12px;
    margin:20px 0;
    border-radius:6px;
    text-align:center;
}

.error{
    background:#fee2e2;
    color:#991b1b;
    padding:12px;
    margin:20px 0;
    border-radius:6px;
    text-align:center;
}

.search-form{
    display:flex;
    flex-wrap:wrap;
    gap:15px;
    justify-content:center;
    align-items:center;
    margin-bottom:20px;
}

.search-form input{
    flex:1;
    min-width:240px;
    padding:12px;
    border:1px solid #ccc;
    border-radius:6px;
    font-size:15px;
}

.search-form button{
    background:#0d6efd;
    color:#fff;
    border:none;
    padding:12px 30px;
    border-radius:6px;
    cursor:pointer;
}

.search-form button:hover{
    background:#0b5ed7;
}

.radio-box{
    text-align:center;
    margin-bottom:30px;
}

.main-grid{
    display:grid;
    grid-template-columns:24% 50% 26%;
    gap:20px;
}

.popular-grid{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
gap:25px;
margin-top:20px;
}

.popular-grid h3{
margin-bottom:10px;
font-size:18px;
color:#0d6efd;
}

.popular-grid ul{
padding-left:20px;
}

.popular-grid li{
margin-bottom:8px;
line-height:1.5;
}

.popup-gallery{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
gap:20px;
margin-top:40px;
}

.popup-gallery img{
width:100%;
height:250px;
object-fit:contain;
border-radius:10px;
box-shadow:0 5px 15px rgba(0,0,0,.12);
transition:.3s;
}

.popup-gallery img:hover{
transform:scale(1.04);
}

footer{
margin-top:40px;
}

.card{
background:#fff;
border-radius:10px;
padding:20px;
box-shadow:0 3px 10px rgba(0,0,0,.08);
}

.card-title{
font-size:22px;
margin-bottom:20px;
color:#0d6efd;
}

.scroll-box{
max-height:520px;
overflow-y:auto;
}

.category-item{
padding:10px;
border-bottom:1px solid #ececec;
}

.category-item:last-child{
border-bottom:none;
}

.category-item a{
text-decoration:none;
color:#333;
transition:.3s;
font-size:15px;
}

.category-item a:hover{
color:#0d6efd;
padding-left:5px;
}

.category-grid{
display:grid;
grid-template-columns:repeat(3,1fr);
gap:20px;
}

.detail-item{
padding:8px 0;
border-bottom:1px solid #f2f2f2;
}

.detail-item a{
text-decoration:none;
color:#444;
font-size:15px;
transition:.3s;
}

.detail-item a:hover{
color:#0d6efd;
padding-left:5px;
}

.btn-more{
display:inline-block;
background:#0d6efd;
color:#fff;
padding:12px 24px;
border-radius:6px;
text-decoration:none;
transition:.3s;
}

.btn-more:hover{
background:#084298;
}

.form-group{
margin-bottom:15px;
}

.form-group label{
display:block;
font-weight:600;
margin-bottom:6px;
}

.form-control{
width:100%;
padding:12px;
border:1px solid #ccc;
border-radius:6px;
font-size:15px;
}

.form-control:focus{
outline:none;
border-color:#0d6efd;
box-shadow:0 0 0 3px rgba(13,110,253,.15);
}

textarea.form-control{
resize:vertical;
min-height:120px;
}

.btn-submit{
width:100%;
padding:13px;
border:none;
border-radius:6px;
background:#0d6efd;
color:#fff;
font-size:16px;
cursor:pointer;
transition:.3s;
}

.btn-submit:hover{
background:#084298;
}

.mt-4{
margin-top:30px;
}

.verified-slider{
display:flex;
gap:20px;
overflow-x:auto;
scroll-behavior:smooth;
padding:10px 0;
}

.verified-slider::-webkit-scrollbar{
height:8px;
}

.verified-slider::-webkit-scrollbar-thumb{
background:#bbb;
border-radius:20px;
}

.verified-card{
min-width:220px;
background:#fff;
border-radius:10px;
box-shadow:0 3px 10px rgba(0,0,0,.08);
padding:15px;
text-align:center;
transition:.3s;
}

.verified-card:hover{
transform:translateY(-5px);
}

.verified-card img{
width:180px;
height:145px;
object-fit:contain;
margin-bottom:10px;
}

.verified-card a{
text-decoration:none;
color:#333;
}

</style>

<script>

function clearText(el,text){

    if(el.value===text){

        el.value='';

    }

}

function restoreText(el,text){

    if(el.value===''){

        el.value=text;

    }

}

</script>

</head>
<body>
<a class="inline" href="#inline_content"></a>

<?php require_once 'header.php'; ?>

<div class="container">
<div class="logo">
<img
src="logo.jpg"
alt="Look8US Logo">

</div>

<?php if($msg): ?>

<div class="success">
Your message has been sent successfully.
</div>

<?php endif; ?>

<?php if($error !== ''): ?>

<div class="error">

<?= htmlspecialchars($error) ?>

</div>

<?php endif; ?>

<form
method="post"
action="searchResult.php">
<div class="search-form">

<input
type="text"
name="item"
id="item"
value="Enter your search Product or Company"
onfocus="clearText(this,'Enter your search Product or Company')"
onblur="restoreText(this,'Enter your search Product or Company')">

<input
type="text"
name="loc"
id="loc"
value="Location"
onfocus="clearText(this,'Location')"
onblur="restoreText(this,'Location')">

<button
type="submit"
name="submit0">
Go
</button>
</div>

<div class="radio-box">
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

<div class="main-grid">
<!-- ===========================
     LEFT SIDEBAR
=========================== -->

<aside class="card">
    <h2 class="card-title">
        Popular Categories
    </h2>
    <div class="scroll-box">

<?php
$stmt = $con->prepare("
    SELECT
        cateid,
        cname
    FROM category
    WHERE cstatus = ?
    ORDER BY cname
");

$status = 1;

$stmt->bind_param("i", $status);
$stmt->execute();
$result = $stmt->get_result();
$count = 0;

while (($row = $result->fetch_assoc()) && ($count < 50)) :
?>
        <div class="category-item">
            <a
                class="a1"
                href="searchresult.php?id=<?= (int)$row['cateid']; ?>">
                <?= htmlspecialchars($row['cname']); ?>
            </a>
        </div>

<?php
$count++;
endwhile;
$stmt->close();
?>

    </div>
</aside>


<!-- ===========================
     CENTER COLUMN
=========================== -->

<section class="card">
<h2 class="card-title">
Category Details
</h2>

<?php
$stmt = $con->prepare("
SELECT DISTINCT
    catdid,
    cdname
FROM
    catedetail
WHERE
    cdstatus = ?
ORDER BY
    cdname
LIMIT 185
");

$status = 1;
$stmt->bind_param("i", $status);
$stmt->execute();
$result = $stmt->get_result();
$rows = [];

while ($row = $result->fetch_assoc()) {
    $rows[] = $row;
}

$stmt->close();
$total = count($rows);
$perColumn = (int) ceil($total / 3);
$columns = array_chunk($rows, $perColumn);
?>

<div class="category-grid">

<?php foreach ($columns as $column): ?>

<div>

<?php foreach ($column as $item): ?>

<div class="detail-item">
<a
class="a5"
href="searchresult1.php?id=<?= (int)$item['catdid']; ?>">

<?= htmlspecialchars($item['cdname']); ?>
</a>
</div>

<?php endforeach; ?>

</div>

<?php endforeach; ?>

</div>


<div
style="
margin-top:20px;
text-align:right;
">
<a
class="btn-more"
href="index-subcate.php">

More Categories →

</a>
</div>
</section>
<!-- ==========================================
     RIGHT SIDEBAR - FEEDBACK & ENQUIRY
========================================== -->

<aside class="card">
<h2 class="card-title">
Feedback & Enquiry
</h2>

<form
method="post"
action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>"
autocomplete="off">

<input
type="hidden"
name="csrf_token"
value="<?= htmlspecialchars($_SESSION['csrf_token']); ?>">

<div class="form-group">
<label for="city">
City
</label>

<input
type="text"
id="city"
name="city"
class="form-control"
value="<?= htmlspecialchars($city ?? ''); ?>"
required>

</div>

<div class="form-group">
<label for="mname">
Name
</label>

<input
type="text"
id="mname"
name="mname"
class="form-control"
value="<?= htmlspecialchars($mname ?? ''); ?>"
required>

</div>

<div class="form-group">
<label for="mobile">
Mobile
</label>

<input
type="text"
id="mobile"
name="mobile"
class="form-control"
value="<?= htmlspecialchars($mobile ?? ''); ?>"
required>

</div>

<div class="form-group">
<label for="txtmail">
Email
</label>

<input
type="email"
id="txtmail"
name="txtmail"
class="form-control"
value="<?= htmlspecialchars($email ?? ''); ?>"
required>

</div>

<div class="form-group">
<label for="remark">
Message
</label>

<textarea
id="remark"
name="remark"
rows="5"
class="form-control"
required><?= htmlspecialchars($remark ?? ''); ?></textarea>

</div>

<button
type="submit"
name="submit"
class="btn-submit">
Submit
</button>
</form>
</aside>
</div>

<!-- ==========================================
     VERIFIED BUSINESSES
========================================== -->

<section class="card mt-4">
<h2 class="card-title">
Verified Business & Services
</h2>

<?php
$stmt = $con->prepare("
SELECT
    aname,
    website,
    img
FROM
    advert
WHERE
    astatus = ?
ORDER BY RAND()
");

$status = 'H';
$stmt->bind_param("s", $status);
$stmt->execute();
$result = $stmt->get_result();
?>

<div class="verified-slider">

<?php while ($row = $result->fetch_assoc()): ?>

<?php if ($row['img'] !== '-'): ?>

<div class="verified-card">
<a
href="https://<?= htmlspecialchars($row['website']); ?>"
target="_blank"
rel="noopener noreferrer">
<img
src="User/logo//<?= rawurlencode($row['img']); ?>"
alt="<?= htmlspecialchars($row['aname']); ?>">
<h4>
<?= htmlspecialchars($row['aname']); ?>
</h4>
</a>
</div>

<?php endif; ?>

<?php endwhile; ?>

</div>

<?php
$stmt->close();
?>

</section>

<script>
const slider=document.querySelector('.verified-slider');

if(slider){
setInterval(()=>{
slider.scrollBy({
left:240,
behavior:'smooth'
});

if(
slider.scrollLeft+
slider.clientWidth>=
slider.scrollWidth-5
){
slider.scrollTo({
left:0,
behavior:'smooth'
});

}

},3000);

}

</script>
<!-- =====================================================
     POPULAR FINDERS / BRANDS / SEARCHES
====================================================== -->

<section class="card mt-4">
<h2 class="card-title">
Popular Information
</h2>

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
<li>Spice Mobile Phone Dealers</li>
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
<li>Valentine Dinner</li>
<li>Valentine Flowers</li>
<li>Candy Bouquet</li>
<li>Child Adoption</li>
<li>Birthday Party Restaurants</li>
</ul>

</div>

<div>
<h3>Popular Branches</h3>

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
</section>


<!-- =====================================================
     HOME POPUP IMAGES
====================================================== -->

<?php

$stmt = $con->prepare("
SELECT
    website,
    img
FROM
    homeimg
ORDER BY
    aid DESC
LIMIT 4
");

$stmt->execute();

$result = $stmt->get_result();

?>

<div id="inline_content" class="popup-gallery">

<?php while($row = $result->fetch_assoc()): ?>

<?php if($row['img'] !== '-'): ?>

<a
href="https://<?= htmlspecialchars($row['website']) ?>"
target="_blank"
rel="noopener noreferrer">

<img
src="User/logo//<?= rawurlencode($row['img']) ?>"
alt="Advertisement">

</a>

<?php endif; ?>

<?php endwhile; ?>

</div>

<?php

$stmt->close();

?>

<?php require_once 'footer.php'; ?>

</div>
</body>
</html>
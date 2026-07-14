<?php
declare(strict_types=1);

require_once __DIR__ . '/config.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/* CSRF Token */
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$msg = 0;
$error = '';

$city   = trim($_POST['city'] ?? '');
$mname  = trim($_POST['mname'] ?? '');
$mobile = trim($_POST['mobile'] ?? '');
$email  = trim($_POST['txtmail'] ?? '');
$remark = trim($_POST['remark'] ?? '');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {

    if (
        !isset($_POST['csrf_token']) ||
        !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])
    ) {
        $error = 'Invalid request.';
    }

    if ($error === '') {

        if ($city === '') {
            $error = 'Please enter city.';
        } elseif ($mname === '') {
            $error = 'Please enter your name.';
        } elseif ($mobile === '') {
            $error = 'Please enter mobile number.';
        } elseif (!preg_match('/^[0-9]{10}$/', $mobile)) {
            $error = 'Please enter valid mobile number.';
        } elseif ($email === '') {
            $error = 'Please enter email.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 'Please enter valid email.';
        } elseif ($remark === '') {
            $error = 'Please enter message.';
        }
    }
    if ($error === '') {
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
                    cdate
                )
                VALUES
                (
                    ?, ?, ?, ?, ?, ?
                )"
            );

            if (!$stmt) {
                throw new Exception(mysqli_error($con));
            }

            $cdate = date('d-m-Y');

            mysqli_stmt_bind_param(
                $stmt,
                "ssssss",
                $city,
                $mname,
                $mobile,
                $email,
                $remark,
                $cdate
            );

            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            $msg = 1;

            // Clear form values

            $city = '';
            $mname = '';
            $mobile = '';
            $email = '';
            $remark = '';

            // New CSRF Token

            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

        } catch (Throwable $e) {
            error_log($e->getMessage());
            $error = 'Unable to save your enquiry. Please try again later.';
        }
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
<title>
Look8US : Business Directory Kota, Rajasthan, India
</title>
<meta
    name="description"
    content="Look8US Business Directory Kota Rajasthan">
<meta
    name="keywords"
    content="Business Directory, Kota, Rajasthan, India">

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
    font-family:Arial, Helvetica, sans-serif;
    background:#fff;
    color:#333;
    line-height:1.5;
}

img{
    max-width:100%;
    height:auto;
}

table{
    width:100%;
    border-collapse:collapse;
}

.container{
    width:min(1200px,95%);
    margin:auto;
}

.success-message{
    background:#d4edda;
    color:#155724;
    border:1px solid #c3e6cb;
    padding:12px;
    margin:15px 0;
    border-radius:4px;
}

.error-message{
    background:#f8d7da;
    color:#721c24;
    border:1px solid #f5c6cb;
    padding:12px;
    margin:15px 0;
    border-radius:4px;
}

.search-section{
margin:30px 0;
}

.search-form{
display:flex;
flex-direction:column;
gap:15px;
}

.search-row{
display:flex;
gap:15px;
}

.search-row input{
flex:1;
}

.subsea{
padding:12px 25px;
border:none;
background:#0066cc;
color:#fff;
cursor:pointer;
border-radius:5px;
}

.subsea:hover{
background:#004b99;
}

.search-options{
display:flex;
gap:30px;
font-size:15px;
}

.home-layout{
display:grid;
grid-template-columns:280px 1fr 300px;
gap:20px;
}

.card{
background:#fff;
border:1px solid #ddd;
border-radius:8px;
overflow:hidden;
}

.card h2{
background:#007bff;
color:#fff;
padding:14px;
font-size:18px;
}

.scroll-box{
max-height:520px;
overflow:auto;
}

.category-list{
list-style:none;
padding:0;
margin:0;
}

.category-list li{
border-bottom:1px solid #eee;
}

.category-list li a{
display:block;
padding:10px 15px;
text-decoration:none;
color:#333;
}

.category-list li a:hover{
background:#f3f3f3;
}

.category-details{
display:grid;
grid-template-columns:repeat(3,1fr);
gap:25px;
padding:20px;
}

.category-column ul{
list-style:none;
margin:0;
padding:0;
}

.category-column li{
margin-bottom:10px;
}

.category-column a{
text-decoration:none;
color:#333;
font-size:14px;
transition:.3s;
}

.category-column a:hover{
color:#0066cc;
}

.more-category{
text-align:center;
padding:20px;
}

.btn-more{
display:inline-block;
padding:10px 22px;
background:#0066cc;
color:#fff;
text-decoration:none;
border-radius:5px;
}

.btn-more:hover{
background:#004c99;
}

.right-panel{
display:flex;
flex-direction:column;
gap:20px;
}

.feedback-form{
padding:20px;
}

.form-group{
margin-bottom:18px;
}

.form-group label{
display:block;
margin-bottom:6px;
font-weight:bold;
color:#333;
}

.form-group input,
.form-group textarea{
width:100%;
padding:12px;
border:1px solid #cccccc;
border-radius:5px;
font-size:15px;
transition:.3s;
}

.form-group input:focus,
.form-group textarea:focus{
border-color:#0066cc;
outline:none;
box-shadow:0 0 5px rgba(0,102,204,.25);
}

textarea{
resize:vertical;
min-height:120px;
}

.submit-group{
text-align:center;
}

.subbox{
background:#0066cc;
color:#fff;
border:none;
padding:12px 35px;
font-size:16px;
border-radius:5px;
cursor:pointer;
transition:.3s;
}

.subbox:hover{
background:#004b99;
}

.verified-business{
margin-top:30px;
}

.verified-slider{
display:flex;
gap:20px;
overflow-x:auto;
padding:20px;
scroll-behavior:smooth;
}

.verified-item{
min-width:220px;
text-align:center;
flex-shrink:0;
}

.verified-item img{
width:180px;
height:145px;
object-fit:contain;
border:1px solid #ddd;
border-radius:6px;
padding:8px;
background:#fff;
transition:.3s;
}

.verified-item img:hover{
transform:scale(1.04);
}

.verified-item p{
margin-top:10px;
font-size:14px;
}

.verified-item a{
text-decoration:none;
color:#333;
}

.verified-item a:hover{
color:#0066cc;
}

.no-data{
padding:20px;
text-align:center;
}

.estore-section{
margin-top:40px;
}

.estore-grid{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(180px,1fr));
gap:20px;
padding:20px;
}

.estore-card{
background:#ffffff;
border:1px solid #dddddd;
border-radius:8px;
overflow:hidden;
text-align:center;
transition:.3s;
}

.estore-card:hover{
transform:translateY(-4px);
box-shadow:0 5px 15px rgba(0,0,0,.15);
}

.estore-card a{
text-decoration:none;
color:#333333;
display:block;
padding:15px;
}

.estore-card img{
width:100%;
height:170px;
object-fit:contain;
margin-bottom:12px;
}

.estore-card h3{
font-size:18px;
font-weight:bold;
color:#003366;
}

.popup-content{
padding:20px;
background:#ffffff;
border-radius:8px;
max-width:900px;
margin:auto;
}

.popup-grid{
display:grid;
grid-template-columns:repeat(2,1fr);
gap:20px;
}

.popup-card{
text-align:center;
}

.popup-card img{
width:100%;
max-width:250px;
height:250px;
object-fit:contain;
border:1px solid #dddddd;
border-radius:8px;
padding:10px;
background:#ffffff;
transition:.3s;
}

.popup-card img:hover{
transform:scale(1.03);
}
</style>
</head>

<body>
<?php require_once 'header.php'; ?>
<a class="inline" href="#inline_content"></a>
<main class="container">
<?php if ($msg === 1): ?>
    <div class="success-message">
        Your message has been sent successfully.
    </div>

<?php endif; ?>

<?php if ($error !== ''): ?>

    <div class="error-message">
        <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?>
    </div>

<?php endif; ?>

<section class="search-section">
<form
    method="post"
    action="searchResult.php"
    class="search-form"
    autocomplete="on">

<div class="search-row">
<input
    type="search"
    name="item"
    class="txtsea"
    placeholder="Enter Product or Company"
    value="<?= htmlspecialchars($_POST['item'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
>

<input
    type="text"
    name="loc"
    class="txtloc"
    placeholder="Location"
    value="<?= htmlspecialchars($_POST['loc'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
>

<button
    type="submit"
    name="submit0"
    class="subsea">
    Search
</button>

</div>

<div class="search-options">
<label>
<input
    type="radio"
    name="sea"
    value="0"
    <?= (($_POST['sea'] ?? '0') === '0') ? 'checked' : ''; ?>
>
Categories
</label>

<label>
<input
    type="radio"
    name="sea"
    value="1"
    <?= (($_POST['sea'] ?? '') === '1') ? 'checked' : ''; ?>
>
Company
</label>
</div>
</form>
</section>

<div class="home-layout">
<aside class="left-panel">
<div class="card">

<h2 class="section-title">
Popular Categories
</h2>

<div class="scroll-box">

<?php

$sql = "
SELECT
    cateid,
    cname
FROM category
WHERE cstatus=1
ORDER BY cname
LIMIT 50
";

$result = mysqli_query($con, $sql);

?>

<ul class="category-list">

<?php while ($row = mysqli_fetch_assoc($result)): ?>

<li>

<a
    href="searchresult.php?id=<?= (int)$row['cateid']; ?>"
>

<?= htmlspecialchars($row['cname'], ENT_QUOTES, 'UTF-8'); ?>

</a>

</li>

<?php endwhile; ?>

</ul>

</div>

</div>

</aside>

<section class="middle-panel">
<div class="card">

    <h2>
        Category in Details
    </h2>

<?php

$sql = "
SELECT
    catdid,
    cdname
FROM catedetail
WHERE cdstatus=1
ORDER BY cdname
LIMIT 300
";

$result = mysqli_query($con, $sql);

if (!$result) {
    throw new RuntimeException(mysqli_error($con));
}

$categories = mysqli_fetch_all($result, MYSQLI_ASSOC);

$total = count($categories);

$perColumn = (int) ceil($total / 3);

$columns = array_chunk($categories, $perColumn);

?>

<div class="category-details">

<?php foreach ($columns as $column): ?>

<div class="category-column">

<ul>

<?php foreach ($column as $row): ?>

<li>

<a
    class="a5"
    href="searchresult1.php?id=<?= (int)$row['catdid']; ?>"
>

<?= htmlspecialchars($row['cdname'], ENT_QUOTES, 'UTF-8'); ?>

</a>

</li>

<?php endforeach; ?>

</ul>

</div>

<?php endforeach; ?>

</div>

<div class="more-category">

<a
    href="index-subcate.php"
    class="btn-more"
>
More Categories →
</a>

</div>

</div>
<aside class="right-panel">

<div class="card">

<h2>
Feedback &amp; Enquiry
</h2>

<form
    method="post"
    action="<?= htmlspecialchars($_SERVER['PHP_SELF'], ENT_QUOTES, 'UTF-8'); ?>"
    class="feedback-form"
    autocomplete="on"
>

<input
    type="hidden"
    name="csrf_token"
    value="<?= htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8'); ?>"
>

<div class="form-group">

<label for="city">
City
</label>

<input
    type="text"
    id="city"
    name="city"
    maxlength="50"
    required
    autocomplete="address-level2"
    value="<?= htmlspecialchars($city, ENT_QUOTES, 'UTF-8'); ?>"
>

</div>

<div class="form-group">

<label for="mname">
Name
</label>

<input
    type="text"
    id="mname"
    name="mname"
    maxlength="60"
    required
    autocomplete="name"
    value="<?= htmlspecialchars($mname, ENT_QUOTES, 'UTF-8'); ?>"
>

</div>

<div class="form-group">

<label for="mobile">
Mobile
</label>

<input
    type="tel"
    id="mobile"
    name="mobile"
    maxlength="10"
    pattern="[0-9]{10}"
    inputmode="numeric"
    required
    autocomplete="tel"
    value="<?= htmlspecialchars($mobile, ENT_QUOTES, 'UTF-8'); ?>"
>

</div>

<div class="form-group">

<label for="txtmail">
Email
</label>

<input
    type="email"
    id="txtmail"
    name="txtmail"
    maxlength="254"
    required
    autocomplete="email"
    value="<?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?>"
>

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
    required><?= htmlspecialchars($remark, ENT_QUOTES, 'UTF-8'); ?></textarea>

</div>

<div class="form-group submit-group">

<button
    type="submit"
    name="submit"
    class="subbox"
>
Submit
</button>

</div>

</form>

</div>
</aside>
						<!--<div align="center">
						<table border="1" width="99%" id="table30" height="218" bgcolor="#FFFFFF" style="border-collapse: collapse" bordercolor="#E3E3E3">
							<tr>
								<td align="center"><b><font color="#0066CC">
								Place your Ads here</font><font color="#0066CC" size="4"><br>
								</font><font color="#FF3300" size="4">Ads&nbsp; 
								No. #01 </font><font color="#FF3300" size="2">
								(6cm*6cm)</font><font color="#FF3300" size="4"><br>
								</font><font color="#0066CC">Contact us for this 
								space.</font></b></td>
							</tr>
						</table>-->
<section class="verified-business">
<div class="card">

<h2>
Verified Business &amp; Services
</h2>

<?php

$sql = "
SELECT
    aname,
    website,
    img
FROM advert
WHERE astatus='H'
ORDER BY RAND()
";

$result = mysqli_query($con, $sql);

if (!$result) {
    throw new RuntimeException(mysqli_error($con));
}

$adverts = [];

while ($row = mysqli_fetch_assoc($result)) {

    if ($row['img'] !== '-') {
        $adverts[] = $row;
    }

}

?>

<?php if (!empty($adverts)): ?>

<div class="verified-slider">

<?php foreach ($adverts as $row): ?>

<div class="verified-item">
<?php 
$url=$row['website'];

if(!preg_match('#^https?://#',$url)){
    $url='https://'.$url;
}
?>
<a
    href="<?= htmlspecialchars($url) ?>"
    target="_blank"
    rel="noopener noreferrer"
>

<img
    src="user/logo/<?= htmlspecialchars($row['img'], ENT_QUOTES, 'UTF-8'); ?>"
    alt="<?= htmlspecialchars($row['aname'], ENT_QUOTES, 'UTF-8'); ?>"
	loading="lazy"
>

</a>

<p>

<a
    href=<?= htmlspecialchars($url) ?>"
    target="_blank"
    rel="noopener noreferrer"
>

<?= htmlspecialchars($row['aname'], ENT_QUOTES, 'UTF-8'); ?>

</a>

</p>

</div>

<?php endforeach; ?>

</div>

<?php else: ?>

<p class="no-data">

No verified businesses available.

</p>

<?php endif; ?>

</div>

</section>
<section class="estore-section">

<div class="card">

<h2>
e-Store Products Gallery
</h2>

<?php

$sql = "
SELECT
    catename,
    cateimg
FROM ecate
ORDER BY catename
";

$result = mysqli_query($con, $sql);

if (!$result) {
    throw new RuntimeException(mysqli_error($con));
}

$ecategories = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>

<?php if (!empty($ecategories)): ?>

<div class="estore-grid">

<?php foreach ($ecategories as $row): ?>

<div class="estore-card">

<a
    href="http://www.ebydeal.com/"
    target="_blank"
    rel="noopener noreferrer"
>

<img
    src="user/logo/<?= htmlspecialchars($row['cateimg'], ENT_QUOTES, 'UTF-8'); ?>"
    alt="<?= htmlspecialchars($row['catename'], ENT_QUOTES, 'UTF-8'); ?>"
	loading="lazy"
>

<h3>

<?= htmlspecialchars($row['catename'], ENT_QUOTES, 'UTF-8'); ?>

</h3>

</a>

</div>

<?php endforeach; ?>

</div>

<?php else: ?>

<p class="no-data">
No product categories available.
</p>

<?php endif; ?>

</div>

</section>
<footer class="site-footer">

    <?php require_once __DIR__ . "/footer.php"; ?>

</footer>

<a href="<?php echo $path; ?>payment/subscribe.php" class="demoTest"></a>
<?php

$sql = "
SELECT
    website,
    img
FROM homeimg
ORDER BY aid DESC
LIMIT 4
";

$result = mysqli_query($con, $sql);

if (!$result) {
    throw new RuntimeException(mysqli_error($con));
}

$popupImages = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>

<div class="popup-wrapper" style="display:none;">

<div id="inline_content" class="popup-content">

<?php if (!empty($popupImages)): ?>

<div class="popup-grid">

<?php foreach ($popupImages as $row): ?>

<?php if ($row['img'] !== '-'): ?>

<div class="popup-card">

<a
href="<?= htmlspecialchars($url) ?>"
target="_blank"
rel="noopener noreferrer"
>

<img
src="user/logo/<?= htmlspecialchars($row['img'], ENT_QUOTES, 'UTF-8'); ?>"
alt="Advertisement"
loading="lazy">

</a>

</div>

<?php endif; ?>

<?php endforeach; ?>

</div>

<?php else: ?>

<p class="no-data">

No advertisements available.

</p>

<?php endif; ?>

</div>

</div>


<script>
const slider = document.querySelector('.verified-slider');

if(slider){
let direction = 1;

setInterval(()=>{
slider.scrollLeft += direction;
if(
slider.scrollLeft + slider.clientWidth >= slider.scrollWidth
){
direction = -1;
}
if(slider.scrollLeft <= 0){
direction = 1;
}
},30);
}

</script>
</body>

</html>
<?php
declare(strict_types=1);

require_once __DIR__ . '/config.php';

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_set_cookie_params([
        'lifetime' => 0,
        'path'     => '/',
        'domain'   => '',
        'secure'   => !empty($_SERVER['HTTPS']),
        'httponly' => true,
        'samesite' => 'Lax',
    ]);

    session_start();
}

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

function h(?string $value): string
{
    return htmlspecialchars(
        $value ?? '',
        ENT_QUOTES | ENT_SUBSTITUTE,
        'UTF-8'
    );
}

$sql = "SELECT *
        FROM postjob
        ORDER BY jid DESC";

$result = mysqli_query($con, $sql);

if (!$result) {
    throw new RuntimeException(mysqli_error($con));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1">

<meta http-equiv="X-UA-Compatible"
      content="IE=edge">

<title>
Look8US : Business Directory Kota Rajasthan | Job Offers | Online Business Directory
</title>

<meta
name="description"
content="Search the latest job offers in Kota Rajasthan. Browse verified companies, businesses, employers, manufacturers, suppliers and recruiters on Look8US.">

<meta
name="keywords"
content="job kota, jobs kota, government jobs, IT jobs, marketing jobs, online job portal, business directory kota, Look8US">

<link rel="stylesheet" href="akc.css">

<style>
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
        #f4f6f9
        url("images/bg.png")
        repeat;
    color:#333;
    line-height:1.6;
}

.page-wrapper{
    width:min(1200px,96%);
    margin:auto;
}

.page-title{
    background:#d2d2d2;
    padding:18px 20px;
    margin-bottom:20px;
}

.page-title h1{
    font-size:clamp(1.6rem,3vw,2.2rem);
    color:#333;
    font-weight:600;
}

.content-box{
    background:#fff;
    border-radius:8px;
    box-shadow:
        0 3px 12px
        rgba(0,0,0,.08);
    padding:20px;
    overflow:hidden;
}

.section-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    flex-wrap:wrap;
    gap:10px;
    background:#ddd;
    padding:14px 18px;
    border-radius:6px;
    margin-bottom:25px;
}

.section-header h2{
    font-size:1.1rem;
    color:#003366;
}

.back-link{
    text-decoration:none;
    color:#0056b3;
    font-weight:bold;
    transition:.3s;
}

.back-link:hover{
    color:#000;
}

.job-list{
    display:flex;
    flex-direction:column;
    gap:18px;
}

.job-card{
    display:grid;
    grid-template-columns:
        220px
        1fr
        120px;
    gap:20px;
    align-items:center;
    padding:20px;
    background:#fff;
    border:1px solid #ddd;
    border-radius:8px;
    transition:.25s;
 box-shadow:
        0 2px 8px rgba(0,0,0,.05);
}

.job-card:hover{
    box-shadow:
        0 8px 24px rgba(0,0,0,.12);
    transform:translateY(-2px);
}

.job-meta{
    margin-bottom:10px;
    font-size:.95rem;
    color:#555;
}

.job-category{
    color:#003366;
    margin-bottom:8px;
    font-size:1.15rem;
}

.job-title{
    font-size:1.35rem;
    color:#111;
    margin-bottom:12px;
}

.job-description{
    margin-bottom:15px;
    color:#555;
}

.job-details{
    display:flex;
    flex-wrap:wrap;
    gap:15px;
    font-size:.95rem;
}

.job-right{
    display:flex;
    justify-content:center;
    align-items:center;
}

.view-btn{
    display:inline-block;
    padding:10px 22px;
    background:#0056b3;
    color:#fff;
    text-decoration:none;
    border-radius:5px;
    font-weight:600;
    transition:.25s;
}

.view-btn:hover{
    background:#003d80;
}

.no-record{
    text-align:center;
    padding:50px 20px;
    color:#666;
}
</style>
</head>

<body>
<div class="page-wrapper">
<?php require_once __DIR__ . '/header.php'; ?>
<section class="page-title">
    <h1>View Job Offers</h1>
</section>
<main class="content-box">
    <div class="section-header">
        <h2>
            Required
            <small style="font-weight:normal;">
                (Click on <strong>View</strong> to see complete job details)
            </small>
        </h2>
        <a
            href="javascript:window.history.back();"
            class="back-link"
            aria-label="Go Back">
            &laquo; Back
        </a>
    </div>
<?php
/*
|--------------------------------------------------------------------------
| Job Listing Starts
|--------------------------------------------------------------------------
*/
?>

<div class="job-list">

<?php
if (mysqli_num_rows($result) > 0):
    while ($row = mysqli_fetch_assoc($result)):
?>

<article class="job-card">
    <div class="job-left">
        <div class="job-meta">
            <strong>Post Date:</strong>
            <?= h($row['y']) ?>
        </div>
        <div class="job-meta">
            <strong>Location:</strong>
            <?= h($row['city']) ?>
        </div>
    </div>

    <div class="job-middle">
        <h3 class="job-category">
            <?= h($row['cate']) ?>
        </h3>
        <h2 class="job-title">
            <?= h($row['atitle']) ?>
        </h2>
        <p class="job-description">
            <?= nl2br(h($row['discr'])) ?>
        </p>
        <div class="job-details">
            <span>
                <strong>Job Type:</strong>
                <?= h($row['jtype']) ?>
            </span>
            <span>
                <strong>Salary:</strong>
                Rs.
                <?= h($row['srange']) ?>
                <?= h($row['stype']) ?>
            </span>
            <span>
                <strong>City:</strong>
                <?= h($row['city']) ?>
            </span>
        </div>
    </div>
    <div class="job-right">
        <a
            class="view-btn"
            href="viewJobDetail.php?id=<?= urlencode((string)$row['jid']) ?>"
            aria-label="View Job Details">
            View
        </a>
    </div>
</article>

<?php
    endwhile;
?>
</div>
<div style="height:15px;"></div>
<?php
else:
?>
<div class="no-record">
    <h3>No Job Offers Available</h3>
    <p>
        There are currently no job offers available.
        Please check back later.
    </p>
</div>
<?php
endif;
?>
</main>
<?php require_once __DIR__ . '/footer.php'; ?>
</div>
</body>
</html>
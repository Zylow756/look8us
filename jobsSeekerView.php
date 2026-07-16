<?php
declare(strict_types=1);

require_once __DIR__ . '/config.php';

/*
|--------------------------------------------------------------------------
| Secure Session
|--------------------------------------------------------------------------
*/
if (session_status() !== PHP_SESSION_ACTIVE) {

    session_set_cookie_params([
        'lifetime' => 0,
        'path'     => '/',
        'domain'   => '',
        'secure'   => !empty($_SERVER['HTTPS']),
        'httponly' => true,
        'samesite' => 'Lax'
    ]);

    session_start();
}

/*
|--------------------------------------------------------------------------
| Common Escape Function
|--------------------------------------------------------------------------
*/
function e(?string $value): string
{
    return htmlspecialchars(
        $value ?? '',
        ENT_QUOTES | ENT_SUBSTITUTE,
        'UTF-8'
    );
}

/*
|--------------------------------------------------------------------------
| Database Connection Check
|--------------------------------------------------------------------------
*/
if (!isset($con) || !$con instanceof mysqli) {
    die('Database connection failed.');
}

/*
|--------------------------------------------------------------------------
| Fetch Job Seekers
|--------------------------------------------------------------------------
*/

$sql = "
    SELECT
        cid,
        pdate,
        city,
        cate,
        atitle,
        discr,
        jtype,
        exper
    FROM postcv
    ORDER BY cid DESC
";

$stmt = $con->prepare($sql);

if (!$stmt) {
    die('Prepare failed : ' . e($con->error));
}

$stmt->execute();

$result = $stmt->get_result();

$jobSeekers = [];

while ($row = $result->fetch_assoc()) {
    $jobSeekers[] = $row;
}

$stmt->close();

$totalRecords = count($jobSeekers);
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta
    name="viewport"
    content="width=device-width, initial-scale=1.0"
>

<meta
    http-equiv="X-UA-Compatible"
    content="IE=edge"
>

<title>
Look8US :
Business Directory Kota Rajasthan,
Online Business Directory,
Yellow Pages,
Verified Businesses,
Job Portal
</title>

<meta
    name="description"
    content="Look8US Business Directory Kota Rajasthan. Search jobs, apply online, business directory, verified companies, suppliers, manufacturers and service providers."
>

<meta
    name="keywords"
    content="look8us, jobs kota, job portal, online jobs, business directory, kota jobs, employers, job seekers"
>

<meta
    name="robots"
    content="index,follow"
>

<meta
    name="author"
    content="Look8US"
>

<link
    rel="stylesheet"
    href="akc.css"
>

<style>

/*************************************************
    RESET
*************************************************/

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

html{

    scroll-behavior:smooth;

}

body{

    font-family:Arial, Helvetica, sans-serif;

    background:#f4f4f4 url("images/bg.png") repeat;

    color:#333;

    line-height:1.6;

    min-height:100vh;

}

/*************************************************
    LINKS
*************************************************/

a{

    text-decoration:none;

}

a:hover{

    text-decoration:none;

}

/*************************************************
    PAGE WRAPPER
*************************************************/

.page-wrapper{

    width:min(1200px,96%);

    margin:auto;

}

/*************************************************
    PAGE TITLE
*************************************************/

.page-title{

    width:100%;

    background:#d2d2d2;

    margin-top:0;

}

.page-title .inner{

    width:min(1200px,96%);

    margin:auto;

    padding:18px 10px;

}

.page-title h1{

    font-size:clamp(26px,3vw,40px);

    color:#333;

    font-weight:600;

}

/*************************************************
    MAIN CONTENT
*************************************************/

.content{

    background:#fff;

    padding:20px;

    margin:20px auto;

    border-radius:8px;

    box-shadow:0 3px 12px rgba(0,0,0,.08);

}

/*************************************************
    SECTION HEADER
*************************************************/

.section-header{

    display:flex;

    justify-content:space-between;

    align-items:center;

    flex-wrap:wrap;

    gap:15px;

    background:#dddddd;

    padding:15px;

    border-radius:6px;

    margin-bottom:20px;

}

.section-header h2{

    font-size:20px;

    color:#003366;

}

.back-btn{

    color:#003366;

    font-weight:bold;

}

.back-btn:hover{

    color:#cc0000;

}

/*************************************************
    RECORD COUNT
*************************************************/

.record-count{

    margin-bottom:20px;

    color:#666;

    font-size:15px;

}

/*************************************************
    JOB CARD
*************************************************/

.job-card{

    display:grid;

    grid-template-columns:220px 1fr 120px;

    gap:20px;

    padding:20px;

    border-bottom:1px solid #e5e5e5;

}

.job-card:last-child{

    border-bottom:none;

}

.job-left{

    font-size:15px;

}

.job-middle h3{

    font-size:20px;

    color:#003366;

    margin-bottom:10px;

}

.job-middle p{

    margin-bottom:8px;

}

.job-right{

    display:flex;

    justify-content:center;

    align-items:center;

}

/*************************************************
    BUTTON
*************************************************/

.view-btn{

    display:inline-block;

    padding:10px 22px;

    background:#0056b3;

    color:#fff;

    border-radius:6px;

    transition:.3s;

    font-weight:bold;

}

.view-btn:hover{

    background:#003b78;

}

/*************************************************
    EMPTY MESSAGE
*************************************************/

.empty-box{

    text-align:center;

    padding:60px 20px;

    font-size:20px;

    color:#888;

}
</style>

</head>

<body>

<div class="page-wrapper">

<?php require_once 'header.php'; ?>
<section class="page-title">
    <div class="inner">
        <h1>View Job Seekers</h1>
    </div>
</section>
<main class="content">

    <!-- ===========================
         Section Header
    ============================ -->

    <div class="section-header">

        <h2>
            Job Seekers
            <small style="font-weight:normal;font-size:14px;">
                (Click <strong>View</strong> to see contact details)
            </small>
        </h2>

        <a
            href="javascript:window.history.back();"
            class="back-btn"
            aria-label="Go Back"
        >
            &laquo; Back
        </a>

    </div>

    <!-- ===========================
         Record Counter
    ============================ -->

    <div class="record-count">

        Total Job Seekers :
        <strong><?php echo $totalRecords; ?></strong>

    </div>

    <!-- ===========================
         Job Listing Container
    ============================ -->

    <section
        class="job-list"
        aria-label="Job Seekers List"
    >
<?php if ($totalRecords > 0): ?>

    <?php foreach ($jobSeekers as $job): ?>

        <article class="job-card">

            <!-- ===========================
                 Left Column
            ============================ -->

            <div class="job-left">

                <p>
                    <strong>Post Date</strong><br>
                    <?php echo e($job['pdate']); ?>
                </p>

                <br>

                <p>
                    <strong>Location</strong><br>
                    <?php echo e($job['city']); ?>
                </p>

            </div>

            <!-- ===========================
                 Middle Column
            ============================ -->

            <div class="job-middle">

                <h3>
                    <?php echo e($job['cate']); ?>
                </h3>

                <p>
                    <strong>Job Title :</strong>
                    <?php echo e($job['atitle']); ?>
                </p>

                <p>
                    <strong>Description :</strong><br>
                    <?php echo nl2br(e($job['discr'])); ?>
                </p>

                <p>
                    <strong>Job Type :</strong>
                    <?php echo e($job['jtype']); ?>
                </p>

                <p>
                    <strong>City :</strong>
                    <?php echo e($job['city']); ?>
                </p>

                <p>
                    <strong>Experience :</strong>
                    <?php echo e($job['exper']); ?>
                </p>

            </div>

            <!-- ===========================
                 Right Column
            ============================ -->

            <div class="job-right">

                <a
                    href="viewSeeKerDetail.php?id=<?php echo urlencode((string)$job['cid']); ?>"
                    class="view-btn"
                    aria-label="View Job Seeker Details"
                >
                    View
                </a>

            </div>

        </article>

    <?php endforeach; ?>

<?php else: ?>

    <div class="empty-box">

        <h2>No Job Seekers Found</h2>

        <p>
            There are currently no job seeker records available.
        </p>

    </div>

<?php endif; ?>

    </section>

</main>

</div>
<?php require_once 'footer.php'; ?>

</body>
</html>


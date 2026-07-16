<?php
declare(strict_types=1);

require_once __DIR__ . '/config.php';

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_set_cookie_params([
        'lifetime' => 0,
        'path'     => '/',
        'domain'   => '',
        'secure' => !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
        'httponly' => true,
        'samesite' => 'Lax'
    ]);
    session_start();
}
header('X-Frame-Options: SAMEORIGIN');
header('X-Content-Type-Options: nosniff');
header('Referrer-Policy: strict-origin-when-cross-origin');

?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport"
      content="width=device-width, initial-scale=1">
<title>
Look8US :
Business Directory Kota, Rajasthan, India |
Jobs |
Online Business Directory |
Yellow Pages |
Trusted & Verified Businesses
</title>

<meta name="description"
content="Look8US.com from Kota Rajasthan is your local Business Directory. Find employers, job opportunities, job seekers, manufacturers, exporters, suppliers and verified businesses.">

<meta name="keywords"
content="look8us, jobs kota, jobs in kota, government jobs, IT jobs, marketing jobs, job portal, online business directory, employers, resume upload">

<meta name="robots"
content="index,follow">

<meta name="author"
content="Look8US">

<link rel="canonical"
href="https://look8us.com/jobs.php">

<link rel="stylesheet"
href="akc.css">

<style>
*,
*::before,
*::after{
    box-sizing:border-box;
}

html{
    scroll-behavior:smooth;
}

body.jobs-page{
    margin:0;
    font-family:
        Arial,
        Helvetica,
        sans-serif;
    background:
        #f5f5f5
        url("images/bg.png");
    color:#333;
    line-height:1.6;
}

.container{
    width:min(1200px,96%);
    margin:auto;
}

.page-banner{
    background:#d2d2d2;
    padding:25px 20px;
}

.page-title{
    margin:0;
    font-size:clamp(2rem,4vw,2.8rem);
    color:#333;
    font-weight:600;
}

.main-wrapper{
    background:#fff;
    margin:30px auto;
    border-radius:8px;
    box-shadow:
        0 5px 18px rgba(0,0,0,.12);
    padding:35px;
}

.text-center{
    text-align:center;
}

.mt-2{
    margin-top:20px;
}

.mt-3{
    margin-top:30px;
}

.mt-4{
    margin-top:40px;
}

img{
    max-width:100%;
    height:auto;
    border:none;
}

.jobs-content{
    width:100%;
    display:flex;
    flex-direction:column;
    align-items:center;
}

.content-panel{
    width:100%;
}

.section-gap{
    margin-top:40px;
}

.section-gap-small{
    margin-top:20px;
}

.jobs-grid{
    width:100%;
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:30px;
    margin:30px auto;
}

.job-card{
    background:#ffffff;
    border-radius:10px;
    overflow:hidden;
    box-shadow:0 10px 25px rgba(0,0,0,.12);
    transition:.30s ease;
}

.job-card:hover{
    transform:translateY(-6px);
    box-shadow:0 15px 35px rgba(0,0,0,.18);
}

.job-card-header{
    padding:18px;
    color:#fff;
    text-align:center;
    font-size:1.75rem;
    font-weight:700;
}

.job-card-header.red{
    background:#d32f2f;
}

.job-card-header.blue{
    background:#1e40af;
}

.job-card-body{
    padding:35px 25px;
    text-align:center;
    min-height:220px;
    display:flex;
    flex-direction:column;
    justify-content:center;
    align-items:center;
}

.job-card-body img{
    max-width:220px;
    width:100%;
    height:auto;
    transition:.25s;
}

.job-card-body img:hover{
    transform:scale(1.03);
}

.job-card-body p{
    margin-top:18px;
    color:#003366;
    font-size:.95rem;
    line-height:1.7;
}

.card-bg-blue{
    background:#d8e6fc;
}

.card-bg-yellow{
    background:#ffe9bb;
}

.card-bg-pink{
    background:#ffe6ff;
}

.card-bg-cream{
    background:#ffffcc;
}

.job-advertisement{
    width:100%;
    text-align:center;
    margin-top:40px;
}

.job-banner{
    width:100%;
    max-width:800px;
    height:auto;
    border-radius:10px;
    display:block;
    margin:0 auto;
    box-shadow:0 8px 25px rgba(0,0,0,.15);
}
</style>
</head>
<body class="jobs-page">
<div class="text-center">
<?php require_once __DIR__ . '/header.php'; ?>
<section class="page-banner">
    <div class="container">
        <h1 class="page-title">
            Jobs
        </h1>
    </div>
</section>
<main class="container">
    <section class="main-wrapper">
        <div class="text-center">
            <br>
        </div>

        <div class="jobs-content">
<section class="jobs-grid">
    <article class="job-card">
        <div class="job-card-header red">
            View Listed
        </div>

        <div class="job-card-body card-bg-blue">
            <a href="jobsOfferView.php">
                <img
                    src="images/button49.jpg"
loading="lazy"
decoding="async"
                    alt="View Job Offers">
            </a>
            <p>
                View all listed Job Offers uploaded by Employers.
            </p>
        </div>

        <div class="job-card-body card-bg-pink">
            <a href="jobsSeekerView.php">
                <img
                    src="images/button31.jpg"
loading="lazy"
decoding="async"
                    alt="View Job Seekers CV">
            </a>
            <p>
                Companies can browse and search candidate CVs
                according to their hiring requirements.
            </p>
        </div>
    </article>
    <article class="job-card">
        <div class="job-card-header blue">
            Post / Upload
        </div>

        <div class="job-card-body card-bg-yellow">
            <a href="jobSeeker.php">
                <img
                    src="images/button3D.jpg"
loading="lazy"
decoding="async"
                    alt="Post Your Resume">
            </a>
            <p>
                Upload your Resume / CV so employers can
                discover your profile.
            </p>
        </div>

        <div class="job-card-body card-bg-cream">
            <a href="jobPost.php">
                <img
                    src="images/button4C.jpg"
loading="lazy"
decoding="async"
                    alt="Post Job Advertisement">
            </a>
            <p>
                Post your company job openings and recruit
                qualified candidates.
            </p>
        </div>
    </article>
</section>
        <section class="job-advertisement section-gap">
            <img
                src="images/job%20Ads.JPG"
                alt="Jobs Advertisement"
loading="lazy"
decoding="async"
                class="job-banner">
        </section>
    </div>
    </section>
</main>
</div>
<?php require_once __DIR__ . '/footer.php'; ?>
</body>
</html>
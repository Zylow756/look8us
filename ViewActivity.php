<?php
declare(strict_types=1);
require_once __DIR__ . "/config.php";
/*
|--------------------------------------------------------------------------
| Secure Session Handling
|--------------------------------------------------------------------------
*/

if (session_status() === PHP_SESSION_NONE) {

    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'secure' => isset($_SERVER['HTTPS']),
        'httponly' => true,
        'samesite' => 'Lax'
    ]);

    session_start();
}/*
|--------------------------------------------------------------------------
| Validate Activity ID
|--------------------------------------------------------------------------
*/

$activityId = filter_input(
    INPUT_GET,
    'id',
    FILTER_VALIDATE_INT
);$activity = null;/*
|--------------------------------------------------------------------------
| Fetch Activity Details Securely
|--------------------------------------------------------------------------
*/

if ($activityId !== false && $activityId !== null) {    $stmt = $con->prepare(
        "SELECT 
            eid,
            edate,
            eventhead,
            eventdetail,
            eimg
         FROM activity
         WHERE eid = ?
         LIMIT 1"
    );    if ($stmt) {

        $stmt->bind_param(
            "i",
            $activityId
        );        $stmt->execute();        $result = $stmt->get_result();        if ($result && $result->num_rows > 0) {

            $activity = $result->fetch_assoc();

        }        $stmt->close();

    }

}?>
<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0"><title>
Look8US : Business Directory Kota Rajasthan | Events & Activities
</title><meta name="description"
content="Look8US Kota Rajasthan Business Directory. View verified business events and activities, contacts, services and updates." ><meta name="keywords"
content="Look8US, Kota Business Directory, Rajasthan Events, Business Activities, Yellow Pages India"><link rel="stylesheet" href="akc.css">
<style>
*{
    box-sizing:border-box;
}body{

    margin:0;
    padding:0;

    font-family:
    Arial,
    Helvetica,
    sans-serif;

    background:#f5f5f5;

}/*
|--------------------------------------------------------------------------
| Page Header
|--------------------------------------------------------------------------
*/.page-title{

    width:100%;

    background:#d2d2d2;

    padding:15px;

    color:#333;

}
.page-title .container{

    max-width:1020px;

    margin:auto;

}
.page-title h1{

    font-size:clamp(24px,4vw,36px);

    margin:0;

}
/*
|--------------------------------------------------------------------------
| Main Content
|--------------------------------------------------------------------------
*/.activity-container{    max-width:1020px;

    margin:20px auto;

    background:white;

    padding:25px;

    border-radius:8px;

    box-shadow:
    0 2px 8px rgba(0,0,0,0.1);

}
.activity-details{

    font-size:16px;

    line-height:1.7;

}
.activity-details strong{

    color:#0033cc;

}
.activity-image{

    margin-top:20px;

    max-width:100%;

    height:auto;

    border-radius:6px;

}
</style>
</head><body><?php require_once __DIR__ . "/header.php"; ?><section class="page-title">

<div class="container">

<h1>
Event &amp; Activity
</h1>

</div>

</section>
<!--
|--------------------------------------------------------------------------
| Activity Content Section
|--------------------------------------------------------------------------
-->

<section class="activity-container"><?php if ($activity !== null): ?><div class="activity-details"><p>
<strong>
Event Date :
</strong>

<?= htmlspecialchars(
        (string)$activity['edate'],
        ENT_QUOTES | ENT_SUBSTITUTE,
        'UTF-8'
); ?>

</p>
<p>

<strong>
Subject :
</strong>

<?= htmlspecialchars(
        (string)$activity['eventhead'],
        ENT_QUOTES | ENT_SUBSTITUTE,
        'UTF-8'
); ?></p>
<p>

<strong>
Detail :
</strong>

<?= nl2br(
        htmlspecialchars(
            (string)$activity['eventdetail'],
            ENT_QUOTES | ENT_SUBSTITUTE,
            'UTF-8'
        )
); ?></p>
<?php
if (
    !empty($activity['eimg']) &&
    $activity['eimg'] !== "-"
) {
    $imageName = basename(
        (string)$activity['eimg']
    );    $allowedExtensions = [
        'jpg',
        'jpeg',
        'png',
        'gif',
        'webp'
    ];    $extension = strtolower(
        pathinfo(
            $imageName,
            PATHINFO_EXTENSION
        )
    );
    if (
        in_array(
            $extension,
            $allowedExtensions,
            true
        )
    ) {        $imagePath = 
            __DIR__ .
            "/User/logo//" .
            $imageName;

        /*
        |--------------------------------------------------------------------------
        | Check physical file exists
        |--------------------------------------------------------------------------
        */        if (file_exists($imagePath)) {?>

<img
    src="User/logo//<?= htmlspecialchars(
        $imageName,
        ENT_QUOTES | ENT_SUBSTITUTE,
        'UTF-8'
    ); ?>"
    
    alt="<?= htmlspecialchars(
        (string)$activity['eventhead'],
        ENT_QUOTES | ENT_SUBSTITUTE,
        'UTF-8'
    ); ?>"
    
    class="activity-image"

    loading="lazy"
><?php

        }

    }

}?></div>
<?php else: ?><div class="activity-details"><h2>
Activity Not Found
</h2><p>
The requested event or activity does not exist or has been removed.
</p></div>
<?php endif; ?></section>
<?php require_once __DIR__ . "/footer.php"; ?></body>

</html>
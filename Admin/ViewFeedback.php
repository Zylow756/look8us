<?php
declare(strict_types=1);

require_once __DIR__ . '/../config.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION['admin'])) {
    header('Location: index.php?r=0');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="Content-Language" content="en-us">
<title>Online Directory : Admin Panel</title>

<link rel="stylesheet" href="../akc.css">

<style>
body{
    margin:0;
    background:#70828F url('img/bg.png') repeat-x;
    font-family:Arial,Helvetica,sans-serif;
}

/* Main Container */

.page-container{
    width:98%;
    max-width:1600px;
    margin:0 auto;
    background:#fff;
}

/* Header */

.header-area{
    width:100%;
}

.separator{
    height:12px;
    background:#697779;
}

/* Two-column Layout */

.main-layout{
    display:flex;
    align-items:flex-start;
}

/* Sidebar */

.sidebar{
    width:230px;
    min-width:230px;
    background:#EEEEEE;
}

/* Content */

.content{
    flex:1;
    padding:20px;
    overflow:hidden;
}

.content h1{
    margin-top:10px;
    font-size:28px;
    color:#003366;
}

/* Table Wrapper */

.table-wrapper{
    width:100%;
    overflow-x:auto;
}

/* Table */

.table2{
    border-collapse:collapse;
    min-width:1500px;
    width:100%;
    background:#fff;
}

.table2 th,
.table2 td{
    border:1px solid #CCCCCC;
    padding:10px;
    font-size:15px;
    vertical-align:top;
}

.table2 th{
    background:#D2D2D2;
    font-weight:bold;
}

/* Column Widths */

.sno-col{
    width:70px;
    text-align:center;
}

.date-col{
    width:130px;
    white-space:nowrap;
}

.name-col{
    width:180px;
}

.mobile-col{
    width:150px;
    white-space:nowrap;
}

.email-col{
    width:330px;
    word-break:break-word;
}

.city-col{
    width:150px;
}

.msg-col{
    width:450px;
    white-space:normal;
    word-break:break-word;
}

/* Zebra */

.table2 tbody tr:nth-child(even){
    background:#f7f7f7;
}

.table2 tbody tr:hover{
    background:#eef7ff;
}

/* Footer */

.footer-area{
    margin-top:20px;
}
</style>

</head>

<body>

<div class="page-container">

    <div class="header-area">
        <?php require_once "../header.php"; ?>
    </div>

    <div class="separator"></div>

    <div class="main-layout">

        <aside class="sidebar">
            <?php
            if (!empty($_SESSION['id'])) {
                require_once "sidemenu.php";
            }
            ?>
        </aside>

        <main class="content">

            <h1>View All Feedback &amp; Enquiry</h1>

            <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>">

                <div class="table-wrapper">

                    <table class="table2">

                        <thead>

                        <tr>

                            <th class="sno-col">SNO.</th>
                            <th class="date-col">Date</th>
                            <th class="name-col">Name</th>
                            <th class="mobile-col">Mobile</th>
                            <th class="email-col">Email</th>
                            <th class="city-col">City</th>
                            <th class="msg-col">Message</th>

                        </tr>

                        </thead>

                        <tbody>

                        <?php

                        $sql = "SELECT * FROM feedback ORDER BY fid DESC LIMIT 50";

                        $result = mysqli_query($con, $sql);

                        if (!$result) {
                            die(mysqli_error($con));
                        }

                        $i = 1;

                        while ($row = mysqli_fetch_assoc($result)) {

                        ?>

                        <tr>

                            <td class="sno-col"><?= $i++; ?></td>

                            <td class="date-col"><?= htmlspecialchars($row['fdate']) ?></td>

                            <td class="name-col"><?= htmlspecialchars($row['fname']) ?></td>

                            <td class="mobile-col"><?= htmlspecialchars($row['mobile']) ?></td>

                            <td class="email-col"><?= htmlspecialchars($row['email']) ?></td>

                            <td class="city-col"><?= htmlspecialchars($row['city']) ?></td>

                            <td class="msg-col"><?= htmlspecialchars($row['msg']) ?></td>

                        </tr>

                        <?php } ?>

                        </tbody>

                    </table>

                </div>

            </form>

        </main>

    </div>

    <div class="footer-area">
        <?php require_once "../footer.php"; ?>
    </div>

</div>
</body>
</html>
<?php
require_once "config.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (empty($_SESSION['user'])) {
    header("Location: index.php?r=0");
    exit;
}
		
// $conn=mysqli_connect('localhost','root','');
// $db=mysqli_select_db('look8us',$conn);

$filename = "agenquiry-Excelexport.xls"; // File Name
// Download file
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Type: application/vnd.ms-excel");


$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$st = "SELECT
            edate AS Date,
            ename AS Name,
            cate AS Qualification,
            mobile AS Mobile,
            email AS Mobile2,
            address AS Address,
            area AS Area,
            cdate AS LastFeedback,
            ndate AS NextDate,
            estatus AS Status
        FROM agenquiry
        WHERE aid = $id
          AND hid = 1
        ORDER BY eid DESC";


$user_query = mysqli_query($con,$st);
if (!$user_query) {
    die(mysqli_error($con));
}

// Write data to file
$flag = false;
while ($row = mysqli_fetch_assoc($user_query)) 
{
    if (!$flag) {
        // display field/column names as first row
        echo implode("\t", array_keys($row)) . "\r\n";
        $flag = true;
    }
    echo implode("\t", array_map(function ($value) {
    return str_replace(["\r", "\n", "\t"], " ", $value);
}, $row)) . "\r\n";
}
?>
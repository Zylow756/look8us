<?php
// Connection 


include("../config.php"); 
		
// $conn=mysql_connect('localhost','root','');
// $db=mysql_select_db('look8us',$conn);

$filename = "agenquiry-Excelexport.xls"; // File Name
// Download file
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Type: application/vnd.ms-excel");


$st="Select edate as Date ,ename as Name,cate as Qualification,Mobile,email as Mobile2 ,Address, Area,cdate as LastFeedback,ndate as NextDate,estatus as Status from agenquiry where aid=" . $_GET['id'] ." and hid=1  order by eid desc";


$user_query = mysql_query($st,$con);
// Write data to file
$flag = false;
while ($row = mysql_fetch_assoc($user_query)) 
{
    if (!$flag) {
        // display field/column names as first row
        echo implode("\t", array_keys($row)) . "\r\n";
        $flag = true;
    }
    echo implode("\t", array_values($row)) . "\r\n";
}
?>
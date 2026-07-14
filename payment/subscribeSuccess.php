<?php
require_once __DIR__ . "/../config.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta charset="UTF-8">
<title>Online Exam Test Result & Analysis</title>
 <link rel="stylesheet" type="text/css" href="../akc.css" />
  <link rel="stylesheet" type="text/css" href="../TableCSSCode.css" />

<script type="text/javascript" src="../admin/jquery.js"></script>



</head>

<style type="text/css"> 

body
{
background-image:url('../Admin/img/bg.png');
background-repeat:repeat-x;
background-color: #70828F
} 
</style>
<body topmargin="0" leftmargin="0" rightmargin="0" bottommargin="2" >

<div align="center">

<table border="0" width="1020" height="23" cellpadding="0" style="border-collapse: collapse">
	<tr>
		<td bgcolor="#D2D2D2">
		<?php 

require_once "../header.php";
 ?>
		</td>
	</tr>
</table>

<table border="0" width="1020" id="table2" cellpadding="0" style="border-collapse: collapse" bordercolor="#FFFFCC">
				
			
				<tr>
					<td valign="top" bgcolor="#E3E3E3" width="228" align="left">
					
					&nbsp;<?php if ($_SESSION["mid"]!="") include("../user/sidemenu.php"); ?></td>
					<td valign="top" width="799" bgcolor="#FFFFFF">
					
					<font color="#333333" size="5">&nbsp;</font><b><font color="#333333">Subscribe</font></b><p>&nbsp;</p>
					<p align="center"><font color="#FF0000"><b>Your Transaction 
					Successfully done.</b></font></p>
					<p align="center">
					<?php 
					if ($_GET["flag"]==0)
					{
					//echo "Your Registration done successfully. Your User Name is :". $_GET["us"]; 	
					//echo "<br>Your Password is :". $_GET["pass"]; 	
					//echo "<br><br><a href='../student/index.php' class='big'>Click here for login >></a>"; 
					}
					else
					{
					echo "Subscribed Package add in your account.";
					}
					?>
					
					</p>
					<p align="center">&nbsp;</p>
					<p>&nbsp;</p>
					<p>&nbsp;</p>
					<p>&nbsp;</p>
					<p>&nbsp;</p></td>
				</tr>
			</table>
			
	<table border="0" width="980" id="table1" style="border-collapse: collapse" bordercolor="#F2F2F2" bgcolor="#FFFFFF" cellpadding="0">
		<tr>
			<td valign="top">
			
			
			<?php require_once "../footer.php"; ?></div>
			</td>
		</tr>
	</table>



</body>

</html>
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


<body topmargin="0" leftmargin="0" rightmargin="0" bottommargin="2" background="../images/bg.png">

<div align="center">
<?php 

require_once "../header.php";
 ?>
<table border="0" width="100%" height="100" cellpadding="0" style="border-collapse: collapse">
	<tr>
		<td bgcolor="#D2D2D2">
		<div align="center">
			<table border="0" width="1010" id="table33" style="border-collapse: collapse" height="40" cellpadding="0">
				<tr>
					<td><font size="6">&nbsp;</font><font color="#333333" size="5">Subscribe</font></td>
				</tr>
			</table>
		</div>
		</td>
	</tr>
</table>

	<table border="0" width="1020" id="table1" style="border-collapse: collapse" bordercolor="#F2F2F2" bgcolor="#FFFFFF" cellpadding="0">
		<tr>
			<td valign="top">
			<div align="center">
			<table border="0" width="100%" id="table2" cellpadding="0" style="border-collapse: collapse" bordercolor="#FFFFCC">
				
			
				<tr>
					<td valign="top">
					
					&nbsp;<p>&nbsp;</p>
					<p align="center"><font color="#FF0000"><b>Opps ! , 
					Transaction NOT Successfully done,&nbsp; Subscription 
					Failed.</b></font></p>
					<p align="center"><font color="#FF0000"><b>
					<a href="<?php echo $path; ?>user/payment.php"  class="a2">try again &gt;&gt;</a></b></font></p>
					<p>&nbsp;</p>
					<p>&nbsp;</p>
					<p>&nbsp;</p>
					<p>&nbsp;</p></td>
				</tr>
			</table>
			</div>
			</td>
		</tr>
	</table>
</div>

<div align="center">
	<?php require_once "../footer.php"; ?>
</div>

</body>

</html>
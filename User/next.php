<?php
require_once "config.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (empty($_SESSION['user'])) {
    header("Location: index.php?r=0");
    exit;
}
?>
<html>

<head>
<meta charset="UTF-8">
<title>Online Directory</title>
 <link rel="stylesheet" type="text/css" href="../akc.css" />

</head>

<body topmargin="0" leftmargin="0" rightmargin="0" bottommargin="0">

<table border="0" width="100%" id="table1" style="border-collapse: collapse" bordercolor="#C0C0C0" cellpadding="0">
	<tr>
		<td height="20" bgcolor="#E2E2E2"><?php  require_once "../header.php"; ?></td>
	</tr>
	<tr>
		<td align="center" valign="top">
		<table border="0" width="1010" id="table2" cellpadding="0" style="border-collapse: collapse" height="450">
			<tr>
				<td align="center" valign="top" style="border-left-style: dotted; border-left-width: 1px; border-right-style: dotted; border-right-width: 1px; border-top-width: 1px; border-bottom-width: 1px" bordercolor="#EEEEEE">&nbsp;<p>
				&nbsp;<p>
				<font color="#FF0000"><b>
		<?php 
		 
		if ($_GET["flag"]==2) echo "Member Registered, Your User ID : ".$_GET["us"]; 
 ?> <br><br>
				<a href="login.php">Click here for login>>
</a>
</b></font></td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td bgcolor="#F5F5F5" height="20"><?php  require_once "../footer.php"; ?></td>
	</tr>
</table>

</body>

</html>
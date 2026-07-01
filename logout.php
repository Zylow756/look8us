<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Login : Admin Panel</title>
 <link rel="stylesheet" type="text/css" href="akc.css" />

<style type="text/css"> 

body
{
background-image:url('img/bg.png');
background-repeat:repeat-x;
background-color: #70828F;

} 
</style>
</head>

<?php

session_start();
if (isset($_SESSION['user'])) 	$_SESSION['user']="";
if (isset($_SESSION['typ']))	$_SESSION['typ']="";
if (isset($_SESSION['id']))	$_SESSION['id']="";
if (isset($_SESSION['mid'])) $_SESSION['mid']="";
if (isset($_SESSION['mtyp'])) $_SESSION['mtyp']="";
if (isset($_SESSION['agent'])) $_SESSION['agent']="";
if (isset($_SESSION['aid'])) $_SESSION['aid']="";


		
session_destroy();

?>

	
<body bgcolor="#748592">

<div align="center">
	<table border="0" width="100%" id="table1" style="border-collapse: collapse" bordercolor="#CCCCCC" cellpadding="0">
		<tr>
			<td height="84" align="center" valign="top">			<?php  include("header.php"); ?></td>
		</tr>
		<tr>
			<td>
			<table border="0" width="100%" id="table2" style="border-collapse: collapse" bordercolor="#CCCCCC" height="418" cellpadding="0">
				<tr>
					<td align="center" valign="top" bgcolor="#FFFFFF">
					<p>&nbsp;<p>&nbsp;<p>&nbsp;<h1 style="text-align: center">You are Successfully Logout.</h1>
					<p style="text-align: center">
					<a href="index.php" class="a2">Go to 
					Home&gt;</a></p>
					<p>&nbsp;<p>&nbsp;<p>&nbsp;<p>&nbsp;</td>
				</tr>
			</table>
			</td>
		</tr>
		<tr>
			<td height="31" align="center" valign="top">			<?php  include("footer.php"); ?></td>
		</tr>
	</table>
</div>

</body>

</html>
<?php
require_once "config.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (empty($_SESSION['agent'])) {
    header("Location: index.php?r=0");
    exit;
}
?>
<html>
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta charset="UTF-8">
<title>Online Directory : Admin Panel</title>
 <link rel="stylesheet" type="text/css" href="../akc.css" />
<style type="text/css"> 
body
{
background-image:url('../Admin/img/bg.png');
background-repeat:repeat-x;
background-color: #70828F
} 
</style>
</head>
<?php
if (empty($_SESSION['agent'])) {
    header("Location: index.php?r=0");
    exit;
}

$msg=0;
if ( isset($_POST['submit']))
{
$pass=$_POST['pass'];

	$oldPass = mysqli_real_escape_string($con, $_POST['pass0']);
$agent   = mysqli_real_escape_string($con, $_SESSION['agent']);

$s = "SELECT * FROM agent WHERE us='$agent' AND pass='$oldPass'";
		$r=mysqli_query($con,$s);
if (!$r) {
    error_log(mysqli_error($con));
die("Database Error");
}
   //echo $s;    
	if ($row=mysqli_fetch_assoc($r))
	{
	$newPass = mysqli_real_escape_string($con, $pass);
$aid = (int)$_SESSION['aid'];

$s = "UPDATE agent SET pass='$newPass' WHERE aid=$aid";

mysqli_query($con, $s);
	$msg=1;
	//header("location: index.php");
  }
  else
  $msg=2;
}
?>
<body >
<div align="center">
	<table border="0" width="980" id="table1" style="border-collapse: collapse" bordercolor="#E2E2E2" cellpadding="0">
		<tr>
			<td height="50" align="center" valign="top">	<?php  require_once "../header.php"; ?>		</td>		</tr>
		<tr>
			<td height="12" align="center" valign="top" bgcolor="#697779">			
					</td>
		</tr>
		<tr>
			<td>
			<table border="0" width="100%" id="table2" style="border-collapse: collapse" bordercolor="#CCCCCC" height="206" cellpadding="0">
				<tr>
					<td width="228" valign="top" bgcolor="#E3E3E3">			<?php if ($_SESSION["aid"]!="") include("sidemenu.php"); ?></td>
					<td align="center" valign="top" bgcolor="#FFFFFF">
					&nbsp;<p  ><font color="#FF0000"><b>&nbsp;<?php if ($msg==1) echo "Password Changed Successfully"; else if ($msg==2) echo "Old Password Is Incorrect"; 
					
					//  echo $s;  
					  ?>
					  </b></font></p>
					<table border="0" width="80%" id="table4" cellpadding="0" style="border-collapse: collapse" height="175">
								<form name="frmhlp" id="frmhlp" method="post" action="password.php" onsubmit="">
<tr><td width="274" align="right">Old Password&nbsp; &nbsp;&nbsp; </td>
	<td width="208">
	<input class="txtbox" type="password" name="pass0" id="pass0" tabindex="4" required/></td>
	<td width="120">
	&nbsp;</td></tr>
<tr>
	<td width="274" height="39" align="right">New Password&nbsp;&nbsp;&nbsp; </td>
	<td width="208" height="39">
	<input class="txtbox" type="password" name="pass" id="pass" tabindex="4" required/></td>
	<td height="39" width="120">
	<p class="p1">&nbsp;</p></td>
</tr>
<tr><td width="274">&nbsp;</td><td width="208">
	<input  class="subbox" type="submit" value="Change" name="submit"/></td>
	<td width="120">
	&nbsp;</td></tr>
</form>
							</table>
					<p>&nbsp;</p>
					<p>&nbsp;</td>
				</tr>
			</table>
			</td>
		</tr>
		<tr>
			<td height="57" align="center" valign="top">			<?php  require_once "../footer.php"; ?></td>
		</tr>
	</table>
</div>
</body>
</html>
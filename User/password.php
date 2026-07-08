<?php
require_once __DIR__ . "/../config.php";

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
if ($_SESSION['user']=="")
	header("location: ../index.php?r=0");



$msg=0;
if ( isset($_POST['submit']))
{


$pass=base64_encode($_POST['pass']);

	$s="select * from member  where (uname='".$_SESSION['user']."' or email='".$_SESSION['user']."')  and pass='".base64_encode($_POST['pass0'])."'" ;
		$r=mysqli_query($con,$s);
if (!$r) {
    die(mysqli_error($con));
}
   //  echo $s;    
	if ($row=mysqli_fetch_assoc($r))
	{
	$s="update member  set  pass='".$pass."' where mid='".$_SESSION['mid']."' "  ;
	mysqli_query($con,$s);
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
					<td width="228" valign="top" bgcolor="#E3E3E3">			<?php if ($_SESSION["mid"]!="") include("sidemenu.php"); ?></td>
					<td align="center" valign="top" bgcolor="#FFFFFF">
					<h1>Change Your login Password</h1>
					<p>&nbsp;<?php if ($msg==1) echo "<h3>Password Changed</h3>" ; else if ($msg==2) echo "<h3>Password NOT Correct</h3>" ; 
					
					//  echo $s;  
					  ?></p>
					<table border="0" width="80%" id="table4" cellpadding="0" style="border-collapse: collapse" height="175">
								<form name="frmhlp" id="frmhlp" method="post" action="Password.php" onSubmit="return vfhfn();">
<tr><td width="164">Old Password</td><td width="197">
	<input class="txtbox" type="password" name="pass0" id="pass0" tabindex="4" /></td>
	<td width="298">
	&nbsp;</td></tr>
<tr>
	<td width="164" height="39">New Password </td><td width="197" height="39">
	<input class="txtbox" type="password" name="pass" id="pass" tabindex="4" /></td>
	<td height="39" width="298">
	<p class="p1">&nbsp;</p></td>
</tr>
<tr><td width="164">Confirm Password</td><td width="197">
	<input class="txtbox" type="password" name="pass1" id="pass1" tabindex="4" /></td>
	<td width="298">
	&nbsp;</td></tr>
<tr><td width="164">&nbsp;</td><td width="197">
	<input  class="subbox" type="submit" value="Change" name="submit"/></td>
	<td width="298">
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
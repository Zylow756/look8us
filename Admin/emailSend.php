<?php
require_once __DIR__ . "/../config.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (empty($_SESSION['admin'])) {
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
background-image:url('img/bg.png');
background-repeat:repeat-x;
background-color: #70828F
} 
</style>
</head>

<?php
$msg=0;
			
if (isset( $_POST["submit"]))
{

$pass=base64_encode($_POST['pass']);

$s="update member  set pass='".$pass. "', mname='". ucwords($_POST['mname']). "',compname='". ucwords($_POST['compname']). "',tagline='". $_POST['tagline']. "',shopno='". $_POST['shopno']. "',address='". ucwords($_POST['address']). "',area='". ucwords($_POST['area']). "',city='". ucwords($_POST['city']). "',state1='". ucwords($_POST['state1']). "',pin='". $_POST['pincode']. "',phone='". $_POST['phone']. "',phone1='". $_POST['phone0']. "',mobile='".$_POST["mobile"]."',mobile1='". $_POST['mobile0']. "',email='".$_POST['txtmail']."',web='".$_POST['website']."',remark='". $_POST['remark']. "',remark1='". $_POST['remark0']. "',estyear='".$_POST['establish']."' where mid=".$_POST["mid"] ;
mysqli_query($con,$s);
//echo $s;
$msg=1;
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
					<td width="228" valign="top" bgcolor="#E3E3E3">			<?php if (!empty($_SESSION['id'])) include("sidemenu.php"); ?></td>
					<td align="center" valign="top" bgcolor="#FFFFFF">
					<h1>&nbsp;Send Mail ( Member Information)</h1>
					<p><?php if ($msg==1) echo "<h3>Information Update</h3>" ;  
					
					//  echo $s;  
					  ?></p>
					<table border="0" width="96%" id="table3" style="border-collapse: collapse">
						<tr>
							<td>
							
			<?php 
		if (isset($_GET["id"]))
		{
			$id = (int)$_GET['id'];

$st = "SELECT * FROM member WHERE mid=$id";
		}
		else
		$st="Select * from member where mid=".$_POST["mid"];
		$result=mysqli_query($con,$st);
if (!$result) {
    die(mysqli_error($con));
}
		if ($row=mysqli_fetch_assoc($result))
		{
		?>
			<form name="frmhlp" id="frmhlp" method="get" action="../email2.aspx" >
			<table border="0" width="100%" id="table2" cellpadding="0" style="border-collapse: collapse">
<tr>
	<td width="295" height="25" align="right">
	<font size="2" face="Arial" color="#000000">Company/Firm/Shop Name
	:&nbsp;&nbsp;&nbsp; </font><font face="Arial">
	<input type="hidden"  name="mid"  value="<?php echo htmlspecialchars($row['mid']);  ?>">
	</font>
	</td>
	<td width="257" height="25" align="left"><font size="2" face="Arial"><?php echo htmlspecialchars($row['compname']); ?>
	</font>
	</td>
	<td height="25" width="458">
	&nbsp;</td>
				</tr>
<tr><td width="295" height="25" align="right">
	<font size="2" face="Arial" color="#000000">Owner/Contact Person Name :&nbsp;&nbsp;&nbsp;&nbsp;
	</font></td>
	<td width="257" height="25" align="left"><font size="2" face="Arial"><?php echo htmlspecialchars($row['mname']);  ?>
	</font>
	</td>
	<td height="25" width="458">
	&nbsp;</td>
				</tr>
<tr>
	<td width="295" height="25" align="right">
	<font size="2" face="Arial" color="#000000">City :&nbsp;&nbsp;&nbsp;&nbsp;
	</font></td>
	<td width="257" height="25" align="left"><font size="2" face="Arial"><?php echo htmlspecialchars($row['city']);  ?>
	</font>
	</td>
	<td height="25" valign="top" width="458">
	&nbsp;</td>
</tr>
				<tr>
					<td width="295" height="30" align="right">
					<font size="2" face="Arial" color="#000000">Phone Number:&nbsp;&nbsp;&nbsp;&nbsp;
					</font></td>
					<td width="257" height="30" align="left">
					<font size="2" face="Arial"><?php echo htmlspecialchars($row['phone']);  ?>
					</font>
	</td>
	<td height="30" valign="top" width="458">
	&nbsp;</td>
				</tr>
<tr><td width="295" height="30" align="right">
	<font size="2" face="Arial" color="#000000">Mobile Number:&nbsp;&nbsp;&nbsp;&nbsp;
	</font></td>
	<td width="257" height="30" align="left"><font size="2" face="Arial"><?php  echo htmlspecialchars($row['mobile']);    ?>
	</font>
	</td>
	<td height="30" valign="top" width="458">
	&nbsp;</td></tr>
<tr><td width="295" height="30" align="right">
	<font size="2" face="Arial" color="#000000">Email ID:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	</font></td>
	<td width="257" height="30" align="left"><font size="2" face="Arial"><?php  echo htmlspecialchars($row['email']);     ?>
	</font>
	</td>
	<td height="30" width="458">
	&nbsp;</td></tr>
<tr><td width="295" height="28" align="right">&nbsp;</td>
	<td width="257" height="28" align="left">
	
	<?php 	$pass=base64_decode($row['pass']); ?>

	<input   type="hidden" name="pass" id="pass" tabindex="3" value="<?php echo $pass;  ?>"  size="1"/></td>
	<td height="28" width="458">
	&nbsp;</td></tr>

<tr><td width="295" height="130">&nbsp;</td>
	<td width="257" height="130" align="left" valign="top">
	<input  class="subbox" type="submit" value="Submit" name="submit"/></td>
	<td height="130" width="458">
	&nbsp;
	</td></tr>
		</table></form>
		<?php
		}
		?>
		</td>
						</tr>
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
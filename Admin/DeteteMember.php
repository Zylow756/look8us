<?php
require_once __DIR__ . "/../config.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (empty($_SESSION['admin'])) {
    header("Location: index.php?r=0");
    exit;
} ?>
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

$mid = (int)$_POST['mid'];

$s = "DELETE FROM member WHERE mid = $mid";

$result = mysqli_query($con, $s);

if (!$result) {
    die(mysqli_error($con));
}
header("Location: DeteteMember.php?deleted=1");
exit;
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
					<h1>&nbsp;Delete Member</h1>
					<p><?php if ($msg==1) echo "<h3>Member Delete</h3>" ;  
					
					//  echo $s;  
					  ?></p>
					<table border="0" width="96%" id="table3" style="border-collapse: collapse">
						<tr>
							<td>
							
			<?php 
		if (isset($_GET["id"]))
		{
			$id = (int)$_GET['id'];

$st = "SELECT * FROM member WHERE mid = $id";
}
		else
		{
			$mid = (int)$_POST['mid'];

$st = "SELECT * FROM member WHERE mid = $mid";
		}
		$result=mysqli_query($con,$st);
if (!$result) {
    die(mysqli_error($con));
}
		if ($row=mysqli_fetch_assoc($result))
		{
		?>
			<form name="frmhlp" id="frmhlp" method="post" action="DeteteMember.php" >
			<table border="0" width="100%" id="table2" cellpadding="0" style="border-collapse: collapse" height="288">
			
<tr>
	<td width="268" height="30" align="right"><font size="2" color="#000000">Company/Firm/Shop Name 
	:&nbsp;&nbsp;&nbsp; </font>
	<input
    type="hidden"
    name="mid"
    value="<?php echo (int)$row['mid']; ?>">
	</td>
	<td width="290" height="30" align="left"><b><font color="#000000" size="2"><?php echo htmlspecialchars($row['compname']); ?>
	</font></b>
	</td>
	<td height="30" width="197">
	&nbsp;</td>
				</tr>
<tr><td width="268" height="30" align="right"><font size="2" color="#000000">Owner/Contact Person Name 
	:&nbsp;&nbsp;&nbsp; </font> </td>
	<td width="290" height="30" align="left"><b><font color="#000000" size="2"><?php echo htmlspecialchars($row['mname']);  ?>
	</font></b>
	</td>
	<td height="30" width="197">
	&nbsp;</td>
				</tr>
<tr>
	<td width="268" height="30" align="right"><font size="2" color="#000000">Shop No./Plot No 
	:&nbsp;&nbsp;&nbsp; </font> </td>
	<td width="290" height="30" align="left"><b><font color="#000000" size="2"><?php  echo htmlspecialchars($row['shopno']);  ?>
	</font></b>
	</td>
	<td height="30" valign="top" width="197">
	&nbsp;</td>
</tr>
<tr>
	<td width="268" height="30" align="right"><font size="2" color="#000000">Address Area City 
	:&nbsp;&nbsp; &nbsp; </font> </td>
	<td width="290" height="30" align="left"><b><font color="#000000" size="2"><?php  echo htmlspecialchars($row['address']);   ?><?php  echo htmlspecialchars($row['area']);   ?><?php echo htmlspecialchars($row['city']);  ?>
	</font></b>
	</td>
	<td height="30" valign="top" width="197">
	&nbsp;</td>
</tr>
<tr>
	<td width="1010" height="15" align="right" colspan="3" bgcolor="#FFFFFF">&nbsp;</td>
</tr>
<tr>
	<td width="268" height="20" align="right">&nbsp;</td>
	<td width="290" height="20" align="left">
	&nbsp;</td>
	<td height="20" valign="top" width="197">
	&nbsp;</td>
</tr>
<tr><td width="268" height="64">&nbsp;</td>
	<td width="290" height="64" align="left">
	<input
    class="subbox"
    type="submit"
    value="Delete Member"
    name="submit"
    onclick="return confirm('Are you sure you want to permanently delete this member?');"
/></td>
	<td height="64" width="197">
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
					<p>&nbsp;</p>
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
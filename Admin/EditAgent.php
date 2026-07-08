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
background-color: #70828F;;
} 
</style>
<script type="text/javascript">
function vfhfn()
{
var fllnme1=document.frmhlp.cname.value;
var num =/^[0-9]+$/;
var alpha =/^[a-z]+$/;
if(fllnme1==null||fllnme1=="")
{alert("Required Category Name");
document.frmhlp.cname.focus();
return false;
}

if(fllnme1=="Category Name")
{alert("Required Category Name");
document.frmhlp.cname.focus();
return false;
}
return true;
}
</script>
</head>
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
			<?php
			
			$msg=0;
			
if (isset( $_POST["submit"]))
{
$aid = (int)$_POST['aid'];

$s = "UPDATE agent SET
aname='" . mysqli_real_escape_string($con, $_POST['aname']) . "',
address='" . mysqli_real_escape_string($con, $_POST['address']) . "',
mobile='" . mysqli_real_escape_string($con, $_POST['mobile']) . "',
pass='" . mysqli_real_escape_string($con, $_POST['pass']) . "'
WHERE aid=$aid";
//echo $s;
if (!mysqli_query($con, $s)) {
    die(mysqli_error($con));
}
$msg=1;

}
elseif (isset( $_POST["submit0"]))
{
$aid = (int)$_POST['aid'];

$s = "DELETE FROM agent WHERE aid=$aid";
if (!mysqli_query($con, $s)) {
    die(mysqli_error($con));
}
$msg=2;
}
?>
			<table border="0" width="100%" id="table2" style="border-collapse: collapse" bordercolor="#CCCCCC" height="206" cellpadding="0">
				<tr>
					<td width="228" valign="top" bgcolor="#EEEEEE">			<?php if (!empty($_SESSION['id'])) include("sidemenu.php"); ?></td>
					<td align="center" valign="top" bgcolor="#FFFFFF">
					<h1>View /Edit/ Delete Agent</h1>
					<p><h3><?php if ($msg==1) echo "Agent Detail Update"; ?>
					<?php if ($msg==2) echo "Agent Detail Delete"; ?>
					</h3>
</p>
					<table border="0" width="90%" id="table13" cellpadding="0" style="border-collapse: collapse" bordercolor="#697779" height="128">
						<tr>
							<td valign="top" width="402">
							<table class="table3" border="0" width="434"  id="table14" cellpadding="0" style="border-collapse: collapse" bordercolor="#697779" height="174">
						
	<?php
	if (isset( $_GET["id"]))
	{
		$id = (int)$_GET["id"];

$s = "SELECT * FROM agent WHERE aid=$id";
	   $r=mysqli_query($con,$s);
if (!$r) {
    die(mysqli_error($con));
}
	   if($row=mysqli_fetch_assoc($r))
		{
		
		?>
						<form name="frmhlp" id="frmhlp" method="post" action="EditAgent.php" >
<tr>
	<td width="103" height="30">Agent Code</td><td width="331" height="30">
	&nbsp;<b><?php echo htmlspecialchars($row['acode']); ?></b></td>
</tr>
<tr>
	<td width="103" height="30">Agent Name
	<input  type="hidden" name="aid" id="aid" tabindex="4" value="<?php echo htmlspecialchars($row['aid']); ?>"  size="1"/>
	</td><td width="331" height="30">
	<input  class="txtbox" type="text" name="aname" id="cname" tabindex="4" value="<?php echo htmlspecialchars($row['aname']); ?>"  size="1"/></td>
</tr>
<tr>
	<td width="103" height="30">Address</td><td width="331" height="30">
	<input  class="txtbox" type="text" name="address" id="remark" tabindex="4"  value="<?php echo htmlspecialchars($row['address']); ?>" size="1"/></td>
</tr>
<tr>
	<td width="103" height="30">Mobile</td><td width="331" height="30">
	<input  class="txtbox" type="text" name="mobile" id="mobile" tabindex="4"  size="1" value="<?php echo htmlspecialchars($row['mobile']); ?>"/>
	</td>
</tr>
<tr>
	<td width="103" height="30">Password</td><td width="331" height="30">
	<input  class="txtbox" type="text" name="pass" id="pass" tabindex="4"  size="1" value="<?php echo htmlspecialchars($row['pass']); ?>"/>
	
	</td>
</tr>
<tr><td width="103" height="33">&nbsp;</td><td width="331" height="33">
	&nbsp;</td>
	</tr>
<tr><td width="103" height="77">&nbsp;</td><td width="331" height="77">
	<input  class="subbox" type="submit" value="Edit" name="submit"/>&nbsp;
	<input  class="subbox" type="submit" value="Delete" name="submit0"/></td>
	</tr>
</form>
<?php
}

}

?>
					</table>
							<table class="table3" border="0" width="96%"  id="table16" cellpadding="0" style="border-collapse: collapse" bordercolor="#697779">
						</td>
						</tr>
					</table>
							</td>
						</tr>
					</table></p>
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
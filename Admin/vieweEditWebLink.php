<?php
require_once "config.php";

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
var fllnme1 = document.frmhlp.wname.value;

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
<?php 
$msg=0;

if (isset($_POST["submit"]))
{
		$id      = (int)$_POST['id'];
$wname   = mysqli_real_escape_string($con, trim($_POST['wname']));
$wlink   = mysqli_real_escape_string($con, trim($_POST['wlink']));
$address = mysqli_real_escape_string($con, trim($_POST['address']));
$city    = mysqli_real_escape_string($con, trim($_POST['city']));
$mobile  = mysqli_real_escape_string($con, trim($_POST['mobile']));

$st = "UPDATE eweblink
        SET wname='$wname',
            wlink='$wlink',
            address='$address',
            city='$city',
            mobile='$mobile'
        WHERE wid=$id";

if(mysqli_query($con,$st)){
    $msg = 1;
}else{
    die(mysqli_error($con));
}
} 	
elseif (isset($_POST["submit0"]))
{
				$id = (int)$_POST['id'];

$st = "DELETE FROM eweblink WHERE wid=$id";

if(mysqli_query($con,$st)){
    $msg = 3;
}else{
    die(mysqli_error($con));
}
} 	// end of elseif (submit0)
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
					<td width="228" valign="top" bgcolor="#EEEEEE">			<?php if (!empty($_SESSION['id'])) include("sidemenu.php"); ?></td>
					<td align="center" valign="top" bgcolor="#FFFFFF">
					<h1>Edit e-commerce Web-Link</h1>
					<h3>
<?php
if($msg==1) echo "E-Commerce Web-Link Updated";
if($msg==3) echo "E-Commerce Web-Link Deleted";
?>
</h3>
					<table border="0" width="90%" id="table13" cellpadding="0" style="border-collapse: collapse" bordercolor="#697779" height="294">
						<tr>
							<td valign="top" width="449">
							<table class="table3" border="0" width="100%"  id="table14" cellpadding="0" style="border-collapse: collapse" bordercolor="#697779" height="289">
<?php						
if ( isset($_GET["id"]))
 {
	if(empty($_GET['id'])){
    die("Invalid Request");
}
 $id = (int)$_GET['id'];

$st = "SELECT *
       FROM eweblink
       INNER JOIN ecate ON ecateid = cateid
       WHERE wid = $id";
//echo $st;
$i=1;
$result=mysqli_query($con,$st);
if (!$result) {
    die(mysqli_error($con));
}
	if ($row=mysqli_fetch_assoc($result))
	{	
	?>	
						<form
    name="frmhlp"
    method="post"
    action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"
    onsubmit="return vfhfn();">
<tr>
	<td width="172" height="42"><b>Category Name
	</b>
	<input  type="hidden" name="id"  value="<?php echo htmlspecialchars($row['wid']); ?>" size="1" style="font-weight: 700"/></td>
	<td width="371" height="42">
	<h4><?php echo htmlspecialchars($row['catename']); ?></h4></td>
</tr>
<tr>
	<td width="172" height="28">Name</td><td width="371" height="28">
	<input  class="txtbox" type="text" name="wname" id="remark" tabindex="4" value="<?php echo htmlspecialchars($row['wname']); ?>"  size="1"/></td>
</tr>
<tr>
	<td width="172" height="28">Web-Link</td><td width="371" height="28">
	<input  class="txtbox" type="text" name="wlink" id="remark0" tabindex="4" value="<?php echo htmlspecialchars($row['wlink']); ?>"  size="1"/></td>
</tr>
<tr>
	<td width="172" height="28">Address</td><td width="371" height="28">
	<input  class="txtbox" type="text" name="address" id="remark1" tabindex="4" value="<?php echo htmlspecialchars($row['address']); ?>"  size="1"/></td>
</tr>
<tr>
	<td width="172" height="28">City</td><td width="371" height="28">
	<input  class="txtbox" type="text" name="city" id="remark2" tabindex="4" value="<?php echo htmlspecialchars($row['city']); ?>"  size="1"/></td>
</tr>
<tr>
	<td width="172" height="28">Phone</td><td width="371" height="28">
	<input  class="txtbox" type="text" name="mobile" id="remark3" tabindex="4" value="<?php echo htmlspecialchars($row['mobile']); ?>"  size="1"/></td>
</tr>
<tr><td  height="50" colspan="2" align="center" >
	
	<input  class="subbox" type="submit" value="Update Link" name="submit" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input  class="subbox" type="submit" value="Delete Link" name="submit0"/>&nbsp;&nbsp;&nbsp;&nbsp;

	</td>
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
							<td valign="top">
							&nbsp;
							<a href="eNewWebLink.php" class="a5">
							&lt;&lt;back </a></td>
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
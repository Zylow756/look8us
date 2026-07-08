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
var fllnme1=document.frmhlp.cname.value;
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
	</table>
			<?php
			$msg=0;
if (isset( $_POST["submit"]))
{
$catdid = (int)$_POST['catdid'];

$s = "DELETE FROM catedetail WHERE catdid = $catdid";

mysqli_query($con, $s) or die(mysqli_error($con));
header("Location: DelsubCate.php?deleted=1");
exit;
}
?>
			<table border="0" width="100%" id="table2" style="border-collapse: collapse" bordercolor="#CCCCCC" height="206" cellpadding="0">
				<tr>
					<td width="228" valign="top" bgcolor="#EEEEEE">			<?php if (!empty($_SESSION['id'])) include("sidemenu.php"); ?></td>
					<td align="center" valign="top" bgcolor="#FFFFFF">
					<h1><font color="#FF0000" size="3">Delete Sub-Category</font></h1>
					<p><h3><?php if ($msg==1) echo "Sub-Category Delete"; ?></h3>
</p>
					<table border="0" width="90%" id="table13" cellpadding="0" style="border-collapse: collapse" bordercolor="#697779" height="128">
						<tr>
							<td valign="top" width="100%">
							<table class="table3" border="0" width="80%"  id="table14" cellpadding="0" style="border-collapse: collapse" bordercolor="#697779">
						
	<?php
	if (isset( $_GET["id"]))
	{
		$id = (int)$_GET['id'];

$s = "SELECT *
      FROM category, catedetail
      WHERE category.cateid = catedetail.cateid
      AND catdid = $id";
	   $r=mysqli_query($con,$s);
if (!$r) {
    die(mysqli_error($con));
}
	   if($row=mysqli_fetch_assoc($r))
		{
		?>
						<form name="frmhlp" id="frmhlp" method="post" action="DelsubCate.php" >
<tr>
	<td width="116" height="50">Category Name</td><td width="290" height="50">
	&nbsp;<?php echo htmlspecialchars($row['cname']); ?></td>
</tr>
<tr>
	<td width="116" height="50">Sub Category Name
	<input  type="hidden" name="catdid" id="catdid" tabindex="4" value="<?php echo htmlspecialchars($row['catdid']); ?>"  size="1"/>
	
	
	</td><td width="290" height="50">
	<input  class="txtbox" type="text" name="cdname" id="cdname" tabindex="4" value="<?php echo htmlspecialchars($row['cdname']); ?>"  size="1"/></td>
</tr>
<tr>
	<td width="116" height="30">Remark</td><td width="290" height="30">
	<input  class="txtbox" type="text" name="remark" id="remark" tabindex="4"  value="<?php echo htmlspecialchars($row['remark1']); ?>" size="1"/></td>
</tr>
<tr>
	<td width="116" height="39">Status</td><td width="290" height="39"><select  class="selbox" name="gstatus" id="gstatus" size="1" tabindex="5">
	<option value="1" <?php if ( $row['cdstatus']==='1' ) echo 'Selected' ; ?>  >Enable</option>
	<option value="0"  <?php if ($row['cdstatus']==='0') echo 'Selected' ; ?>  >Disable</option>
	</select>
	</td>
</tr>
<tr><td width="116" height="38">&nbsp;</td><td width="290" height="38">
	<input
    class="subbox"
    type="submit"
    value="Delete"
    name="submit"
    onclick="return confirm('Are you sure you want to delete this sub-category?');"
/>

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
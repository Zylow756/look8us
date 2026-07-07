<?php
require_once "config.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (empty($_SESSION['user'])) {
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
<?php 
$msg=0;

if (isset($_POST["submit"]))
{
		$id      = (int)$_POST['id'];
$cname   = mysqli_real_escape_string($con, trim($_POST['cname']));
$remark  = mysqli_real_escape_string($con, trim($_POST['remark']));

$st = "UPDATE ecate
        SET catename='$cname',
            remark='$remark'
        WHERE ecateid=$id";

if(mysqli_query($con,$st)){
    $msg = 1;
}else{
    die(mysqli_error($con));
}
		//echo $st;
		$msg=1;
} 	

elseif (isset($_POST["submit0"]))
{
		$allowed = ['jpg','jpeg','gif'];

$ext = strtolower(pathinfo($_FILES['photoimg']['name'], PATHINFO_EXTENSION));

if(in_array($ext,$allowed) && $_FILES['photoimg']['size'] < 41100000)
	{
				$name = $_FILES['photoimg']['name'];
				$ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
$txt = pathinfo($name, PATHINFO_FILENAME);
				$fp = date('d')."_".date('M')."_".date('Y')."_".time()."_".substr(str_replace(" ", "_", $txt),0,5).".jpg";

			//	$fp=date('d')."_".date('M')."_".date('Y')."_".date('h')."_".date('i')."_".date('s')."_".substr(str_replace(" ", "_", $txt),0,5).".".$ext;                    
				
				if(move_uploaded_file($_FILES['photoimg']['tmp_name'], "../user/logo/".$fp))
{
				
				$st="update ecate set cateimg='". $fp. "' where ecateid=". $_POST["id"] ;
				if(mysqli_query($con,$st)){
    $msg=3;
}else{
    die(mysqli_error($con));
}
}
else
{
    $msg=2;
}
			}
		else
			{
				$msg=2;
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
					<h1>View e-commerce category</h1>
					<h3>
<?php
if($msg==1) echo "E-Commerce Category Updated";
if($msg==2) echo "Error: Please check image format (GIF/JPG) or size.";
if($msg==3) echo "E-Commerce Image Updated";
?>
</h3>
					<table border="0" width="90%" id="table13" cellpadding="0" style="border-collapse: collapse" bordercolor="#697779" height="294">
						<tr>
							<td valign="top" width="524">
							<table class="table3" border="0" width="121%"  id="table14" cellpadding="0" style="border-collapse: collapse" bordercolor="#697779" height="431">
						
<?php						
$id = 0;

if(isset($_GET['id'])){
    $id = (int)$_GET['id'];
}
elseif(isset($_POST['id'])){
    $id = (int)$_POST['id'];
}
else{
    die("Invalid Request");
}

$st = "SELECT * FROM ecate WHERE ecateid=$id";
//echo $st;
$i=1;
$result=mysqli_query($con,$st);
if (!$result) {
    die(mysqli_error($con));
}
	if($row=mysqli_fetch_assoc($result))
	{	
	?>		
						<form
    name="frmhlp"
    method="post"
    action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"
    enctype="multipart/form-data"
    onsubmit="return vfhfn();">
<tr>
	<td width="116" height="42">Category Name<input  type="hidden" name="id"  value="<?php echo htmlspecialchars($row['ecateid']); ?>" size="1"/></td>
	<td width="385" height="42">
	<input  class="txtbox" type="text" name="cname" id="cname" tabindex="4" value="<?php echo htmlspecialchars($row['catename']); ?>"  size="1"/></td>
</tr>
<tr>
	<td width="116" height="38">Remark</td><td width="385" height="38">
	<input  class="txtbox" type="text" name="remark" id="remark" tabindex="4" value="<?php echo htmlspecialchars($row['remark']); ?>"  size="1"/></td>
</tr>
<tr><td width="116" height="50">&nbsp;</td><td width="385" height="50">
	<input  class="subbox" type="submit" value="Update Name" name="submit"/></td>
	</tr>
<tr>
	<td width="116" height="25">&nbsp;</td><td width="385" height="25">
		&nbsp;</td>
</tr>
<tr>
	<td width="116" height="25" bgcolor="#F5F5F5">&nbsp;</td>
	<td width="385" height="25" bgcolor="#F5F5F5">
		<b><font size="3">Current Image</font></b></td>
</tr>
<tr>
	<td width="116" height="189">&nbsp;</td><td width="385" height="189">
		&nbsp;&nbsp;<img border="0" src="../user/logo/<?php echo htmlspecialchars($row['cateimg']); ?>" width="149" height="148"></td>
</tr>
<tr>
	<td width="116" height="34"><b>Select New&nbsp; Images</b></td>
	<td width="385" height="34">
		
<input type="file" name="photoimg" size="27" ></td>
</tr>
<tr><td width="116" height="53">&nbsp;</td><td width="385" height="53">
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input  class="subbox" type="submit" value="Change Image" name="submit0"/>
	</td>
	</tr>
</form>
	<?php
	}
else
{
    echo "<h3>Category not found.</h3>";
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
							<a href="javascript: window.history.go(-1)" class="a5">
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
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


$id = (int)$_POST["id"];

$st = "UPDATE advert SET
aname='" . mysqli_real_escape_string($con, $_POST["cname"]) . "',
mobile='" . mysqli_real_escape_string($con, $_POST["mobile"]) . "',
website='" . mysqli_real_escape_string($con, $_POST["website"]) . "',
astatus='" . mysqli_real_escape_string($con, $_POST["gstatus"]) . "'
WHERE aid=$id";

if (!mysqli_query($con, $st)) {
    die(mysqli_error($con));
}
//echo $st;
$msg=1;


	

} 	// end of if (submit)

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
					<h1>Edit Ads Links Information</h1>
					<p><h3><?php if ($msg==1) echo "Information Update"; ?></h3>
</p>
					<table border="0" width="90%" id="table13" cellpadding="0" style="border-collapse: collapse" bordercolor="#697779" height="128">
						<tr>
							<td valign="top" width="76%">
							<?php
	if (isset( $_GET["id"]))
	{
		$id = (int)$_GET["id"];
$s = "SELECT * FROM advert WHERE aid=$id";
	   $r=mysqli_query($con,$s);
if (!$r) {
    die(mysqli_error($con));
}
	   if($row=mysqli_fetch_assoc($r))
		{
		
		?>

							
							<table class="table3" border="0" width="96%"  id="table14" cellpadding="0" style="border-collapse: collapse" bordercolor="#697779">
						
						<form name="frmhlp" id="frmhlp" method="post" action="EditAdvert.php" enctype="multipart/form-data" >
						

<tr>
	<td width="173" height="42">Company/Form/Shop&nbsp; Name</td>
	<td width="300" height="42"><input   type="hidden" name="id" id="id" tabindex="4" value="<?php echo (int)$row['aid']; ?>"   size="1"/>
	<input  class="txtbox" type="text" name="cname" id="cname" tabindex="4" value="<?php echo htmlspecialchars($row['aname']); ?>"   size="1"/></td>
</tr>
<tr>
	<td width="173" height="31">Contact No</td><td width="300" height="31">
	<input  class="txtbox" type="text" name="mobile" id="remark0" tabindex="4" value="<?php echo htmlspecialchars($row['mobile']); ?>"   size="1"/></td>
</tr>
<tr>
	<td width="173" height="37">Website Link</td><td width="300" height="37">
	<input  class="txtbox" type="text" name="website" id="remark" tabindex="4" value="<?php echo htmlspecialchars($row['website']); ?>"   size="1"/></td>
</tr>
<tr>
	<td width="173" height="39">Status</td><td width="300" height="39">
	<select  class="selbox" name="gstatus" id="gstatus" size="1" tabindex="5">

	<option value="D" <?php if ($row['astatus']=='D') echo "selected"; ?>   >Disable</option>
	<option value="H"  <?php if ($row['astatus']=='H') echo "selected"; ?>  >Home Page</option>

	</select></td>
</tr>
<tr><td width="173" height="38">&nbsp;</td><td width="300" height="38">
	<input  class="subbox" type="submit" value="Update" name="submit"/>

	</td>
	</tr>
</form>
					</table>
					
					<?php
					}
					
					}
					?>
					
							<table class="table3" border="0" width="96%"  id="table16" cellpadding="0" style="border-collapse: collapse" bordercolor="#697779">
						</td>
						</tr>
					</table>
							</td>
							<td valign="top" width="24%">
							<img border="1"
     src="<?php echo "../User/logo//" . htmlspecialchars($row['img']); ?>"
     width="164"
     height="166"></td>
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
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
/*function vfhfn()
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
}*/
</script>
</head>
<?php 
$msg=0;
if (isset($_GET['id'])) {

    $id = (int)$_GET['id'];

    $sql = "DELETE FROM homeimg WHERE aid = $id";

    if (mysqli_query($con, $sql)) {
        $msg = 2;
    } else {
        die(mysqli_error($con));
    }
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
					<td width="228" valign="top" bgcolor="#EEEEEE">			<?php if (!empty($_SESSION['id'])) include("sidemenu.php"); ?></td>
					<td align="center" valign="top" bgcolor="#FFFFFF">
					<h1>View Home Imgage/Ads</h1>
					<?php
if ($msg == 2) {
    echo "<h3>Image Deleted from Gallery</h3>";
}
?>
					<table border="1" width="90%" id="table13" cellpadding="0" style="border-collapse: collapse" bordercolor="#697779" height="128">
						<tr>
							<td width="26%" height="37" align="center" bgcolor="#98C5FC">
							<b><font size="2" color="#000000">Name</font></b></td>
							<td width="53%" height="37" align="center" bgcolor="#98C5FC">
							<b><font size="2" color="#000000">Image</font></b></td>
							<td width="13%" height="37" align="center" bgcolor="#98C5FC">
							<b><font size="2" color="#000000">Delete</font></b></td>
						</tr>
						<?php 
		 $st="Select * from homeimg order by aname";
		 		 $result=mysqli_query($con,$st);
if (!$result) {
    die(mysqli_error($con));
}
		 		 
		 		 $i=1;
		if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_assoc($result)) {
			if (!empty($row['img']) && $row['img'] != "-")
			{
			?>
						<tr>
							<td width="26%" align="justify">
							<p style="line-height: 22px; margin-left: 10px">
							<?php  echo htmlspecialchars($row["aname"]) ; ?> <br>

							<?php  echo htmlspecialchars($row["website"]) ; ?> <br>
							<?php  echo htmlspecialchars($row["mobile"]) ; ?> <br>
							</td>
							<td width="53%" align="center">
							<img border="1" src="<?php echo "../user/logo/" . htmlspecialchars($row['img']); ?>"  width="243" height="246"></td>
							<td width="13%" align="center">
							<?php
				echo "<br>";
			echo "<a class='a2'
href='ViewHomeImg.php?id=".(int)$row['aid']."'
onclick=\"return confirm('Delete this image?');\">
Delete
</a>"; 
			echo "<br><br>";?>
							&nbsp;</td>
						</tr>
							<?php
			$i=$i+1;
			}
		}
} else {

    echo '<tr><td colspan="3" align="center">No images found.</td></tr>';

}
		?>
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
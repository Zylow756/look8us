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
<?php 
$msg=0;
if (isset($_POST["submit"]))
{
$cname = mysqli_real_escape_string($con, trim($_POST['cname']));
$remark = mysqli_real_escape_string($con, trim($_POST['remark']));
$gstatus = (int)$_POST['gstatus'];

$st = "INSERT INTO category
        VALUES
        (NULL,'$cname','$remark',$gstatus)";
mysqli_query($con,$st);
//echo $st;
$msg=1;
} 	// end of if (submit)
if (isset( $_GET["id"]))
{

$id = (int)$_GET['id'];
$a  = (int)$_GET['a'];

if ($a == 2) {
    $s = "UPDATE category SET cstatus=1 WHERE cateid=$id";
} elseif ($a == 1) {
    $s = "UPDATE category SET cstatus=0 WHERE cateid=$id";
}
//echo $s;
if (!mysqli_query($con, $s)) {
    die(mysqli_error($con));
}
//$msg=1;
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
					<td width="228" valign="top" bgcolor="#EEEEEE">			<?php
if (!empty($_SESSION['id'])) {
    include("sidemenu.php");
}
?></td>
					<td align="center" valign="top" bgcolor="#FFFFFF">
					<h1>View All Category</h1>
					<p>&nbsp;</p>
					<table class="table2"  width="94%" id="table5" border="1"    >
								<tr>
									<td bgcolor="#D2D2D2" width="5%">&nbsp;SNO.</td>
									<td bgcolor="#D2D2D2" width="36%">&nbsp;Category&nbsp; Name</td>
									<td bgcolor="#D2D2D2" width="32%" style="text-align: center">
									Remark</td>
									<td bgcolor="#D2D2D2" width="10%" style="text-align: center">
									Edit</td>
									<td bgcolor="#D2D2D2" width="8%" style="text-align: center">
									&nbsp;Delete</td>
									<td bgcolor="#D2D2D2" width="7%" style="text-align: center">
									Status</td>
								</tr>
			<?php						

$st="Select * from category order by cname";

//echo $st;
$i=1;
$result=mysqli_query($con,$st);
if (!$result) {
    die(mysqli_error($con));
}
	while ($row=mysqli_fetch_assoc($result))
	{	
	?>	
								<tr>
									<td height="29" width="5%">&nbsp;<?php echo $i; ?></td>
									<td height="29" width="36%">&nbsp;<?php echo htmlspecialchars($row["cname"]); ?></td>
									<td height="29" width="32%" style="text-align: center">&nbsp;<?php 	echo htmlspecialchars($row["remark"]);  ?></td>
									<td height="29" width="10%" style="text-align: center">&nbsp;<a class="a3"
   href="EditCate.php?id=<?php echo (int)$row['cateid']; ?>">
    Edit
</a></td>
									<td height="29" width="8%" style="text-align: center">&nbsp;<a class='a3' href='DelCate.php?id=<?php echo (int)$row['cateid']; ?>">'>Delete</a></td>
									<td height="29" width="7%" style="text-align: center">
									
					&nbsp;<?php //if ($row["cstatus"]==1) echo "Enable" ; else echo "<b>Disable</b>"; ?>

								<?php 
									if ($row["cstatus"]==1)
									echo "<a class='a5' href='viewCate.php?a=1&id=".$row['cateid']."'>Enable</a>"; 
									else
									echo "<a class='a' href='viewCate.php?a=2&id=".$row['cateid']."'>Disable</a>"; 
									
									?>	
	</td>
								</tr>
								
								<?php
								$i=$i+1;
								}
								?>
							</table>
					</td>
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
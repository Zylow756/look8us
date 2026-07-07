<?php
require_once "config.php";

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
background-image:url('img/bg.png');
background-repeat:repeat-x;
background-color: #70828F;;
} 
</style>
</head>
<?php
$msg=0;
if ( isset($_GET['id']))
{
$id = (int)$_GET['id'];

$s = "DELETE FROM FRANCH WHERE fid=$id";

if (mysqli_query($con, $s)) {
    $msg = 2;
} else {
    die(mysqli_error($con));
}
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
					<td width="228" valign="top" bgcolor="#EEEEEE">			<?php if (!empty($_SESSION['id'])) include("sidemenu.php"); ?></td>
					<td align="center" valign="top" bgcolor="#FFFFFF">
					<h1>View All Franchise Request</h1>
					
					</p>
					<?php
if ($msg == 2) {
    echo "<h3>Enquiry Deleted</h3>";
}
?>
</p>

					<p>&nbsp;
					<table class="table2"  width="94%" id="table5" border="1"    >
								<tr>
									<td bgcolor="#D2D2D2" width="5%" style="text-align: center">&nbsp;SNO.</td>
									<td bgcolor="#D2D2D2" width="23%">&nbsp;Name</td>
									<td bgcolor="#D2D2D2" width="13%">&nbsp;Mobile </td>
									<td bgcolor="#D2D2D2" width="19%" style="text-align: center">
									Email</td>
									<td bgcolor="#D2D2D2" width="7%" style="text-align: center">
									City</td>
									<td bgcolor="#D2D2D2" width="11%" style="text-align: center">
									Remark</td>
									<td bgcolor="#D2D2D2" width="7%" style="text-align: center">
									Date</td>
									<td bgcolor="#D2D2D2" width="8%" style="text-align: center">
									Delete</td>
								</tr>
			<?php						

$st="SELECT *
FROM FRANCH
ORDER BY FID DESC";

//echo $st;
$i=1;
$result=mysqli_query($con,$st);
if (!$result) {
    die(mysqli_error($con));
}
	if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) 
	{	
	?>
								<tr>
									<td height="29" width="5%" style="text-align: center">&nbsp;<?php echo $i; ?></td>
									<td height="29" width="23%">&nbsp;<?php echo htmlspecialchars($row["fname"]); ?></td>
									<td height="29" width="13%">&nbsp;<?php echo htmlspecialchars($row["mobile"]); ?></td>
									<td height="29" width="19%" style="text-align: center">&nbsp;<?php 	echo htmlspecialchars($row["email"]);  ?></td>
									<td height="29" width="7%" style="text-align: center">&nbsp;<?php echo htmlspecialchars($row["city"]); ?></td>
									<td height="29" width="11%" style="text-align: center">&nbsp;<?php echo htmlspecialchars($row["remark"]); ?></td>
									<td height="29" width="7%" style="text-align: center">&nbsp;<?php echo htmlspecialchars($row["fdate"]); ?></td>
									<td height="29" width="8%" style="text-align: center">&nbsp;
				<?php
			echo "<a class='a2'
href='ViewFranchise.php?id=".(int)$row['fid']."'
onclick=\"return confirm('Delete this record?');\">
Delete
</a>";
			?>
</td>
								</tr>
								
								<?php
								$i=$i+1;
								}
} else {
    echo '<tr><td colspan="8" align="center">No franchise requests found.</td></tr>';
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
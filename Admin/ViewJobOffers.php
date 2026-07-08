<?php
require_once "config.php";

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
</head>
<?php
$msg=0;
			
if (isset($_GET['id'])) {

    $id = (int)$_GET['id'];

    $sql = "DELETE FROM postjob WHERE jid = $id";

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
					<h1>View All Job Offers</h1>
					
					</p>
					<?php
if ($msg == 2) {
    echo "<h3>Job Offer Deleted</h3>";
}
?>
					<p>&nbsp;
					<table class="table2"  width="96%" id="table5" border="1"    >
								<tr>
									<td bgcolor="#D2D2D2" width="5%">&nbsp;SNO.</td>
									<td bgcolor="#D2D2D2" width="14%">&nbsp;Company Name</td>
									<td bgcolor="#D2D2D2" width="10%">&nbsp;Phone</td>
									<td bgcolor="#D2D2D2" width="13%" style="text-align: center">
									Email</td>
									<td bgcolor="#D2D2D2" width="8%" style="text-align: center">
									City</td>
									<td bgcolor="#D2D2D2" width="9%" style="text-align: center">
									Web</td>
									<td bgcolor="#D2D2D2" width="11%" style="text-align: center">
									Job type</td>
									<td bgcolor="#D2D2D2" width="8%" style="text-align: center">
									Job Location</td>
									<td bgcolor="#D2D2D2" width="7%" style="text-align: center">
									Post
									Date</td>
									<td bgcolor="#D2D2D2" width="3%" style="text-align: center">
									Category</td>
									<td bgcolor="#D2D2D2" width="3%" style="text-align: center">
									Title</td>
									<td bgcolor="#D2D2D2" width="3%" style="text-align: center">
									Delete</td>
								</tr>
			<?php						

$st="Select * from postjob order by jid DESC";

//echo $st;
$i=1;
$result=mysqli_query($con,$st);
if (!$result) {
    die(mysqli_error($con));
}
	if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_assoc($result)) {
	?>
								<tr>
									<td height="29" width="5%">&nbsp;<?php echo $i; ?></td>
									<td height="29" width="14%">&nbsp;<?php echo htmlspecialchars($row["ename"]); ?></td>
									<td height="29" width="10%">&nbsp;<?php echo htmlspecialchars($row["phone"]); ?></td>
									<td height="29" width="13%" style="text-align: center">&nbsp;<?php 	echo htmlspecialchars($row["email"]);  ?></td>
									<td height="29" width="8%" style="text-align: center">&nbsp;<?php echo htmlspecialchars($row["city"]); ?></td>
									<td height="29" width="9%" style="text-align: center">&nbsp;<?php echo htmlspecialchars($row["web"]); ?></td>
									<td height="29" width="11%" style="text-align: center">&nbsp;<?php echo htmlspecialchars($row["jtype"]); ?><BR><?php echo htmlspecialchars($row["srange"]); ?><?php echo htmlspecialchars($row["stype"]); ?></td>
									<td height="29" width="8%" style="text-align: center">&nbsp;<?php echo htmlspecialchars($row["jobloc"]); ?></td>
									<td height="29" width="7%" style="text-align: center">&nbsp;<?php echo htmlspecialchars($row["y"]); ?></td>
									<td height="29" width="3%" style="text-align: center">&nbsp;
									<?php echo htmlspecialchars($row["cate"]); ?>									</td>
									<td height="29" width="3%" style="text-align: center">&nbsp;<?php echo htmlspecialchars($row["atitle"]); ?>	</td>
									<td height="29" width="3%" style="text-align: center">&nbsp;
				<?php
			echo "<a class='a2'
href='ViewJobOffers.php?id=".(int)$row['jid']."'
onclick=\"return confirm('Delete this job offer?');\">
Delete
</a>"; 
			?>
									</td>
								</tr>
								
								<?php
								$i=$i+1;
								}
} else {

    echo '<tr><td colspan="12" align="center">No job offers found.</td></tr>';

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
<?php
require_once "config.php";

if (!isset($_SESSION['user']) || $_SESSION['user'] == "") {
    header("location: index.php?r=0");
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
?>
<body  onselectstart="return false">
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
if (!empty($_SESSION["id"])) {
    include("sidemenu.php");
}
?></td>
					<td align="center" valign="top" bgcolor="#FFFFFF">
					<h1>View All Enquiry by Agent<br>
&nbsp;</h1>
					<?php
					if (isset($_GET["msg"])) {
    echo "<p style='color:green;font-weight:bold;'>Email sent successfully.</p>";
}
					?>
<form name="frmhlp" id="frmhlp" method="post" action="viewAgentEnquiry.php" >

	<table border="0" width="100%" id="table4" style="border-collapse: collapse" height="70">
						<tr>
							<td width="141">&nbsp; <font color="#000000"><b>&nbsp; 
							<font size="2">Select Agent</font></b></font></td>
							<td width="426">
	
<select name="aid" class="selbox4" >
<?php
$st="Select * from agent order by aname";
$i=1;
$result=mysqli_query($con,$st);
if (!$result) {
    die(mysqli_error($con));
}

	while ($row=mysqli_fetch_assoc($result))
	{	
	
	?>
	<option value="<?php echo htmlspecialchars($row['aid']); ?>" <?php if (isset($_POST['aid'])) if($_POST['aid']==$row['aid']) echo 'selected'; ?>  > <?php echo htmlspecialchars($row["aname"]); ?></option>
	
	<?php
	}
	?>
					</select>								
							</td>
							<td>
	<input  class="subbox" type="submit" value="Show" name="submit"/> <br>
					<?php
					if (isset($_POST["aid"]))
					{
					?>
&nbsp;<a href="asp-mail/email_purchase_order.aspx?x=<?php echo urlencode($_POST['aid'] ?? ''); ?>"> " class="email"  ><font color="#FF0000" size="4">Click for Email >></font></a>
				<?php
				}
				?>	
							</td>
						</tr>
					</table>
					<?php
					if (isset($_POST["aid"]))
					{
					?>
					<table class="table2"  width="99%" id="table3" border="1"    >
								<tr>
									<td bgcolor="#D2D2D2" width="5%" height="33">&nbsp;SNO.</td>
									<td bgcolor="#D2D2D2" width="10%" style="text-align: center" height="33">
									Date</td>
									<td bgcolor="#D2D2D2" width="23%" height="33" style="text-align: left">&nbsp; Name</td>
									<td bgcolor="#D2D2D2" width="13%" height="33" style="text-align: left">
									&nbsp; Qualification</td>
									<td bgcolor="#D2D2D2" width="10%" height="33" style="text-align: center">Mobile</td>
									<td bgcolor="#D2D2D2" width="200" height="33" style="text-align: left">
									Mobile2</td>
									<td bgcolor="#D2D2D2" width="8%" height="33" style="text-align: left">&nbsp;Address</td>
									<td bgcolor="#D2D2D2" width="6%" height="33">
									&nbsp;Area </td>
									<td bgcolor="#D2D2D2" width="11%" height="33">&nbsp;Last 
									Feedback </td>
									<td bgcolor="#D2D2D2" width="11%" height="33">&nbsp;Next 
									Follow</td>
									<td bgcolor="#D2D2D2" width="4%" height="33">&nbsp;Status</td>
									<td bgcolor="#D2D2D2" width="3%" height="33">
									View</td>
								</tr>
			<?php	
$aid = (int)($_POST['aid'] ?? 0);

$st = "SELECT *
       FROM agenquiry
       WHERE aid = $aid
       AND hid = 1
       ORDER BY eid DESC";
//echo $st;
$i=1;

$result=mysqli_query($con,$st);
if (!$result) {
    die(mysqli_error($con));
}

$num_rows = mysqli_num_rows($result);

	while ($row=mysqli_fetch_assoc($result))
	{	
	
	?>				<tr>
									<td height="29" width="5%" style="text-align: center">&nbsp;<?php echo $num_rows; ?></td>
									<td height="29" width="10%" style="text-align: center">&nbsp;<?php echo htmlspecialchars($row["edate"]); ?></td>
									<td height="29" width="23%" style="text-align: left">&nbsp;<?php echo htmlspecialchars($row["ename"]); ?></td>
									<td height="29" width="13%" style="text-align: left">&nbsp;<?php echo htmlspecialchars($row["cate"]); ?></td>
									<td height="29" width="10%" style="text-align: center">&nbsp;<?php echo htmlspecialchars($row["mobile"]); ?></td>
									<td height="29" width="200" style="text-align: left">&nbsp;<?php echo htmlspecialchars($row["email"]); ?> &nbsp; <?php echo htmlspecialchars($row["web"]); ?></td>
									<td height="29" width="8%" style="text-align: left">&nbsp;<?php echo htmlspecialchars($row["address"]); ?></td>
									<td height="29" width="6%">&nbsp;<?php echo htmlspecialchars($row["area"]); ?></td>
									<td height="29" width="11%">&nbsp;<?php echo htmlspecialchars($row["cdate"]); ?></td>
									<td height="29" width="11%">&nbsp;<?php echo htmlspecialchars($row["ndate"]); ?></td>
									<td height="29" width="4%">&nbsp;<?php echo htmlspecialchars($row["estatus"]); ?></td>
									<td height="29" width="3%">&nbsp;<?php echo "<a class='a2' href='ViewEnqStatus.php?eid=" .
     urlencode($row['eid']) .
     "'>Detail</a>"; ?></td>
								</tr>
								
								<?php
//								$i=$i+1;
$num_rows=$num_rows-1;
								}
								?>
							</table>
							<?php
							}
							?>
					</form>
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
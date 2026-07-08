	<?php
require_once "config.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (empty($_SESSION['admin'])) {
    header("Location: index.php?r=0");
    exit;
}
					if (isset($_GET["id"]))
					{
					?>
					<table class="table2"  width="99%" id="table3" border="1" style="border-collapse: collapse" bordercolor="#C0C0C0"    >
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
								</tr>
			<?php						

$id = (int)$_GET['id'];

$st = "SELECT * FROM agenquiry WHERE aid=$id AND hid=1 ORDER BY eid DESC";

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
								</tr>
								
								<?php
//								$i=$i+1;
$num_rows=$num_rows-1;
								}
								?>
							</table>
							<br><br><a target="_blank" href="ViewAgentEnquiry-excelexport.php?id=<?php echo urlencode($_GET['id'] ?? ''); ?>"
<font size="4">Click here for Excel Export</font></a><br><br>
							<?php
							}
							?>
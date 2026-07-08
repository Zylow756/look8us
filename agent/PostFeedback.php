<?php
require_once "config.php";

if (session_status() === PHP_SESSION_NONE) {
	session_start();
}
if (empty($_SESSION['agent'])) {
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
		body {
			background-image: url('../Admin/img/bg.png');
			background-repeat: repeat-x;
			background-color: #70828F;
			;
		}
	</style>
	<SCRIPT LANGUAGE="JavaScript" SRC="../CalendarPopup.js"></SCRIPT>
	<SCRIPT LANGUAGE="JavaScript">
		var cal = new CalendarPopup();
	</SCRIPT>
</head>
<?php
$msg = 0;

if (isset($_POST["submit0"])) {
	$eid = (int)$_POST["eid"];
	$remark = mysqli_real_escape_string($con, trim($_POST["remark"]));
	$tdate = mysqli_real_escape_string($con, $_POST["tdate"]);
	$status = mysqli_real_escape_string($con, $_POST["curstatus"]);

	$st = "INSERT INTO enqfeedback VALUES
(NULL,$eid," . $_SESSION["aid"] . ",'" . date("d-m-Y") . "',
'$remark','$tdate','$status','-')";
	mysqli_query($con, $st);

	$st = "UPDATE agenquiry
SET
cdate='" . date("d-m-Y") . "',
estatus='$status',
ndate='$tdate'
WHERE eid=$eid";
	if (mysqli_query($con, $st)) {
		$msg = 1;
	}

	$msg = 1;
} 	// end of if (submit)
?>

<body>
	<div align="center">
		<table border="0" width="980" id="table1" style="border-collapse: collapse" bordercolor="#E2E2E2" cellpadding="0">
			<tr>
				<td height="50" align="center" valign="top"> <?php require_once "../header.php"; ?> </td>
			</tr>
			<tr>
				<td height="12" align="center" valign="top" bgcolor="#697779">
				</td>
			</tr>
			<tr>
				<td>
					<table border="0" width="100%" id="table2" style="border-collapse: collapse" bordercolor="#CCCCCC" height="206" cellpadding="0">
						<tr>
							<td width="228" valign="top" bgcolor="#EEEEEE" rowspan="4"> <?php if ($_SESSION["aid"] != "") include("sidemenu.php"); ?></td>
							<td align="center" valign="top" bgcolor="#FFFFFF">
								<h1>Post Feedback<br>
									&nbsp;</h1>

								<form name="frmhlp" id="frmhlp" method="post" action="PostFeedback.php">
									<table border="0" width="98%" id="table4" style="border-collapse: collapse">
										<tr>
											<td width="150">&nbsp; <b>Select Enquiry</b>&nbsp;&nbsp; </td>
											<td width="353">&nbsp;<select name="eid" class="selbox" size="1">
													<option value="">Please Select</option>
													<?php
													//if (isset($_POST['eid']))$eid = $_POST['eid'] ?? '';
													$st = "Select * from agenquiry where aid=" . $_SESSION['aid'] . " order by ename";
													$i = 1;
													$result = mysqli_query($con, $st);
													if (!$result) {
														error_log(mysqli_error($con));
														die("Database Error");
													}
													while ($row = mysqli_fetch_assoc($result)) {
													?>
														<option value="<?php echo htmlspecialchars($row['eid']); ?>" <?php if (isset($_GET['eid'])) {
																															if ($_GET['eid'] == $row['eid']) echo 'selected';
																														} ?> <?php if (isset($_POST['eid'])) {
																																																				if ($_POST['eid'] == $row['eid']) echo 'selected';
																																																			} ?>><?php echo htmlspecialchars($row["ename"]); ?> [ <?php echo htmlspecialchars($row["cate"]); ?> ] (<?php echo htmlspecialchars($row["mobile"]); ?>)</option>
													<?php
														$i = $i + 1;
													}
													?>
												</select></td>
											<td>&nbsp;<input class="subbox" type="submit" value="Show History" name="submit" /></td>
										</tr>
									</table>
									<b>&nbsp;<?php
												if ((isset($_POST["eid"])) or (isset($_GET['eid']))) {
												?>
										<br>
										Agent Detail
										<?php
													$eid = isset($_POST['eid'])
														? (int)$_POST['eid']
														: (int)$_GET['eid'];

													$st = "SELECT * FROM agenquiry WHERE eid=$eid";
													$result2 = mysqli_query($con, $st);
													if (!$result2) {
														error_log(mysqli_error($con));
														die("Database Error");
													}
													if ($row2 = mysqli_fetch_assoc($result2)) {
										?>
									</b>
									<table border="1" width="94%" style="border-collapse: collapse" bordercolor="#D2D2D2">
										<tr>
											<td width="183">
												<font color="#000080">Contact No</font>
											</td>
											<td>
												<font color="#000080">&nbsp;<?php echo htmlspecialchars($row2['mobile']); ?></font>
											</td>
										</tr>
										<tr>
											<td width="183">
												<font color="#000080">Email ID</font>
											</td>
											<td>
												<font color="#000080">&nbsp;<?php echo htmlspecialchars($row2['email']); ?></font>
											</td>
										</tr>
										<tr>
											<td width="183">
												<font color="#000080">Address</font>
											</td>
											<td>
												<font color="#000080">&nbsp;<?php echo htmlspecialchars($row2['address']); ?> &nbsp;<?php echo htmlspecialchars($row2['area']); ?> &nbsp;<?php echo htmlspecialchars($row2['city']); ?></font>
											</td>
										</tr>
									</table>
								<?php
													}
								?>
								<br>
								<br>
								<table class="table2" width="94%" id="table3" border="1">
									<tr>
										<td bgcolor="#D2D2D2" width="5%">&nbsp;SNO.</td>
										<td bgcolor="#D2D2D2" width="10%" style="text-align: center">
											Date</td>
										<td bgcolor="#D2D2D2" width="61%">&nbsp;
											Remark</td>
										<td bgcolor="#D2D2D2" width="12%">&nbsp;Next
											Follow-up</td>
										<td bgcolor="#D2D2D2" width="9%">&nbsp;Status</td>
									</tr>
									<?php

													if (isset($_POST["eid"]))
														$st = "Select * from enqfeedback where eid=" . $_POST['eid'] . " order by fid";

													elseif (isset($_GET["eid"]))
														$st = "Select * from enqfeedback where eid=" . $_GET['eid'] . " order by fid";

													$i = 1;

													$sts = "";
													$result = mysqli_query($con, $st);
													if (!$result) {
														error_log(mysqli_error($con));
														die("Database Error");
													}
													while ($row = mysqli_fetch_assoc($result)) {
									?>
										<tr>
											<td height="29" width="5%" style="text-align: center">&nbsp;<?php echo $i; ?></td>
											<td height="29" width="10%" style="text-align: center">&nbsp;<?php echo htmlspecialchars($row["fdate"]); ?></td>
											<td height="29" width="61%">&nbsp;<?php echo htmlspecialchars($row["remark"]); ?></td>
											<td height="29" width="12%">&nbsp;<?php echo htmlspecialchars($row["nxtdate"]); ?></td>
											<td height="29" width="9%">&nbsp;<?php echo htmlspecialchars($row["curstatus"]);
																				$sts = $row["curstatus"];
																				?></td>
										</tr>
									<?php
														$i = $i + 1;
													}
									?>
								</table>
								<p>
									<font color="#000080"><u><b>Post Feedback</b></u></font>
								</p>
								<table border="0" width="100%" id="table5" style="border-collapse: collapse">
									<tr>
										<td width="169">&nbsp; Remark</td>
										<td>
											<textarea name="remark" rows="6" cols="60" required></textarea>
										</td>
									</tr>
									<tr>
										<td width="169" height="42">&nbsp; Next Follow up</td>
										<td height="42">
											<p>
												<input type="text" name="tdate" value="<?php echo date('d-m-Y'); ?>" size="17">
												<A HREF="#" onClick="cal.select(document.forms['frmhlp'].tdate,'anchor1','dd-MM-yyyy'); return false;" NAME="anchor1" ID="anchor1">
													<img src="../Admin/cal.gif" width="16" height="16" border="0" alt="Pick a date"></A>&nbsp;&nbsp;
										</td>
									</tr>
									<tr>
										<td width="169" height="43">&nbsp; Status</td>
										<td height="43">
											<select name="curstatus" class="selbox">
												<option>Open</option>
												<option>Closed</option>
											</select>
										</td>
									</tr>
									<tr>
										<td width="169" height="58">&nbsp;</td>
										<td height="58">
											<input class="subbox" type="submit" value="Save Feedback" name="submit0" <?php if ($sts == 'Closed') echo 'disabled'; ?> />
										</td>
									</tr>
								</table>
								<p>&nbsp;</p>
							<?php
												}
							?>
								</form>
							</td>
						</tr>
						<tr>
							<td align="center" valign="top" bgcolor="#FFFFFF">
								&nbsp;</td>
						</tr>
						<tr>
							<td align="center" valign="top" bgcolor="#FFFFFF">
								&nbsp;</td>
						</tr>
						<tr>
							<td align="center" valign="top" bgcolor="#FFFFFF">
								&nbsp;</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td height="57" align="center" valign="top"> <?php require_once "../footer.php"; ?></td>
			</tr>
		</table>
	</div>
</body>

</html>
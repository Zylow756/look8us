<?php
require_once "config.php";

if (session_status() === PHP_SESSION_NONE) {
	session_start();
}
if (empty($_SESSION['admin'])) {
    header("Location: index.php?r=0");
    exit;
}

function add_date($original_date, $d, $m, $y)
{
	$current_date = strtotime($original_date);
	$resultant_date = date('d-m-Y', mktime(0, 0, 0, date('m', $current_date) + $m, date('d', $current_date) + $d, date('Y', $current_date) + $y));
	return $resultant_date;
}

function diff_date($original_date, $endDate)
{
	$d1 = strtotime($original_date);
	$d2 = strtotime($endDate);

	$dd1 =  mktime(0, 0, 0, date('m', $d1), date('d', $d1), date('Y', $d1));
	$dd2 =  mktime(0, 0, 0, date('m', $d2), date('d', $d2), date('Y', $d2));


	return ($dd2 - $dd1) / (24 * 60 * 60);
}

function set_date($original_date, $d, $m, $y)
{
	$current_date = strtotime($original_date);
	$resultant_date = date('d-m-Y', mktime(0, 0, 0, $d, date('m', $current_date) + $m, date('Y', $current_date) + $y));
	return $resultant_date;
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
			background-image: url('img/bg.png');
			background-repeat: repeat-x;
			background-color: #70828F;
			;
		}
	</style>
	<SCRIPT LANGUAGE="JavaScript" SRC="../CalendarPopup.js"></SCRIPT>
	<SCRIPT>
		var cal = new CalendarPopup();
	</SCRIPT>
	<script language="JavaScript1.2">
		//Disable select-text script (IE4+, NS6+)- By Andy Scott
		//Exclusive permission granted to Dynamic Drive to feature script
		//Visit http://www.dynamicdrive.com for this script

		function disableselect(e) {
			return false
		}

		function reEnable() {
			return true
		}

		//if IE4+
		document.onselectstart = new Function("return false")

		//if NS6
		if (window.sidebar) {
			document.onmousedown = disableselect
			document.onclick = reEnable
		}
	</script>
</head>
<?php
$msg = 0;
?>
<body>
	<script language=JavaScript>
		<!--
		//Disable right mouse click Script
		//By Maximus (maximus@nsimail.com) w/ mods by DynamicDrive
		//For full source code, visit http://www.dynamicdrive.com

		var message = "Sorry, The Right Click is Disabled!";

		///////////////////////////////////
		function clickIE4() {
			if (event.button == 2) {
				alert(message);
				return false;
			}
		}

		function clickNS4(e) {
			if (document.layers || document.getElementById && !document.all) {
				if (e.which == 2 || e.which == 3) {
					alert(message);
					return false;
				}
			}
		}

		if (document.layers) {
			document.captureEvents(Event.MOUSEDOWN);
			document.onmousedown = clickNS4;
		} else if (document.all && !document.getElementById) {
			document.onmousedown = clickIE4;
		}

		document.oncontextmenu = new Function("alert(message);return false")

		// 
		-->
	</script>
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
							<td width="228" valign="top" bgcolor="#EEEEEE"> <?php
																			if (!empty($_SESSION['id'])) {
																				include("sidemenu.php");
																			}
																			?></td>
							<td align="center" valign="top" bgcolor="#FFFFFF">
								<h1>View All Agent Enquiry Date Wise<br>
									&nbsp;</h1>

								<b>
									<font size="2"><a href="ViewAgentFollow_dateWise.php">
											Click for Follow up date wise &gt;&gt;</a></font>
								</b>&nbsp;
								<form name="frmhlp" id="frmhlp" method="post" action="ViewAgentEnquiry_dateWise.php">


									<table border="0" width="100%" id="table4" style="border-collapse: collapse" height="70">
										<tr>
											<td width="195">&nbsp; <font color="#000000"><b>&nbsp;
														<font size="2">From Enquiry Date </font>
													</b></font>
											</td>
											<td width="372">
												<INPUT TYPE="text" NAME="tdate0"
													VALUE="<?php echo $_POST['tdate0'] ?? date('d-m-Y'); ?>"
													size="17">
												<A HREF="#" onClick="cal.select(document.forms['frmhlp'].tdate0,'anchor2','dd-MM-yyyy'); return false;" NAME="anchor2" ID="anchor2">
													<img src="../Admin/cal.gif" width="16" height="16" border="0" alt="Pick a date"></A>&nbsp;&nbsp;&nbsp;
											</td>
											<td>
												&nbsp;</td>
										</tr>
										<tr>
											<td width="141">&nbsp; <font color="#000000"><b>&nbsp;
														<font size="2">Upto Enquiry Date</font>
													</b></font>
											</td>
											<td width="426">
												<INPUT TYPE="text" NAME="tdate"
													VALUE="<?php echo $_POST['tdate'] ?? date('d-m-Y'); ?>"
													size="17">
												<A HREF="#" onClick="cal.select(document.forms['frmhlp'].tdate,'anchor1','dd-MM-yyyy'); return false;" NAME="anchor1" ID="anchor1">
													<img src="../Admin/cal.gif" width="16" height="16" border="0" alt="Pick a date"></A>&nbsp;&nbsp;&nbsp;
											</td>
											<td>
												<input class="subbox" type="submit" value="Show" name="submit" />
											</td>
										</tr>
									</table>
									<?php
									if (isset($_POST["tdate"])) {
									?>
										<table class="table2" width="99%" id="table3" border="1">
											<tr>
												<td bgcolor="#D2D2D2" width="5%" height="33">&nbsp;SNO.</td>
												<td bgcolor="#D2D2D2" width="10%" style="text-align: center" height="33">
													Date</td>
												<td bgcolor="#D2D2D2" width="23%" height="33">&nbsp; Company Name</td>
												<td bgcolor="#D2D2D2" width="13%" height="33">&nbsp;Contact Person</td>
												<td bgcolor="#D2D2D2" width="10%" height="33">Mobile</td>
												<td bgcolor="#D2D2D2" width="11%" height="33">
													Email</td>
												<td bgcolor="#D2D2D2" width="11%" height="33">&nbsp;Last
													Feedback </td>
												<td bgcolor="#D2D2D2" width="11%" height="33">
													&nbsp;Agent Name</td>
												<td bgcolor="#D2D2D2" width="4%" height="33">&nbsp;Status</td>
												<td bgcolor="#D2D2D2" width="3%" height="33">
													View</td>
											</tr>
											<?php
											$d1 = $_POST['tdate0'] ?? '';
											$d2 = $_POST['tdate'] ?? '';
if (
    strtotime($d1) === false ||
    strtotime($d2) === false
) {
    exit("Invalid date.");
}

											$diff = diff_date($d1, $d2);
											//echo $diff;

											$d = 0;
											$i = 1;
											while ($d <= $diff) {
												$d3 = add_date($d1, $d, 0, 0);
												$st = mysqli_prepare(
    $con,
    "SELECT eid,edate,ename,cate,
            agenquiry.mobile,
            email,
            cdate,
            aname,
            estatus
     FROM agenquiry
JOIN agent
ON agenquiry.aid = agent.aid
WHERE STR_TO_DATE(edate,'%d-%m-%Y')
BETWEEN ? AND ?
ORDER BY STR_TO_DATE(edate,'%d-%m-%Y') DESC"
);

mysqli_stmt_bind_param($st, "s", $d3);
mysqli_stmt_execute($st);

$result = mysqli_stmt_get_result($st);
												$result = mysqli_query($con, $st);
												if (!$result) {
    error_log(mysqli_error($con));
    exit("Database error.");
}
												//$num_rows = mysqli_num_rows($result);
												while ($row = mysqli_fetch_assoc($result)) {
											?> <tr>
														<td height="29" width="5%" style="text-align: center">&nbsp;<?php echo $i; ?></td>
														<td height="29" width="10%" style="text-align: center">&nbsp;<?php echo htmlspecialchars($row["edate"]); ?></td>
														<td height="29" width="23%">&nbsp;<?php echo htmlspecialchars($row["ename"]); ?></td>
														<td height="29" width="13%">&nbsp;<?php echo htmlspecialchars($row["cate"]); ?></td>
														<td height="29" width="10%">&nbsp;<?php echo htmlspecialchars($row["mobile"]); ?></td>
														<td height="29" width="11%">&nbsp;<?php echo htmlspecialchars($row["email"]); ?></td>
														<td height="29" width="11%">&nbsp;<?php echo htmlspecialchars($row["cdate"]); ?></td>
														<td height="29" width="11%">&nbsp;<?php echo htmlspecialchars($row["aname"]); ?></td>
														<td height="29" width="4%">&nbsp;<?php echo htmlspecialchars($row["estatus"]); ?></td>
														<td height="29" width="3%">&nbsp;<?php echo "<a class='a2' href='ViewEnqStatus.php?eid=" . $row['eid'] . "'>Detail</a>"; ?></td>
													</tr>

											<?php
													//	$num_rows=$num_rows-1;

													$i = $i + 1;
												}

												$d = $d + 1;
											}  //  d1 less than  d2
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
				<td height="57" align="center" valign="top"> <?php require_once "../footer.php"; ?></td>
			</tr>
		</table>
	</div>

</body>

</html>
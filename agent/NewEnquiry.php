<?php
require_once __DIR__ . "/../config.php";

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
	<script type="text/javascript">
		function vfhfn() {
			var fllnme1 = document.frmhlp.aname.value;
			if (fllnme1 == null || fllnme1 == "") {
				alert("Required Enquiry Name");
				document.frmhlp.aname.focus();
				return false;
			}

			var fllnme1 = document.frmhlp.cate.value;
			if (fllnme1 == "Category Name") {
				alert("Required Category Name");
				document.frmhlp.cate.focus();
				return false;
			}

			var fllnme1 = document.frmhlp.mobile.value;
			if (fllnme1 == "") {
				alert("Required Mobile No");
				document.frmhlp.mobile.focus();
				return false;
			}
			return true;
		}
	</script>
</head>
<?php
$msg = 0;
if (isset($_POST["submit"])) {
	$aname  = mysqli_real_escape_string($con, trim($_POST["aname"]));
	$cate   = mysqli_real_escape_string($con, trim($_POST["cate"]));
	$address = mysqli_real_escape_string($con, trim($_POST["address"]));
	$area   = mysqli_real_escape_string($con, trim($_POST["area"]));
	$city   = mysqli_real_escape_string($con, trim($_POST["city"]));
	$mobile = mysqli_real_escape_string($con, trim($_POST["mobile"]));
	$email  = mysqli_real_escape_string($con, trim($_POST["email"]));
	$web    = mysqli_real_escape_string($con, trim($_POST["web"]));

	$st = "INSERT INTO agenquiry VALUES
(NULL,'$aname','$cate','$address','$area','$city','$mobile','$email',
" . $_SESSION['aid'] . ",'" . date("d-m-Y") . "','Open','-','-','$web',1)";
	if (mysqli_query($con, $st)) {
		$msg = 1;
	} else {
		die(mysqli_error($con));
	}
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
							<td width="228" valign="top" bgcolor="#EEEEEE"> <?php if ($_SESSION["aid"] != "") include("sidemenu.php"); ?></td>
							<td align="center" valign="top" bgcolor="#FFFFFF">
								<h1>Create New Enquiry</h1>
								<h3><?php if ($msg == 1) echo "New Enquiry Created Successfully"; ?>
								</h3>
								<table border="0" width="99%" id="table13" cellpadding="0" style="border-collapse: collapse" bordercolor="#697779" height="128">
									<tr>
										<td valign="top" width="338">
											<table class="table3" border="0" width="99%" id="table14" cellpadding="0" style="border-collapse: collapse" bordercolor="#697779" height="181">

												<form name="frmhlp" id="frmhlp" method="post" action="NewEnquiry.php" onSubmit="return vfhfn();">


													<tr>
														<td width="104" height="50">Company Name/<br>
															Name</td>
														<td width="231" height="50">
															<input class="txtbox" type="text" name="aname" id="aname" tabindex="4" onfocus="if(this.value=='Enquiry Name'){this.value='';}" onblur="if(this.value==''){this.value='Enquiry Name';}" value="Enquiry Name" size="24" required />
														</td>
													</tr>
													<tr>
														<td width="104" height="40">Contact Person/<br>
															Qualification</td>
														<td width="231" height="40">
															<input class="txtbox" type="text" name="cate" id="cate" tabindex="4" size="24" required />
														</td>
													</tr>
													<tr>
														<td width="104" height="40">Address</td>
														<td width="231" height="40">
															<input class="txtbox" type="text" name="address" id="address" tabindex="4" size="1" />
														</td>
													</tr>
													<tr>
														<td width="104" height="28">Area</td>
														<td width="231" height="28">
															<input class="txtbox" type="text" name="area" id="address0" tabindex="4" size="1" />
														</td>
													</tr>
													<tr>
														<td width="104" height="28">City</td>
														<td width="231" height="28">
															<input class="txtbox" type="text" name="city" id="city" tabindex="4" size="1" />
														</td>
													</tr>
													<tr>
														<td width="104" height="37">Mobile-1</td>
														<td width="231" height="37">
															<input class="txtbox" type="tel" name="mobile" id="mobile" tabindex="4" size="1" required />
														</td>
													</tr>
													<tr>
														<td width="104" height="44">Email/ Mobile-2</td>
														<td width="231" height="44">
															<input class="txtbox" type="email" name="email" id="email" tabindex="4" size="1" />
														</td>
													</tr>
													<tr>
														<td width="104" height="39">Website</td>
														<td width="231" height="39">
															<input class="txtbox" type="url" name="web" id="email0" tabindex="4" size="1" />
														</td>
													</tr>
													<tr>
														<td width="104" height="97">&nbsp;</td>
														<td width="231" height="97">
															<input class="subbox" type="submit" value="Submit" name="submit" />

														</td>
													</tr>
												</form>
											</table>
											<table class="table3" border="0" width="96%" id="table16" cellpadding="0" style="border-collapse: collapse" bordercolor="#697779">
										</td>
									</tr>
								</table>
							</td>
							<td valign="top">
								<h2>Already Created </h2>
								<table class="table2" border="1" width="99%" id="table17">
									<tr>
										<td bgcolor="#E0E2FE" width="155">&nbsp;Enquiry Name</td>
										<td bgcolor="#E0E2FE" width="90">&nbsp;Contact
											Person</td>
										<td bgcolor="#E0E2FE" width="65">&nbsp;Mobile</td>
										<td bgcolor="#E0E2FE" width="65">&nbsp;Enq.Date</td>
										<td bgcolor="#E0E2FE" width="60">&nbsp;Edit </td>
									</tr>
									<?php
									$st = "Select * from agenquiry where aid=" . $_SESSION['aid'] . " order by eid desc";
									$result = mysqli_query($con, $st);
									if (!$result) {
										error_log(mysqli_error($con));
										die("Database Error");
									}
									while ($row = mysqli_fetch_assoc($result)) {
									?>
										<tr>
											<td width="155">&nbsp;&nbsp;<?php echo htmlspecialchars($row["ename"]); ?></td>
											<td width="90">&nbsp;&nbsp;<?php echo htmlspecialchars($row["cate"]); ?></td>
											<td width="65">&nbsp;<?php echo htmlspecialchars($row["mobile"]); ?></td>
											<td width="65">&nbsp;<?php echo htmlspecialchars($row["edate"]); ?></td>
											<td width="60">&nbsp;&nbsp;&nbsp;<?php echo "<a class='a5' href='EditEnq.php?id=" . (int)$row['eid'] . "'>View</a>"; ?></td>
										</tr>

									<?php
									}
									?>
								</table>
							</td>
						</tr>
					</table>
					</p>
					<p>&nbsp;
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
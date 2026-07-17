<?php

declare(strict_types=1);

require_once __DIR__ . "/config.php";

if (session_status() === PHP_SESSION_NONE) {
	session_start();
}

$msg = 0;
$id = isset($_GET["id"]) ? (int) $_GET["id"] : 0;

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["submit"]) && $id > 0) {
	$city = $_GET["city"] ?? "";
	$mname = $_GET["mname"] ?? "";
	$mobile = $_GET["mobile"] ?? "";
	$txtmail = $_GET["txtmail"] ?? "";
	$remark = $_GET["remark"] ?? "";
	$createdDate = date("d-m-Y");

	$stmt = mysqli_prepare(
		$con,
		"INSERT INTO enquiry VALUES (NULL, ?, ?, ?, ?, ?, ?, ?)"
	);

	if ($stmt) {
		mysqli_stmt_bind_param(
			$stmt,
			"issssss",
			$id,
			$city,
			$mname,
			$mobile,
			$txtmail,
			$remark,
			$createdDate
		);

		if (mysqli_stmt_execute($stmt)) {
			$msg = 1;
		}

		mysqli_stmt_close($stmt);
	}
}

function e(?string $value): string
{
	return htmlspecialchars($value ?? "", ENT_QUOTES, "UTF-8");
}
?>

<html>

<head>
	<meta http-equiv="Content-Language" content="en-us">
	<meta charset="UTF-8">
	<title>Online Directory Service</title>
	<link rel="stylesheet" type="text/css" href="akc.css" />
</head>

<body topmargin="0" leftmargin="0" rightmargin="0" bottommargin="2" background="images/bg.png">

	<?php require_once "header.php"; ?>

	<table border="0" width="100%" cellpadding="0" style="border-collapse: collapse">
		<tr>
			<td valign="top">
				<div align="center">

					<?php if ($msg === 1): ?>
						<br>
						<h5>Your Message Successfully Send.</h5>
					<?php endif; ?>

					<table border="0" width="1010" id="table33" style="border-collapse: collapse" height="40" cellpadding="0">

						<?php
						if ($id > 0) {
							$stmt = mysqli_prepare(
								$con,
								"SELECT *
         FROM member, memberdetail
         WHERE member.mid = memberdetail.mid
         AND member.mid = ?"
							);

							if (!$stmt) {
								die(mysqli_error($con));
							}

							mysqli_stmt_bind_param($stmt, "i", $id);
							mysqli_stmt_execute($stmt);

							$result = mysqli_stmt_get_result($stmt);

							if ($row = mysqli_fetch_assoc($result)) {
						?>

								<tr>
									<td width="599" align="center" valign="top" style="border-left-width: 1px; border-right-style: dotted; border-right-width: 1px; border-top-width: 1px; border-bottom-width: 1px">
										<br>

										<?php
										// Google map usually contains iframe HTML, so it is intentionally not escaped here.
										// Keep this only if gmap is saved by trusted admin users.
										echo $row["gmap"] ?? "";
										?>

									</td>

									<td width="410" valign="top">
										&nbsp;<div align="right">

											<table border="0" width="96%" id="table37" style="border-collapse: collapse">
												<tr>
													<td width="21%" align="center" height="105">
														<a href="http://<?php echo e($row["website"] ?? ""); ?>" target="_blank" class="a5">
															<img border="0" src="User/logo//<?php echo e($row["logo"] ?? ""); ?>" width="82" height="91">
														</a>
													</td>

													<td width="79%" height="105">
														&nbsp;<font color="#333333" size="5"><?php echo e($row["compname"] ?? ""); ?></font>
													</td>
												</tr>

												<tr>
													<td colspan="2" align="center" height="37" valign="top">&nbsp;
														<a target="_blank" href="http://<?php echo e($row["twiter"] ?? ""); ?>">
															<img border="0" src="<?php echo e($path ?? ""); ?>images/twitter-icon.png" width="32" height="32">
														</a>

														<a target="_blank" href="http://<?php echo e($row["facebook"] ?? ""); ?>">
															<img border="0" src="<?php echo e($path ?? ""); ?>images/facebook-icon.png" width="32" height="32">
														</a>

														<a target="_blank" href="http://<?php echo e($row["linken"] ?? ""); ?>">
															<img border="0" src="<?php echo e($path ?? ""); ?>images/linkedin-icon.png" width="32" height="32">
														</a>

														<a href="http://<?php echo e($row["ytube"] ?? ""); ?>">
															<img border="0" src="<?php echo e($path ?? ""); ?>images/uTube.png" width="32" height="32">
														</a>
														&nbsp;&nbsp;
													</td>
												</tr>

												<tr>
													<td colspan="2" align="center" height="37" valign="top">
														<div align="left">

															<table class="table1" border="0" width="99%" id="table42" style="border-collapse: collapse" bordercolor="#E3E3E3" cellpadding="0">
																<tr>
																	<td width="47%" height="8"></td>
																</tr>

																<tr>
																	<td width="47%" height="25">
																		<p style="line-height: 25px"><b>
																				<font size="3" color="#003366">Contact Person : <?php echo e($row["mname"] ?? ""); ?></font>
																			</b></p>
																	</td>
																</tr>

																<tr>
																	<td width="47%" height="25">
																		<b>
																			<font color="#003366">&nbsp;Address&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</font>
																		</b>
																		<font color="#003366" size="2">
																			<?php echo e(ucwords($row["shopno"] ?? "")); ?>
																			<?php echo e(ucwords($row["address"] ?? "")); ?>
																			<?php echo e(ucwords($row["area"] ?? "")); ?>
																			<?php echo e($row["city"] ?? ""); ?>
																			<?php echo e($row["state1"] ?? ""); ?>
																		</font>
																	</td>
																</tr>

																<tr>
																	<td width="47%" height="25">
																		<font color="#003366"><b>&nbsp;Contact No. :</b></font>
																		<font size="2" color="#003366">
																			<?php echo e($row["phone"] ?? ""); ?>,
																			<?php echo e($row["mobile"] ?? ""); ?>
																		</font>
																	</td>
																</tr>

																<tr>
																	<td width="47%" height="25">
																		<font color="#003366">
																			<b>&nbsp;Email&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</b>
																			<font size="2"><?php echo e($row["email"] ?? ""); ?></font>
																		</font>
																	</td>
																</tr>

																<tr>
																	<td width="47%" height="25">
																		<font color="#003366"><b>&nbsp;Website&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</b>
																			<font size="2">
																				<a href="https://<?php echo e($row["web"] ?? ""); ?>" target="_blank" class="a5">
																					<?php echo e($row["web"] ?? ""); ?>
																				</a>
																			</font>
																		</font>
																	</td>
																</tr>

																<tr>
																	<td align="center" height="3" valign="bottom" bgcolor="#D3D3D3"></td>
																</tr>

																<tr>
																	<td height="20"></td>
																</tr>

																<tr>
																	<td height="25">
																		<div align="center"></div>
																	</td>
																</tr>

																<tr>
																	<td height="200" style="border-left-width: 1px; border-right-width: 1px; border-top-style: dotted; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px">

																		<marquee>
																			<?php
																			$imageStmt = mysqli_prepare($con, "SELECT * FROM memberimage WHERE mid = ?");

																			if (!$imageStmt) {
																				die(mysqli_error($con));
																			}

																			mysqli_stmt_bind_param($imageStmt, "i", $id);
																			mysqli_stmt_execute($imageStmt);

																			$result2 = mysqli_stmt_get_result($imageStmt);

																			while ($row2 = mysqli_fetch_assoc($result2)) {
																			?>
																				<img border="0" src="User/logo//<?php echo e($row2["img"] ?? ""); ?>" width="156" height="169"> &nbsp;&nbsp;&nbsp;
																			<?php
																			}

																			mysqli_stmt_close($imageStmt);
																			?>
																		</marquee>

																	</td>
																</tr>
															</table>

														</div>
													</td>
												</tr>
											</table>

										</div>
									</td>
								</tr>

								<tr>
									<td align="center" colspan="2" bgcolor="#FFFFFF" height="50">
										<table border="0" width="99%" id="table40" cellspacing="1" style="border-collapse: collapse">
											<tr>
												<td bgcolor="#E3E3E3" height="8"></td>
											</tr>

											<tr>
												<td width="98%" valign="top" height="5"></td>
											</tr>

											<tr>
												<td width="98%" valign="top" bgcolor="#FFFFFF">
													<p style="line-height: 25px; margin-left: 10px; margin-right: 20px; margin-top: 10px; margin-bottom: 5px" align="justify">
														<b>
															<font color="#003366" size="2">About Us :</font>
														</b>
														<font color="#003366" size="2">&nbsp;&nbsp; <?php echo e($row["remark1"] ?? ""); ?></font>
														<br><br>
													</p>
												</td>
											</tr>
										</table>
									</td>
								</tr>

						<?php
							}

							mysqli_stmt_close($stmt);
						}
						?>

					</table>
				</div>
			</td>
		</tr>
	</table>

	<div align="center">
		<?php require_once "footer.php"; ?>
	</div>

</body>

</html>
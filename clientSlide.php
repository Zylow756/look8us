<?php

declare(strict_types=1);

require_once __DIR__ . "/config.php";

if (session_status() === PHP_SESSION_NONE) {
	session_start();
}

$msg = 0;
$id = isset($_GET["id"]) ? (int) $_GET["id"] : 0;

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
	<link href="css/templatemo_style1.css" rel="stylesheet" type="text/css" />
	<link href="css/jquery.ennui.contentslider.css" rel="stylesheet" type="text/css" media="screen,projection" />
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
					<table border="0" width="1010" id="table33" style="border-collapse: collapse" cellpadding="0" bordercolor="#E3E3E3" height="587">
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
									<td width="1010" valign="top" height="112" colspan="2">
										<table border="0" width="100%" id="table50" style="border-collapse: collapse" height="113">
											<tr>
												<td width="127" align="center">
													<?php if (($row["logo"] ?? "-") !== "-"): ?>
														<a href="http://<?php echo e($row["website"] ?? ""); ?>" target="_blank" class="a5">
															<img border="0" src="User/logo//<?php echo e($row["logo"] ?? ""); ?>" width="82" height="91">
														</a>
													<?php endif; ?>
												</td>
												<td>
													&nbsp;&nbsp;<font color="#0000CC" size="6"><?php echo e($row["compname"] ?? ""); ?></font>
												</td>
												<td width="349">
													<table border="0" width="100%" id="table51" style="border-collapse: collapse">
<?php if (($row["mplan"] ?? "") === "Gold" || ($row["mplan"] ?? "") === "Platinum"): ?>
															<tr>
																<td width="100" valign="bottom">
																	<p style="margin-bottom: 15px">
																		<b>
																			<font size="2" color="#003366">&nbsp; </font>
																			<font color="#02203E">Follow Us :</font>
																		</b>
																	</p>
																</td>
																<td>
																	<?php if (($row["twiter"] ?? "-") !== "-"): ?>
																		<a target="_blank" href="http://<?php echo e($row["twiter"] ?? ""); ?>">
																			<img border="0" src="<?php echo e($path ?? ""); ?>images/twitter-icon.png" width="32" height="32">
																		</a>
																	<?php endif; ?>

																	<?php if (($row["facebook"] ?? "-") !== "-"): ?>
																		<a target="_blank" href="http://<?php echo e($row["facebook"] ?? ""); ?>">
																			<img border="0" src="<?php echo e($path ?? ""); ?>images/facebook-icon.png" width="32" height="32">
																		</a>
																	<?php endif; ?>

																	<?php if (($row["linken"] ?? "-") !== "-"): ?>
																		<a target="_blank" href="http://<?php echo e($row["linken"] ?? ""); ?>">
																			<img border="0" src="<?php echo e($path ?? ""); ?>images/linkedin-icon.png" width="32" height="32">
																		</a>
																	<?php endif; ?>

																	<?php if (($row["ytube"] ?? "-") !== "-"): ?>
																		<a href="http://<?php echo e($row["ytube"] ?? ""); ?>">
																			<img border="0" src="<?php echo e($path ?? ""); ?>images/uTube.png" width="32" height="32">
																		</a>
																	<?php endif; ?>

																	<?php if (($row["gmap"] ?? "-") !== "-"): ?>
																		<a href="<?php echo e(($path ?? "") . "clientMap.php?id=" . $id); ?>">
																			<img border="0" src="<?php echo e($path ?? ""); ?>images/gmap.png" width="49" height="62">
																		</a>
																	<?php endif; ?>
																	&nbsp;&nbsp;
																</td>
															</tr>
														<?php endif; ?>
													</table>
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td width="1010" valign="top" height="8" colspan="2" bgcolor="#02203E"></td>
								</tr>
								<tr>
									<td width="341" valign="top" height="397">
										&nbsp;<div align="center">
											<table border="0" width="98%" id="table46" style="border-collapse: collapse">
												<tr>
													<td align="center" height="20" valign="top">
														<p>&nbsp;</p>
													</td>
												</tr>
												<tr>
													<td align="center" height="37" valign="top">
														<div align="left">
															<table class="table1" border="0" width="99%" id="table48" style="border-collapse: collapse" bordercolor="#E3E3E3" cellpadding="0">
																<tr>
																	<td width="47%" height="8"></td>
																</tr>
																<tr>
																	<td width="47%" height="30">
																		<p style="line-height: 25px">
																			<b>
																				<font size="3" color="#0000CC">&nbsp;Contact : <?php echo e($row["mname"] ?? ""); ?></font>
																			</b>
																		</p>
																	</td>
																</tr>
																<tr>
																	<td width="47%" height="30">
																		<table border="0" width="100%" id="table52" style="border-collapse: collapse">
																			<tr>
																				<td width="77" valign="top"><b>
																						<font color="#02203E" size="2">&nbsp;Address&nbsp;&nbsp;&nbsp;&nbsp;:</font>
																					</b></td>
																				<td valign="top">
																					<font color="#02203E" size="2">
																						<?php echo e(ucwords($row["shopno"] ?? "")); ?>
																						<?php echo e(ucwords($row["address"] ?? "")); ?>
																						<?php echo e(ucwords($row["area"] ?? "")); ?>
																						<?php echo e($row["city"] ?? ""); ?>
																						<?php echo e($row["state1"] ?? ""); ?>
																						&nbsp;
																					</font>
																				</td>
																			</tr>
																		</table>
																	</td>
																</tr>
																<tr>
																	<td width="47%" height="30">
																		<font color="#02203E"><b>&nbsp;Contact No. :</b></font>
																		<font size="2" color="#02203E">
																			<?php echo e($row["phone"] ?? ""); ?>,
																			<?php echo e($row["mobile"] ?? ""); ?>
																		</font>
																	</td>
																</tr>
																<tr>
																	<td width="47%" height="30">
																		<font color="#02203E">
																			<b>&nbsp;Email&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</b>
																			<font size="2"><?php echo e($row["email"] ?? ""); ?></font>
																		</font>
																	</td>
																</tr>
																<tr>
																	<td width="47%" height="30">
																		<font color="#02203E"><b>&nbsp;Website&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</b></font>
																		<font color="#003366" size="2">
																			<a href="http://<?php echo e($row["web"] ?? ""); ?>" target="_blank" class="a5">
																				<font color="#02203E"><?php echo e($row["web"] ?? ""); ?></font>
																			</a>
																		</font>
																	</td>
																</tr>
															</table>
														</div>
													</td>
												</tr>
											</table>
										</div>
									</td>
									<td width="669" align="center" valign="top" height="397">
										&nbsp;<table border="1" width="650" id="table49" bgcolor="#F7F7F7" style="border-collapse: collapse" height="430" bordercolor="#F4F4F4" cellspacing="1">
											<tr>
												<td align="center">
													<div id="templatemo_slider_wrapper">
														<div id="templatemo_slider">
															<div id="one" class="contentslider">
																<div class="cs_wrapper">
																	<div class="cs_slider" style="position: absolute; left: 0px; top: 0px">
<?php
																		$imageStmt = mysqli_prepare($con, "SELECT * FROM memberimage WHERE mid = ?");

																		if (!$imageStmt) {
																			die(mysqli_error($con));
																		}

																		$memberId = (int) ($row["mid"] ?? 0);
																		mysqli_stmt_bind_param($imageStmt, "i", $memberId);
																		mysqli_stmt_execute($imageStmt);

																		$result2 = mysqli_stmt_get_result($imageStmt);

																		while ($row2 = mysqli_fetch_assoc($result2)) {
																		?>
																			<div class="cs_article">
																				<div class="article">
																					<div class="right">
																						<a href="#" target="_parent">
																							<img src="User/logo//<?php echo e($row2["img"] ?? ""); ?>" alt="Slider Image" />
																						</a>
																					</div>
																				</div>
																			</div>
																		<?php
																		}
																		mysqli_stmt_close($imageStmt);
																		?>
																	</div>
																</div>
															</div>
															<script type="text/javascript" src="js/jquery-1.3.1.min.js"></script>
															<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
															<script type="text/javascript" src="js/jquery.ennui.contentslider.js"></script>
															<script type="text/javascript">
																$(function() {
																	$('#one').ContentSlider({
																		width: '650px',
																		height: '370px',
																		speed: 500,
																		easing: 'easeOutQuart'
																	});
																});
															</script>
														</div>
													</div>
												</td>
											</tr>
										</table>
										<br>
									</td>
								</tr>
								<tr>
									<td width="1007" valign="top" colspan="2" bgcolor="#E3E3E3" height="7"></td>
								</tr>
								<tr>
									<td width="1007" valign="top" colspan="2" bgcolor="#FFFFFF">
										<?php if (($row["remark"] ?? "-") !== "-"): ?>
											<p style="line-height: 22px; margin-left: 10px; margin-right: 10px; margin-top: 10px">
												<font color="#02203E" size="2" face="Arial">
													<b>About Us :</b>&nbsp;&nbsp; <?php echo e($row["remark"] ?? ""); ?>
													&nbsp;
												</font>
											</p>
										<?php endif; ?>
									</td>
								</tr>
								<tr>
									<td width="1007" valign="top" colspan="2" bgcolor="#FFFFFF" height="20">&nbsp;</td>
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
		&nbsp;
	</div>
</body>
</html>
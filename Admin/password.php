<?php
require_once "config.php";

if (session_status() === PHP_SESSION_NONE) {
	session_start();
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
			background-color: #70828F
		}
	</style>
</head>

<?php
if (!isset($_SESSION['user']) || $_SESSION['user'] == "") {
	header("location: ../index.php?r=0");
	exit;
}

$msg = 0;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$stmt = mysqli_prepare(
		$con,
		"SELECT * FROM admin WHERE uname=? AND pass=?"
	);

	$oldPass = base64_encode($_POST['pass0']);

	mysqli_stmt_bind_param(
		$stmt,
		"ss",
		$_SESSION['user'],
		$oldPass
	);

	mysqli_stmt_execute($stmt);

	$result = mysqli_stmt_get_result($stmt);

	if (mysqli_fetch_assoc($result)) {
		$stmt = mysqli_prepare(
			$con,
			"UPDATE admin SET pass=? WHERE uid=?"
		);

		mysqli_stmt_bind_param(
			$stmt,
			"si",
			$pass,
			$_SESSION['id']
		);
		if (!isset($_SESSION['id'])) {
			header("Location: ../index.php?r=0");
			exit;
		}

		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	} else
		$msg = 2;

	mysqli_stmt_close($stmt);
}
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
							<td width="228" valign="top" bgcolor="#E3E3E3"> <?php if ($_SESSION["id"] != "") include("sidemenu.php"); ?></td>
							<td align="center" valign="top" bgcolor="#FFFFFF">
								&nbsp;<p>&nbsp;<?php if ($msg == 1) echo "Password changed successfully.";
												else if ($msg == 2) echo "Password NOT Correct";
												if (trim($_POST['pass']) == "") {
													die("Password cannot be empty.");
												}
												//  echo $s;  
												?></p>
								<form name="frmhlp" id="frmhlp" method="post" action="Password.php" onsubmit="return vfhfn();">
									<table border="0" width="80%" id="table4" cellpadding="0" style="border-collapse: collapse" height="175">
										<tr>
											<td width="164">Old Password</td>
											<td width="197">
												<input class="txtbox" type="password" name="pass0" id="pass0" tabindex="4" />
											</td>
											<td width="298">
												&nbsp;</td>
										</tr>
										<tr>
											<td width="164" height="39">New Password </td>
											<td width="197" height="39">
												<input class="txtbox" type="password" name="pass" id="pass" tabindex="4" />
											</td>
											<td height="39" width="298">
												<p class="p1">&nbsp;</p>
											</td>
										</tr>
										<tr>
											<td width="164">Confirm Password</td>
											<td width="197">
												<input class="txtbox" type="password" name="pass1" id="pass1" tabindex="4" />
											</td>
											<td width="298">
												&nbsp;</td>
										</tr>
										<tr>
											<td width="164">&nbsp;</td>
											<td width="197">
												<input class="subbox" type="submit" value="Change" name="submit" />
											</td>
											<td width="298">
												&nbsp;</td>
										</tr>
									</table>
								</form>
								<p>&nbsp;</p>
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
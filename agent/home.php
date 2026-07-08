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
</head>
<?php
//	$ip = getenv('HTTP_CLIENT_IP')?: getenv('HTTP_X_FORWARDED_FOR')?: 	getenv('HTTP_X_FORWARDED')?: 	getenv('HTTP_FORWARDED_FOR')?: 	getenv('HTTP_FORWARDED')?: 	getenv('REMOTE_ADDR');

$ip = getenv('REMOTE_ADDR');
if ($_SERVER['REQUEST_METHOD'] === "POST") {
	$pass = $_POST['t2'];
	$rhost = "-";
	$rhost = $ip;
	$username = mysqli_real_escape_string($con, trim($_POST['t1']));
	$pass = mysqli_real_escape_string($con, $_POST['t2']);

	$s = "SELECT * FROM agent WHERE us='$username' AND pass='$pass'";
	$r = mysqli_query($con, $s);
	if (!$r) {
		error_log(mysqli_error($con));
		die("Database Error");
	}
	//echo $s;
	if ($row = mysqli_fetch_assoc($r)) {
		if ($row) {
			session_regenerate_id(true);

			$_SESSION['agent'] = $username;
			$_SESSION['aid'] = $row['aid'];

			$st = "insert into loginlog values(NULL,'" . $row["us"] . "'," . $row["aid"] . ",'" . date("d/M/Y") . "','" . date("h:i:s a") . "','" . $rhost . "','" . $_SERVER['REMOTE_ADDR'] . "','Success','-')";
			mysqli_query($con, $st);
		} else {
			$_SESSION['agent'] = "";
			$_SESSION['aid'] = 0;
			header("Location: index.php?r=0");
			exit;
		}
	} else {
		//$res="Invalid User Name OR Password";
		$_SESSION['agent'] = "";
		$_SESSION['aid'] = 0;

		$st = "insert into loginlog values(NULL,'" . $username . "',0,'" . date("d/M/Y") . "','" . date("h:i:s a") . "','" . $rhost . "','" . $_SERVER['REMOTE_ADDR'] . "','Fail','-')";
		mysqli_query($con, $st);

		header("Location: index.php?r=0");
		exit;
	}
} else {
	header("Location: index.php?r=0");
	exit;
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
							<td width="228" valign="top" bgcolor="#EEEEEE">
								<?php
								if (!empty($_SESSION['aid'])) {
									include("sidemenu.php");
								}
								?>
							</td>
							<td align="center" valign="top" bgcolor="#FFFFFF">
								&nbsp;<p>&nbsp;</p>
								<table border="0" width="70%" id="table3" cellpadding="0" style="border-collapse: collapse" bordercolor="#697779" height="128">
									<tr>
										<td bgcolor="#0033CC" align="center">
											&nbsp;<p>&nbsp;</p>
											<p>
											<h2 style="color:white;"><b>Welcome at
													Agent Panel </b></h2>
											</p>
											<p>&nbsp;</p>
											IP : <?php echo $ip; ?>
											<p>&nbsp;</p>
											<p>&nbsp;</p>
											<p>&nbsp;
										</td>
									</tr>
								</table>
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
<?php
require_once __DIR__ . "/../config.php";

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

body
{
background-image:url('img/bg.png');
background-repeat:repeat-x;
background-color: #70828F
} 
</style>
</head>

<?php
 if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
	{
		$username = trim($_POST['t1']);
$password = trim($_POST['t2']);
$acode    = trim($_POST['t3']);

$stmt = $con->prepare(
    "SELECT * FROM admin
     WHERE uname = ?
       AND pass = ?
       AND acode = ?"
);

$stmt->bind_param("sss", $username, $password, $acode);
$stmt->execute();

$r = $stmt->get_result();

if ($row = $r->fetch_assoc()) {

    $_SESSION['admin'] = $row['uname'];
    $_SESSION['typ']   = $row['utyp'];
    $_SESSION['id']    = $row['uid'];

	echo "<pre>";
echo "LOGIN SUCCESS\n";
echo "Session ID: " . session_id() . "\n";
print_r($_SESSION);

session_write_close();
exit;

    $stmt = $con->prepare(
        "UPDATE admin SET acode='012345' WHERE uid=?"
    );

    $stmt->bind_param("i", $row['uid']);
    $stmt->execute();

    header("Location: home.php");
    exit;

} else {

    $_SESSION['admin'] = "";
    $_SESSION['typ']   = "";
    $_SESSION['id']    = 0;

    header("Location: index.php?r=0");
    exit;
}
	}
	else
	{
	if (empty($_SESSION['admin']))
		{
	 header("Location: index.php?r=0");
exit;
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
					&nbsp;<p>&nbsp;</p>
					<table border="0" width="70%" id="table3" cellpadding="0" style="border-collapse: collapse" bordercolor="#697779" height="128">
						<tr>
							<td bgcolor="#FF0000" align="center">
							&nbsp;<p>&nbsp;</p>
							<p><font size="4" color="#FFFFFF"><b>Welcome at 
							Admin Panel </b></font></p>
							<p><b><font size="4" color="#000000">Admin Panel</font></b></p>
							<p>&nbsp;</p>
							<p>&nbsp;</p>
							<p>&nbsp;</td>
						</tr>
					</table>
					<p>&nbsp;</p>
					<p>&nbsp;</td>
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
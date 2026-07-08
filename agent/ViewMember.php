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
body
{
background-image:url('../Admin/img/bg.png');
background-repeat:repeat-x;
background-color: #70828F;;
} 
</style>
</head>
<?php
$msg=0;	
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
					<td width="228" valign="top" bgcolor="#EEEEEE">			<?php if ($_SESSION["aid"]!="") include("sidemenu.php"); ?></td>
					<td align="center" valign="top" bgcolor="#FFFFFF">
					<h1>View All Member<br>
&nbsp;</h1>
				
<form name="frmhlp" id="frmhlp" method="post" action="ViewEnq.php" >
					<?php
					if (isset($_SESSION["aid"]))
					{
					?>
					<table class="table2"  width="94%" id="table3" border="1"    >
								<tr>
									<td bgcolor="#D2D2D2" width="5%">&nbsp;SNO.</td>
									<td bgcolor="#D2D2D2" width="23%" style="text-align: center">
									Date</td>
									<td bgcolor="#D2D2D2" width="34%">&nbsp; Name</td>
									<td bgcolor="#D2D2D2" width="37%">&nbsp;Company</td>
								</tr>
			<?php						

$agent = mysqli_real_escape_string($con, $_SESSION['agent']);

$st = "SELECT * FROM member
       WHERE acode='$agent'
       ORDER BY mid DESC";

//echo $st;
$i=1;
$result=mysqli_query($con,$st);
if (!$result) {
    error_log(mysqli_error($con));
    die("Database Error");
}
	while ($row=mysqli_fetch_assoc($result))
	{	
	?>
								<tr>
									<td height="29" width="5%" style="text-align: center">&nbsp;<?php echo $i; ?></td>
									<td height="29" width="23%" style="text-align: center">&nbsp;<?php echo htmlspecialchars($row["y"]); ?></td>
									<td height="29" width="34%">&nbsp;<?php echo htmlspecialchars($row["mname"]); ?></td>
									<td height="29" width="37%">&nbsp;<?php echo htmlspecialchars($row["compname"]); ?></td>
								</tr>
								
								<?php
								$i=$i+1;
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
<?php
require_once "config.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (empty($_SESSION['admin'])) {
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
background-image:url('img/bg.png');
background-repeat:repeat-x;
background-color: #70828F;;
} 
</style>
</head>
<?php
$msg=0;
			
if (isset($_GET["id"], $_GET["st"])) {

    $id = (int)$_GET["id"];
    $status = (int)$_GET["st"];

    $stmt = mysqli_prepare($con, "UPDATE member SET mstatus=? WHERE mid=?");
    mysqli_stmt_bind_param($stmt, "ii", $status, $id);

    if (mysqli_stmt_execute($stmt)) {
        $msg = 1;
    }

    mysqli_stmt_close($stmt);
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
					<h1>View All Member</h1>
					<p>&nbsp;</p>
<font color="#FF0000"><?php 
if(isset($_GET['msg']))
 if($_GET['msg']==1)
    echo "<b>Mail Send</b><br>";
  ?>	
					</font>
					<table class="table2"  width="98%" id="table5" border="1"    >
								<tr>
									<td bgcolor="#D2D2D2" width="5%" style="text-align: center">&nbsp;SNO.</td>
									<td bgcolor="#D2D2D2" width="14%">&nbsp;Company Name</td>
									<td bgcolor="#D2D2D2" width="14%">&nbsp;Member&nbsp; 
									Name</td>
									<td bgcolor="#D2D2D2" width="16%" style="text-align: center">
									Email</td>
									<td bgcolor="#D2D2D2" width="12%" style="text-align: center">
									Mobile</td>
									<td bgcolor="#D2D2D2" width="7%" style="text-align: center">
									View</td>
									<td bgcolor="#D2D2D2" width="6%" style="text-align: center">
									Delete</td>
									<td bgcolor="#D2D2D2" width="6%" style="text-align: center">
									Plan</td>
									<td bgcolor="#D2D2D2" width="6%" style="text-align: center">
									Expiry</td>
									<td bgcolor="#D2D2D2" width="4%" style="text-align: center">
									&nbsp;Status</td>
									<td bgcolor="#D2D2D2" width="4%" style="text-align: center">
									Mail</td>
								</tr>
			<?php	
$st="Select * from member order by mid desc";

$i=1;
$result=mysqli_query($con,$st);
if (!$result) {
    error_log(mysqli_error($con));
    die("Database Error");
}

$num_rows = mysqli_num_rows($result);

	while ($row=mysqli_fetch_assoc($result))
	{	
	?>
								<tr>
									<td height="29" width="5%" style="text-align: center">&nbsp;<?php echo $num_rows; ?></td>
									<td height="29" width="14%">&nbsp;<?php echo htmlspecialchars($row["compname"]); ?></td>
									<td height="29" width="14%">&nbsp;<?php echo htmlspecialchars($row["mname"]); ?></td>
									<td height="29" width="16%" style="text-align: center">&nbsp;<?php echo htmlspecialchars($row["email"]); ?></td>
									<td height="29" width="12%" style="text-align: center">&nbsp;<?php echo htmlspecialchars($row["mobile"]); ?></td>
									<td height="29" width="7%" style="text-align: center">&nbsp;<?php echo "<a class='a5' href='ViewDetail.php?id=" . (int)$row['mid'] . "'>View</a>"; ?></td>
									<td height="29" width="6%" style="text-align: center">	&nbsp;&nbsp;<?php echo "<a class='a5' href='DeteteMember.php?id=".(int)$row['mid']."'>Delete</a>"; ?></td>
									<td height="29" width="6%" style="text-align: center">	&nbsp;<?php echo htmlspecialchars($row["mplan"]); ?></td>
									<td height="29" width="6%" style="text-align: center">	&nbsp;<?php 
									if ($row["z"] != "-")
									{
									echo date('d-m-Y', strtotime($row["z"])); 
									}
									else
									echo "-";
								 ?>
									<td height="29" width="4%" style="text-align: center">
									<?php 
									if ((int)$row["mstatus"] === 0)
										echo "<a class='a1' href='ViewMember.php?id=".(int)$row['mid']."&st=1'>Enable</a>"; 
									else
										echo "<a class='a2' href='ViewMember.php?id=".(int)$row['mid']."&st=0'>Disable</a>"; 
									
									?>
									</td>
									<td height="29" width="4%" style="text-align: center">
									&nbsp;&nbsp;<?php echo "<a class='a5' href='emailSend.php?id=".(int)$row['mid']."'>Mail</a>"; ?></td>
								</tr>
								
								<?php
							//	$i=$i+1;
							$num_rows=$num_rows-1;
								}
								?>
							</table>
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
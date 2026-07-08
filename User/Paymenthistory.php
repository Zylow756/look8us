<?php
require_once __DIR__ . "/../config.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (empty($_SESSION['user'])) {
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
background-color: #70828F
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
					<td width="228" valign="top" bgcolor="#E3E3E3">			<?php if ($_SESSION["mid"]!="") include("sidemenu.php"); ?></td>
					<td align="center" valign="top" bgcolor="#FFFFFF">
					<h1><font size="2">&nbsp;</font>&nbsp;View Payment History</h1>
					<table border="0" width="100%" id="table35" cellpadding="0" style="border-collapse: collapse" >
								<tr>
									
									<td align="right" valign="top" height="400">
									<div align="center">
									

&nbsp;<table class="table2"  border="1" width="96%" id="table36">
								<tr>
									<td bgcolor="#E0E2FE" width="121"><b>&nbsp;Payment 
									Date</b></td>
									<td bgcolor="#E0E2FE" width="85"><b>&nbsp;Status</b></td>
									<td bgcolor="#E0E2FE" width="109"><b>&nbsp;Amount</b></td>
									<td bgcolor="#E0E2FE" width="118"><b>&nbsp;Payment 
									for Plan </b></td>
									<td bgcolor="#E0E2FE" width="134">&nbsp;<b>Transfer 
									ID</b></td>
								</tr>
								
							<?php 
		 $st="Select distinct(txnid),rdate,status,amount,productinfo  from payreq,member where member.email=payreq.email and  payreq.x=".$_SESSION["mid"]." order by payid desc";
//		 $st="Select * from payreq,member where member.email=payreq.email and  payreq.x=".$_SESSION["mid"]." order by payid desc";

		 		 $result=mysqli_query($con,$st);
if (!$result) {
    die(mysqli_error($con));
}
		while ($row=mysqli_fetch_assoc($result))
			{
			?>
								<tr>
									<td width="121">&nbsp;&nbsp;<?php echo htmlspecialchars($row["rdate"]); ?></td>
									<td width="85">&nbsp;<?php echo htmlspecialchars($row["status"]); ?></td>
									<td width="109">&nbsp;<?php echo htmlspecialchars($row["amount"]); ?></td>
									<td width="118">&nbsp;<?php echo htmlspecialchars($row["productinfo"]); ?></td>
									<td width="134">&nbsp;<?php echo htmlspecialchars($row["txnid"]); ?></td>
								</tr>
								
								<?php
								}
								?>

								

							</table></div>
									<br>
									</td>
								</tr>
							</table>
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
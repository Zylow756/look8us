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
<title>Look8US :Business Directory Kota, Rajasthan , India, Online Business Directory Kota,  Yellow Pages  kota Rajasthan , Trusted & Verified Businesses, Exporters, Manufacturers, Suppliers Directory, B2B Business Directory </title>
<meta name="description" content="Look8us.com from Kota Rajasthan is Your local Business Directory , yellow pages  Business Directory. Business Details, Contacts, Products, Services & Verified Businesses, Exporters, Manufacturers, Suppliers Directory">
<meta name="keywords" content=" Look8us.com ,Search job kota, best job offer , apply job, goverment jobs, job portal , online job portal, online business directory, IT job in kota, marketing job in kota ">

 <link rel="stylesheet" type="text/css" href="akc.css" />


</head>

<body topmargin="0" leftmargin="0" rightmargin="0" bottommargin="2" background="images/bg.png">





<div align="center">
<?php require_once "header.php"; ?>
<table border="0" width="100%" height="100" cellpadding="0" style="border-collapse: collapse">
	<tr>
		<td bgcolor="#D2D2D2">
		<div align="center">
			<table border="0" width="1010" id="table33" style="border-collapse: collapse" height="40" cellpadding="0">
				<tr>
					<td><font size="6">&nbsp;</font><font size="5" color="#333333">View 
					Job Offers</font></td>
				</tr>
			</table>
		</div>
		</td>
	</tr>
</table>
	<table border="0" width="1020" id="table1" style="border-collapse: collapse" bordercolor="#F2F2F2" bgcolor="#FFFFFF" cellpadding="0">
		<tr>
			<td valign="top">
			<div align="center">
			<table border="0" width="100%" id="table2" cellpadding="0" style="border-collapse: collapse" bordercolor="#FFFFCC">
				
				<tr>
					<td valign="top">
					<table border="0" width="100%" id="table8" cellpadding="0" style="border-collapse: collapse">
						<tr>
							<td  valign="top" bgcolor="#FFFFFF">
							<table border="0" width="100%" id="table10" cellpadding="0" style="border-collapse: collapse" height="326" >
								<tr>
									
									<td align="center" valign="top"> <br>
									<p style="margin-left: 10px; margin-top: 5px; margin-bottom: 5px">
											<b>
											
														</b>
											</p><div align="center">
										
									
									
									
									
									
								
										
										<table border="0" width="98%" id="table34" style="border-collapse: collapse" cellpadding="0">
										<tr>
											<td height="29" width="1%" bgcolor="#DDDDDD">
											&nbsp; </td>
											<td height="29" width="50%" bgcolor="#DDDDDD">
											&nbsp;<font size="2" color="#003366"><b>Required</b></font><font size="2" color="#003366"><b> </b>( 
											for 
											job detail Click on &quot;View&quot; )</font></td>
											<td height="29" align="right" width="49%" bgcolor="#DDDDDD">
											<a href="javascript: window.history.go(-1)" class="a5">
							&lt;&lt;back </a>&nbsp;&nbsp;&nbsp;&nbsp; </td>
										</tr>
										<tr>
											<td height="98" colspan="3">
											&nbsp;
					<?php						

$st="Select * from postjob order by jid DESC";

//echo $st;
$i=1;
$result=mysqli_query($con,$st);
if (!$result) {
    die(mysqli_error($con));
}

	while ($row=mysqli_fetch_assoc($result))
	{	
	
	?>						
						<table   width="94%" id="table5" border="0" style="border-collapse: collapse"    >
								<tr>
									<td width="21%" valign="top">
									<p style="line-height: 150%; margin-left:5px; margin-right:5px; margin-top:5px">Post Date: <b> <?php echo htmlspecialchars($row["y"]); ?></b><br>Location : <?php echo htmlspecialchars($row["city"]); ?>

									</td>
									<td width="69%">
									<table border="0" width="100%" id="table35" style="border-collapse: collapse">
										<tr>
											<td width="24" height="25">&nbsp;</td>
											<td height="25"><b><?php echo htmlspecialchars($row["cate"]) ?></b></td>
										</tr>
										<tr>
											<td width="24" height="25">&nbsp;</td>
											<td height="25"><b><font size="2"><?php echo htmlspecialchars($row["atitle"]); ?></font></b></td>
										</tr>
										<tr>
											<td width="24" height="25">&nbsp;</td>
											<td height="25"><font size="2"><?php echo htmlspecialchars($row["discr"]); ?></font></td>
										</tr>
										<tr>
											<td width="24" height="25"></td>
											<td height="25"><font size="2"><?php echo htmlspecialchars($row["jtype"]); ?></font></td>
										</tr>
										<tr>
											<td width="24" height="25"></td>
											<td height="25"><font size="2">Rs.<?php echo htmlspecialchars($row["srange"]." ".$row["stype"]); ?></font></td>
										</tr>
										<tr>
											<td width="24" height="25"></td>
											<td height="25"><font size="2"><?php echo htmlspecialchars($row["city"]); ?></font></td>
										</tr>
									</table>
									</td>
									<td width="9%">
									&nbsp;<a class="a5" href="viewJobDetail.php?id=<?php echo htmlspecialchars($row['jid']); ?>" >View</a></td>
								</tr>
			
				
								<tr>
									<td width="99%" colspan="3" height="3"></td>
								</tr>
			
				
								<tr>
									<td width="99%" colspan="3" bgcolor="#E2E2E2" height="3"></td>
								</tr>
			
				
								<tr>
									<td width="99%" colspan="3" height="3"></td>
								</tr>
			
				
								<?php
								$i=$i+1;

								}
								
								
								?>
							</table></td>
										</tr>
										<tr>
											<td colspan="3">
											&nbsp;<p>&nbsp;</td>
										</tr>
									</table>
									
							
											
									</div>
									</td>
								</tr>
							</table>
							</td>
						</tr>
						</table>
					</td>
				</tr>
			</table>
			</div>
			</td>
		</tr>
	</table>
</div>

<div align="center">
	<?php require_once "footer.php"; ?>
</div>

</body>

</html>
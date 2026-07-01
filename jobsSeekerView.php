<?php
if(!isset($_SESSION))
{
session_start();
}
?>

<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Look8US :Business Directory Kota, Rajasthan , India, Online Business Directory Kota,  Yellow Pages  kota Rajasthan , Trusted & Verified Businesses, Exporters, Manufacturers, Suppliers Directory, B2B Business Directory </title>
<meta name="description" content="Look8us.com from Kota Rajasthan is Your local Business Directory , yellow pages  Business Directory. Business Details, Contacts, Products, Services & Verified Businesses, Exporters, Manufacturers, Suppliers Directory">
<meta name="keywords" content=" Look8us.com ,Search job kota, best job offer , apply job, goverment jobs, job portal , online job portal, online business directory, IT job in kota, marketing job in kota ">

 <link rel="stylesheet" type="text/css" href="akc.css" />


</head>

<body topmargin="0" leftmargin="0" rightmargin="0" bottommargin="2" background="images/bg.png">





<div align="center">
<?php include("header.php"); ?>
<table border="0" width="100%" height="100" cellpadding="0" style="border-collapse: collapse">
	<tr>
		<td bgcolor="#D2D2D2">
		<div align="center">
			<table border="0" width="1010" id="table33" style="border-collapse: collapse" height="40" cellpadding="0">
				<tr>
					<td><font size="6">&nbsp;</font><font size="5" color="#333333">View Job 
					Seekers</font></td>
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
											&nbsp;<font size="2" color="#003366"><b>Job 
											Seeker</b> (for contact detail Click 
											on &quot;View&quot;)</font></td>
											<td height="29" align="right" width="49%" bgcolor="#DDDDDD">
											<a href="javascript: window.history.go(-1)" class="a5">
							&lt;&lt;back </a>&nbsp;&nbsp;&nbsp;&nbsp; </td>
										</tr>
										<tr>
											<td height="98" colspan="3">
											&nbsp;
					<?php						

$st="Select * from postcv order by cid DESC";

//echo $st;
$i=1;
$result=mysql_query($st,$con);

	while ($row=mysql_fetch_array($result))
	{	
	
	?>						
						<table   width="94%" id="table5" border="0" style="border-collapse: collapse"    >
								<tr>
									<td width="21%" valign="top">
									<p style="line-height: 150%; margin-left:5px; margin-right:5px; margin-top:5px">Post Date: <b> <?php echo $row["pdate"]; ?></b><br>Location : <?php echo $row["city"]; ?>

									</td>
									<td width="69%">
									<table border="0" width="100%" id="table35" style="border-collapse: collapse">
										<tr>
											<td width="24" height="26">&nbsp;</td>
											<td height="26"><b><?php echo $row["cate"]; ?></b></td>
										</tr>
										<tr>
											<td width="24" height="26">&nbsp;</td>
											<td height="26"><b><font size="2"><?php echo $row["atitle"]; ?></font></b></td>
										</tr>
										<tr>
											<td width="24" height="26">&nbsp;</td>
											<td height="26"><font size="2"><?php echo $row["discr"]; ?></font></td>
										</tr>
										<tr>
											<td width="24" height="26">&nbsp;</td>
											<td height="26"><font size="2"><?php echo $row["jtype"]; ?></font></td>
										</tr>
										<tr>
											<td width="24" height="26">&nbsp;</td>
											<td height="26">
											<font size="2">City: <?php echo $row["city"]; ?></font>
											&nbsp;&nbsp;&nbsp;</td>
										</tr>
										<tr>
											<td width="24" height="26">&nbsp;</td>
											<td height="26">
											<font size="2">Experience : &nbsp;<?php echo $row["exper"]; ?> </font>
											</td>
										</tr>
										</table>
									</td>
									<td width="9%">
									&nbsp;<a class="a5" href="viewSeeKerDetail.php?id=<?php echo $row['cid']; ?>" >View</a></td>
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
	<?php include("footer.php"); ?>
</div>

</body>

</html>
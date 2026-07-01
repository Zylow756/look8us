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
<meta name="keywords" content=" Look8us.com , yellow pages Kota Rajasthan , business directory Kota Rajasthan india,business search engine, indian business directory, online business directory, Indian manufacturers, suppliers, Indian exporters directory, b2b portal, b2b business directory,manufacturer, importers, traders, dealers, buyers, ">

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
					<td><font size="6">&nbsp;</font><font size="5" color="#333333">Buy product now..</font></td>
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
											&nbsp;</p>
								
 <?php 
 $flag=0;
		 $st="Select * from ecate where ecateid=".$_GET["id"] ;
		 		 $result=mysql_query($st,$con);
		if ($row=mysql_fetch_array($result))
			{
			$flag=1;
			}
			?>
	<table class="shadow2" border="0" width="800" id="table35" height="418" style="border-collapse: collapse" cellpadding="0">
										<tr>
											<td width="759" height="33" align="center"  style="background:rgba(0,90,180,0.9);" >
											<font size="5" color="#FFFFFF">
	 <?php  if( $flag==1)										
      echo $row["catename"];?>
						</font></td>
										</tr>
										<tr>
											<td   height="385"  valign="top">
											<table border="1" width="100%" id="table36" height="100%" style="border-collapse: collapse" bordercolor="#C0C0C0" cellspacing="0" cellpadding="0">
												<tr>
													<td width="338" valign="top">
													<p align="center">
													&nbsp;<p align="center">
													<img class="imgshad1" border="0" style="opacity:.90;" src="user/logo/<?php  if( $flag==1)echo $row['cateimg'];?>" width="280" height="323"></td>
													<td valign="top">
													<table border="0" width="100%" id="table37" style="border-collapse: collapse">
														<tr>
															<td height="34">&nbsp;</td>
														</tr>
														
 	
			
														<tr>
															<td>
															<div align="center">
															<table border="0" width="80%" id="table38" cellpadding="0" style="border-collapse: collapse">
														
												<?php 
											 $st="Select * from eweblink where cateid=".$_GET["id"] ;
											 		 $result=mysql_query($st,$con);
											while ($row=mysql_fetch_array($result))
												{
												?><tr>
																						
														<td height="33" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#D2D2D2">
																												
														<a  class="big" href="http://<?php echo $row['wlink']; ?>" target="_blank" ><?php echo $row["wname"];?> </a> <br>
														 
														 <font size="2">Website : <a  class="a1" href="http://<?php echo $row['wlink']; ?>" target="_blank" ><?php echo $row['wlink']; ?></a>    &nbsp; &nbsp;   Contact No : <?php echo $row['mobile']; ?>
															
																											 
														 </font>
															
																											 
														 </td>	
														 
															</tr>	
														<?php
															}
															
															?>
															
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
									<div align="center">
										
									
									
									
									
									
								
										
										<table border="0" width="98%" id="table34" cellspacing="1" style="border-collapse: collapse">
										<tr>
											<td>
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
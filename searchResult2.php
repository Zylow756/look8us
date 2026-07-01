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
<title>Online Directory Service</title>
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
					<td><font size="6">&nbsp;</font><font color="#333333" size="5">Search 
					Result</font></td>
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
							<table border="0" width="100%" id="table10" cellpadding="0" style="border-collapse: collapse" height="384" >
								<tr>
									
									<td align="right" valign="top">
									<p align="left" class="p1" style="text-align: justify">
									<p align="left" class="p1">&nbsp;</p>
									<table border="0" width="96%" id="table34" style="border-collapse: collapse">
											<tr>
												<td><form action="searchResult2.php" method="get">
					
					<br>	<?php						

if (isset($_GET["item"]))
{

?>

	<table   width="96%" id="table5" border="0"    >
								<tr>
									<td bgcolor="#0066FF" width="99%" style="text-align: left" colspan="2" height="35">
									<b><font size="2" color="#000000">&nbsp;</font><font size="2" color="#FFFFFF"> </font>
									<font size="2" color="#FFFF00">Search 
									Company Search for :</font><font size="2" color="#FFFFFF">
									
		<?php
									
	echo $_GET["item"];
	
	?>
	

									
									</font></b></td>
								</tr>
			<?php						

if ($_GET["item"]=="Enter your search Product or Company")
{
if ($_GET["loc"]<>"Location")
	$st="Select * from member where city like '".$_GET["loc"] ."%' order by RAND()  limit 15 ";
else
    $st="Select * from member order by RAND()  limit 15";

}
else
{
if ($_GET["loc"]<>"Location")
	$st="Select * from member where ( mname like '".$_GET["item"]."%'|| compname like '%".$_GET["item"]."%' ) and city like '".$_GET["loc"] ."%' order by rating,RAND() limit 15";
else
    $st="Select * from member where  mname like '".$_GET["item"]."%'|| compname like '%".$_GET["item"]."%'  order by rating, RAND() limit 15";
    
}

	//$st="Select * from category,catedetail where category.cateid=catedetail.cateid and cdname like '%".$_POST["item"]."%' and  order by cdname";

//echo $st;
$i=1;
$result=mysql_query($st,$con);

	while ($row=mysql_fetch_array($result))
	{	
	
	?>
				
								<tr>
									<td height="29" width="4%" style="text-align: center; border-left-width:1px; border-right-width:1px; border-top-width:1px; " bordercolor="#E3E3E3">&nbsp;<?php //echo $i; ?></td>
									<td height="29" width="95%" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; " bordercolor="#E3E3E3">
									
	
				
									
									<table class="table1" border="0" width="100%" id="table35" style="border-collapse: collapse" bordercolor="#E3E3E3" cellpadding="0">
										<tr>
											<td >
											<table border="0" width="100%" id="table36" style="border-collapse: collapse" height="100">
												<tr>
												<?php 
										if (($row['mplan']=="Gold") ||($row['mplan']=="Platinum"))
										{
										?>
	
			<?php
			if ($row['logo']<>"-")
			{
			?>			<td width="107" align="center" height="107">
	
<a href="http://<?php  echo $row['web'] ; ?>" target="_blank" class="a5">
	<img  src="user/logo/<?php  echo $row['logo'] ; ?>" width="89" height="84"></a>
		
	</td>
	<?php
			}
			?>
	<?php
	}
	?>
													<td width="460"><b>
													<font size="4" color="#003399"><?php echo $row["compname"] ; ?>
											</font></b>
											<p style="line-height: 20px; margin-left:2px; margin-top:4px">
											<font size="4" color="#003399">Contact : <?php echo ucwords($row["mname"]) ; ?>
											</font>
											<br>
											<b> 
											<font size="2" color="#CC3300">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											<u><?php if(($row["tagline"]<>"-") &&($row["tagline"]<>"") ) echo $row['tagline'];  ?>											
											</u>											
											</font></b>
											
											</td>
													<td valign="top">
													&nbsp;</td>
												</tr>
											</table>
											</td>
										</tr>
										
										<tr>
											<td height="25">
											<table border="0" width="100%" id="table39" style="border-collapse: collapse" height="200">
												<tr>
													
											<?php 
										if (($row['mplan']=="Gold") ||($row['mplan']=="Platinum"))
										{
											$st="Select * from memberimage where mid=".$row["mid"];
											$result2=mysql_query($st,$con);
										?>
		
													<td width="204" align="center" rowspan="2" valign="top">
<table border="1" class="tbBG" width="190" id="table42" height="180" style="border-collapse: collapse" bordercolor="#E2E2E2" background="<?php if ($row2=mysql_fetch_array($result2)){ echo 'user/logo/'.$row2['img'] ; } else {echo 'user/logo/no-images.jpg' ; } ?>" >
														<tr>
															<td align="center">
															

	<a href="clientSlide.php?id=<?php  echo $row['mid'] ; ?>" ><img class="imgshad" border="0" src="images/transp.png" width="190" height="176"></a>
	


														
															
															</td>
														</tr>
													</table>
													</td>
													
													<?php
													}
													?>
													
													<td width="363" valign="top" rowspan="2">
													<table border="0" width="100%" id="table40" cellspacing="1" style="border-collapse: collapse">
														<tr>
											<td height="25" width="56%" colspan="2"><table border="0" width="100%" id="table44" style="border-collapse: collapse">
												<tr>
													<td width="78"   valign="top" >
													&nbsp;<font size="2" color="#121212"><b>Address&nbsp; :&nbsp;
													</b></font>
													</td>
													<td valign="top">
													<p style="line-height: 25px"><font size="2" color="#121212">
													<?php if(($row["shopno"]<>"-")&&($row["shopno"]<>"")) echo ucwords($row["shopno"])."," ; ?>
													 <?php if(($row["address"]<>"-")&&($row["address"]<>"")) echo ucwords($row["address"]) ; ?></font>
													</td>
												</tr>
												<tr>
													<td width="78"  height="6" valign="top" >
													<p style="line-height: 25px">
													<font size="2" color="#121212">
													<b>&nbsp;Area&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
													: </b></font></td>
													<td valign="top"><p style="line-height: 25px">
													<font size="2" color="#121212"><?php if(($row["area"]<>"-") &&($row["area"]<>"") ) echo ucwords($row["area"]).","  ; ?> 
											
											
</font></td>
												</tr>
												<tr>
													<td width="78"  height="6" valign="top" >
													<p style="line-height: 25px">&nbsp;<font size="2" color="#121212"><b>City/State:</b></font></td>
													<td valign="top"><p style="line-height: 25px"><font size="2" color="#121212"><?php echo ucwords($row["city"]) ; ?> <?php  if ($row["pin"]<>"-") echo "-".$row["pin"];  ?>,
											<?php echo ucwords($row["state1"]) ; ?></font>
													</td>
												</tr>
											</table>





</td>
														</tr>
														<tr>
											<td height="13" width="21%">
											<p style="line-height: 25px"><font color="#121212">
											&nbsp;<b><font size="2"> Phone&nbsp;&nbsp;&nbsp;&nbsp; : </font></b></font>



</td>
											<td height="13" width="77%">
											<font size="2" color="#121212"><?php echo $row["phone"] ; ?>
										<?php if ($row["phone1"]<>"-") echo " , " .$row["phone1"] ; ?>
											
											</font></td>
														</tr>
														<tr>
											<td height="12" width="21%">
											<p style="line-height: 25px">&nbsp;<font size="2" color="#121212"><b> Mobile&nbsp;&nbsp;&nbsp; :</b></font> </b>



</td>
											<td height="12" width="77%">
												<font size="2" color="#121212"> 
<?php echo $row["mobile"] ; ?>
											<?php if ($row["mobile1"]<>"-") echo " , " .$row["mobile1"] ; ?></font>
											</td>
														</tr>
														<tr>
											<td height="25" width="56%" colspan="2">  
											&nbsp; <font color="#121212"><b><font size="2"> 
											Email&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;: </font></b></font><font size="2" color="#121212"> 
											&nbsp;<?php echo $row["email"] ; ?> 
											


											</font>



											</td>
														</tr>
														<tr>
											<td height="25" width="56%" colspan="2">  
											<font color="#121212" size="2"><b>&nbsp; 
											Website&nbsp; : </b> 
											&nbsp;
					<a href="http://<?php  echo $row['web'] ; ?>" target="_blank" class="a5">
<?php echo $row["web"] ; ?> </a>



											</font> 



											</td>
														</tr>
														<?php 
										if (($row['mplan']=="Gold") ||($row['mplan']=="Platinum"))
										{
										?>
										<tr>
											<td height="35" width="100%" colspan="2" >
											<table border="0" width="100%" id="table41" cellpadding="0" style="border-collapse: collapse" bordercolor="#0033CC" height="31">
												<tr>
													<td width="76">
													<font color="#121212" size="2">
													<b>
											&nbsp;
											Follow&nbsp;&nbsp;&nbsp; :&nbsp; </b></font></td>
													<td width="256" valign="bottom">
													&nbsp;

	<?php if ($row['twiter']<>"-") { ?>		<a  target="_blank" href="http://<?php  echo $row['twiter'] ; ?>"><img border="0" src="<?php echo $path; ?>images/twitter-icon.png" width="25" height="25"></a>    <?php } ?>
	<?php if ($row['facebook']<>"-") { ?>		<a  target="_blank" href="http://<?php  echo $row['facebook'] ; ?>"> <img border="0" src="<?php echo $path; ?>images/facebook-icon.png" width="25" height="25"></a>  <?php } ?>
	<?php if ($row['linken']<>"-") { ?>		<a  target="_blank" href="http://<?php  echo $row['linken'] ; ?>"> 	<img border="0" src="<?php echo $path; ?>images/linkedin-icon.png" width="25" height="25"></a>   <?php } ?>
	<?php if ($row['ytube']<>"-") { ?>		<a href="http://<?php  echo $row['ytube'] ; ?>"> <img border="0" src="<?php echo $path; ?>images/uTube.png" width="25" height="25"></a>  <?php } ?>
									
									</td>

													<td>
													&nbsp;
									</td>

												</tr>
											</table>

											</td>
										</tr>
										
											<?php
										}
										?>		</table>
													</td>
													<td height="122" valign="top">
										<?php 
										if ($row["remark"]<>"-")
										{
										?>

										
											<p style="margin-left: 5px; margin-right: 10px; line-height:25px; text-align:justify; margin-top:5px; margin-bottom:5px">
											<font size="2" color="#000000"><b>
											About Us :</b>&nbsp;&nbsp; <?php echo $row["remark"] ; ?>
											&nbsp;</font>
											<?php
										}
										?></td>												</tr>
												<tr>
													
													<td height="78" valign="top">
										<div align="center">
													<table border="0" width="90%" id="table43" style="border-collapse: collapse" bordercolor="#F4F4F4">
														<tr>
															<td>&nbsp;<font color="#121212" size="2"><b><?php if ($row['a']<>"-") { ?>Rating :&nbsp;<?php  echo $row['a'] ; } ?> </b></font></td>
															<td width="136">&nbsp;
													<?php if ($row['verify'] == "Verified") { ?>  
															<img border="0" src="images/VerifiedLogo.jpg"> <?php } ?></td>
														</tr>
													</table>
												</div>
											</td>												</tr>
											</table>




</td>
										</tr>
										
										
										
										
										
										
										<?php 
										if ($row['mplan']=="Platinum")
										{
										?>
										
										<tr>
											<td height="25">
								
										<a href="clientweb.php?id=<?php echo $row['mid']; ?> ">
											<img border="0" id="img1" src="images/button22.jpg" onmouseover="this.src='images/button23.jpg'" onmouseout="this.src='images/button22.jpg'"  height="26" width="166" alt="View more detail &gt;&gt;" >
											
											</a>			
											&nbsp;&nbsp;&nbsp;

																						</td>
										</tr>
										<?php
										}
										?>
										
										
									</table>
									<p>
									
									
	
				
									
									</td>
								</tr>
								<tr><td colspan="2" bgcolor="#E3E3E3" height="5"></td></tr>
								<?php
								$i=$i+1;

								}
								
								
								?>
							</table>
							
							
							<p align="center">
							
							
							<?php
							}
							
							?>
							
							
							<input   type="hidden" name="item" id="item" tabindex="4" value="<?php echo $_GET['item'] ;?>"  size="1"/>
							<input   type="hidden" name="loc" id="loc" value="<?php echo $_GET['loc'] ;?>" />
							
							<input  class="subbox11" type="submit" value="More" name="submit" style="float: center"/></p>
												</form>&nbsp;</td>
											</tr>
										</table></td>
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
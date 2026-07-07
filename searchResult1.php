<?php
require_once "config.php";

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
<title>Online Directory Service</title>

 <link rel="stylesheet" type="text/css" href="akc.css" />
 <link rel="stylesheet" href="css/backbox.css" type="text/css" />




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
												<td><form action="Search.php" method="get">
					
					<br>	<?php						

if (isset($_GET["id"]))
{

?>

	<table   width="96%" id="table5" border="0"    >
								<tr>
									<td bgcolor="#0066FF" width="99%" style="text-align: left" colspan="2" height="35">
									<b><font size="2" color="#000000">&nbsp;</font><font size="2" color="#FFFFFF"> </font>
									<font size="2" color="#FFFF00">Search 
									Results for :</font><font size="2" color="#FFFFFF">
									
		<?php
									
	$st="Select * from category,catedetail where category.cateid=catedetail.cateid and catdid= ".$_GET["id"];

$result2=mysqli_query($con,$st);
if (!$result2) {
    die(mysqli_error($con));
}

	if  ($row2=mysqli_fetch_assoc($result2)) 
	{
	 
	 echo htmlspecialchars($row2["cname"]); 
	 echo " >> ";
	 echo htmlspecialchars($row2["cdname"]);
	}
	
	?>
	

									
									</font></b></td>
								</tr>
			<?php						

	$st="Select * from member,memberdetail where member.mid=memberdetail.mid and catdid =".$_GET["id"]." order by rating,mname";

	//$st="Select * from category,catedetail where category.cateid=catedetail.cateid and cdname like '%".$_POST["item"]."%' and  order by cdname";

//echo $st;
$i=1;
$result=mysqli_query($con,$st);
if (!$result) {
    die(mysqli_error($con));
}

	while ($row=mysqli_fetch_assoc($result))
	{	
	
	?>
				
								<tr>
									<td height="29" width="4%" style="text-align: center; border-left-width:1px; border-right-width:1px; border-top-width:1px; " bordercolor="#E3E3E3">&nbsp;<?php //echo $i; ?></td>
									<td height="29" width="95%" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; " bordercolor="#E3E3E3">
									
	
				
									
									<table class="table1" border="0" width="100%" id="table35" style="border-collapse: collapse" bordercolor="#E3E3E3" cellpadding="0">
										<tr>
											<td >
											<table border="0" width="100%" id="table36" style="border-collapse: collapse" height="101">
												<tr>
												<?php 
										if (($row['mplan']=="Gold") ||($row['mplan']=="Platinum"))
										{
										?>
	
			<?php
			if ($row['logo']<>"-")
			{
			?>			<td width="107" align="center" height="101">
	
<a href="http://<?php  echo htmlspecialchars($row['web']) ; ?>" target="_blank" class="a5">
	<img  src="user/logo/<?php  echo htmlspecialchars($row['logo']) ; ?>" width="89" height="84"></a>
		
	</td>
	<?php
			}
			?>
	<?php
	}
	?>
													<td width="460"><b>
													<font size="4" color="#003399"><?php echo htmlspecialchars($row["compname"]) ; ?>
											</font></b>
											<p style="line-height: 20px; margin-left:2px; margin-top:4px">
											<font size="4" color="#003399">Contact : <?php echo htmlspecialchars(ucwords($row["mname"])) ; ?>
											</font>
											<br>
											<b> 
											<font size="2" color="#CC3300">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											<u><?php if(($row["tagline"]<>"-") &&($row["tagline"]<>"") ) echo htmlspecialchars($row['tagline']);  ?>											
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
											$result2=mysqli_query($con,$st);
if (!$result2) {
    die(mysqli_error($con));
}
										?>
		
													<td width="204" align="center" rowspan="2" valign="top">
<table border="1" width="190" class="tbBG" id="table42" height="180" style="border-collapse: collapse" bordercolor="#E2E2E2" background="<?php if ($row2=mysqli_fetch_assoc($result2)){ echo 'user/logo/'.$row2['img'] ; } else {echo 'user/logo/no-images.jpg' ; } ?>" >
														<tr>
															<td align="center">
															

	
	
<a href="clientSlide.php?id=<?php  echo htmlspecialchars($row['mid']) ; ?>" ><img class="imgshad" border="0" src="images/transp.png" width="190" height="176"></a>

														
															
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
											<td height="25" width="56%"><table border="0" width="100%" id="table44" style="border-collapse: collapse">
												<tr>
													<td width="75"  height="6" valign="top" >
													<p style="line-height: 25px">&nbsp;<font size="2" color="#121212"><b>Address&nbsp; :&nbsp;
													</b></font>
													</td>
													<td valign="top">
													<p style="line-height: 25px"><font size="2" color="#121212">
													<?php if(($row["shopno"]<>"-")&&($row["shopno"]<>"")) echo ucwords($row["shopno"])."," ; ?>
													 <?php if(($row["address"]<>"-")&&($row["address"]<>"")) echo ucwords($row["address"]) ; ?></font>
													</td>
												</tr>
												<tr>
													<td width="75"  height="6" valign="top" >
													<p style="line-height: 25px">
													<font size="2" color="#121212">
													<b>&nbsp;Area&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
													: </b></font></td>
													<td valign="top"><p style="line-height: 25px">
													<font size="2" color="#121212"><?php if(($row["area"]<>"-") &&($row["area"]<>"") ) echo ucwords($row["area"]).","  ; ?> 
											
											</font></td>
												</tr>
												<tr>
													<td width="75"  height="6" valign="top" >
													<p style="line-height: 25px">&nbsp;<font size="2" color="#121212"><b>City/State:</b></font></td>
													<td valign="top"><p style="line-height: 25px">
<font size="2" color="#121212">
													<?php echo ucwords($row["city"]) ; ?> <?php  if ($row["pin"]<>"-") echo "-".$row["pin"];  ?>,
											<?php echo ucwords($row["state1"]) ; ?></font>
													</td>
												</tr>
											</table>




</td>
														</tr>
														<tr>
											<td height="25" width="56%">
											<p style="line-height: 25px"><font color="#121212">
											&nbsp;<b><font size="2"> 
											Phone &nbsp;&nbsp;&nbsp; 
											: </font></b></font><font size="2" color="#121212"> 
											&nbsp;<?php echo htmlspecialchars($row["phone"]) ; ?>
										<?php if ($row["phone1"]<>"-") echo " , " .htmlspecialchars($row["phone1"]) ; ?>
											
											<br>
&nbsp; <b>Mobile &nbsp;&nbsp; : </b>	&nbsp;<?php echo htmlspecialchars($row["mobile"]) ; ?>
											<?php if ($row["mobile1"]<>"-") echo " , " .htmlspecialchars($row["mobile1"]) ; ?>
											</font>



</td>
														</tr>
														<tr>
											<td height="25" width="56%">  
											&nbsp; <font color="#121212"><b><font size="2"> 
											Email&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
											: </font></b></font><font size="2" color="#121212"> 
											&nbsp;<?php echo htmlspecialchars($row["email"]) ; ?> 
											


											</font>



											</td>
														</tr>
														<tr>
											<td height="25" width="56%">  
											<font color="#121212" size="2"><b>&nbsp; 
											Website&nbsp;&nbsp;: </b> 
											&nbsp;
					<a href="http://<?php  echo htmlspecialchars($row['web']) ; ?>" target="_blank" class="a5">
<?php echo htmlspecialchars($row["web"]) ; ?> </a>



											</font> 



											</td>
														</tr>
														<?php 
										if (($row['mplan']=="Gold") ||($row['mplan']=="Platinum"))
										{
										?>
										<tr>
											<td height="35" width="100%" >
											<table border="0" width="100%" id="table41" cellpadding="0" style="border-collapse: collapse" bordercolor="#0033CC" height="31">
												<tr>
													<td width="76">
													<font color="#121212" size="2">
													<b>
											&nbsp;
											Follow&nbsp;&nbsp;&nbsp; :&nbsp; </b></font></td>
													<td width="256" valign="bottom">
													&nbsp;

	<?php if ($row['twiter']<>"-") { ?>		<a  target="_blank" href="http://<?php  echo htmlspecialchars($row['twiter']) ; ?>"><img border="0" src="<?php echo $path; ?>images/twitter-icon.png" width="25" height="25"></a>    <?php } ?>
	<?php if ($row['facebook']<>"-") { ?>		<a  target="_blank" href="http://<?php  echo htmlspecialchars($row['facebook']) ; ?>"> <img border="0" src="<?php echo $path; ?>images/facebook-icon.png" width="25" height="25"></a>  <?php } ?>
	<?php if ($row['linken']<>"-") { ?>		<a  target="_blank" href="http://<?php  echo htmlspecialchars($row['linken']) ; ?>"> 	<img border="0" src="<?php echo $path; ?>images/linkedin-icon.png" width="25" height="25"></a>   <?php } ?>
	<?php if ($row['ytube']<>"-") { ?>		<a href="http://<?php  echo htmlspecialchars($row['ytube']) ; ?>"> <img border="0" src="<?php echo $path; ?>images/uTube.png" width="25" height="25"></a>  <?php } ?>
									
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
											About Us :</b>&nbsp;&nbsp; <?php echo htmlspecialchars($row["remark"]) ; ?>
											&nbsp;</font>
											<?php
										}
										?></td>												</tr>
												<tr>
													
													<td height="78" valign="top">
										<div align="center">
													<table border="0" width="90%" id="table43" style="border-collapse: collapse" bordercolor="#F4F4F4">
														<tr>
															<td>&nbsp;<font color="#121212" size="2"><b><?php if ($row['a']<>"-") { ?>Rating :&nbsp;<?php  echo htmlspecialchars($row['a']) ; } ?> </b></font></td>
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
											<a href="clientweb.php?id=<?php echo htmlspecialchars($row['mid']); ?> ">
											<img border="0" id="img1" src="images/button22.jpg" onmouseover="this.src='images/button23.jpg'" onmouseout="this.src='images/button22.jpg'"  height="26" width="166" alt="View more detail &gt;&gt;" >
											
											</a></td>
										</tr>
										<?php
										}
										?>
										
										
									</table>
									</td>
								</tr>
								<tr><td colspan="2" height="7"></td></tr>
								<tr><td colspan="2" bgcolor="#E3E3E3" height="5"></td></tr>
								<?php
								$i=$i+1;

								}
								
								
								?>
							</table>
							
							
							<?php
							}
							
							?>
							
							</form></td>
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
	<?php require_once "footer.php"; ?>
</div>
<script type="text/javascript" src="js/customsignsfooter.js"></script>

</body>

</html>
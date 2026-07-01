<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">

<title>Look8US :Business Directory Kota, Rajasthan , India, Online Business Directory Kota,  Yellow Pages  kota Rajasthan , Trusted & Verified Businesses, Exporters, Manufacturers, Suppliers Directory, B2B Business Directory </title>
<meta name="description" content="Look8us.com from Kota Rajasthan is Your local Business Directory , yellow pages  Business Directory. Business Details, Contacts, Products, Services & Verified Businesses, Exporters, Manufacturers, Suppliers Directory">
<meta name="keywords" content=" Look8us.com , yellow pages Kota Rajasthan , business directory Kota Rajasthan india,business search engine, indian business directory, online business directory, Indian manufacturers, suppliers, Indian exporters directory, b2b portal, b2b business directory,manufacturer, importers, traders, dealers, buyers,Best english spoken institute in kota ">


<link rel="stylesheet" type="text/css" href="akc.css" />

<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/form.css" />


		
		
</head>

<?php include("config.php"); 


$msg=0;

	if (isset($_POST["submit"]))
		{
		
		$st="insert into feedback values (NULL ,'". $_POST["city"]."','".$_POST["mname"]."','".$_POST["mobile"]."','".$_POST["txtmail"]."','".$_POST["remark"]."','".date("d-m-Y")."')";
		mysql_query($st,$con);
		//echo $st;
		$msg=1;
			
		}
?>

<body topmargin="0" leftmargin="0" rightmargin="0" bottommargin="0">

<a class='inline' href="#inline_content"></a>


<table border="0" width="100%" id="table1" style="border-collapse: collapse" bordercolor="#C0C0C0" cellpadding="0">
	<tr>
		<td height="20" bgcolor="#E2E2E2"><?php  include("header.php"); ?></td>
	</tr>
	<tr>
		<td align="center" valign="top">
		<table border="0" width="1010" id="table2" cellpadding="0" style="border-collapse: collapse" height="450">
			<tr>
				<td align="center" valign="top" style="border-top-width: 1px; border-bottom-width: 1px" bordercolor="#FFFFFF">
				<table border="0" width="100%" id="table3" style="border-collapse: collapse">
					<tr>
						<td width="23%" valign="top" height="23">&nbsp;</td>
						<td valign="top" height="23" width="49%">&nbsp;</td>
						<td width="28%" valign="top" height="23">&nbsp;</td>
					</tr>
					<tr>
						<td width="23%" valign="top" height="23">&nbsp;</td>
						<td valign="top" height="23" width="49%" align="center">
						<img border="0" src="logo.jpg"></td>
						<td width="28%" valign="top" height="23">&nbsp;</td>
					</tr>
					<tr>
						<td width="23%" valign="top" height="24">&nbsp;</td>
						<td valign="top" height="24" width="49%">&nbsp;</td>
						<td width="28%" valign="top" height="24">&nbsp;</td>
					</tr>
					<tr>
						<td width="100%" valign="top" height="24" colspan="3">
						<div align="center">
						<form method="post" action="searchResult.php">
							<table border="0" width="90%" id="table20" cellpadding="0" style="border-collapse: collapse">
								<tr>
									<td width="596" align="right" height="50">
	<input  class="txtsea" type="text" name="item" id="item" tabindex="4" value="Enter your search Product or Company" onfocus="if(this.value=='Enter your search Product or Company'){this.value='';}" onblur="if(this.value==''){this.value='Enter your search Product or Company';}" size="1"/> </td>
									<td width="161" align="left">
	&nbsp;<input  class="txtloc" type="text" name="loc" id="loc" tabindex="4" value="Location" onfocus="if(this.value=='Location'){this.value='';}" onblur="if(this.value==''){this.value='Location';}" size="18"/></td>
									<td align="left">
	<input  class="subsea" type="submit" value="Go" name="submit0"/></td>
								</tr>
								
								<tr><td align="right">
								<table border="0" width="50%" id="table25" cellspacing="1" style="border-collapse: collapse">
									<tr>
										<td>&nbsp;</td>
										<td width="321">Categories<input type="radio" name="sea" value="0"  checked><font size="2">&nbsp; </font>
										Company<input type="radio" name="sea" value="1"  ><font size="2">
										</font></td>
									</tr>
								</table>
								</td><td></td>
									<td></td></tr>
							</table>
							</form>
						</div>
						</td>
					</tr>
					<tr>
						<td width="23%" valign="top" height="22">&nbsp;</td>
						<td valign="top" height="22" width="49%" align="center"><?php if ($msg==1) echo "<h5>Your Message Send Successfully.</h5>"; ?></td>
						<td width="28%" valign="top" height="22">&nbsp;</td>
					</tr>
					<tr>
						<td width="23%" valign="top" height="22">&nbsp;</td>
						<td valign="top" height="22" width="49%">&nbsp;</td>
						<td width="28%" valign="top" height="22">&nbsp;</td>
					</tr>
					<tr>
						<td width="24%" valign="top" height="390" bgcolor="#FFFFFF" rowspan="2">
						<div align="left">
							<table class="shadow1" border="0" width="100%" id="table12" cellspacing="1" style="border-collapse: collapse" height="333">
								<tr>
									<td bgcolor="#3399FF" height="40" align="center">
									<font color="#FFFFFF"><b>&nbsp;Popular 
									Category</b></font></td>
								</tr>
								<tr>
									<td valign="top">
									

 <div align="center" style="overflow: auto; height: 500px; width: 100%;" >
									
 	<table border="0" width="100%" id="table17" cellpadding="0" style="border-collapse: collapse" height="29"> 
									
<?php						


$st="Select * from category where cstatus=1 order by cname";
	$i=1;
	$result=mysql_query($st,$con);

	while ( ($row=mysql_fetch_array($result)) && ($i<=50))
	{	
?>
		
	<tr>
		
			<td width="5" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: solid; border-bottom-width: 1px" bordercolor="#E3E3E3" bgcolor="#F4F4F4"></td>	
					
					<td style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: solid; border-bottom-width: 1px" bordercolor="#E3E3E3" height="30" bgcolor="#F4F4F4">
											<font size="2" color="#000000">										
													<?php
															
														echo "<a class='a1' href='searchresult.php?id=".$row['cateid']."'>".$row["cname"]."</a>";	
														
														//	echo "<a href='#' class='a1' >".$row["cname"]."</a>";
	
																$i=$i+1;
															?>

											</font></td>
											
							<td width="5" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: solid; border-bottom-width: 1px" bordercolor="#E3E3E3" bgcolor="#F4F4F4"></td>								
										</tr>
										
										<?php
													}
													?>
													

										</table>
										
										</div>
									</td>
								</tr>
							</table>
						</div>
						</td>
						<td valign="top" height="340" width="50%">
						<div align="center">
							<table class="shadow1" border="1" width="97%" id="table8" style="border-collapse: collapse" height="335" bordercolor="#F4F4F4">
								<tr>
									<td height="40" bgcolor="#E3E3E3">
									<font color="#000000">&nbsp;<b>Category in 
									details </b></font></td>
								</tr>
								<tr>
									<td valign="top">
									<div align="right">
									
		<?php						

//$st="Select * from category order by cname";

$st="Select distinct(cdname) cdname,catdid from catedetail where cdstatus=1 order by cdname limit 185";
//$st="Select distinct(cdname) cdname,catdid from catedetail where cdstatus=1 order by cdname";


//echo $st;
$i=1;
$result=mysql_query($st,$con);

$num_rows = mysql_num_rows($result);

$rno=round($num_rows/3);

$rn=40;

//echo $num_rows;
//echo $rno;
?>	


		 <div align="center" style="overflow: auto; height: 500px; width: 100%;" >

	<table  border="0" width="98%" id="table18" cellpadding="0" style="border-collapse: collapse">
											
										<tr>
										<td colspan="5" height="7" ></td>
										
										</tr>	
											<tr>
												<td width="33%" height="280" valign="top">  
												
												 <table class="table1" border="0" width="100%" id="table19" style="border-collapse: collapse" cellpadding="0">
													
	<?php
	$i=1;
	while ( ($i<$rn)&&($i<$rno)&&($row=mysql_fetch_array($result)))
	{	
?>
												
	<tr>
														<td height="25">
														<?php
															
															echo "<a class='a5' href='searchresult1.php?id=".$row['catdid']."'>".$row["cdname"]."</a>"; 

															//echo "<a href='#' class='a5' >".$row["cdname"]."</a>";
	
																$i=$i+1;
															?>
	
	</td>
													</tr>
													
													<?php
													}
													?>
													
													</table>
												
												 </td>
												<td width="1" height="25" valign="top" bgcolor="#F4F4F4"></td>
												<td width="33%" height="25" valign="top">
												
												<table class="table1" border="0" width="100%" id="table19" style="border-collapse: collapse" cellpadding="0" height="25">
													
	<?php
	$i=1;
	while ( ($i<$rn)&&($i<$rno)&&($row=mysql_fetch_array($result)))
	{	
?>
												
	<tr>
														<td height="25">
														<?php
														
														echo "<a class='a5' href='searchresult1.php?id=".$row['catdid']."'>".$row["cdname"]."</a>";
														//	echo "<a href='#' class='a5' >".$row["cdname"]."</a>";
	
																$i=$i+1;
															?>
	
	</td>
													</tr>
													
													<?php
													}
													?>
													
													</table>
												
												</td>
												<td width="1" height="25" valign="top" bgcolor="#F4F4F4"></td>
												<td height="25" valign="top" width="33%">
												
												<table class="table1" border="0" width="100%" id="table19" style="border-collapse: collapse" cellpadding="0">
													
	<?php
	$i=1;
	while ( ($i<$rn)&&($i<$rno)&&($row=mysql_fetch_array($result)))
	{	
?>
												
	<tr>
														<td height="25">
														<?php

															echo "<a class='a5' href='searchresult1.php?id=".$row['catdid']."'>".$row["cdname"]."</a>";
															//echo "<a href='#' class='a5' >".$row["cdname"]."</a>";
	
																$i=$i+1;
															?>
	
	</td>
													</tr>
													
													<?php
													}
													?>
													
													
													<tr><td bgcolor="#005888" height="22"> &nbsp;&nbsp; <a  href="index-subcate.php" class="a4" >more category >> </a> </td></tr>
													</table>
												
												</td>
												
											</tr>
											
											
											
										</table>
									</div>
									</div>
									</td>
								</tr>
								</table>
						</div>
						</td>
						<td width="26%" valign="top" height="340" bgcolor="#F4F4F4">
						<div align="right">
							<table class="shadow1" border="0" width="100%" id="table4" cellpadding="0" style="border-collapse: collapse" height="298" bordercolor="#E3E3E3">
								<tr>
									<td height="40" bgcolor="#0099FF" align="center">
									<font color="#000000"><b>&nbsp;Feedback 
									&amp; Enquiry</b></font></td>
								</tr>
								<tr>
									<td valign="top">
									<form METHOD="post" action="home.php">
									<table border="0" width="100%" id="table11" height="244" cellspacing="1" style="border-collapse: collapse">
										<tr>
											<td width="23%">
											<font size="2" color="#333333">&nbsp;City</font></td>
											<td width="75%">
	<input  class="txtbox" type="text" name="city" id="city"  value="<?php if (isset($_POST['city'])) echo $_POST['city']; else echo 'City';  ?>" onfocus="if(this.value=='City'){this.value='';}" onblur="if(this.value==''){this.value='City';}" size="1"/></td>
										</tr>
										<tr>
											<td width="23%">
											<font size="2" color="#333333">&nbsp;Name</font></td>
											<td width="75%">
	<input class="txtbox" type="text" name="mname" id="mname"  value="<?php if (isset($_POST['mname'])) echo $_POST['mname']; else echo 'Member Name';  ?>" onfocus="if(this.value=='Member Name'){this.value='';}" onblur="if(this.value==''){this.value='Member Name';}" size="1"/></td>
										</tr>
										<tr>
											<td width="23%">
											<font size="2" color="#333333">&nbsp;Mobile</font></td>
											<td width="75%">
	<input  class="txtbox" type="text" name="mobile" id="mobile" value="<?php if (isset($_POST['mobile'])) echo $_POST['mobile'];  else echo 'Mobile';  ?>" onfocus="if(this.value=='Mobile'){this.value='';}" onblur="if(this.value==''){this.value='Mobile';}"  size="1"/></td>
										</tr>
										<tr>
											<td width="23%">
											<font size="2" color="#333333">&nbsp;Email
											</font></td>
											<td width="75%">
	<input class="txtbox" type="text" name="txtmail" id="txttmail" value="<?php if (isset($_POST['txtmail'])) echo $_POST['txtmail'];   else echo 'Email ID';  ?>" onfocus="if(this.value=='Email ID'){this.value='';}" onblur="if(this.value==''){this.value='Email ID';}"  /></td>
										</tr>
										<tr>
											<td width="23%">
											<font color="#666666" size="2">&nbsp;</font><font color="#333333" size="2">Message</font></td>
											<td width="75%">
	<input  class="txtbox" type="text" name="remark" id="remark"  value="<?php if (isset($_POST['remark'])) echo $_POST['remark'];  ?>"  size="1"/></td>
										</tr>
										<tr>
											<td colspan="2" align="center">
	<input  class="subbox" type="submit" value="Submit" name="submit"/></td>
										</tr>
									</table></form>
									</td>
								</tr>
							</table>
						</div>
						</td>
					</tr>
					
					
					
					<tr>
					
						<td valign="top" colspan="2" align="right" >&nbsp;</td>

</tr>						
					<tr>
						<td width="100%" valign="top" colspan="3">
						<table class="shadow1" border="0" width="100%" id="table26" style="border-collapse: collapse" height="246">
							
							<tr>
								<td bgcolor="#003366" height="40"><b>
								<font size="4" color="#FFFFFF">&nbsp;Verified 
								Business &amp; Services </font></b></td>
							</tr>
							<tr>
								<td valign="top">
								<table border="0" width="100%" id="table27" height="240" cellspacing="0" cellpadding="0" style="border-collapse: collapse" bordercolor="#E3E3E3">
									<tr>
										<td  align="left" height="240">
							

<?php
 $st="Select * from advert where astatus='H' order by aname";
 $result=mysql_query($st,$con);
 
 $num_rows = mysql_num_rows($result);
 
 $i=1;						

?>

<?php
if( $num_rows>0) 
{
?>
	<table border="0" width="100%" id="table29" cellpadding="0" style="border-collapse: collapse" bordercolor="#E3E3E3">
	<tr>
		<td height="6" ></td>
	</tr>
</table><table border="0"  id="table28" style="border-collapse: collapse" bordercolor="#E0E2FE" bgcolor="#FFFFFF" cellpadding="0" height="180">
								<tr>
									
									

  
	<?php 
		
		while (($i<6)&&($row=mysql_fetch_array($result)))
			{
			if ($row['img']<>"-")
			{
			?>

<td align="center" width="200">
<a href="http://<?php  echo $row['website'] ; ?>" target="_blank" class="a5">
	<img border="1" src="user/logo/<?php  echo $row['img'] ; ?>" width="180" height="145"> <?php  echo $row['aname'] ; ?>
	</a>

    </td>
    
    <?php
    $i=$i+1;
    
    }
    }
    ?>



								</tr>
								
								
								
							</table>
			
<table border="0" width="100%" id="table29" cellpadding="0" style="border-collapse: collapse" bordercolor="#E3E3E3">
	<tr>
		<td height="6" bgcolor="#E3E3E3"></td>
	</tr>
</table>
<?php 
			}
			
			
			$i=1; 
			
			if( $num_rows>5) 
{

			?>				
							</p>
							<table border="0"  id="table28" style="border-collapse: collapse" bordercolor="#E0E2FE" bgcolor="#FFFFFF" cellpadding="0" height="180">
								<tr>
									
									

  
	<?php 
		
		while (($i<6)&&($row=mysql_fetch_array($result)) )
			{
			if ($row['img']<>"-")
			{
			?>

<td align="center"  width="200">
<a href="http://<?php  echo $row['website'] ; ?>" target="_blank" class="a5">
	<img border="1" src="user/logo/<?php  echo $row['img'] ; ?>" width="180" height="145"> <?php  echo $row['aname'] ; ?>
	</a>

    </td>
    
    <?php
    $i=$i+1;
    
    }
    }
    ?>



								</tr>
								
								
								
							</table>
							
							<table border="0" width="100%" id="table29" cellpadding="0" style="border-collapse: collapse" bordercolor="#E3E3E3">
	<tr>
		<td height="6" bgcolor="#E3E3E3"></td>
	</tr>
</table>
							
							<?php
							
}

 $i=1;
 
if( $num_rows>10) 
{
 ?>
							
							<table border="0"  id="table28" style="border-collapse: collapse" bordercolor="#E0E2FE" bgcolor="#FFFFFF" cellpadding="0" height="180">
								<tr>
									
									

  
	<?php 
		
		while (($i<6)&&($row=mysql_fetch_array($result)) )
			{
			if ($row['img']<>"-")
			{
			?>

<td align="center"  width="200">
<a href="http://<?php  echo $row['website'] ; ?>" target="_blank" class="a5">
	<img border="1" src="user/logo/<?php  echo $row['img'] ; ?>" width="180" height="145"> <?php  echo $row['aname'] ; ?>
	</a>

    </td>
    
    <?php
    $i=$i+1;
    
    }
    }
    ?>



								</tr>
								
								
								
							</table>
							
							<?php
							}
							?>
							
							</td>
									</tr>
								</table>
								</td>
							</tr>
						</table>
						</td>
					</tr>
					
					<tr>
						<td width="99%" valign="top" colspan="3">
						&nbsp;</td>
					</tr>
					
					<tr>
					<td colspan="3">&nbsp;</td>
					</tr>
					
					<tr>
					<td colspan="3">
					<table class="shadow5" border="0" width="100%" id="table16" style="border-collapse: collapse">
						<tr>
							<td height="37" align="left" bgcolor="#EFEFEF"><b>
							<font size="2" color="#071E43">&nbsp;Popular Finders</font></b></td>
							<td height="37" align="left" bgcolor="#DBDBDB"><b>
							<font size="2" color="#071E43">&nbsp;Popular Brands</font></b></td>
							<td height="37" align="left" bgcolor="#D2D2D2"><b>
							<font size="2" color="#071E43">&nbsp;Popular 
							Businesses</font></b></td>
							<td height="37" align="left" bgcolor="#BFBFBF"><b>
							<font size="2" color="#071E43">&nbsp;Popular 
							Searches</font></b></td>
							<td height="37" align="left" bgcolor="#AAAAAA"><b>
							<font size="2" color="#071E43">&nbsp;Popular 
							Branches/Stores</font></b></td>
						</tr>
						<tr>
							<td valign="top" height="172">
							<p style="margin-left: 5px; margin-top: 5px; margin-bottom: 5px">
							<font size="2" color="#0066FF">Bus Route Finder<br>
							Pin Code Finder<br>
							School Finder<br>
							Hotel Finder<br>
							Bank SWIFT Code Finder<br>
							Bank IFSC Code Finder<br>
							Railway station Finder</font></td>
							<td valign="top" height="172">
							<p style="margin-left: 5px; margin-top: 5px; margin-bottom: 5px">
							<font size="2" color="#0066FF">Symphony Air Cooler 
							Dealers<br>
							Onida AC<br>
							Hitachi AC<br>
							Spice Mobile Phone Dealers<br>
							Hero Cycles<br>
							Jet Airways Flight Booking<br>
							More brands &gt;<br>
&nbsp;</font></td>
							<td valign="top" height="172">
							<p style="margin-left: 5px; margin-top: 5px; margin-bottom: 5px">
							<font size="2" color="#0066FF">DTDC Courier &amp; Cargo 
							Ltd.<br>
							Tirupati Travels<br>
							Hotel City Home<br>
							First Flight Courier<br>
							Adarsh Kutir Udyog<br>
							Wipro Ltd.<br>
&nbsp;</font></td>
							<td valign="top" height="172">
							<p style="margin-left: 5px; margin-top: 5px; margin-bottom: 5px">
							<font size="2" color="#0066FF">Valentine Day Party 
							Snacks<br>
							Valentine Day Dinner<br>
							Valentine Flowers Wholesale<br>
							Valentine Candy Bouquet<br>
							Child Adoption<br>
							Birthday Party Restaurants<br>
&nbsp;</font></td>
							<td valign="top" height="172">
							<p style="margin-left: 5px; margin-top: 5px; margin-bottom: 5px">
							<font size="2" color="#0066FF">Union Bank of India 
							ATM<br>
							Thomas Cook<br>
							Fabindia<br>
							ICICI Prudential Life Insurance<br>
							Overnite Express Ltd.<br>
							Tata Motor Finance<br>
&nbsp;</font></td>
						</tr>
					</table>
					</td>
					</tr>
					
					<tr>
					<td colspan="3">&nbsp;</td>
					</tr>
					
					<tr>
					<td colspan="3">&nbsp;</td>
					</tr>
					
				</table>
				</td>
			</tr>
			
		</table>
		</td>
	</tr>
	<tr>
		<td bgcolor="#F5F5F5" height="20"><?php  include("footer.php"); ?></td>
	</tr>
</table>
<a href="<?php echo $path; ?>payment/subscribe.php" class="demoTest"></a>


<?php 
		 $st="Select * from homeimg order by aid desc";
		 		 $result=mysql_query($st,$con);
		 		 
		 		 $i=1;
		$ns = mysql_num_rows($result);



			?>
<div style='display:none'>
			<div id='inline_content' style='padding:10px; background:#fff;'>
			
			

			<table border="0" width="100%" id="table24" cellspacing="1" style="border-collapse: collapse" bordercolor="#E2E2E2">
				<tr>
					<td height="250" align="right" valign="top" width="49%">&nbsp;	
					
		
<?php

	if ($row=mysql_fetch_array($result))
			{
			if ($row['img']<>"-")
			{
			?>

<a href="http://<?php  echo $row['website'] ; ?>" target="_blank" class="a5">
	<img border="1" src="user/logo/<?php  echo $row['img'] ; ?>" width="250" height="250"></a>
<?php

}
}
?>
</td>
					<td height="250" align="center" valign="top" width="2%">&nbsp;
					</td>
					<td height="250" align="left" valign="top" width="49%">&nbsp;
					<?php

	if ($row=mysql_fetch_array($result))
			{
			if ($row['img']<>"-")
			{
			?>

<a href="http://<?php  echo $row['website'] ; ?>" target="_blank" class="a5">
	<img border="1" src="user/logo/<?php  echo $row['img'] ; ?>" width="250" height="250"></a>
<?php

}
}
?>
</td>
				</tr>
				<tr>
					<td height="10" align="center" valign="top" colspan="3" width="49%">
					</td>
				</tr>
		<?php
				
				if ($ns>=4)
			{
			?>
			
				<tr>
					<td height="250" align="right" valign="top" width="49%">&nbsp;
					<?php

	if ($row=mysql_fetch_array($result))
			{
			if ($row['img']<>"-")
			{
			?>

<a href="http://<?php  echo $row['website'] ; ?>" target="_blank" class="a5">
	<img border="1" src="user/logo/<?php  echo $row['img'] ; ?>" width="250" height="250"></a>
<?php

}
}
?>
</td>
					<td height="250" align="center" valign="top" width="2%">&nbsp;</td>
					<td height="250" align="left" valign="top" width="49%">&nbsp;<?php

	if ($row=mysql_fetch_array($result))
			{
			if ($row['img']<>"-")
			{
			?>

<a href="http://<?php  echo $row['website'] ; ?>" target="_blank" class="a5">
	<img border="1" src="user/logo/<?php  echo $row['img'] ; ?>" width="250" height="250"></a>
<?php

}
}
?></td>
				</tr>
					<?php
		}
		?>
			</table>
			</div>
		</div>
		
	
		
</body>

</html>
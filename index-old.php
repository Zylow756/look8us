<?php
require_once __DIR__ . "/config.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<html>

<head>
<meta charset="UTF-8">
<title>Online Directory</title>
 <link rel="stylesheet" type="text/css" href="akc.css" />

<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/form.css" />


<script src="js/jquery-1.3.2.min.js" type="text/javascript"></script>
<script src="js/jquery.easing.1.3.js" type="text/javascript"></script>
<script src="js/jquery.timers-1.2.js" type="text/javascript"></script>
<script src="js/jquery.dualSlider.0.3.min.js" type="text/javascript"></script>



<script type="text/javascript" src="js/jquery.simplyscroll.js"></script>
<link rel="stylesheet" href="js/jquery.simplyscroll.css" media="all" type="text/css">
<script type="text/javascript">
(function($) {
	$(function() {
		$("#scroller").simplyScroll({
			auto: false,
			speed: 10
		});
	});
})(jQuery);
</script>



</head>
<body topmargin="0" leftmargin="0" rightmargin="0" bottommargin="0">

<table border="0" width="100%" id="table1" style="border-collapse: collapse" bordercolor="#C0C0C0" cellpadding="0">
	<tr>
		<td height="20" bgcolor="#E2E2E2"><?php  require_once "header.php"; ?></td>
	</tr>
	<tr>
		<td align="center" valign="top">
		<table border="0" width="1010" id="table2" cellpadding="0" style="border-collapse: collapse" height="450">
			<tr>
				<td align="center" valign="top" style="border-top-width: 1px; border-bottom-width: 1px" bordercolor="#FFFFFF">
				<table border="0" width="100%" id="table3" style="border-collapse: collapse" height="882">
					<tr>
						<td width="23%" valign="top" height="23">&nbsp;</td>
						<td valign="top" height="23" width="49%">&nbsp;</td>
						<td width="28%" valign="top" height="23">&nbsp;</td>
					</tr>
					<tr>
						<td width="23%" valign="top" height="340" bgcolor="#E0E2FE">
						<div align="left">
							<table class="shadow1" border="0" width="100%" id="table12" cellspacing="1" style="border-collapse: collapse" height="333">
								<tr>
									<td bgcolor="#3399FF" height="40" align="center">
									<font color="#FFFFFF"><b>&nbsp;Popular 
									Category</b></font></td>
								</tr>
								<tr>
									<td valign="top">
									<table border="0" width="100%" id="table17" cellpadding="0" style="border-collapse: collapse" height="29">
										<tr>
											<td style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: solid; border-bottom-width: 1px" bordercolor="#808080" height="30">
											<font size="2" color="#000000">&nbsp;<a href="#" class="a3">Construction 
											Material Dealers</a></font></td>
										</tr>
										<tr>
											<td style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: solid; border-bottom-width: 1px" bordercolor="#808080" height="30"><font size="2" color="#000000">&nbsp;<a href="#" class="a3">Home 
											Furniture Dealers</a></font></td>
										</tr>
										<tr>
											<td style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: solid; border-bottom-width: 1px" bordercolor="#808080" height="30"><font size="2" color="#000000">&nbsp;<a href="#" class="a3">Refrigerator</a></font></td>
										</tr>
										<tr>
											<td style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: solid; border-bottom-width: 1px" bordercolor="#808080" height="30"><font size="2" color="#000000">&nbsp;<a href="#" class="a3">Plumbing 
												Contractors</a></font></td>
										</tr>
										<tr>
											<td style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: solid; border-bottom-width: 1px" bordercolor="#808080" height="30"><font size="2" color="#000000">&nbsp;<a href="#" class="a3">Orchestra 
											&amp; Music Organisers</a></font></td>
										</tr>
										<tr>
											<td style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: solid; border-bottom-width: 1px" bordercolor="#808080" height="30"><font size="2" color="#000000">&nbsp;<a href="#" class="a3">Department 
											Stores</a></font></td>
										</tr>
										<tr>
											<td style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: solid; border-bottom-width: 1px" bordercolor="#808080" height="30"><font size="2" color="#000000">&nbsp;<a href="#" class="a3">Fixtures 
											&amp; Fittings Dealers</a></font></td>
										</tr>
										<tr>
											<td style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: solid; border-bottom-width: 1px" bordercolor="#808080" height="30"><font size="2" color="#000000">&nbsp;<a href="#" class="a3">Awnings 
											&amp; Canopies Contractors</a></font></td>
										</tr>
										<tr>
											<td style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: solid; border-bottom-width: 1px" bordercolor="#808080" height="30"><font size="2" color="#000000">&nbsp;<a href="#" class="a3">Electricians</a></font></td>
										</tr>
									</table>
									</td>
								</tr>
							</table>
						</div>
						</td>
						<td valign="top" height="340" width="49%">
						<div align="center">
							<table class="shadow1" border="1" width="96%" id="table8" style="border-collapse: collapse" height="335" bordercolor="#F4F4F4">
								<tr>
									<td height="40" bgcolor="#E3E3E3">
									<font color="#000000">&nbsp;<b>Browse 
									Categories</b></font></td>
								</tr>
								<tr>
									<td valign="top">
									<div align="right">
									
		<?php						

$st="Select * from category order by cname";

//echo $st;
$i=1;
$result=mysqli_query($con,$st);
if (!$result) {
    die(mysqli_error($con));
}

$num_rows = mysqli_num_rows($result);

$rno=round($num_rows/3);

//echo $num_rows;
//echo $rno;
?>	


		<div align="center">

	<table  border="0" width="100%" id="table18" cellpadding="0" style="border-collapse: collapse">
											
										<tr>
										<td colspan="5" height="7" ></td>
										
										</tr>	
											<tr>
												<td width="33%" height="280" valign="top">  
												
												 <table class="table1" border="0" width="100%" id="table19" style="border-collapse: collapse" cellpadding="0">
													
	<?php
	$i=1;
	while ( ($row=mysqli_fetch_assoc($result))&&($i<$rno))
	{	
?>
												
	<tr>
														<td height="25">
														<?php
															echo "<a href='#' class='a5' >".$row["cname"]."</a>";
	
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
	while ( ($row=mysqli_fetch_assoc($result))&&($i<$rno))
	{	
?>
												
	<tr>
														<td height="25">
														<?php
															echo "<a href='#' class='a5' >".$row["cname"]."</a>";
	
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
												<td height="25" valign="top">
												
												<table class="table1" border="0" width="100%" id="table19" style="border-collapse: collapse" cellpadding="0">
													
	<?php
	$i=1;
	while ( ($row=mysqli_fetch_assoc($result))&&($i<$rno))
	{	
?>
												
	<tr>
														<td height="25">
														<?php
															echo "<a href='#' class='a5' >".$row["cname"]."</a>";
	
																$i=$i+1;
															?>
	
	</td>
													</tr>
													
													<?php
													}
													?>
													
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
						<td width="28%" valign="top" height="340" bgcolor="#F4F4F4">
						<div align="right">
							<table class="shadow1" border="0" width="100%" id="table4" cellpadding="0" style="border-collapse: collapse" height="335" bordercolor="#E3E3E3">
								<tr>
									<td height="40" bgcolor="#333333" align="center">
									<b><font color="#F5F5F5" size="2">Tell Us 
									Your Need, Get Instant Response!</font></b></td>
								</tr>
								<tr>
									<td valign="top">
									<table border="0" width="100%" id="table11" height="258" cellspacing="1" style="border-collapse: collapse">
										<tr>
											<td width="28%">
											<font color="#666666" size="2">
											<span class="ksic flt tp5">&nbsp;Category</span></font></td>
											<td width="70%">
	



	<select  class="selbox" name="cname" id="cname" size="1" tabindex="5">
	<option value='0' >Please Select</option>
		<?php 
		 $st="Select * from catedetail order by cdname";
		 $result=mysqli_query($con,$st);
if (!$result) {
    die(mysqli_error($con));
}
		while ($row=mysqli_fetch_assoc($result))
			{
			?>
		<option value='<?php echo htmlspecialchars($row["catdid"]); ?>' <?php if (isset($_POST["cdname"])){if ($_POST["cdname"]==$row["catdid"]) echo "Selected" ;} ?> > <?php echo htmlspecialchars($row["cdname"]); ?></option>
			<?php
			}
			?>
	
	</select></td>
										</tr>
										<tr>
											<td width="28%">
											<font color="#666666" size="2">&nbsp;City</font></td>
											<td width="70%">
	<input  class="txtbox" type="text" name="city" id="city" tabindex="4" value="<?php if (isset($_POST['city'])) $city = $_POST['city'] ?? ''; else echo 'City';  ?>" onfocus="if(this.value=='City'){this.value='';}" onblur="if(this.value==''){this.value='City';}" size="1"/></td>
										</tr>
										<tr>
											<td width="28%">
											<font color="#666666" size="2">
											<span class="ksic flt tp5">&nbsp;Name</span></font></td>
											<td width="70%">
	<input class="txtbox" type="text" name="mname" id="mname" tabindex="1" value="<?php if (isset($_POST['mname'])) $mname = $_POST['mname'] ?? ''; else echo 'Member Name';  ?>" onfocus="if(this.value=='Member Name'){this.value='';}" onblur="if(this.value==''){this.value='Member Name';}" size="1"/></td>
										</tr>
										<tr>
											<td width="28%">
											<font color="#666666" size="2">&nbsp;Mobile</font></td>
											<td width="70%">
	<input  class="txtbox" type="text" name="mobile" id="mobile" value="<?php if (isset($_POST['mobile'])) $mobile = $_POST['mobile'] ?? ''; else echo 'Mobile';  ?>" onfocus="if(this.value=='Mobile'){this.value='';}" onblur="if(this.value==''){this.value='Mobile';}" tabindex="10" size="1"/></td>
										</tr>
										<tr>
											<td width="28%">
											<font color="#666666" size="2">&nbsp;Email
											</font></td>
											<td width="70%">
	<input class="txtbox" type="text" name="txtmail" id="txttmail" value="<?php if (isset($_POST['txtmail'])) $txtmail = $_POST['txtmail'] ?? ''; else echo 'Email ID';  ?>" onfocus="if(this.value=='Email ID'){this.value='';}" onblur="if(this.value==''){this.value='Email ID';}" tabindex="4" /></td>
										</tr>
										<tr>
											<td width="28%">
											<font color="#666666" size="2">&nbsp;Detail</font></td>
											<td width="70%">
	<input  class="txtbox" type="text" name="remark" id="remark" tabindex="3" value="<?php if (isset($_POST['remark'])) $remark = $_POST['remark'] ?? ''; else echo 'Message';  ?>"  size="1"/></td>
										</tr>
										<tr>
											<td colspan="2" align="center">
	<input  class="subbox" type="submit" value="Get Response" name="submit"/></td>
										</tr>
									</table>
									</td>
								</tr>
							</table>
						</div>
						</td>
					</tr>
					
					<tr>
						<td valign="top" colspan="3" height="11">
</td></tr>						
					<tr>
						<td valign="top" colspan="3">
						<table class="shadow4" border="1" width="100%" id="table6" height="398" style="border-collapse: collapse" bordercolor="#E3E3E3">
							<tr>
								<td height="40" bgcolor="#FFCC00">
								<font size="4">&nbsp;</font><i><font size="5" color="#000000" face="Times New Roman">New 
								on Look8us.com</font></i></td>
							</tr>
							<tr>
								<td valign="top" bgcolor="#F7F7F7">
								<div align="center">
&nbsp;<table border="0" width="99%" id="table13" style="border-collapse: collapse" height="148">
										<tr>
											<td height="35" bgcolor="#0033CC" width="32%">&nbsp;<font color="#FFFFFF"><b>Construction 
											&amp; Renovation</b></font></td>
											<td height="35" bgcolor="#FFFFFF" width="1%">&nbsp;</td>
											<td height="35" bgcolor="#0066FF" width="34%">&nbsp;<b><font color="#FFFFFF">Decoration 
											&amp; Furniture</font></b></td>
											<td height="35" bgcolor="#FFFFFF" width="1%">&nbsp;</td>
											<td height="35" bgcolor="#0385AF" width="32%">&nbsp;<b><font color="#FFFFFF">Electronics 
											&amp; Appliances</font></b></td>
										</tr>
										<tr>
											<td valign="top" bgcolor="#F4F4F4" width="32%">
											<font size="2">&nbsp;</font><font size="2" color="#000000">Bathroom 
											&amp; Sanitaryware<br>
&nbsp;Bathroom Fittings<br>
&nbsp;Fixtures &amp; Fittings Dealers<br>
&nbsp;Construction Material Dealers</font></td>
											<td valign="top" bgcolor="#FFFFFF" width="1%">&nbsp;</td>
											<td valign="top" bgcolor="#F4F4F4" width="34%">
											<font size="2">&nbsp;</font><font size="2" color="#000000">Architects<br>
&nbsp;Curtains &amp; Blinds Dealers<br>
&nbsp;Awnings &amp; Canopies Contractors<br>
&nbsp;Home Furniture Dealers</font></td>
											<td valign="top" bgcolor="#FFFFFF" width="1%">&nbsp;</td>
											<td valign="top" bgcolor="#F4F4F4" width="32%">
											<font size="2">&nbsp;</font><font size="2" color="#000000">Audio 
											Music System<br>
&nbsp;Refrigerator<br>
&nbsp;TV<br>
&nbsp;Inverter Dealers &amp; Services &amp; Rentals</font></td>
										</tr>
									</table>
									<div align="center">
&nbsp;<table border="0" width="99%" id="table14" style="border-collapse: collapse" height="149">
											<tr>
												<td height="35" bgcolor="#6600FF" width="32%">
												<b><font color="#FFFFFF">&nbsp;Grocery 
												&amp; Home Supplies</font></b></td>
												<td height="35" bgcolor="#FFFFFF" width="1%">&nbsp;</td>
												<td height="35" bgcolor="#333399" width="34%">&nbsp;<b><font color="#FFFFFF">Home 
												Services &amp; Repair</font></b></td>
												<td height="35" bgcolor="#FFFFFF" width="1%">&nbsp;</td>
												<td height="35" bgcolor="#000099" width="32%">
												<b><font color="#FFFFFF">&nbsp;Other 
												Services</font></b></td>
											</tr>
											<tr>
												<td valign="top" bgcolor="#F4F4F4" width="32%">
												<font size="2">&nbsp;</font><font size="2" color="#000000">Crockery 
												Stores<br>
&nbsp;Department Stores<br>
&nbsp;Grocery Stores<br>
&nbsp;Allopathy Pharmacies</font></td>
												<td valign="top" bgcolor="#FFFFFF" width="1%">&nbsp;</td>
												<td valign="top" bgcolor="#F4F4F4" width="34%">
												<font size="2">&nbsp;</font><font size="2" color="#000000">Plumbing 
												Contractors<br>
&nbsp;Cleaning Services<br>
&nbsp;Electricians<br>
&nbsp;Painters</font></td>
												<td valign="top" bgcolor="#FFFFFF" width="1%">&nbsp;</td>
												<td valign="top" bgcolor="#F4F4F4" width="32%">
												<font size="2">&nbsp;</font><font size="2" color="#000000">Florists<br>
&nbsp;Orchestra &amp; Music Organisers<br>
&nbsp;Cooking Gas Agencies<br>
&nbsp;Generator Hire<br>
												<br>
&nbsp;</font></td>
											</tr>
										</table>
									</div>
								</div>
								</td>
							</tr>
						</table>
						</td>
					</tr>
					<tr>
						<td width="99%" valign="top" height="22" colspan="3">&nbsp;</td>
					</tr>
					<tr>
						<td width="99%" valign="top" height="254" colspan="3">
						<table class="shadow2" border="0" width="100%" id="table9" style="border-collapse: collapse" height="246">
							<tr>
								<td bgcolor="#FF0000" height="40"><b>
								<font size="4" color="#FFFFFF">&nbsp;Verified 
								Business &amp; Services </font>
								<font size="1" color="#FFFFFF">(Advertisements)</font></b></td>
							</tr>
							<tr>
								<td valign="top" bgcolor="#F0F0FF">
								<table border="0" width="100%" id="table10" height="240" cellspacing="0" cellpadding="0" style="border-collapse: collapse" bordercolor="#E3E3E3">
									<tr>
										<td valign="middle"  align="center" height="240">
							
							<table border="0" width="1000" id="table15" style="border-collapse: collapse" bordercolor="#E0E2FE" bgcolor="#FFFFFF" cellpadding="0">
								<tr>
									<td valign="middle">
									

<ul id="scroller">
    <li>
	<img border="0" src="images/board_paper_solutions.jpg" width="240" height="145">&nbsp;&nbsp;Tirupati Travels</li>
    <li>
	<img border="0" src="images/HC%20Verma%20solution.png" width="240" height="145">&nbsp;&nbsp;Thomas Cook</li>
    <li>
	<img border="0" src="images/Irodo%20Solution.png" width="240" height="145">&nbsp;&nbsp;&nbsp;Hero Cycles</li>
    <li>
	<img border="0" src="images/NCERT%20SOLUTION%20TOP.jpg" width="240" height="145">&nbsp;&nbsp;&nbsp;Tata Motor Finance</li>
    <li>
	<img border="0" src="images/Previous%20AIEEE%20Papers.jpg" width="240" height="145">&nbsp;&nbsp;Food Plaza</li>
    <li>
	<img border="0" src="images/Previous%20AIPMT%20papers.jpg" width="240" height="145">&nbsp;&nbsp;Surya Hotel</li>
	<li>
	<img border="0" src="images/Puzzle.jpg" width="240" height="145">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Resonance</li>
</ul>

</td>
								</tr>
							</table></td>
									</tr>
								</table>
								</td>
							</tr>
						</table>
						</td>
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
		<td bgcolor="#F5F5F5" height="20"><?php  require_once "footer.php"; ?></td>
	</tr>
</table>
<a href="<?php echo $path; ?>payment/subscribe.php" class="demoTest"></a>
</body>

</html>
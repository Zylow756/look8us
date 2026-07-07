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
<title>Look8US :Business Directory Kota, Rajasthan , India, Online Business Directory Kota,  Yellow Pages  kota Rajasthan , Trusted & Verified Businesses, Exporters, Manufacturers, Suppliers Directory, B2B Business Directory </title>
<meta name="description" content="Look8us.com from Kota Rajasthan is Your local Business Directory , yellow pages  Business Directory. Business Details, Contacts, Products, Services & Verified Businesses, Exporters, Manufacturers, Suppliers Directory">
<meta name="keywords" content=" Look8us.com , yellow pages Kota Rajasthan , business directory Kota Rajasthan india,business search engine, indian business directory, online business directory, Indian manufacturers, suppliers, Indian exporters directory, b2b portal, b2b business directory,manufacturer, importers, traders, dealers, buyers, ">
 <link rel="stylesheet" type="text/css" href="akc.css" />


<?php 

$msg=0;

if (isset($_POST["submit"]))
{

$st="insert into franch values (NULL ,'". $_POST["fname"]. "','". $_POST["mobile"]. "','". $_POST["email"]. "','". $_POST["city"]. "','". $_POST["remark"]. "','".date("d-m-Y")."')" ;
mysqli_query($con,$st);
//echo $st;
$msg=1;
	

} 	// end of if (submit)

?>


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
					<td><font size="6">&nbsp;</font><font color="#333333" size="5">Franchise </font></td>
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
									
									<td align="right" valign="top">
									<table border="0" width="100%" id="table34" style="border-collapse: collapse">
										<tr>
											<td width="686">
											<p style="text-align: justify; line-height: 17px; margin-left: 50px; margin-right: 10px; margin-top:2px; margin-bottom:2px">&nbsp;</p>
											<p style="line-height: 17px; margin-left: 5px; margin-right: 10px; margin-top: 2px; margin-bottom: 2px" align="justify">
											<font size="2">
											<span style="font-family: Arial; ">
											The service industry 
											has shown new business horizons to 
											the world. It is the service 
											industry which has multiplied the 
											customer comforts and has churned 
											immeasurable benefits for the 
											society world over. Education 
											industry is one of the most eminent 
											bright stars of service industry. 
											Apart from the monetary inducements, 
											it is one those few industries which 
											has immense developmental corollary 
											for the society.</span></font></p>
											<p style="line-height: 17px; margin-left: 5px; margin-right: 10px; margin-top: 2px; margin-bottom: 2px" align="justify">
											<font size="2">
											<span style="font-family: Arial; ">
											In business sense, 
											the investments required are simple 
											and clean. The major investment is 
											in terms of human resource unlike 
											tangible raw materials in other 
											industries. Online marketing is not only 
											one of the fastest growing 
											businesses in the service industry 
											but also is a business which 
											commands a lot of respect and 
											acknowledgement from different 
											facets of the civilization. 
											</span> </font>
											</p>
											<p style="line-height: 17px; margin-left: 5px; margin-right: 10px; margin-top: 2px; margin-bottom: 2px">&nbsp;</p>
											<p class="hd" style="text-align: justify; line-height: 17px; margin-left: 5px; margin-right: 10px; margin-top: 2px; margin-bottom: 2px">
											<b>
											<span style="font-family: Arial; color: black" lang="EN-US">
											<font size="2">Why us ?</font></span></b></p>
											<p style="line-height: 17px; margin-left: 5px; margin-right: 10px; margin-top: 2px; margin-bottom: 2px">
											<font size="2">
											<span style="font-family: Arial">Look8us 
											is an umbrella, which would give you 
											recognition and will ensure that 
											your investments are safe and 
											growing. With our help and support, 
											you will find yourself set to make 
											your moves in the evolving Industry 
											and make your mark.</span></font></p>
											<ul style="margin-bottom: 0cm" type="disc">
												<p style="line-height: 17px; margin-left: 5px; margin-right: 10px; margin-top: 2px; margin-bottom: 2px">
												<img border="0" src="images/arrow3.gif" width="30" height="9"><font face="Arial" size="2">
												</font>
												<span style="font-family: Arial" lang="EN-US">
												<font size="2">Association with 
												the leading brand name of India
												</font></span></p>
												<p style="line-height: 17px; margin-left: 5px; margin-right: 10px; margin-top: 2px; margin-bottom: 2px">
												<font face="Arial" size="2">
												<img border="0" src="images/arrow3.gif" width="30" height="9">
												</font>
												<span style="font-family: Arial" lang="EN-US">
												<font size="2">Membership of a 
												nationwide network </font>
												</span></p>
												<p style="line-height: 17px; margin-left: 5px; margin-right: 10px; margin-top: 2px; margin-bottom: 2px">
												<font face="Arial" size="2">
												<img border="0" src="images/arrow3.gif" width="30" height="9">
												</font>
												<span style="font-family: Arial" lang="EN-US">
												<font size="2">Detailed 
												operations manual and processes 
												to help you function smoothly 
												and efficiently </font></span>
												</p>
												<p style="line-height: 17px; margin-left: 5px; margin-right: 10px; margin-top: 2px; margin-bottom: 2px">
												<font face="Arial" size="2">
												<img border="0" src="images/arrow3.gif" width="30" height="9">
												</font>
												<span style="font-family: Arial" lang="EN-US">
												<font size="2">Latest and 
												updated study material and 
												curriculum </font></span></p>
												<p style="line-height: 17px; margin-left: 5px; margin-right: 10px; margin-top: 2px; margin-bottom: 2px">
												<font face="Arial" size="2">
												<img border="0" src="images/arrow3.gif" width="30" height="9">
												</font>
												<span style="font-family: Arial" lang="EN-US">
												<font size="2">National level 
												advertisement support </font>
												</span></p>
											</ul>
											<ul style="margin-bottom: 0cm" type="disc">
												<p style="line-height: 17px; margin-left: 5px; margin-right: 10px; margin-top: 2px; margin-bottom: 2px">
												<font face="Arial" size="2">&nbsp;</font></p>
											</ul>
											<p class="hd" style="text-align: justify; line-height: 17px; margin-left: 5px; margin-right: 10px; margin-top: 2px; margin-bottom: 2px">
											<b>
											<span style="font-family: Arial; color: black" lang="EN-US">
											<font size="2">Reach of Look8us</font></span></b></p>
											<ul style="margin-bottom: 0cm" type="disc">
												<p style="line-height: 17px; margin-left: 5px; margin-right: 10px; margin-top: 2px; margin-bottom: 2px">
												<font face="Arial" size="2">
												<img border="0" src="images/arrow3.gif" width="30" height="9">
												</font>
												<span style="font-family: Arial" lang="EN-US">
												<font size="2">A customer list 
												that includes various customer 
												all over India </font></span>
												</p>
												<p style="line-height: 17px; margin-left: 5px; margin-right: 10px; margin-top: 2px; margin-bottom: 2px">
												<font face="Arial" size="2">
												<img border="0" src="images/arrow3.gif" width="30" height="9">
												</font>
												<span style="font-family: Arial" lang="EN-US">
												<font size="2">A vast community 
												of satisfied clients </font>
												</span></p>
												<p style="line-height: 17px; margin-left: 5px; margin-right: 10px; margin-top: 2px; margin-bottom: 2px">
												<font face="Arial" size="2">
												<img border="0" src="images/arrow3.gif" width="30" height="9">
												</font>
												<span style="font-family: Arial" lang="EN-US">
												<font size="2">A strong 
												nationwide customer base </font>
												</span></p>
												<p style="line-height: 17px; margin-left: 5px; margin-right: 10px; margin-top: 2px; margin-bottom: 2px">
												<font face="Arial" size="2">&nbsp;</font></p>
											</ul>
											<p style="text-align: justify; line-height: 17px; margin-left: 5px; margin-right: 10px; margin-top: 2px; margin-bottom: 2px">
											<font face="Arial" size="2">&nbsp;</font></p>
											<p style="text-align: justify; line-height: 17px; margin-left: 5px; margin-right: 10px; margin-top: 2px; margin-bottom: 2px">
											<span style="color: black" lang="EN-US">
											<strong><i>
											<font size="2" face="Arial">Be a 
											part of the movement called&nbsp; </font>
											</i></strong>
											<font size="2" face="Arial">L</font></span><span style="font-family: Arial; color: black" lang="EN-US"><font size="2">ook8us
											</font><strong><i><font size="2">: 
											follow the footprints of success....
											</font></i></strong></span></p>
											<p style="text-align: justify; line-height: 17px; margin-left: 5px; margin-right: 10px; margin-top: 2px; margin-bottom: 2px">
											<span style="color: black" lang="EN-US">
											<strong><font size="2" face="Arial">
											Come to </font></strong>
											<font face="Arial"><b>
											<font size="2">L</font></b></font></span><span style="font-family: Arial; color: black" lang="EN-US"><b><font size="2">ook8us</font></b><strong><font size="2"> 
											if you</font></strong></span></p>
											<ul style="margin-bottom: 0cm" type="disc">
												<p style="line-height: 17px; margin-left: 5px; margin-right: 10px; margin-top: 2px; margin-bottom: 2px">
												<font face="Arial" size="2">
												<img border="0" src="images/arrow3.gif" width="30" height="9">
												</font>
												<span style="font-family: Arial" lang="EN-US">
												<font size="2">Have fire to 
												excel </font></span></p>
												<p style="line-height: 17px; margin-left: 5px; margin-right: 10px; margin-top: 2px; margin-bottom: 2px">
												<font face="Arial" size="2">
												<img border="0" src="images/arrow3.gif" width="30" height="9">
												</font>
												<span style="font-family: Arial" lang="EN-US">
												<font size="2">Have right skills 
												and attitude </font></span></p>
												<p style="line-height: 17px; margin-left: 5px; margin-right: 10px; margin-top: 2px; margin-bottom: 2px">
												<font face="Arial" size="2">
												<img border="0" src="images/arrow3.gif" width="30" height="9">
												</font>
												<span style="font-family: Arial" lang="EN-US">
												<font size="2">Have experience 
												and knowledge in Education 
												Industry </font></span></p>
												<p style="line-height: 17px; margin-left: 5px; margin-right: 10px; margin-top: 2px; margin-bottom: 2px">
												<font face="Arial" size="2">
												<img border="0" src="images/arrow3.gif" width="30" height="9">
												</font>
												<span style="font-family: Arial" lang="EN-US">
												<font size="2">Have ideas which 
												can change the face of this 
												industry </font></span></p>
												<p style="line-height: 17px; margin-left: 5px; margin-right: 10px; margin-top: 2px; margin-bottom: 2px">
												<font face="Arial" size="2">
												<img border="0" src="images/arrow3.gif" width="30" height="9">
												</font>
												<span style="font-family: Arial" lang="EN-US">
												<font size="2">Have all it takes 
												to make a successful 
												entrepreneur </font></span></p>
												<p style="line-height: 17px; margin-left: 5px; margin-right: 10px; margin-top: 2px; margin-bottom: 2px">
												<font face="Arial" size="2">&nbsp;</font></p>
											</ul>
											<p style="text-align: justify; line-height: 17px; margin-left: 5px; margin-right: 10px; margin-top: 2px; margin-bottom: 2px">
											<span style="color: black" lang="EN-US">
											<strong><font size="2" face="Arial">
											In </font></strong>
											<font face="Arial"><b>
											<font size="2">L</font></b></font></span><span style="font-family: Arial; color: black" lang="EN-US"><b><font size="2">ook8us</font></b><strong><font size="2"> 
											you will find :</font></strong></span></p>
											<ul style="margin-bottom: 0cm" type="disc">
												<p style="line-height: 17px; margin-left: 5px; margin-right: 10px; margin-top: 2px; margin-bottom: 2px">
												<font face="Arial" size="2">
												<img border="0" src="images/arrow3.gif" width="30" height="9">
												</font>
												<span style="font-family: Arial" lang="EN-US">
												<font size="2">Someone, who 
												believe in your vision </font>
												</span></p>
												<p style="line-height: 17px; margin-left: 5px; margin-right: 10px; margin-top: 2px; margin-bottom: 2px">
												<font face="Arial" size="2">
												<img border="0" src="images/arrow3.gif" width="30" height="9">
												</font>
												<span style="font-family: Arial" lang="EN-US">
												<font size="2">Someone, who 
												would provide you with solutions 
												when you are struck </font>
												</span></p>
												<p style="line-height: 17px; margin-left: 5px; margin-right: 10px; margin-top: 2px; margin-bottom: 2px">
												<font face="Arial" size="2">
												<img border="0" src="images/arrow3.gif" width="30" height="9">
												</font>
												<span style="font-family: Arial" lang="EN-US">
												<font size="2">Someone, who will 
												help you see horizons of the 
												glory </font></span></p>
												<p style="line-height: 17px; margin-left: 5px; margin-right: 10px; margin-top: 2px; margin-bottom: 2px">
												<font face="Arial" size="2">
												<img border="0" src="images/arrow3.gif" width="30" height="9">
												</font>
												<span style="font-family: Arial" lang="EN-US">
												<font size="2">Someone, who will 
												help you realize your personal 
												goals </font></span></p>
												<p style="line-height: 17px; margin-left: 5px; margin-right: 10px; margin-top: 2px; margin-bottom: 2px">
												<font face="Arial" size="2">
												<img border="0" src="images/arrow3.gif" width="30" height="9">
												</font>
												<span style="font-family: Arial" lang="EN-US">
												<font size="2">Someone, who will 
												take your dreams and transform 
												them into reality </font></span>
												</p>
											</ul>
											<p>&nbsp;</td>
											<td valign="top" bgcolor="#E3E3E3" align="center">
											<p style="margin-left: 10px; margin-top: 5px; margin-bottom: 5px">
											<b><font color="#0033CC" size="2"><?php if ($msg==1) echo "Your Detail Send."; ?></font></b>
											</p>
											<form name="example" METHOD="post" action="Franchise.php" enctype="multipart/form-data"  onsubmit="document.getElementById('pos').disabled = false;" >

			<div align="right">

			<table border="0" width="99%" id="table1" style="BORDER-COLLAPSE: collapse" bordercolor="#f2f2f2" height="408">
	<tr>
		<td width="99%" align="middle" bgcolor="#969696" colspan="2" height="30">
		<b>
		<font size="2" color="#000000">Send your Detail </font></b></td>
	</tr>
	<tr>
		<td width="99%" align="left" height="15" colspan="2">
		
		</td>
		
	</tr>
	<tr>
		<td width="35%" align="left" height="40">
		
		<font face="Arial" color="#000000" size="2">&nbsp;Name</font></td>
		<td align="left" width="64%" height="40">
	
		<input name="fname" size="65" maxlength="35" onBlur="emailCheck(email.value)" class="txtbox1"   ></td>
		
	</tr>
	<tr>
		<td width="35%" align="left" height="40">
		
		<font face="Arial" color="#000000" size="2">&nbsp;Mobile/Phone</font></td>
		<td align="left" width="64%" height="40">
	
		<input name="mobile" size="65" maxlength="35" onBlur="emailCheck(email.value)" class="txtbox1"    ></td>
		
	</tr>
	<tr>
		<td align="left" height="40">
		
		<font face="Arial" color="#000000" size="2">&nbsp;Email Id</font></td>
		<td align="left" width="64%" height="40">
	
		<input name="email" size="65" maxlength="35" onBlur="emailCheck(email.value)" 
		class="txtbox1" ></td>
	</tr>
	<tr>
		<td align="left" height="40">
		
		<font face="Arial" color="#000000" size="2">&nbsp;Preffered Location</font></td>
		<td align="left" width="64%" height="40">
	
		<input name="city" size="65" maxlength="35" onBlur="emailCheck(email.value)" 
		class="txtbox1" ></td>
	</tr>
	<tr>
		<td width="99%" align="left" height="40" colspan="2">
		
		<font face="Arial" color="#000000" size="2">&nbsp; Your Query - Remark </font></td>
		
	</tr>
	<tr>
		<td align="center" height="50" colspan="2">
		
		<textarea name="remark" rows="6" cols="35"></textarea>
		&nbsp;
		
		</td>
	</tr>
	<tr>
		<td align="middle" colspan="2" height="61">
	
		&nbsp;&nbsp;&nbsp;&nbsp;
	
		<input type="submit" value="Send"  name="submit" class="subbox" ></B></FONT></td>
	</tr>
	</table>
			</div>
	</form>
											</td>
										</tr>
									</table>
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
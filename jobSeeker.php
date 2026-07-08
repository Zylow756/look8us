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


<?php 

$msg=0;

if (isset($_POST["submit"]))
{

$st="insert into postcv values (NULL ,'". $_POST["atitle"]. "','". $_POST["cate"]. "','". $_POST["discr"]. "','". $_POST["jtype"]. "','". $_POST["yname"]. "','". $_POST["mobile"]. "','". $_POST["email"]. "','". $_POST["city"]. "','". $_POST["qual"]. "','". $_POST["expr"]. "','". $_POST["expsalary"]. "','-','0','".date("d-m-Y")."')" ;
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
					<td><font size="6">&nbsp;</font><font size="5" color="#333333">Post 
					Your CV Detail </font></td>
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
											
											<?php
											if ($msg==1)
											
											{ 
																					
											//echo "<h5>Your CV Submitted Successfully.</h5>"; 
											
											echo "<br><img border='0' src='images/cvupload.jpg' alt='Your CV Submitted Successfully'><br><br>";
											}
											
											?>
											<?php if ($msg==2) echo "<h5>Error : Please Check File Format(DOC/PDF/JPG) or Size</h5>"; ?>
											</b>
											</p><div align="center">
										
									
									
									
									
									
									<?php
											if ($msg==0)
											
											{ 
										?>	
										
										<table border="0" width="98%" id="table34" cellspacing="1" style="border-collapse: collapse">
										<tr>
											<td>
											<!--webbot BOT="GeneratedScript" PREVIEW=" " startspan --><script Language="JavaScript" Type="text/javascript"><!--
function FrontPage_Form1_Validator(theForm)
{

  if (theForm.atitle.value == "")
  {
    alert("Please enter a value for the \"Ads Title\" field.");
    theForm.atitle.focus();
    return (false);
  }

  if (theForm.atitle.value.length > 35)
  {
    alert("Please enter at most 35 characters in the \"Ads Title\" field.");
    theForm.atitle.focus();
    return (false);
  }

  if (theForm.discr.value == "")
  {
    alert("Please enter a value for the \"Discription\" field.");
    theForm.discr.focus();
    return (false);
  }

  if (theForm.discr.value.length > 35)
  {
    alert("Please enter at most 35 characters in the \"Discription\" field.");
    theForm.discr.focus();
    return (false);
  }

  if (theForm.yname.value == "")
  {
    alert("Please enter a value for the \"Your Name\" field.");
    theForm.yname.focus();
    return (false);
  }

  if (theForm.yname.value.length > 35)
  {
    alert("Please enter at most 35 characters in the \"Your Name\" field.");
    theForm.yname.focus();
    return (false);
  }
  return (true);
}
//--></script><!--webbot BOT="GeneratedScript" endspan --><form name="FrontPage_Form1" METHOD="post" action="jobSeeker.php" onsubmit="return FrontPage_Form1_Validator(this)" language="JavaScript"    >

			<table border="0" width="100%" id="table1" style="BORDER-COLLAPSE: collapse" bordercolor="#f2f2f2" bgcolor="#ffffff">
	<tr>
		<td width="23%" align="left" bgcolor="#DDDDDD" height="30">
		<font size="2" color="#000000">&nbsp;Post your CV information&nbsp; </font></td>
		<td width="77%" align="right" bgcolor="#DDDDDD" height="30">
							<a href="javascript: window.history.go(-1)" class="a5">
							&lt;&lt;back </a>&nbsp;&nbsp;&nbsp;&nbsp; </td>
	</tr>
	<tr>
		<td width="99%" align="left" height="28" colspan="2">
		
		&nbsp;</td>
		
	</tr>
	<tr>
		<td width="23%" align="left" height="34">
		
		<font face="Arial" size="2" color="#000000">&nbsp; Ads Title *</font></td>
		<td align="left" width="77%" height="34">
	
		&nbsp;<!--webbot bot="Validation" s-display-name="Ads Title" b-value-required="TRUE" i-maximum-length="35" --><input name="atitle" size="65" maxlength="35"  class="txtbox1"   ></td>
		
	</tr>
	<tr>
		<td align="left" height="40">
		
		<font face="Arial" size="2" color="#000000">&nbsp; Category</font></td>
		<td align="left" width="77%" height="40"> 
	
		<select  class="selbox" name="cate" id="pos" size="1"  >
	
<option  >IT Services/Development</option>
<option  >DTP-Data Entry/Online</option>
<option  >Marketing</option>
<option  >Customer Service</option>
<option  >Advertising & PR</option>
<option  >Sales</option>
<option  >Clerical & Administration</option>
<option  >Human Resource</option>
<option  >Education/School/Coaching</option>
<option  >Hotel & Tourisim</option>
<option  >Hospital-Nursing</option>
<option  >Account & Finance</option>
<option  >Industry/Manufacturing</option>
<option  >Other</option>
							
			
								
								
	</select></td>
	</tr>
	<tr>
		<td width="23%" align="left" height="40">
		
		<font face="Arial" size="2" color="#000000">&nbsp; Description *</font></td>
		<td align="left" width="77%" height="40">
	
		&nbsp;<!--webbot bot="Validation" s-display-name="Discription" b-value-required="TRUE" i-maximum-length="35" --><input name="discr" size="65" maxlength="35"  class="txtbox1"    ></td>
		
	</tr>
	<tr>
		<td align="left" height="40">
		
		<font face="Arial" size="2" color="#000000">&nbsp; Job Type</font></td>
		<td align="left" width="77%" height="40">
	
		<select  class="selbox" name="jtype"  size="1"  >
	
<option  >Full Time</option>
<option  >Part Time</option>
<option  >Contract</option>
							
			
								
								
	</select></td>
	</tr>
	<tr>
		<td width="23%" align="left" height="34">
		
		<font face="Arial" size="2" color="#000000">&nbsp; Your Name *</font></td>
		<td align="left" width="77%" height="34">
	
		&nbsp;<!--webbot bot="Validation" s-display-name="Your Name" b-value-required="TRUE" i-maximum-length="35" --><input name="yname" size="65" maxlength="35"  class="txtbox1"   ></td>
		
	</tr>
	<tr>
		<td width="23%" align="left" height="40">
		
		<font face="Arial" size="2" color="#000000">&nbsp; Contact No.</font></td>
		<td align="left" width="77%" height="40">
	
		<input name="mobile" size="65" maxlength="35"  class="txtbox1"    ></td>
		
	</tr>
	<tr>
		<td align="left" height="40">
		
		<font face="Arial" size="2" color="#000000">&nbsp; Email Id</font></td>
		<td align="left" width="77%" height="40">
	
		<input name="email" size="65" maxlength="35" onBlur="emailCheck(email.value)" 
		class="txtbox1" ></td>
	</tr>
	<tr>
		<td align="left" height="40">
		
		<font face="Arial" size="2" color="#000000">&nbsp; City/State</font></td>
		<td align="left" width="77%" height="40">
	
		<input name="city" size="65" maxlength="35" 
		class="txtbox1" ></td>
	</tr>
	<tr>
		<td width="23%" align="left" height="40">
		
		<font face="Arial" size="2" color="#000000">&nbsp; Qualification</font></td>
		<td align="left" width="77%" height="40">
	
		<input name="qual" size="65" maxlength="35"  class="txtbox1"    ></td>
		
	</tr>
	<tr>
		<td align="left" height="40">
		
		<font face="Arial" size="2" color="#000000">&nbsp; Experience if any (Yr.)</font></td>
		<td align="left" width="77%" height="40">
	
		<input name="expr" size="65" maxlength="35" 
		class="txtbox1" ></td>
	</tr>
	<tr>
		<td align="left" height="40">
		
		<font face="Arial" size="2" color="#000000">&nbsp; Salary Expected</font></td>
		<td align="left" width="77%" height="40">
	
		<input name="expsalary" size="65" maxlength="35" 
		class="txtbox1" ></td>
	</tr>
	<tr>
		<td align="left" height="20">
		
		&nbsp;</td>
		<td align="left" width="77%" height="20">
	
&nbsp;</td>
	</tr>
	<tr>
		<td align="left" height="40">
		
		&nbsp;</td>
		<td align="left" width="77%" height="40">
	
		<input type="submit" value="Submit"  name="submit" class="subbox" ></td>
	</tr>
	<tr>
		<td align="middle" colspan="2" height="50">
	
		</B></FONT></td>
	</tr>
	</table>
	</form></td>
										</tr>
									</table>
									
								<?php
									}
											
											?>
											
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
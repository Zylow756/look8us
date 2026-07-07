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
					<h1><font size="2">&nbsp;</font></h1>
					<table border="0" width="100%" id="table35" cellpadding="0" style="border-collapse: collapse" >
								<tr>
									
									<td align="right" valign="top" height="400">
									<p align="left" style="margin-left: 15px">
									<font face="Arial">
									<b>&nbsp;<font color="#FF0000"><u>Membership 
									Plans:</u></font></b></font></p>
									<div align="center">
									

<form method="get" action="../payment/paymentReq.php">
	<table class="tablenew" border="1" width="96%" id="table36" cellspacing="0" style="border-collapse: collapse" height="305" bordercolor="#E3E3E3" cellpadding="0">
											<tr>
												<td bgcolor="#F4F4F4" height="36" align="left">
												<b>
												<font color="#003366" size="4">&nbsp;</font><font color="#003366" size="3">Plan
												Features</font></b></td>
												<td width="4" bgcolor="#C9C9C9" rowspan="17">&nbsp;</td>
												<td bgcolor="#E3E3E3" height="36" align="center" width="171">
												<b>
												<font size="3" color="#003366">Silver 
												</font></b></td>
												<td width="4" bgcolor="#C9C9C9" rowspan="17">&nbsp;</td>
												<td width="172" height="36" align="center" bgcolor="#E3E3E3">
												<b>
												<font size="3" color="#003366">Gold </font></b></td>
												<td width="4" bgcolor="#C9C9C9" rowspan="17">&nbsp;</td>
												<td width="178" height="36" align="center" bgcolor="#E3E3E3">
												<b>
												<font size="3" color="#003366">Platinum </font></b></td>
											</tr>
											<tr>
												<td bgcolor="#FFFFFF" align="left" height="40">
												<b>&nbsp; Company/ 
												Organization /Shop Name</b></td>
												<td bgcolor="#FFFFFF" align="center" width="171" height="40">
												<img border="0" src="../payment/icontexto_webdev_ok.png"></td>
												<td width="172" bgcolor="#FFFFFF" align="center" height="40">
												<img border="0" src="../payment/icontexto_webdev_ok.png"></td>
												<td width="178" bgcolor="#FFFFFF" align="center" height="40">
												<img border="0" src="../payment/icontexto_webdev_ok.png"></td>
											</tr>
											<tr>
												<td bgcolor="#FFFFFF" align="left" height="40">
												<b>&nbsp; Contact 
												Person Name</b></td>
												<td bgcolor="#FFFFFF" align="center" width="171" height="40">
												<img border="0" src="../payment/icontexto_webdev_ok.png"></td>
												<td width="172" bgcolor="#FFFFFF" align="center" height="40">
												<img border="0" src="../payment/icontexto_webdev_ok.png"></td>
												<td width="178" bgcolor="#FFFFFF" align="center" height="40">
												<img border="0" src="../payment/icontexto_webdev_ok.png"></td>
											</tr>
											<tr>
												<td bgcolor="#FFFFFF" align="left" height="40">
												<b>&nbsp; Contact 
												Information <br>
&nbsp; (Address/Phone/Mobile/Fax/Email)</b></td>
												<td bgcolor="#FFFFFF" align="center" width="171" height="40">
												<img border="0" src="../payment/icontexto_webdev_ok.png"></td>
												<td width="172" bgcolor="#FFFFFF" align="center" height="40">
												<img border="0" src="../payment/icontexto_webdev_ok.png"></td>
												<td width="178" bgcolor="#FFFFFF" align="center" height="40">
												<img border="0" src="../payment/icontexto_webdev_ok.png"></td>
											</tr>
											<tr>
												<td bgcolor="#FFFFFF" align="left" height="40">
												<b>&nbsp; Description 
												[250 char]</b></td>
												<td bgcolor="#FFFFFF" align="center" width="171" height="40">
												<img border="0" src="../payment/icontexto_webdev_ok.png"></td>
												<td width="172" bgcolor="#FFFFFF" align="center" height="40">
												<img border="0" src="../payment/icontexto_webdev_ok.png"></td>
												<td width="178" bgcolor="#FFFFFF" align="center" height="40">
												<img border="0" src="../payment/icontexto_webdev_ok.png"></td>
											</tr>
											<tr>
												<td bgcolor="#FFFFFF" align="left" height="40">
												<b>&nbsp; Website 
												Link</b></td>
												<td bgcolor="#FFFFFF" align="center" width="171" height="40">
												<img border="0" src="../payment/icontexto_webdev_ok.png"></td>
												<td width="172" bgcolor="#FFFFFF" align="center" height="40">
												<img border="0" src="../payment/icontexto_webdev_ok.png"></td>
												<td width="178" bgcolor="#FFFFFF" align="center" height="40">
												<img border="0" src="../payment/icontexto_webdev_ok.png"></td>
											</tr>
											<tr>
												<td bgcolor="#FFFFFF" align="left" height="40">
												<b>&nbsp; Your 
												Logo upload</b></td>
												<td bgcolor="#FFFFFF" align="center" width="171" height="40">
												<img border="0" src="../payment/wrong.png"></td>
												<td width="172" bgcolor="#FFFFFF" align="center" height="40">
												<img border="0" src="../payment/icontexto_webdev_ok.png"></td>
												<td width="178" bgcolor="#FFFFFF" align="center" height="40">
												<img border="0" src="../payment/icontexto_webdev_ok.png"></td>
											</tr>
											<tr>
												<td bgcolor="#FFFFFF" align="left" height="40">
												<b>&nbsp; Product 
												Image Gallery upload</b></td>
												<td bgcolor="#FFFFFF" align="center" width="171" height="40">
												<img border="0" src="../payment/wrong.png"></td>
												<td width="172" bgcolor="#FFFFFF" align="center" height="40">
												<img border="0" src="../payment/icontexto_webdev_ok.png"></td>
												<td width="178" bgcolor="#FFFFFF" align="center" height="40">
												<img border="0" src="../payment/icontexto_webdev_ok.png"></td>
											</tr>
											<tr>
												<td bgcolor="#FFFFFF" align="left" height="40">
												<b>&nbsp; No. 
												of Category can be Listed</b></td>
												<td bgcolor="#FFFFFF" align="center" width="171" height="40">
												<b>3 Categories</b></td>
												<td width="172" bgcolor="#FFFFFF" align="center" height="40">
												<b>5 Categories</b></td>
												<td width="178" bgcolor="#FFFFFF" align="center" height="40">
												<b>Unlimited Category</b></td>
											</tr>
											<tr>
												<td bgcolor="#FFFFFF" align="left" height="40">
												<b>&nbsp; Brief 
												Introduction [500 char]</b></td>
												<td bgcolor="#FFFFFF" align="center" width="171" height="40">
												<img border="0" src="../payment/wrong.png"></td>
												<td width="172" bgcolor="#FFFFFF" align="center" height="40">
												<img border="0" src="../payment/wrong.png"></td>
												<td width="178" bgcolor="#FFFFFF" align="center" height="40">
												<img border="0" src="../payment/icontexto_webdev_ok.png"></td>
											</tr>
											<tr>
												<td bgcolor="#FFFFFF" align="left" height="40">
												<b>&nbsp; You 
												Tube Link</b></td>
												<td bgcolor="#FFFFFF" align="center" width="171" height="40">
												<img border="0" src="../payment/wrong.png"></td>
												<td width="172" bgcolor="#FFFFFF" align="center" height="40">
												<img border="0" src="../payment/icontexto_webdev_ok.png"></td>
												<td width="178" bgcolor="#FFFFFF" align="center" height="40">
												<img border="0" src="../payment/icontexto_webdev_ok.png"></td>
											</tr>
											<tr>
												<td bgcolor="#FFFFFF" align="left" height="40">
												<b>&nbsp; Social 
												Media Link</b></td>
												<td bgcolor="#FFFFFF" align="center" width="171" height="40">
												<img border="0" src="../payment/wrong.png"></td>
												<td width="172" bgcolor="#FFFFFF" align="center" height="40">
												<img border="0" src="../payment/icontexto_webdev_ok.png"></td>
												<td width="178" bgcolor="#FFFFFF" align="center" height="40">
												<img border="0" src="../payment/icontexto_webdev_ok.png"></td>
											</tr>
											<tr>
												<td bgcolor="#FFFFFF" align="left" height="40">
												<b>&nbsp; Google 
												Map</b></td>
												<td bgcolor="#FFFFFF" align="center" width="171" height="40">
												<img border="0" src="../payment/wrong.png"></td>
												<td width="172" bgcolor="#FFFFFF" align="center" height="40">
												<img border="0" src="../payment/wrong.png"></td>
												<td width="178" bgcolor="#FFFFFF" align="center" height="40">
												<img border="0" src="../payment/icontexto_webdev_ok.png"></td>
											</tr>
											<tr>
												<td bgcolor="#FFFFFF" align="left" height="40">
												<b>&nbsp; Visitor 
												Tracking &amp; Landing Page</b></td>
												<td bgcolor="#FFFFFF" align="center" width="171" height="40">
												<img border="0" src="../payment/wrong.png"></td>
												<td width="172" bgcolor="#FFFFFF" align="center" height="40">
												<img border="0" src="../payment/wrong.png"></td>
												<td width="178" bgcolor="#FFFFFF" align="center" height="40">
												<img border="0" src="../payment/icontexto_webdev_ok.png"></td>
											</tr>
											<tr>
												<td bgcolor="#FFFFFF" height="40" align="left">
												<b>&nbsp; Membership 
												Charges / Validity</b></td>
												<td bgcolor="#FFFFFF" height="40" align="center" width="171">
												<b><font size="2">&nbsp;Rs.200/- 
												[1 Year]</font></b></td>
												<td width="172" bgcolor="#FFFFFF" height="40" align="center">
												<b><font size="2">&nbsp;Rs.500/- 
												[1 Year]</font></b></td>
												<td width="178" bgcolor="#FFFFFF" height="40" align="center">
												<b><font size="2">&nbsp;Rs.1000/- 
												[3 Months]</font></b></td>
											</tr>
											<tr>
												<td bgcolor="#F4F4F4" align="center" style="height: 100px">
												<font color="#FF0000">&nbsp;</font><font color="#008000"><b>Please 
												accept terms &amp; <br>
												condition&nbsp; for initiate <br>
&nbsp;payment process</b></font></td>
												<td bgcolor="#F4F4F4" height="29" align="center" width="171" style="height: 100px">
												<font color="#008000" size="2">&nbsp;I 
												accept terms and condition<br>
												</font>
												<input type="checkbox" name="c1" ><font size="2"><br>
&nbsp;</font><input type="submit" value="Pay" name="submit1"></td>
												<td width="172" bgcolor="#F4F4F4" height="29" align="center" style="height: 100px">
												<font size="2">
												<font color="#008000">I accept 
												terms and condition <br>
												</font><font color="#000000">&nbsp;</font></font><input type="checkbox" name="c2" ><br>
												<input type="submit" value="Pay" name="submit2"></td>
												<td width="178" bgcolor="#F1F1F1" height="29" align="center" style="height: 100px">
												<font size="2" color="#008000">I 
												accept terms and condition <br>
												</font> 
												<input type="checkbox" name="c3" ><br>
												<input type="submit" value="Pay" name="submit3"></td>
											</tr>
											<tr>
												<td bgcolor="#F4F4F4" align="center" style="height: 10px" ></td>
												<td bgcolor="#F4F4F4" height="28" align="center" width="171" style="height: 10px"></td>
												<td width="172" bgcolor="#F4F4F4" align="center" style="height: 10px"></td>
												<td width="178" bgcolor="#F1F1F1"  align="center" style="height: 10px"></td>
											</tr>
											</table>
											</form>
										<p align="left"><font color="#0000FF">
										<b><font size="2">&nbsp;&nbsp; </font>
										</b></font></p>
										<p>&nbsp;</div>
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
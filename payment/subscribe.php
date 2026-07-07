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
 <link rel="stylesheet" type="text/css" href="../akc.css" />


</head>

<body topmargin="0" leftmargin="0" rightmargin="0" bottommargin="2" background="../images/bg.png">
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1&appId=1403091889904611";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>




<div align="center">
<?php require_once "../header.php"; ?>
<table border="0" width="100%" height="100" cellpadding="0" style="border-collapse: collapse">
	<tr>
		<td bgcolor="#D2D2D2">
		<div align="center">
			<table border="0" width="1010" id="table33" style="border-collapse: collapse" height="40" cellpadding="0">
				<tr>
					<td><font size="6">&nbsp;</font><font size="5" color="#333333">Subscribe
					</font></td>
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
							&nbsp;<table border="0" width="100%" id="table10" cellpadding="0" style="border-collapse: collapse" >
								<tr>
									
									<td align="right" valign="top" height="400">
									<p align="left" style="margin-left: 15px">
									<b>&nbsp;<u><font color="#FF0000" face="Arial">Registration 
									Process: </font></u></b></p>
									<p align="left" style="margin-left: 15px">
									<font face="Arial">
									<font color="#000000">&nbsp; </font>
									<font color="#000000" size="2"><b>Step-1 :</b> 
									Register your self by click top right link 
									&quot;Signup New User&quot;.<br>
&nbsp; <b>Step-2 :</b> After successful registration login by click top right 
									link &quot;Member login&quot;. <br>
&nbsp; <b>Step-3 :</b> After Login click on &quot;Paid Membership =&gt; Go for Payment&quot; 
									.<br>
&nbsp; <b>Step-4 :</b> Select Membership Plan and transfer Payment.<br>
&nbsp;</font></font></p>
									<p align="left" style="margin-left: 15px">
									<font face="Arial">
									<b>&nbsp;<font color="#FF0000"><u>Membership 
									Plans:</u></font></b></font></p>
									<div align="center">
	<table class="tablenew" border="1" width="96%" id="table34" cellspacing="0" style="border-collapse: collapse" height="305" bordercolor="#E3E3E3" cellpadding="0">
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
												<td bgcolor="#F4F4F4" align="center">
												&nbsp;</td>
												<td bgcolor="#F4F4F4" height="29" align="center" width="171">
													
	<a class="a2" href="<?php echo $path; ?>user/index.php">Signup Now</a>
												</td>
												<td width="172" bgcolor="#F4F4F4" height="29" align="center">
													
	<a class="a2" href="<?php echo $path; ?>user/index.php">Signup Now</a>
												</td>
												<td width="178" bgcolor="#F1F1F1" height="29" align="center">
													
	<a class="a2" href="<?php echo $path; ?>user/index.php">Signup Now</a>
												</td>
											</tr>
											<tr>
												<td bgcolor="#F4F4F4" align="center" style="height: 10px" ></td>
												<td bgcolor="#F4F4F4" height="28" align="center" width="171" style="height: 10px"></td>
												<td width="172" bgcolor="#F4F4F4" align="center" style="height: 10px"></td>
												<td width="178" bgcolor="#F1F1F1"  align="center" style="height: 10px"></td>
											</tr>
											</table>
										<p>&nbsp;</p>
										<p>&nbsp;</div>
									<br>
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
	<?php require_once "../footer.php"; ?>
</div>

</body>

</html>
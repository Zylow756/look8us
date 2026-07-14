<?php
require_once __DIR__ . "/../config.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
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



<div align="center">
<?php require_once "../header.php"; ?>
<table border="0" width="100%" height="100" cellpadding="0" style="border-collapse: collapse">
	<tr>
		<td bgcolor="#D2D2D2">
		<div align="center">
			<table border="0" width="1010" id="table33" style="border-collapse: collapse" height="40" cellpadding="0">
				<tr>
					<td><font size="6">&nbsp;</font><font size="5" color="#333333">Subscribe
					Payment</font></td>
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
									<b>&nbsp;<u><font face="Arial" color="#003366">Payment 
									Process: </font></u></b></p>
									<div align="center">
										

<?php

$pid=0;
$amt=0;
$product="";

$mname="-";
$email="-";
$mobile="-";

$address="-";
$city="-";
$state="-";
$zip="-";
$country="-";


$st="Select * from member where mid =".$_SESSION['mid'];
$result=mysqli_query($con,$st);
if (!$result) {
    die(mysqli_error($con));
}

if ($row=mysqli_fetch_assoc($result))
{
$mname=$row["mname"];
$email=$row["email"];
$mobile=$row["mobile"];

$address=$row["address"].", ".$row["area"];
$city=$row["city"];
$state=$row["state1"];
$zip=$row["pin"];
$country="India";


}

if (isset($_GET["c1"]))
	{
	$amt=200; 
	$pid=1;
	$product="Silver";
	}
else if(isset($_GET["c2"]))
	{
	$amt=500;
	$pid=2;
	$product="Gold";
	}
else if(isset($_GET["c3"]))
	{
	$amt=1000;
	$pid=3;
	$product="Platinum";
	}




?>

<form method="post" name="FrontPage_Form1" action="ccavRequestHandler.php" onsubmit="return FrontPage_Form1_Validator(this)" language="JavaScript">
		
			<div align="center">
		
			<table border="0" width="50%" id="table34" cellspacing="2" style="border-collapse: collapse" bordercolor="#F4F4F4" cellpadding="2">
				<tr>
												<td width="30%" height="30" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#E2E2E2">
												<font size="2" color="#003366">
												<b>Member</b></font><b><font size="2" color="#003366"> Name 
												</font></b></td>
												<td width="2%" height="30" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#E2E2E2"><b>
												<font size="2" color="#003366">:</font></b></td>
												<td height="30" width="64%" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#E2E2E2">
												<font size="2" color="#003366">&nbsp;<?php echo $mname; ?> 
												</font> </td>
											</tr>
				<tr>
												<td width="30%" height="30" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#E2E2E2"><b>
												<font size="2" color="#003366">Email ID 
												</font></b></td>
												<td width="2%" height="30" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#E2E2E2"><b>
												<font size="2" color="#003366">:</font></b></td>
												<td height="30" width="64%" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#E2E2E2">
												<font size="2" color="#003366">&nbsp;<?php echo $email; ?></font></td>
											</tr>
				<tr>
												<td width="30%" height="30" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#E2E2E2"><b>
												<font size="2" color="#003366">Mobile No. 
												</font></b></td>
												<td width="2%" height="30" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#E2E2E2"><b>
												<font size="2" color="#003366">:</font></b></td>
												<td height="30" width="64%" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#E2E2E2">
												<font size="2" color="#003366">&nbsp;<?php echo $mobile; ?></font></td>
											</tr>
				<tr>
												<td width="30%" height="30" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#E2E2E2"><b>
												<font size="2" color="#003366">Plan 
												Selected </font></b></td>
												<td width="2%" height="30" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#E2E2E2"><b>
												<font size="2" color="#003366">:</font></b></td>
												<td height="30" width="64%" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#E2E2E2">
												<font size="2" color="#003366">&nbsp;<?php echo $product; ?></font></td>
											</tr>
				<tr>
												<td width="30%" height="30" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#E2E2E2"><b>
												<font size="2" color="#003366">Amount in Rs.&nbsp; </font></b></td>
												<td width="2%" height="30" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#E2E2E2"><b>
												<font size="2" color="#003366">:</font></b></td>
												<td height="30" width="64%" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#E2E2E2">
														<font size="2" color="#003366">&nbsp;<?php echo $amt; ?>/-</font></td>
											</tr>
				<tr>
												<td width="96%" height="28" colspan="3" bgcolor="#E3E3E3" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#E2E2E2">
												<font color="#000080" size="2">
												<b>Billing Address :</b></font></td>
											</tr>
				<tr>
												<td width="30%" height="33" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#E2E2E2">
												<font color="#000080" size="2">
												Billing Name </font><b>
												<font size="2" color="#FF0000">*</font></b></td>
												<td width="2%" height="33" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#E2E2E2"><b>
												<font size="2" color="#003366">:</font></b></td>
												<td height="33" width="64%" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#E2E2E2">
					<font color="#000080">
					&nbsp;</font></td>
											</tr>
				<tr>
												<td width="30%" height="33" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#E2E2E2">
												<font color="#000080" size="2">
												Billing Address </font><b>
												<font size="2" color="#FF0000">*</font></b></td>
												<td width="2%" height="33" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#E2E2E2"><b>
												<font size="2" color="#003366">:</font></b></td>
												<td height="33" width="64%" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#E2E2E2">
					<font color="#000080">
					&nbsp;</font></td>
											</tr>
				<tr>
												<td width="30%" height="33" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#E2E2E2">
												<font color="#000080" size="2">
												Billing City </font><b>
												<font size="2" color="#FF0000">*</font></b></td>
												<td width="2%" height="33" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#E2E2E2"><b>
												<font size="2" color="#003366">:</font></b></td>
												<td height="33" width="64%" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#E2E2E2">
					<font color="#000080">
					&nbsp;</font></td>
											</tr>
				<tr>
												<td width="30%" height="33" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#E2E2E2">
												<font color="#000080" size="2">
												Billing State </font><b>
												<font size="2" color="#FF0000">*</font></b></td>
												<td width="2%" height="33" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#E2E2E2"><b>
												<font size="2" color="#003366">:</font></b></td>
												<td height="33" width="64%" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#E2E2E2">
					<font color="#000080">
					&nbsp;</font></td>
											</tr>
				<tr>
												<td width="30%" height="33" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#E2E2E2">
												<font color="#000080" size="2">
												Billing Zip </font><b>
												<font size="2" color="#FF0000">*</font></b></td>
												<td width="2%" height="33" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#E2E2E2"><b>
												<font size="2" color="#003366">:</font></b></td>
												<td height="33" width="64%" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#E2E2E2">
														<font color="#000080">
														&nbsp;</font></td>
											</tr>
				<tr>
												<td width="30%" height="33" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#E2E2E2">
												<font color="#000080" size="2">
												Billing Country </font><b>
												<font size="2" color="#FF0000">*</font></b></td>
												<td width="2%" height="33" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#E2E2E2"><b>
												<font size="2" color="#003366">:</font></b></td>
												<td height="33" width="64%" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#E2E2E2">
														<font color="#000080">
														&nbsp;</font></td>
											</tr>
				<tr>
												<td width="30%" height="1">&nbsp;</td>
												<td width="2%" height="1"></td>
												<td height="1" width="64%">
														</td>
											</tr>
			</table> </div>
		<div align="center" style="display: block;">

			<table width="40%" height="100" border='1' align="center">
				<tr>
					<td>Parameter Name:</td><td>Parameter Value:</td>
				</tr>
				<tr>
					<td colspan="2"> Compulsory information</td>
				</tr>
				<tr>
					<td>Merchant Id	:</td><td><input type="text" name="merchant_id" value="42089"/></td>
				</tr>
				<tr>
					<td>Order Id	:</td><td><input type="text" name="order_id" value="<?php echo  substr(hash('sha256', mt_rand() . microtime()), 0, 20); ?>"/></td>
				</tr>
				<tr>
					<td>Amount	:</td><td><input type="text" name="amount" value="<?php echo $amt; ?>"/></td>
				</tr>
				<tr>
					<td>Currency	:</td><td><input type="text" name="currency" value="INR"/></td>
				</tr>
				<tr>
					<td>Redirect URL	:</td><td><input type="text" name="redirect_url" value="<?php echo $path; ?>payment/ccavResponseHandler.php"/></td>
				</tr>
			 	<tr>
			 		<td>Cancel URL	:</td><td><input type="text" name="cancel_url" value="<?php echo $path; ?>payment/ccavResponseHandler.php"/></td>
			 	</tr>
			 	<tr>
					<td>Language	:</td><td><input type="text" name="language" value="EN"/></td>
				</tr>
		     	<tr>
		     		<td colspan="2">Billing information(optional):</td>
		     	</tr>
		        <tr>
		        	<td>Billing Name :</td><td><input type="text" name="billing_name" value="<?php echo $mname ; ?>"/></td>
		        </tr>
		        <tr>
		        	<td>Billing Address :</td><td><input type="text" name="billing_address" value="<?php echo $address ; ?>"/></td>
		        </tr>
		        <tr>
		        	<td>Billing City :</td><td><input type="text" name="billing_city" value="<?php echo $city ; ?>"/></td>
		        </tr>
		        <tr>
		        	<td>Billing State :</td><td><input type="text" name="billing_state" value="<?php echo $state ; ?>"/></td>
		        </tr>
		        <tr>
		        	<td>Billing Zip :</td><td><input type="text" name="billing_zip" value="<?php echo $zip ; ?>"/></td>
		        </tr>
		        <tr>
		        	<td>Billing Country :</td><td><input type="text" name="billing_country" value="India"/></td>
		        </tr>
		        <tr>
		        	<td>Billing Tel	:</td><td><input type="text" name="billing_tel" value="<?php echo $mobile; ?>"/></td>
		        </tr>
		        <tr>
		        	<td>Billing Email	:</td><td><input type="text" name="billing_email" value="<?php echo $email; ?>"/></td>
		        </tr>
		        <tr>
		        	<td colspan="2">Shipping information(optional)</td>
		        </tr>
		        <tr>
		        	<td>Shipping Name	:</td><td><input type="text" name="delivery_name" value="Websoft"/></td>
		        </tr>
		        <tr>
		        	<td>Shipping Address	:</td><td><input type="text" name="delivery_address" value="Plot-6 Jawahar Nagar"/></td>
		        </tr>
		        <tr>
		        	<td>shipping City	:</td><td><input type="text" name="delivery_city" value="Kota"/></td>
		        </tr>
		        <tr>
		        	<td>shipping State	:</td><td><input type="text" name="delivery_state" value="Rajasthan"/></td>
		        </tr>
		        <tr>
		        	<td>shipping Zip	:</td><td><input type="text" name="delivery_zip" value="324005"/></td>
		        </tr>
		        <tr>
		        	<td>shipping Country	:</td><td><input type="text" name="delivery_country" value="India"/></td>
		        </tr>
		        <tr>
		        	<td>Shipping Tel	:</td><td><input type="text" name="delivery_tel" value="9595226054"/></td>
		        </tr>
		        <tr>
		        	<td>Merchant Param1	:</td><td><input type="text" name="merchant_param1" value="<?php echo $pid ; ?>"/></td>
		        </tr>
		        <tr>
		        	<td>Merchant Param2	:</td><td><input type="text" name="merchant_param2" value="<?php echo $product ; ?>"/></td>
		        </tr>
				<tr>
					<td>Merchant Param3	:</td><td><input type="text" name="merchant_param3" value="<?php echo $_SESSION['mid'] ; ?>"/></td>
				</tr>
				<tr>
					<td>Merchant Param4	:</td><td><input type="text" name="merchant_param4" value="<?php echo $email; ?>"/></td>
				</tr>
				<tr>
					<td>Merchant Param5	:</td><td><input type="text" name="merchant_param5" value="additional Info."/></td>
				</tr>
				<tr>
					<td>Promo Code	:</td><td><input type="text" name="promo_code" value=""/></td>
				</tr>
				<tr>
					<td>Vault Info.	:</td><td><input type="text" name="customer_identifier" value=""/></td>
				</tr>
		        <tr>
		        	<td></td><td><INPUT TYPE="submit" value="CheckOut"></td>
		        </tr>
	      	</table>
	      &nbsp;</div>
			<table border="0" width="100%" id="table35" style="border-collapse: collapse" height="47">
				<tr>
					<td align="center">&nbsp;</td>
					<td align="left" width="569">
					&nbsp;</td>
				</tr>
			</table>
	      </form>
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
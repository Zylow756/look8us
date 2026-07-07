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

<!--webbot BOT="GeneratedScript" PREVIEW=" " startspan --><script Language="JavaScript" Type="text/javascript"><!--
function FrontPage_Form1_Validator(theForm)
{

  if (theForm.billing_name.value == "")
  {
    alert("Please enter a value for the \"Billing Name\" field.");
    theForm.billing_name.focus();
    return (false);
  }

  if (theForm.billing_address.value == "")
  {
    alert("Please enter a value for the \"Billing Address\" field.");
    theForm.billing_address.focus();
    return (false);
  }

  if (theForm.billing_city.value == "")
  {
    alert("Please enter a value for the \"Billing City\" field.");
    theForm.billing_city.focus();
    return (false);
  }

  if (theForm.billing_state.value == "")
  {
    alert("Please enter a value for the \"Billing State\" field.");
    theForm.billing_state.focus();
    return (false);
  }

  if (theForm.billing_zip.value == "")
  {
    alert("Please enter a value for the \"Billing Zipcode\" field.");
    theForm.billing_zip.focus();
    return (false);
  }

  if (theForm.billing_country.value == "")
  {
    alert("Please enter a value for the \"Billing Country\" field.");
    theForm.billing_country.focus();
    return (false);
  }
  return (true);
}
//--></script><!--webbot BOT="GeneratedScript" endspan --><form method="post" name="FrontPage_Form1" action="ccavRequestHandler.php" onsubmit="return FrontPage_Form1_Validator(this)" language="JavaScript">
		
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
												<b>Billing Address : </b></font>
												<b>
												<font color="#FF0000" size="2">
												Payment Will be Failed Without 
												Proper Billing Information</font></b></td>
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
					&nbsp;<!--webbot bot="Validation" s-display-name="Billing Name" b-value-required="TRUE" --><input type="text" name="billing_name" value="<?php echo $mname ; ?>" size="35"/></font></td>
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
					&nbsp;<!--webbot bot="Validation" s-display-name="Billing Address" b-value-required="TRUE" --><input type="text" name="billing_address" value="<?php echo $address ; ?>" size="35"/></font></td>
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
					&nbsp;<!--webbot bot="Validation" s-display-name="Billing City" b-value-required="TRUE" --><input type="text" name="billing_city" value="<?php echo $city ; ?>" size="35"/></font></td>
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
					&nbsp;<!--webbot bot="Validation" s-display-name="Billing State" b-value-required="TRUE" --><input type="text" name="billing_state" value="<?php echo $state ; ?>" size="35"/></font></td>
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
														&nbsp;<!--webbot bot="Validation" s-display-name="Billing Zipcode" b-value-required="TRUE" --><input type="text" name="billing_zip" value="<?php echo $zip ; ?>" size="35"/></font></td>
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
														&nbsp;<!--webbot bot="Validation" s-display-name="Billing Country" b-value-required="TRUE" --><input type="text" name="billing_country" value="India" size="35"/></font></td>
											</tr>
				<tr>
												<td width="30%" height="1">&nbsp;</td>
												<td width="2%" height="1"></td>
												<td height="1" width="64%">
														</td>
											</tr>
			</table> </div>
		<div align="center" style="display: none;">

			<table width="50%" height="100" border='1' cellspacing="1" style="border-collapse: collapse" bordercolor="#C0C0C0">
				<tr>
					<td width="55%">Parameter Name:</td><td width="42%">Parameter Value:</td>
				</tr>
				<tr>
					<td colspan="2"> Compulsory information</td>
				</tr>
				<tr>
					<td width="55%">Merchant Id	:</td><td width="42%"><input type="text" name="merchant_id" value="42089"/></td>
				</tr>
				<tr>
					<td width="55%">Order Id	:</td><td width="42%"><input type="text" name="order_id" value="<?php echo  substr(hash('sha256', mt_rand() . microtime()), 0, 20); ?>"/></td>
				</tr>
				<tr>
					<td width="55%">Amount	:</td><td width="42%"><input type="text" name="amount" value="<?php echo $amt; ?>"/></td>
				</tr>
				<tr>
					<td width="55%">Currency	:</td><td width="42%"><input type="text" name="currency" value="INR"/></td>
				</tr>
				<tr>
					<td width="55%">Redirect URL	:</td><td width="42%"><input type="text" name="redirect_url" value="<?php echo $path; ?>payment/ccavResponseHandler.php"/></td>
				</tr>
			 	<tr>
			 		<td width="55%">Cancel URL	:</td><td width="42%"><input type="text" name="cancel_url" value="<?php echo $path; ?>payment/ccavResponseHandler.php"/></td>
			 	</tr>
			 	<tr>
					<td width="55%">Language	:</td><td width="42%"><input type="text" name="language" value="EN"/></td>
				</tr>
		     	<tr>
		     		<td colspan="2"><font color="#FF0000" size="2">Billing information(optional):</font></td>
		     	</tr>
		        <tr>
		        	<td width="55%"><b><font color="#0066CC" size="2">Billing Tel	:</font></b></td><td width="42%">
					<input type="text" name="billing_tel" value="<?php echo $mobile; ?>" size="20"/></td>
		        </tr>
		        <tr>
		        	<td width="55%"><b><font color="#0066CC" size="2">Billing Email	:</font></b></td><td width="42%">
					<input type="text" name="billing_email" value="<?php echo $email; ?>" size="20"/></td>
		        </tr>
		        <tr>
		        	<td colspan="2"><font size="2" color="#FF0000">Shipping information(optional)</font></td>
		        </tr>
		        <tr>
		        	<td width="55%">Shipping Name	:</td><td width="42%"><input type="text" name="delivery_name" value="Websoft"/></td>
		        </tr>
		        <tr>
		        	<td width="55%">Shipping Address	:</td><td width="42%"><input type="text" name="delivery_address" value="Plot-6 Jawahar Nagar"/></td>
		        </tr>
		        <tr>
		        	<td width="55%">shipping City	:</td><td width="42%"><input type="text" name="delivery_city" value="Kota"/></td>
		        </tr>
		        <tr>
		        	<td width="55%">shipping State	:</td><td width="42%"><input type="text" name="delivery_state" value="Rajasthan"/></td>
		        </tr>
		        <tr>
		        	<td width="55%">shipping Zip	:</td><td width="42%"><input type="text" name="delivery_zip" value="324005"/></td>
		        </tr>
		        <tr>
		        	<td width="55%">shipping Country	:</td><td width="42%"><input type="text" name="delivery_country" value="India"/></td>
		        </tr>
		        <tr>
		        	<td width="55%">Shipping Tel	:</td><td width="42%"><input type="text" name="delivery_tel" value="935262124"/></td>
		        </tr>
		        <tr>
		        	<td width="55%"><b><font color="#0066CC" size="2">Merchant Param1	: (Product ID)</font></b></td>
					<td width="42%"><font color="#0066CC">
					<input name="merchant_param1" value="<?php echo $pid ; ?>" size="20" style="font-weight: 700"/></font></td>
		        </tr>
		        <tr>
		        	<td width="55%"><b><font color="#0066CC" size="2">Merchant Param2	: (Product Name)</font></b></td>
					<td width="42%"><font color="#0066CC">
					<input name="merchant_param2" value="<?php echo $product ; ?>" size="20" style="font-weight: 700"/></font></td>
		        </tr>
				<tr>
					<td width="55%"><b><font size="2" color="#0066CC">Merchant Param3	: 
					(Member ID)</font></b></td><td width="42%">
					<input type="text" name="merchant_param3" value="<?php echo $_SESSION['mid'] ; ?>" size="20"/></td>
				</tr>
				<tr>
					<td width="55%"><b><font size="2" color="#0066CC">Merchant Param4	: 
					(Email ID)</font></b></td><td width="42%">
					<input type="text" name="merchant_param4" value="<?php echo $email; ?>" size="20"/></td>
				</tr>
				<tr>
					<td width="55%"><font size="2">Merchant Param5	: </font></td><td width="42%">
					<input type="text" name="merchant_param5" value="-" size="20"/></td>
				</tr>
				<tr>
					<td width="55%">Promo Code	:</td><td width="42%"><input type="text" name="promo_code" value=""/></td>
				</tr>
				<tr>
					<td width="55%">Vault Info.	:</td><td width="42%"><input type="text" name="customer_identifier" value=""/></td>
				</tr>
		        <tr>
		        	<td width="55%"></td><td width="42%">&nbsp;</td>
		        </tr>
	      	</table>
	      	</div>
			<table border="0" width="100%" id="table35" style="border-collapse: collapse" height="47">
				<tr>
					<td align="center">&nbsp;</td>
					<td align="left" width="569">
					<INPUT TYPE="submit" value="CheckOut" name="checkout"></td>
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
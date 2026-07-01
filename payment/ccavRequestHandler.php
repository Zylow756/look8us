<html>
<head>
<title>A Non-Seamless-kit</title>
</head>


 <script language="javascript">
setTimeout('document.redirect.submit();',5);
</script>


<body>

<?php 

include("Crypto.php") ;


include("../config.php");

$st="";

if (isset($_POST["checkout"]))
{
if(($_POST['merchant_id']!="")&&($_POST['merchant_param1']!="")&&($_POST['merchant_param3']!=""))
{
$st="insert into payreq values(NULL,'".$_POST['order_id']."','".$_POST['billing_name']."','".$_POST['billing_email']."','".$_POST['billing_tel']."','".$_POST['merchant_param1']."','".$_POST['merchant_param2']."','".$_POST['amount']."','".date("d-m-Y")."','0','0','0','0','0','".$_POST['merchant_param3']."','".$_POST['merchant_param1']."','0')";
mysql_query($st,$con);

}

}
//echo $st;

	error_reporting(0);
	
	$merchant_data='';
	
	
	//$working_key="0AE7D7A1C46823C7ED75295D08D40F94";	 //Shared by CCAVENUES    (http://LOOK8US.COM)
	//$access_code="AVYR02BG07CG94RYGC";	//Shared by CCAVENUES					   (http://LOOK8US.COM)

				  
	$working_key="868E71EFCD3EFBBC591B717F5C958254";	 //Shared by CCAVENUES      (http://www.look8us.com)
	$access_code="AVMP02BH33BR94PMRB";	//Shared by CCAVENUES                       (http://www.look8us.com) 
			      

	foreach ($_POST as $key => $value)
	{
		$merchant_data.=$key.'='.$value.'&';
		//echo $key;
		//echo "<br>";
	}
	
//echo $merchant_data;

//echo "<br>";

$encrypted_data=encrypt($merchant_data,$working_key); // Method for encrypting the data.


//echo $encrypted_data;

//$encrypted_data=$merchant_data;

//http://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction


?>


<form method="post" name="redirect" action="http://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction"> 
<?php
echo "<input type=hidden name=encRequest value=$encrypted_data>";
echo "<input type=hidden name=access_code value=$access_code>";
?>&nbsp;
<INPUT TYPE="hidden" value="CheckOut" name="checkout">
</form>
<script language='javascript'>document.redirect.submit();</script>

</body>
</html>


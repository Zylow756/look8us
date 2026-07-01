<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>New Page 1</title>
</head>

<body>

<p><font color="#FF0000" size="5"><b>Cancel</b></font></p>
<?php 

include("../config.php");

$MERCHANT_KEY = $cMERCHANT_KEY;
$SALT = $cSALT;
$PAYU_BASE_URL = $cPAYU_BASE_URL;


$MERCHANT_KEY = $cMERCHANT_KEY;
$SALT = $cSALT;
$PAYU_BASE_URL = $cPAYU_BASE_URL;


echo $_POST['mihpayid']; 
echo "<br>";

$posted = array();
if(!empty($_POST))
 {
    //print_r($_POST);
  foreach($_POST as $key => $value)
   {
     
    $posted[$key] = htmlentities($value, ENT_QUOTES);
  }
}

/*
foreach ($posted as $key => $value) 
{
    echo "posted[".$key."]=".$value."<br>";
}
*/

//echo $posted;

//====================Claculate Hash==============================================================================
//sha512(key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5||||||<SALT>)
//sha512(<SALT>|status||||||udf5|udf4|udf3|udf2|udf1|email|firstname|productinfo|amount|txnid|key)

$hashr = '';
// Hash Sequence
//$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
$hashSequence = "status|udf10|udf9|udf8|udf7|udf6|udf5|udf4|udf3|udf2|udf1|email|firstname|productinfo|amount|txnid|key";

//$SALT = "3sf0jURk";  // Testing
//$SALT = "fEXll9bP"; //Live

    $hashVarsSeq = explode('|', $hashSequence);
    $hash_string = '';
    foreach($hashVarsSeq as $hash_var)
     {
	 $hash_string .= '|';     
	 $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
     }
    
    $hash_string = $SALT.$hash_string;
    $hashr = strtolower(hash('sha512', $hash_string));

echo "<br>";
//echo $hash_string;
//echo "<br>";

echo $hashr;
echo "<br>";

echo $posted['hash'];
echo "<br>";

echo $SALT;

//echo "<br>";echo "<br>";


if ($hashr==$posted['hash'])
	{
		$st="update payreq set mihpayid='".$posted['mihpayid']."',addedon='".$posted['addedon']."',status='".$posted['status']."',amountr='".$posted['amount']."',emailr='".$posted['email']."' where txnid='".$posted['txnid']."'";
		mysql_query($st,$con);
		
		//echo $st;
		
		header("location: subscribeRefund.php");
		
	}
else
	header("location: subscribeError.php");

?>



</body>

</html>

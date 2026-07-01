<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>New Page 1</title>
</head>
<?php

function add_date($original_date,$d,$m,$y)
{
    $current_date = strtotime($original_date);
    $resultant_date = date('Y-m-d', mktime(0,0,0,date('m',$current_date)+$m,date('d',$current_date)+$d,date('Y',$current_date)+$y));
    return $resultant_date;
}
?>
<body>

<p><b><font size="5" color="#00FF00">Scuuess</font></b></p>
<?php 

include("../config.php");
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
//echo $hashr;
//echo "<br>";echo "<br>";
//echo $posted['hash'];

if ($hashr==$posted['hash'])
{
	
	$st="insert into payrec values(NULL,'".$posted['mihpayid']."','".$posted['addedon']."','".$posted['status']."','".$_POST['txnid']."','".$posted['email']."','".$posted['firstname']."','".$posted['phone']."','".$posted['amount']."','".$posted['productinfo']."','".$posted['mode']."','".date("d-m-Y")."',".$posted['udf1'].",'0','0',".$posted['udf2'].")";
	mysql_query($st,$con);
	echo $st;
	
	$st="update payreq set mihpayid='".$posted['mihpayid']."',addedon='".$posted['addedon']."',status='".$posted['status']."',amountr='".$posted['amount']."',emailr='".$posted['email']."' where txnid='".$posted['txnid']."'";
	mysql_query($st,$con);
	
	//
		
	

	//========================================================================================
	if ($posted['udf2']==1)
	 $d=365;		
	else if ($posted['udf2']==2)
	 $d=365;		
	else if ($posted['udf2']==3)
	 $d=90;		
			
			
	$ag1=$posted['addedon'];
	
	$ag2=add_date($ag1, $d,"0","0");

	$st="update member set mplan='".$posted['productinfo']."', mdate='".$posted['addedon']."', x='".date("d-m-Y")."', z='".$ag2."',expdate='".$ag2."'  where mid=".$posted['udf1'];
	mysql_query($st,$con);

	
				header("location: subscribeSuccess.php?flag=1");
		

  //====================================================================================


}

?>



</body>

</html>

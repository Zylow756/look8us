<?php
require_once __DIR__ . "/../config.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function add_date($original_date,$d,$m,$y)
{
    $current_date = strtotime($original_date);
    $resultant_date = date('Y-m-d', mktime(0,0,0,date('m',$current_date)+$m,date('d',$current_date)+$d,date('Y',$current_date)+$y));
    return $resultant_date;
}

 include('Crypto.php');


	error_reporting(0);
	
	$workingKey='868E71EFCD3EFBBC591B717F5C958254';		//Working Key should be provided here.

	

	$encResponse=$_POST["encResp"];			//This is the response sent by the CCAvenue Server
	$rcvdString=decrypt($encResponse,$workingKey);		//Crypto Decryption used as per the specified working key.
	$order_status="";
	$decryptValues=explode('&', $rcvdString);
	$dataSize=sizeof($decryptValues);
	echo "<center>";

	for($i = 0; $i < $dataSize; $i++) 
	{
		$information=explode('=',$decryptValues[$i]);
		
		if($i==3)	$order_status=$information[1];
		if($i==0)	$order_id =$information[1];
		if($i==1)	$tracking_id = $information[1];
		if($i==10)	$amount = $information[1];
		
		if($i==18)	$billing_email=$information[1];
		if($i==11)	$billing_name=$information[1];
		if($i==17)	$billing_tel=$information[1];
		
		if($i==27)	$merchant_param2=$information[1];  // product 
		if($i==5)	$payment_mode=$information[1];
		if($i==28)	$merchant_param3=$information[1];  //member id
		if($i==26)	$merchant_param1=$information[1];		// product  id
	}

	if($order_status==="Success")
	{
				
				// echo "<br>Thank you for shopping with us. Your credit card has been charged and your transaction is successful. We will be shipping your order to you soon.";
					
				$st="insert into payrec values(NULL,'".$tracking_id."','".date(d-M-Y)."','".$order_status."','".$order_id."','".$billing_email."','".$billing_name."','".$billing_tel."','".$amount."','".$merchant_param2."','".$payment_mode."','".date("d-m-Y")."',".$merchant_param3.",'0','0',".$merchant_param1.")";
				mysqli_query($con,$st);
			
				//echo $st;
				
				$st="update payreq set mihpayid='".$tracking_id."',addedon='".date(d-M-Y)."',status='".$order_status."',amountr='".$amount."',emailr='".$billing_email."' where txnid='".$order_id."'";
				mysqli_query($con,$st);
				
				//echo $st;
			
			//===============Update plan=========================================================================
		
					if ($merchant_param1==1)
					 $d=365;		
					else if ($merchant_param1==2)
					 $d=365;		
					else if ($merchant_param1==3)
					 $d=90;		
							
							
					$ag1=date("Y-m-d");
					$ag2=add_date($ag1, $d,"0","0");
				
					$st="update member set mplan='".$merchant_param2."', mdate='".$ag1."', x='".date("d-m-Y")."', z='".$ag2."',expdate='".$ag2."'  where mid=".$merchant_param3;
					mysqli_query($con,$st);
					
					//echo $st;
			//========================================================================================
			
			 header("location: subscribeSuccess.php?flag=1");

	}
	
	else if($order_status==="Aborted")
		{
			$st="update payreq set mihpayid='".$tracking_id."',addedon='".date(d-M-Y)."',status='".$order_status."',amountr='".$amount."',emailr='".$billing_email."' where txnid='".$order_id."'";
			mysqli_query($con,$st);
			
			header("location: subscribeError.php");
			//	echo "<br>Thank you for shopping with us.We will keep you posted regarding the status of your order through e-mail";
			
		}
	else if($order_status==="Failure")
		{
			$st="update payreq set mihpayid='".$tracking_id."',addedon='".date(d-M-Y)."',status='".$order_status."',amountr='".$amount."',emailr='".$billing_email."' where txnid='".$order_id."'";
			mysqli_query($con,$st);
			
			header("location: subscribeError.php");
		   //		echo "<br>Thank you for shopping with us.However,the transaction has been declined.";
		}
	else
		{
			header("location: subscribeError.php");
		//	echo "<br>Security Error. Illegal access detected";
		
	}

	echo "<br><br>";

	echo "<table cellspacing=4 cellpadding=4>";
	for($i = 0; $i < $dataSize; $i++) 
	{
		$information=explode('=',$decryptValues[$i]);
	    	echo '<tr><td>'.$information[0].'</td><td>'.$information[1].'</td></tr>';
	}

	echo "</table><br>";
	echo "</center>";
	
	
?>

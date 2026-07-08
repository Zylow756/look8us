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
 
 if (isset($_GET['user']))
 {
 $_SESSION['user']=$_GET['user'];
$_SESSION['mtyp']=$_GET['mtyp'];
$_SESSION['mid']=$_GET['mid'];
$_SESSION['mplan']=$_GET['mplan'];


 
 }
 elseif(isset($_POST['submit']))
	{

			$pass=base64_encode($_POST['t2']);
					
			$ty=$_POST['t1'];
			$t=substr($ty,0,1);
			//echo $t;
				
			 
			 	$s="select * from member  where (uname='".$_POST['t1']."' or email='".$_POST['t1']."') and pass='".$pass."' and mstatus=0" ;
				$r=mysqli_query($con,$s);
if (!$r) {
    die(mysqli_error($con));
}
        		// echo $s;
					if ($row=mysqli_fetch_assoc($r))
						{
									if( ((strtoupper($row['uname'])==strtoupper($_POST['t1'])) or (strtoupper($row['email'])==strtoupper($_POST['t1']))) and ($pass==$row['pass']) )
									{
										$_SESSION['user']=$_POST['t1'];
										$_SESSION['mtyp']=$row['mtyp'];
										$_SESSION['mid']=$row['mid'];
										$_SESSION['mplan']=$row['mplan'];
					
							
									}
									else
									{
											$_SESSION['user']="";
											$_SESSION['mtyp']="";
											$_SESSION['mid']=0;
											$_SESSION['mplan']="";
													
											//header("location: index.php?r=0");
									}
							}
						
						else
							{ 
									//$res="Invalid User Name OR Password";
									$_SESSION['user']="";
									$_SESSION['mtyp']="";
									$_SESSION['mid']=0;
									$_SESSION['mplan']="";
									
									header("location: login.php?r=0");
						
							}

	//echo $s;
	
	}
	else
	{
		if ($_SESSION['user']=="")
		{ 
		  header("location: login.php?r=0");
		 }
	
	}
	?>
	
<body >

<div align="center">
	<table border="0" width="980" id="table1" style="border-collapse: collapse" bordercolor="#E2E2E2" cellpadding="0">
		<tr>
			<td height="50" align="center" valign="top">	<?php  require_once "../header.php"; ?>		</td>
		</tr>
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
					&nbsp;<p>&nbsp;</p>
					<table border="0" width="70%" id="table3" cellpadding="0" style="border-collapse: collapse" bordercolor="#697779" height="128">
						<tr>
							<td bgcolor="#005CB9" align="center">
							&nbsp;<p><font size="4" color="#FFFFFF"><b>Welcome at 
							Member Area<br>
&nbsp;</b></font></p>
							
												
							<?php 
		 $st="Select * from member where mid=".$_SESSION["mid"];
		 		 $result1=mysqli_query($con,$st);
if (!$result1) {
    die(mysqli_error($con));
}
		if ($row=mysqli_fetch_assoc($result1))
			{
			?>

							<table border="1" width="80%" id="table4" style="border-collapse: collapse" bordercolor="#003366" bgcolor="#E5E5E5">
								<tr>
									<td width="199" height="25">&nbsp;<b><font size="2" color="#003366">User ID
									</font></b> </td>
									<td height="25">&nbsp;<font color="#FF0000" size="2"><?php echo htmlspecialchars($row["uname"]); ?></font></td>
								</tr>
								<tr>
									<td width="199" height="25"><b>
									<font size="2" color="#003366">&nbsp;Your 
									Membership 
									Plan</font></b></td>
									<td height="25"><b>
									<font color="#FF0000" size="2">&nbsp;<?php echo htmlspecialchars($row["mplan"]); ?></font></b></td>
								</tr>
								<tr>
									<td width="199" height="25"><b>
									<font size="2" color="#003366">&nbsp;Plan 
									Start Date</font></b></td>
									<td height="25"><b>
									<font color="#FF0000" size="2">&nbsp;<?php echo htmlspecialchars($row["x"]); ?></font></b></td>
								</tr>
								<tr>
									<td width="199" height="25">
									<font color="#003366">&nbsp;</font><b><font size="2" color="#003366">Plan 
									Expiry Date</font></b></td>
									<td height="25"> <b>
									<font color="#FF0000" size="2">&nbsp;<?php 
							if ($row["z"]<>"-")
							{		
		$current_date = strtotime($row["z"]);
		 $resultant_date = date('d-m-Y', mktime(0,0,0,date('m',$current_date),date('d',$current_date),date('Y',$current_date)));

									echo $resultant_date; 
									$d=date("Y-m-d");
									if ($row["z"]< $d)
									 echo "expired";
									}
									else
									echo "-";
									?>
									
									 
									
									</font></b></td>
								</tr>
							</table>
							
							<?php
							if ( $row["mplan"]=="Demo")
							{
							?>
<form action="payment.php">
	<br>
	<input class="subbox" type="submit" value="Make Payment" name="submit1"></form>						
								<?php
								}
								
								
								}
								?>


							<p>&nbsp;</p>
							<p>&nbsp;</td>
						</tr>
					</table>
					<p>&nbsp;</p>
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
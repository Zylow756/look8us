<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Online Directory : Admin Panel</title>
 <link rel="stylesheet" type="text/css" href="../akc.css" />

<style type="text/css"> 

body
{
background-image:url('img/bg.png');
background-repeat:repeat-x;
background-color: #70828F
} 
</style>

</head>

<?php
session_start();
include("../config.php"); 

$msg=0;
			

				

?>


	
<body >

<div align="center">
	<table border="0" width="980" id="table1" style="border-collapse: collapse" bordercolor="#E2E2E2" cellpadding="0">
		<tr>
			<td height="50" align="center" valign="top">	<?php  include("../header.php"); ?>		</td>		</tr>
		<tr>
			<td height="12" align="center" valign="top" bgcolor="#697779">			
					</td>
		</tr>
		<tr>
			<td>
			<table border="0" width="100%" id="table2" style="border-collapse: collapse" bordercolor="#CCCCCC" height="206" cellpadding="0">
				<tr>
					<td width="228" valign="top" bgcolor="#E3E3E3">			<?php include("sidemenu.php"); ?></td>
					<td align="center" valign="top" bgcolor="#FFFFFF">
					<h1><font size="2">&nbsp;</font>&nbsp;View Payment History</h1>
					<table border="0" width="100%" id="table35" cellpadding="0" style="border-collapse: collapse" >
								<tr>
									
									<td align="right" valign="top" height="400">
									<div align="center">
									


<form name="frmhlp" id="frmhlp" method="post" action="paymenthistory.php" >

<table border="0" width="100%" id="table37" height="40">
	<tr>
		<td width="254">&nbsp;&nbsp; <font size="2"> <b>Payment Status </b>(Last 
		50 Transaction)</font></td>
		<td width="110">
	
<select name="mid" class="selbox1" >

	<option value="success" <?php if (isset($_POST['mid'])) if($_POST['mid']=='success') echo 'selected'; ?>  >Success</option>
	
	<option value="failure" <?php if (isset($_POST['mid'])) if($_POST['mid']=='failure') echo 'selected'; ?>  >Failure</option>
	<option value="All" <?php if (isset($_POST['mid'])) if($_POST['mid']=='All') echo 'selected'; ?>  >ALL</option>

					</select></td>
		<td>
	<input  class="submit1" type="submit" value="Show" name="submit"/></td>
	</tr>
</table>

</form>
<table class="table2"  border="1" width="96%" id="table36">
								<tr>
									<td bgcolor="#E0E2FE" width="121"><b>&nbsp;Member 
									Name</b></td>
									<td bgcolor="#E0E2FE" width="121"><b>&nbsp;Company 
									Name</b></td>
									<td bgcolor="#E0E2FE" width="121"><b>&nbsp;Payment 
									Date</b></td>
									<td bgcolor="#E0E2FE" width="85"><b>&nbsp;Status</b></td>
									<td bgcolor="#E0E2FE" width="109"><b>&nbsp;Amount</b></td>
									<td bgcolor="#E0E2FE" width="118"><b>&nbsp;Payment 
									for Plan </b></td>
									<td bgcolor="#E0E2FE" width="134">&nbsp;<b>Transfer 
									ID</b></td>
								</tr>
								
							<?php 
		 
 	if (!isset($_POST["mid"]))
 	 {
 		 $st="Select distinct(txnid),mname,compname,rdate,status,amount,productinfo from payreq,member where member.email=payreq.email  order by payid desc limit 100";
 	 }
 	else
 	{
 	
 	if ($_POST["mid"]=="All")
 		$st="Select distinct(txnid),mname,compname,rdate,status,amount,productinfo from payreq,member where member.email=payreq.email  order by payid desc limit 100";		 
    else
	    $st="Select distinct(txnid),mname,compname,rdate,status,amount,productinfo from payreq,member where status='".$_POST["mid"]."' and member.email=payreq.email  order by payid desc limit 100";		 
    
    }
		 $result=mysql_query($st,$con);
		while ($row=mysql_fetch_array($result))
			{
			?>
								<tr>
									<td width="121">&nbsp;<?php echo $row["mname"]; ?></td>
									<td width="121">&nbsp;<?php echo $row["compname"]; ?> </td>
									<td width="121">&nbsp;&nbsp;<?php echo $row["rdate"]; ?></td>
									<td width="85">&nbsp;<?php echo $row["status"]; ?></td>
									<td width="109">&nbsp;<?php echo $row["amount"]; ?></td>
									<td width="118">&nbsp;<?php echo $row["productinfo"]; ?></td>
									<td width="134">&nbsp;<?php echo $row["txnid"]; ?></td>
								</tr>
								
								<?php
								}
								?>

								

							</table></div>
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
			<td height="57" align="center" valign="top">			<?php  include("../footer.php"); ?></td>
		</tr>
	</table>
</div>

</body>

</html>
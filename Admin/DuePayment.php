<?php

session_start();


if ( isset($_SESSION['user']))
 {
   if($_SESSION['user']=="") 
 	header("location: index.php?r=0"); 
 }
else
 		header("location: index.php?r=0"); 

  
 ?>
 
 
 
 
 <html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Online Directory : Admin Panel</title>
 <link rel="stylesheet" type="text/css" href="../akc.css" />
  
  <SCRIPT LANGUAGE="JavaScript" SRC="../CalendarPopup.js"></SCRIPT>
	<SCRIPT LANGUAGE="JavaScript">
	var cal = new CalendarPopup();
	</SCRIPT>
	
	
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
					<h1><font size="2">&nbsp;</font>&nbsp;View Dues Payment 
					Status</h1>
					<table border="0" width="100%" id="table35" cellpadding="0" style="border-collapse: collapse" >
								<tr>
									
									<td align="right" valign="top" height="400">
									<div align="center">
									
<form name="example" id="example" method="post" action="duepayment.php" >

<table border="0" width="100%" id="table37" height="40">
	<tr>
		<td width="130">&nbsp;&nbsp; <font size="2"><b>Expiry&nbsp; From</b></font></td>
		<td width="169">
	
	<INPUT TYPE="text" NAME="tdate" VALUE="<?php if (isset($_POST['tdate'])){ if ($_POST['tdate']<>'') echo $_POST['tdate']; else echo date('d-m-Y'); } else echo date('d-m-Y'); ?>" size="17"  >
<A HREF="#" onClick="cal.select(document.forms['example'].tdate,'anchor1','dd-MM-yyyy'); return false;"  NAME="anchor1" ID="anchor1">
	<img src="cal.gif" width="16" height="16" border="0" alt="Pick a date"></A>&nbsp;&nbsp; </td>
		<td width="54">
	
&nbsp;<b><font size="2">&nbsp;&nbsp; to</font></b></td>
		<td width="204">
	
	<INPUT TYPE="text" NAME="tdate0" VALUE="<?php if (isset($_POST['tdate0'])){ if ($_POST['tdate0']<>'') echo $_POST['tdate0']; else echo date('d-m-Y'); } else echo date('d-m-Y'); ?>" size="17"  >
<A HREF="#" onClick="cal.select(document.forms['example'].tdate0,'anchor2','dd-MM-yyyy'); return false;"  NAME="anchor2" ID="anchor2">
	<img src="cal.gif" width="16" height="16" border="0" alt="Pick a date"></A></td>
		<td>
	<input  class="submit1" type="submit" value="Show" name="submit"/></td>
	</tr>
</table>

</form>
<table class="table2"  border="1" width="96%" id="table36">
								<tr>
									<td bgcolor="#E0E2FE" width="109"><b>&nbsp;Member 
									Name</b></td>
									<td bgcolor="#E0E2FE" width="134">&nbsp;<b>Company 
									Name</b></td>
									<td bgcolor="#E0E2FE" width="134">&nbsp;<b>Mobile</b></td>
									<td bgcolor="#E0E2FE" width="118"><b>&nbsp; Plan </b></td>
									<td bgcolor="#E0E2FE" width="121"><b>&nbsp;Plan 
									Start&nbsp; 
									Date</b></td>
									<td bgcolor="#E0E2FE" width="85"><b>&nbsp;Expiry 
									Date</b></td>
								</tr>
								
							<?php 
							
			if (isset($_POST["tdate"]))
			{
			 $current_date = strtotime($_POST["tdate"]);
   			 $fr = date('Y-m-d', mktime(0,0,0,date('m',$current_date),date('d',$current_date),date('Y',$current_date)));
			
			$current_date = strtotime($_POST["tdate0"]);
   			 $to = date('Y-m-d', mktime(0,0,0,date('m',$current_date),date('d',$current_date),date('Y',$current_date)));


				
		 $st="Select * from member where expdate>='".$fr."' and expdate<='".$to."'  order by expdate ";
		 		 $result=mysql_query($st,$con);
		 		// echo $st;
		while ($row=mysql_fetch_array($result))
			{
			?>
								<tr>
									<td width="109">&nbsp;<?php echo $row["mname"]; ?></td>
									<td width="134">&nbsp;<?php echo $row["compname"]; ?></td>
									<td width="134">&nbsp;<?php echo $row["mobile"]; ?></td>
									<td width="118">&nbsp;<?php echo $row["mplan"]; ?></td>
									<td width="121">&nbsp;&nbsp;<?php echo $row["x"]; ?></td>
									<td width="85">&nbsp;<?php 
									$current_date = strtotime($row["z"]);
		 $resultant_date = date('d-m-Y', mktime(0,0,0,date('m',$current_date),date('d',$current_date),date('Y',$current_date)));
echo $resultant_date; 
 ?></td>
								</tr>
								
								<?php
								}
								
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


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
background-color: #70828F;;
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
					<td width="228" valign="top" bgcolor="#EEEEEE">			<?php if ($_SESSION["id"]!="") include("sidemenu.php"); ?></td>
					<td align="center" valign="top" bgcolor="#FFFFFF">
					<h1>View All Feedback &amp; Enquiry<br>
&nbsp;</h1>
				

<form name="frmhlp" id="frmhlp" method="post" action="viewenquiry.php" >

					
					
					
					
					<table class="table2"  width="94%" id="table3" border="1"    >
								<tr>
									<td bgcolor="#D2D2D2" width="5%">&nbsp;SNO.</td>
									<td bgcolor="#D2D2D2" width="10%" style="text-align: center">
									Date</td>
									<td bgcolor="#D2D2D2" width="17%">&nbsp; Name</td>
									<td bgcolor="#D2D2D2" width="13%">&nbsp;Mobile</td>
									<td bgcolor="#D2D2D2" width="14%" style="text-align: left">
									&nbsp;Email</td>
									<td bgcolor="#D2D2D2" width="8%" style="text-align: left">
									&nbsp;City</td>
									<td bgcolor="#D2D2D2" width="30%" style="text-align: left">
									&nbsp;Message</td>
								</tr>
			<?php						

$st="Select * from feedback order by fid DESC limit 50";

//echo $st;
$i=1;
$result=mysql_query($st,$con);

	while ($row=mysql_fetch_array($result))
	{	
	
	?>
				
								<tr>
									<td height="29" width="5%" style="text-align: center">&nbsp;<?php echo $i; ?></td>
									<td height="29" width="10%" style="text-align: center">&nbsp;<?php echo $row["fdate"]; ?></td>
									<td height="29" width="17%">&nbsp;<?php echo $row["fname"]; ?></td>
									<td height="29" width="13%">&nbsp;<?php echo $row["mobile"]; ?></td>
									<td height="29" width="14%" style="text-align: left">&nbsp;<?php 	echo $row["email"];  ?></td>
									<td height="29" width="8%" style="text-align: left">&nbsp;<?php echo $row["city"]; ?></td>
									<td height="29" width="30%" style="text-align: left">&nbsp;<?php echo $row["msg"]; ?></td>
								</tr>
								
								<?php
								$i=$i+1;

								}
								
								
								?>
							</table>
							
							
					</form>
					</td>
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
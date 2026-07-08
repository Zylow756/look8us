<?php
require_once __DIR__ . "/../config.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (empty($_SESSION['user'])) {
    header("Location: index.php?r=0");
    exit;
}

if (isset($_SESSION['user']))
 {	if ($_SESSION['user']=="")
		  header("location: login.php?r=0");
 }
else
 	 header("location: login.php?r=0");
	
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
<body >

<div align="center">
	<table border="0" width="980" id="table1" style="border-collapse: collapse" bordercolor="#E2E2E2" cellpadding="0">
		<tr>
			<td height="50" align="center" valign="top">	<?php  require_once "../header.php"; ?>		</td>		</tr>
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
					<h1>&nbsp;View Enquiry<br>
&nbsp;</h1>
					
					<table class="table2"  width="94%" id="table5" border="1"    >
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

$st="Select * from enquiry where mid=".$_SESSION['mid']." order by qid DESC";

//echo $st;
$i=1;
$result=mysqli_query($con,$st);
if (!$result) {
    die(mysqli_error($con));
}

	while ($row=mysqli_fetch_assoc($result))
	{	
	
	?>
				
								<tr>
									<td height="29" width="5%" style="text-align: center">&nbsp;<?php echo $i; ?></td>
									<td height="29" width="10%" style="text-align: center">&nbsp;<?php echo htmlspecialchars($row["qdate"]); ?></td>
									<td height="29" width="17%">&nbsp;<?php echo htmlspecialchars($row["qname"]); ?></td>
									<td height="29" width="13%">&nbsp;<?php echo htmlspecialchars($row["mobile"]); ?></td>
									<td height="29" width="14%" style="text-align: left">&nbsp;<?php 	echo htmlspecialchars($row["email"]);  ?></td>
									<td height="29" width="8%" style="text-align: left">&nbsp;<?php echo htmlspecialchars($row["city"]); ?></td>
									<td height="29" width="30%" style="text-align: left">&nbsp;<?php echo htmlspecialchars($row["query"]); ?></td>
								</tr>
								
								<?php
								$i=$i+1;

								}
								
								
								?>
							</table>
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
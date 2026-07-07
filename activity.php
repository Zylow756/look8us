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
<title>Look8US :Business Directory Kota, Rajasthan , India, Online Business Directory Kota,  Yellow Pages  kota Rajasthan , Trusted & Verified Businesses, Exporters, Manufacturers, Suppliers Directory, B2B Business Directory </title>
<meta name="description" content="Look8us.com from Kota Rajasthan is Your local Business Directory , yellow pages  Business Directory. Business Details, Contacts, Products, Services & Verified Businesses, Exporters, Manufacturers, Suppliers Directory">
<meta name="keywords" content=" Look8us.com , yellow pages Kota Rajasthan , business directory Kota Rajasthan india,business search engine, indian business directory, online business directory, Indian manufacturers, suppliers, Indian exporters directory, b2b portal, b2b business directory,manufacturer, importers, traders, dealers, buyers, ">
 <link rel="stylesheet" type="text/css" href="akc.css" />

</head>

<body topmargin="0" leftmargin="0" rightmargin="0" bottommargin="2" background="images/bg.png">


<div align="center">
<?php require_once "header.php"; ?>
<table border="0" width="100%" height="100" cellpadding="0" style="border-collapse: collapse">
	<tr>
		<td bgcolor="#D2D2D2">
		<div align="center">
			<table border="0" width="1010" id="table33" style="border-collapse: collapse" height="40" cellpadding="0">
				<tr>
					<td><font size="6">&nbsp;</font><font color="#333333" size="5">Event 
					&amp; Activity </font></td>
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
							<table border="0" width="100%" id="table10" cellpadding="0" style="border-collapse: collapse" height="415" >
								<tr>
									
									<td align="left" valign="top">
									
									&nbsp;<div align="center">
								<table class="table2"  border="1" width="96%" id="table34">
								<tr>
									<td bgcolor="#E0E2FE" >&nbsp;<b>SNO</b></td>
									<td bgcolor="#E0E2FE" ><b>&nbsp;Date</b></td>
									<td bgcolor="#E0E2FE" ><b>&nbsp;Activity 
									information</b></td>
									<td bgcolor="#E0E2FE" ><b>&nbsp;View Detail</b></td>
								</tr>
								
							<?php 
		 $st="Select * from activity  order by edate1 limit 100" ;
		 		 $result=mysqli_query($con,$st);

if (!$result) {
    die(mysqli_error($con));
}
		 		 $i=1;
		while ($row=mysqli_fetch_assoc($result))
			{
			?>
								<tr>
									<td width="29">&nbsp;<?php echo $i; ?></td>
									<td width="94">&nbsp;<?php echo htmlspecialchars($row["edate"]); ?></td>
									<td width="673">&nbsp;&nbsp;<?php echo htmlspecialchars($row["eventhead"]); ?></td>
									<td width="96">&nbsp;<?php echo "<a class='a5' href='viewActivity.php?id=".$row['eid']."'>View</a>"; ?></td>
								</tr>
								
								<?php
								$i=$i+1;
								}
								?>

								

							</table></div>
									</td>
								</tr>
								<tr>
									
									<td align="left" valign="top">
									
									&nbsp;</td>
								</tr>
								<tr>
									
									<td align="left" valign="top">
									
									&nbsp;</td>
								</tr>
								<tr>
									
									<td align="left" valign="top">
									
									&nbsp;</td>
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
	<?php require_once "footer.php"; ?>
</div>

</body>

</html>
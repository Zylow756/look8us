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
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1&appId=1403091889904611";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>




<div align="center">
<?php require_once "header.php"; ?>
<table border="0" width="100%" height="100" cellpadding="0" style="border-collapse: collapse">
	<tr>
		<td bgcolor="#D2D2D2">
		<div align="center">
			<table border="0" width="1010" id="table33" style="border-collapse: collapse" height="40" cellpadding="0">
				<tr>
					<td><font size="6">&nbsp;</font><font color="#333333" size="5">Search 
					by Category </font></td>
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
							<table border="0" width="100%" id="table10" cellpadding="0" style="border-collapse: collapse" height="384" >
								<tr>
									
									<td align="right" valign="top">
									<p align="left" class="p1" style="text-align: justify">
									<p align="left" class="p1">&nbsp;</p>
									<table border="0" width="96%" id="table34" style="border-collapse: collapse">
											<tr>
												<td><form action="Search.php" method="get">
					
					<table border="1" width="96%" id="table6" style="border-collapse: collapse" bordercolor="#F4F4F4" height="47">
						<tr>
							<td height="47" bgcolor="#F4F4F4" width="148">
							<font size="2">&nbsp;Enter Category/Product </font></td>
							<td height="47" bgcolor="#F4F4F4">
	<input type="text" class="txtbox" id="q" size="38" name="q" value='<?php if (isset($_GET["q"])){ $q = $_GET["q"] ?? '';} ?>' >&nbsp; 
	<input type="submit" name="submit1" style="width: 100px; height: 26" id="submit1" value="Search" ></td>
						</tr>
						</table>
				
<br>	<?php						

if (isset($_GET["q"]))
{

?>

	<table class="table2"  width="96%" id="table5" border="1"    >
								<tr>
									<td bgcolor="#D2D2D2" width="4%">&nbsp;SNO.</td>
									<td bgcolor="#D2D2D2" width="95%">&nbsp;Category Name</td>
								</tr>
			<?php						

	$st="Select * from category,catedetail where category.cateid=catedetail.cateid and cdname like '%".$_GET["q"]."%' order by cdname";

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
									<td height="29" width="4%">&nbsp;<?php echo $i; ?></td>
									<td height="29" width="95%">&nbsp;<?php echo htmlspecialchars($row["cdname"]); ?></td>
								</tr>
								
								<?php
								$i=$i+1;

								}
								
								
								?>
							</table>
							
							
							<?php
							}
							
							?>
							
							</form></td>
											</tr>
										</table></td>
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
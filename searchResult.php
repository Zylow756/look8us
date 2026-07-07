<?php
require_once "config.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (empty($_SESSION['user'])) {
    header("Location: index.php?r=0");
    exit;
}

if (isset($_POST["sea"]))
{
 if ($_POST["sea"]=="1")
 	{echo "x";
 		 header("location: searchResult2.php?item=".$_POST["item"]."&loc=".$_POST["loc"]);
 		// header("location: login.php?r=0");
 	 }
//echo "a";
}
?>

<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta charset="UTF-8">
<title>Online Directory Service</title>
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
					
					<br>	

	<table class="table2"  width="96%" id="table5" border="0"    >
								<tr>
									<td bgcolor="#D2D2D2" width="99%" style="text-align: left" colspan="2" height="35">
									
									&nbsp;<b><font size="2">Refine your search by 
									clicking any of the links below
									</font></b>
									</td>
								</tr>
			<?php						

if (isset($_POST["item"]))
	$st="Select * from category,catedetail where category.cateid=catedetail.cateid and cdname like '%".$_POST["item"]."%' order by cdname";

elseif (isset($_GET["id"]))
	$st="Select * from category,catedetail where category.cateid=catedetail.cateid and catedetail.cateid=".$_GET["id"]." order by cdname";
else
	$st="Select * from category,catedetail where category.cateid=catedetail.cateid order by cdname";
	

	//$st="Select * from category,catedetail where category.cateid=catedetail.cateid and cdname like '%".$_POST["item"]."%' and  order by cdname";

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
									<td height="29" width="4%" style="text-align: center; border-left-width:1px; border-right-width:1px; border-top-width:1px; border-bottom-style:dotted; border-bottom-width:1px" bordercolor="#E3E3E3">&nbsp;<?php echo $i; ?></td>
									<td height="29" width="95%" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#E3E3E3">&nbsp;
									<?php echo "<a class='a1' href='searchresult1.php?id=".$row['catdid']."'>".$row["cdname"]."</a>"; ?>
									
	<?php
									
$st="Select * from memberdetail where catdid =".$row['catdid'];
$result1=mysqli_query($con,$st);
if (!$result1) {
    die(mysqli_error($con));
}

$ns = mysqli_num_rows($result1);
echo "(".$ns.")";
	?>
				
									
									</td>
								</tr>
								
								<?php
								$i=$i+1;

								}
								
								
								
								?>
							</table>
							
							
							
							
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
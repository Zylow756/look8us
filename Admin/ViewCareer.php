

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
			
if ( isset($_GET['id']))
{

$s="delete from cv where rid=".$_GET["id"];
mysql_query($s,$con);

$msg=2;

}

				

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
					<h1>View CV Received</h1>
					
					</p>
					<p><?php if ($msg==2) echo "<h3>CV Delete </h3>" ;  ?>

</p>

					<p>&nbsp;
					<table class="table2"  width="94%" id="table5" border="1"    >
								<tr>
									<td bgcolor="#D2D2D2" width="5%">&nbsp;SNO.</td>
									<td bgcolor="#D2D2D2" width="20%">&nbsp;Applicant Name</td>
									<td bgcolor="#D2D2D2" width="11%">&nbsp;Mobile</td>
									<td bgcolor="#D2D2D2" width="9%" style="text-align: center">
									Email</td>
									<td bgcolor="#D2D2D2" width="9%" style="text-align: center">
									Position</td>
									<td bgcolor="#D2D2D2" width="8%" style="text-align: center">
									City</td>
									<td bgcolor="#D2D2D2" width="10%" style="text-align: center">
									Qualification</td>
									<td bgcolor="#D2D2D2" width="11%" style="text-align: center">
									Experience</td>
									<td bgcolor="#D2D2D2" width="7%" style="text-align: center">
									Date</td>
									<td bgcolor="#D2D2D2" width="3%" style="text-align: center">
									View</td>
									<td bgcolor="#D2D2D2" width="3%" style="text-align: center">
									Delete</td>
								</tr>
			<?php						

$st="Select * from cv order by rid DESC";

//echo $st;
$i=1;
$result=mysql_query($st,$con);

	while ($row=mysql_fetch_array($result))
	{	
	
	?>
				
								<tr>
									<td height="29" width="5%">&nbsp;<?php echo $i; ?></td>
									<td height="29" width="20%">&nbsp;<?php echo $row["rname"]; ?></td>
									<td height="29" width="11%">&nbsp;<?php echo $row["mobile"]; ?></td>
									<td height="29" width="9%" style="text-align: center">&nbsp;<?php 	echo $row["email"];  ?></td>
									<td height="29" width="9%" style="text-align: center">&nbsp;<?php echo $row["post"]; ?></td>
									<td height="29" width="8%" style="text-align: center">&nbsp;<?php echo $row["city"]; ?></td>
									<td height="29" width="10%" style="text-align: center">&nbsp;<?php echo $row["qual"]; ?></td>
									<td height="29" width="11%" style="text-align: center">&nbsp;<?php echo $row["expr"]; ?></td>
									<td height="29" width="7%" style="text-align: center">&nbsp;<?php echo $row["cdate"]; ?></td>
									<td height="29" width="3%" style="text-align: center">&nbsp;
									<?php echo "<a class='a2' href='../user/logo/".$row['cv']."'>CV</a>"; ?>									</td>
									<td height="29" width="3%" style="text-align: center">&nbsp;
				<?php
			echo "<a class='a2' href='ViewCareer.php?id=".$row['rid']."'>Del</a>";  
			?>
									</td>
								</tr>
								
								<?php
								$i=$i+1;

								}
								
								
								?>
							</table>
					
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
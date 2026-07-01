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
include("../config.php"); 

$msg=0;
			
if ( (isset( $_GET["id"]))&&(isset( $_GET["st"])))
{
$s="update member  set mstatus=".$_GET["st"]." where mid=".$_GET["id"] ;
mysql_query($s,$con);
//echo $s;
$msg=1;
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
					<h1>View Member Plan &amp; Rating</h1>
					
					</p>
					<p>&nbsp;
					<table class="table2"  width="94%" id="table5" border="1"    >
								<tr>
									<td bgcolor="#D2D2D2" width="8%">&nbsp;SNO.</td>
									<td bgcolor="#D2D2D2" width="17%">&nbsp;Company Name</td>
									<td bgcolor="#D2D2D2" width="16%">&nbsp;Member&nbsp; 
									Name</td>
									<td bgcolor="#D2D2D2" width="14%" style="text-align: center">
									Member Plan</td>
									<td bgcolor="#D2D2D2" width="11%" style="text-align: center">
									Plan Expire</td>
									<td bgcolor="#D2D2D2" width="12%" style="text-align: center">
									Rating</td>
									<td bgcolor="#D2D2D2" width="9%" style="text-align: center">
									Verified</td>
									<td bgcolor="#D2D2D2" width="9%" style="text-align: center">
									Stars</td>
									<td bgcolor="#D2D2D2" width="18%" style="text-align: center">
									Change </td>
								</tr>
			<?php						

$st="Select * from member order by mid desc";

//echo $st;

$result=mysql_query($st,$con);
$num_rows = mysql_num_rows($result);
$i=$num_rows;
	while ($row=mysql_fetch_array($result))
	{	
	
	?>
				
								<tr>
									<td height="29" width="8%">&nbsp;<?php echo $i; ?></td>
									<td height="29" width="17%">&nbsp;<?php echo $row["compname"]; ?></td>
									<td height="29" width="16%">&nbsp;<?php echo $row["mname"]; ?></td>
									<td height="29" width="14%" style="text-align: center">&nbsp;<?php echo $row["mplan"]; ?></td>
									<td height="29" width="11%" style="text-align: center">&nbsp;
									
									<?php 
									if ($row["z"]<>"-")
									{
									$current_date = strtotime($row["z"]);
								 $resultant_date = date('d-m-Y', mktime(0,0,0,date('m',$current_date),date('d',$current_date),date('Y',$current_date)));
									echo $resultant_date; 
									}
									else
									echo "-";

								 ?>
								 
								 </td>
									<td height="29" width="12%" style="text-align: center">&nbsp;<?php echo $row["rating"]; ?></td>
									<td height="29" width="9%" style="text-align: center">&nbsp;<?php echo $row["verify"]; ?></td>
									<td height="29" width="9%" style="text-align: center">&nbsp;<?php echo $row["a"]; ?></td>
									<td height="29" width="18%" style="text-align: center">&nbsp;<?php echo "<a class='a2' href='changeStatus.php?id=".$row['mid']."'>Change</a>"; ?></td>
								</tr>
								
								<?php
								$i=$i-1;

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
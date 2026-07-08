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
$msg=0;
			
if (isset( $_GET["id"]))
{
$s="delete from activity where eid=".$_GET['id'] ;
mysqli_query($con,$s);
$msg=1;
}


				

?>


	
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
					<h1>&nbsp;View All Activity/ Status</h1>
					<p>&nbsp;<?php if ($msg==1) echo "Activity Delete" ;   ?></p>
					  <form method="get" action="ViewUserCate.php">
					<table border="0" width="90%" id="table17" cellpadding="0" style="border-collapse: collapse" bordercolor="#697779" height="128">
						<tr>
							<td valign="top">
							
							<div id="res">
								<table class="table2"  border="1" width="96%" id="table20">
								<tr>
									<td bgcolor="#E0E2FE" >&nbsp;<b>SNO</b></td>
									<td bgcolor="#E0E2FE" ><b>&nbsp;Activity 
									Heading&nbsp; 
									</b> </td>
									<td bgcolor="#E0E2FE" ><b>&nbsp;Date</b></td>
									<td bgcolor="#E0E2FE" >&nbsp;<b>&nbsp;Status</b></td>
									<td bgcolor="#E0E2FE" ><b>&nbsp;Remove</b></td>
								</tr>
								
							<?php 
		 $st="Select * from activity where mid=".$_SESSION["mid"]." order by eid desc" ;
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
									<td width="403">&nbsp;&nbsp;<?php echo htmlspecialchars($row["eventhead"]); ?></td>
									<td width="94">&nbsp;<?php echo htmlspecialchars($row["edate"]); ?></td>
									<td width="86">&nbsp;<?php echo htmlspecialchars($row["estate"]); ?></td>
									<td width="82">&nbsp;<?php echo "<a class='a2' href='viewActivity.php?id=".$row['eid']."'>Delete</a>"; ?></td>
								</tr>
								
								<?php
								$i=$i+1;
								}
								?>

								

							</table></div>
							</td>
						</tr>
					</table></form>
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
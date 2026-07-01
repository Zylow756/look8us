

<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Online Directory : Admin Panel</title>
 <link rel="stylesheet" type="text/css" href="../akc.css" />

<style type="text/css"> 

body
{
background-image:url('../Admin/img/bg.png');
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
					<td width="228" valign="top" bgcolor="#EEEEEE">			<?php if ($_SESSION["aid"]!="") include("sidemenu.php"); ?></td>
					<td align="center" valign="top" bgcolor="#FFFFFF">
					<h1>View All Enquiry<br>
&nbsp;</h1>
					<a href="ViewEnq.php"><b><font size="2">Click for datewise 
					&gt;&gt;</font></b> </a>		
<form name="frmhlp" id="frmhlp" method="post" action="ViewEnq.php" >

					
					<?php
					
					if (isset($_SESSION["aid"]))
					{
					?>
					
					
					<table class="table2"  width="99%" id="table3" border="1"    >
								<tr>
									<td bgcolor="#D2D2D2"  height="33">&nbsp;SNO.</td>
									<td bgcolor="#D2D2D2"  style="text-align: center" height="33">
									Date</td>
									<td bgcolor="#D2D2D2"  height="33">&nbsp; 
									Company Name</td>
									<td bgcolor="#D2D2D2"  height="33">
									&nbsp;Contact Person</td>
									<td bgcolor="#D2D2D2"  height="33">Mobile</td>
									<td bgcolor="#D2D2D2"  height="33">
									Email</td>
									<td bgcolor="#D2D2D2"  height="33">&nbsp; Address</td>
									<td bgcolor="#D2D2D2" height="33">
									&nbsp;Area </td>
									<td bgcolor="#D2D2D2"  height="33">&nbsp;Last 
									Feedback</td>
									<td bgcolor="#D2D2D2"  height="33">
									Next Follow</td>
									<td bgcolor="#D2D2D2"  height="33">&nbsp;Status</td>
								</tr>
			<?php						

$st="Select * from agenquiry where aid=" . $_SESSION['aid'] ." order by ename";


//echo $st;
$i=1;
$result=mysql_query($st,$con);

$num_rows = mysql_num_rows($result);

	while ($row=mysql_fetch_array($result))
	{	
	
	?>
				
								<tr>
									<td height="29" style="text-align: center">&nbsp;<?php echo $num_rows; ?></td>
									<td height="29"  style="text-align: center">&nbsp;<?php echo $row["edate"]; ?></td>
									<td height="29" >&nbsp;<?php echo $row["ename"]; ?></td>
									<td height="29" >&nbsp;<?php echo $row["cate"]; ?></td>
									<td height="29">&nbsp;<?php echo $row["mobile"]; ?></td>
									<td height="29" >&nbsp;<?php echo $row["email"]; ?></td>
									<td height="29" >&nbsp;<?php echo $row["address"]; ?></td>
									<td height="29" >&nbsp;<?php echo $row["area"]; ?></td>
									<td height="29" >&nbsp;<?php echo $row["cdate"]; ?></td>
									<td height="29">&nbsp;<?php echo $row["ndate"]; ?></td>
									<td height="29" >&nbsp;<a href="PostFeedback.php?eid=<?php echo $row['eid']; ?>" class="a2" ><?php echo $row["estatus"]; ?></a></td>
								</tr>
								
								<?php
								$num_rows=$num_rows-1;
								}
								
								
								?>
							</table>
							
							<?php
							
							}
							?>
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


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

<SCRIPT LANGUAGE="JavaScript" SRC="../CalendarPopup.js"></SCRIPT>
	<SCRIPT LANGUAGE="JavaScript">
	var cal = new CalendarPopup();
</SCRIPT>
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
					<td width="228" valign="top" bgcolor="#EEEEEE">			&nbsp;</td>
					<td align="center" valign="top" bgcolor="#FFFFFF">
					&nbsp;</td>
				</tr>
				<tr>
					<td width="228" valign="top" bgcolor="#EEEEEE">			<?php if ($_SESSION["aid"]!="") include("sidemenu.php"); ?></td>
					<td align="center" valign="top" bgcolor="#FFFFFF">
					<h1>View All Enquiry<br>
&nbsp;</h1>
				
<form name="frmhlp" id="frmhlp" method="post" action="ViewEnq-FollowupDate.php" >

					
					<?php
					
					if (isset($_SESSION["aid"]))
					{
					?><table border="0" width="100%" id="table4" style="border-collapse: collapse">
					<tr>
						<td>


	<table border="0" width="100%" id="table5" style="border-collapse: collapse" height="70">
						<tr>
							<td width="172">&nbsp; <font color="#000000"><b>&nbsp; 
							<font size="2">Select Follow up Date</font></b></font></td>
							<td width="177">
	



	<INPUT TYPE="text" NAME="tdate" VALUE="<?php if (isset($_POST['tdate'])) echo $_POST['tdate'];  else echo date('d-m-Y'); ?>" size="17"  >
<A HREF="#" onClick="cal.select(document.forms['frmhlp'].tdate,'anchor1','dd-MM-yyyy'); return false;"  NAME="anchor1" ID="anchor1">
	<img src="../Admin/cal.gif" width="16" height="16" border="0" alt="Pick a date"></A>&nbsp;&nbsp;&nbsp;								
							</td>
							<td>
	<input  class="subbox" type="submit" value="Show" name="submit"/></td>
						</tr>
					</table>
					
					
						</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
					</tr>
				</table>
					
					<?php
					
					if (isset($_POST["tdate"]))
					{
					?>

					<table class="table2"  width="99%" id="table3" border="1"    >
								<tr>
									<td bgcolor="#D2D2D2" height="33" style="text-align: center">&nbsp;SNO.</td>
									<td bgcolor="#D2D2D2"  style="text-align: center" height="33">
									Date</td>
									<td bgcolor="#D2D2D2"  height="33" style="text-align: left">&nbsp; 
									Company Name</td>
									<td bgcolor="#D2D2D2"  height="33" style="text-align: left">
									&nbsp;Contact Person</td>
									<td bgcolor="#D2D2D2"  height="33" style="text-align: left">&nbsp;Area/ Address</td>
									<td bgcolor="#D2D2D2" height="33" style="text-align: left">Mobile</td>
									<td bgcolor="#D2D2D2" height="33" style="text-align: left">
									Email</td>
									<td bgcolor="#D2D2D2"  height="33" style="text-align: left">
									Website</td>
									<td bgcolor="#D2D2D2"  height="33" style="text-align: left">&nbsp;Last 
									Feedback</td>
									<td bgcolor="#D2D2D2"  height="33" style="text-align: left">
									Next Follow</td>
									<td bgcolor="#D2D2D2" height="33" style="text-align: left">&nbsp;Status</td>
								</tr>
			<?php						

$st="Select * from agenquiry where aid=" . $_SESSION['aid'] ." and ndate='".$_POST['tdate']."' order by eid desc";


//echo $st;
$i=1;
$result=mysql_query($st,$con);

	while ($row=mysql_fetch_array($result))
	{	
	
	?>
				
								<tr>
									<td height="29" style="text-align: center">&nbsp;<?php echo $i; ?></td>
									<td height="29"  style="text-align: center">&nbsp;<?php echo $row["edate"]; ?></td>
									<td height="29" >&nbsp;<?php echo $row["ename"]; ?></td>
									<td height="29" >&nbsp;<?php echo $row["cate"]; ?></td>
									<td height="29" >&nbsp;<?php echo $row["address"]; ?></td>
									<td height="29" >&nbsp;<?php echo $row["mobile"]; ?></td>
									<td height="29" >&nbsp;<?php echo $row["email"]; ?></td>
									<td height="29" >&nbsp;<?php echo $row["web"]; ?></td>
									<td height="29">&nbsp;<?php echo $row["cdate"]; ?></td>
									<td height="29" >&nbsp;<?php echo $row["ndate"]; ?></td>
									<td height="29" >&nbsp;<a href="PostFeedback.php?eid=<?php echo $row['eid']; ?>" class="a2" ><?php echo $row["estatus"]; ?></a></td>
								</tr>
								
								<?php
								$i=$i+1;

								}
								
								
								?>
							</table>
							
							<?php
							
							}
							?>
							
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
<?php

session_start();
include("../config.php"); 

$msg=0;
			



if (isset($_POST["submit0"]))
{
$st="insert into enqfeedback values (NULL ,". $_POST["eid"]. ",". $_POST["aid"]. ",'". date("d-m-Y"). "','". $_POST["remark"]. "','".$_POST["tdate"]."','". $_POST["curstatus"]. "','-')" ;
mysql_query($st,$con);

$st="update agenquiry set cdate='". date("d-m-Y"). "',estatus='".$_POST["curstatus"]. "',ndate='".$_POST["tdate"]."' where eid=".$_POST["eid"] ;
mysql_query($st,$con);

//echo $st;

$msg=1;


	

} 	// end of if (submit)

			
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

<SCRIPT LANGUAGE="JavaScript" SRC="../CalendarPopup.js"></SCRIPT>
	<SCRIPT LANGUAGE="JavaScript">
	var cal = new CalendarPopup();
</SCRIPT>

</head>

	
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
					<h1>View Enquiry Status Report/Feedback<br>
&nbsp;</h1>
				


	
					
					
<?php
					
if ((isset($_GET["eid"]))or ($_POST['eid']))
{
		

if (isset($_GET['eid']))
	$eid=$_GET['eid'];
else
	$eid=$_POST['eid'];
			
$st="Select * from agenquiry where eid=".$eid;

//echo $st;
$i=1;
$result=mysql_query($st,$con);

	if ($row=mysql_fetch_array($result))
	{	
	
	$eid=$row["eid"];
	$aid=$row["aid"];
					?>
					<table border="0" width="90%" id="table4" style="border-collapse: collapse" height="70">
						<tr>
							<td width="143" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#D2D2D2" height="25">
							<font color="#000080">
							<span style="font-size: 9pt; font-weight: 700">
							Enquiry Name</span></font></td>
							<td width="424" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#D2D2D2" height="25">
	
<span style="font-size: 9pt; font-weight: 700">&nbsp;<?php echo $row["ename"]; ?></span></td>
							<td>
	&nbsp;</td>
						</tr>
						<tr>
							<td width="143" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#D2D2D2" height="25">
							<font color="#000080">
							<span style="font-size: 9pt; font-weight: 700">
							Category</span></font></td>
							<td width="424" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#D2D2D2" height="25">
	
<span style="font-size: 9pt; font-weight: 700">&nbsp;<?php echo $row["cate"]; ?></span></td>
							<td>
	&nbsp;</td>
						</tr>
						<tr>
							<td width="143" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#D2D2D2" height="25">
							<font color="#000080">
							<span style="font-size: 9pt; font-weight: 700">City</span></font></td>
							<td width="424" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#D2D2D2" height="25">
	
<span style="font-size: 9pt; font-weight: 700">&nbsp;<?php echo $row["city"]; ?></span></td>
							<td>
	&nbsp;</td>
						</tr>
						<tr>
							<td width="143" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#D2D2D2" height="25">
							<font color="#000080">
							<span style="font-size: 9pt; font-weight: 700">
							Contact No.</span></font></td>
							<td width="424" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#D2D2D2" height="25">
	
<span style="font-size: 9pt; font-weight: 700">&nbsp;<?php echo $row["mobile"]; ?></span></td>
							<td>
	&nbsp;</td>
						</tr>
						<tr>
							<td width="143" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#D2D2D2" height="25">
							<font color="#000080">
							<span style="font-size: 9pt; font-weight: 700">Email</span></font></td>
							<td width="424" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#D2D2D2" height="25">
	
<span style="font-size: 9pt; font-weight: 700">&nbsp;<?php echo $row["email"]; ?></span></td>
							<td>
	&nbsp;</td>
						</tr>
						<tr>
							<td width="143" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#D2D2D2" height="25">
							<font color="#000080">
							<span style="font-weight: 700; font-size: 9pt">Website</span></font></td>
							<td width="424" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#D2D2D2" height="25">
	
&nbsp;<?php echo $row["web"]; ?></td>
							<td>
	&nbsp;</td>
						</tr>
						<tr>
							<td width="143" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#D2D2D2" height="25">
							<font color="#000080">
							<span style="font-size: 9pt; font-weight: 700">
							Enquiry Date</span></font></td>
							<td width="424" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#D2D2D2" height="25">
	
<span style="font-size: 9pt; font-weight: 700">&nbsp;<?php echo $row["edate"]; ?></span></td>
							<td>
	&nbsp;</td>
						</tr>
						<tr>
							<td width="143" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#D2D2D2" height="25">
							<font color="#000080">
							<span style="font-size: 9pt; font-weight: 700">
							Status</span></font></td>
							<td width="424" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#D2D2D2" height="25">
	
<span style="font-size: 9pt; font-weight: 700">&nbsp;<?php echo $row["estatus"]; ?></span></td>
							<td>
	&nbsp;</td>
						</tr>
						<tr>
							<td width="143" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#D2D2D2" height="25">
							<font color="#000080">
							<span style="font-size: 9pt; font-weight: 700">Last 
							follow up Date</span></font></td>
							<td width="424" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#D2D2D2" height="25">
	
<span style="font-size: 9pt; font-weight: 700">&nbsp;<?php echo $row["cdate"]; ?></span></td>
							<td>
	&nbsp;</td>
						</tr>
						<tr>
							<td width="143">&nbsp;</td>
							<td width="424">
	
&nbsp;</td>
							<td>
	&nbsp;</td>
						</tr>
					</table>
					
					
					<?php
					}
					?>
					
					
					<table class="table2"  width="94%" id="table3" border="1"    >
								<tr>
									<td bgcolor="#D2D2D2" width="5%">&nbsp;SNO.</td>
									<td bgcolor="#D2D2D2" width="10%" style="text-align: center">
									Date</td>
									<td bgcolor="#D2D2D2" width="61%">&nbsp; 
									Remark</td>
									<td bgcolor="#D2D2D2" width="12%">&nbsp;Next 
									Follow-up</td>
									<td bgcolor="#D2D2D2" width="9%">&nbsp;Status</td>
								</tr>
			<?php						

$st="Select * from enqfeedback where eid=" .$eid ." order by fid";

//echo $st;
$i=1;
$result=mysql_query($st,$con);

	while ($row=mysql_fetch_array($result))
	{	
	
	?>
				
								<tr>
									<td height="29" width="5%" style="text-align: center">&nbsp;<?php echo $i; ?></td>
									<td height="29" width="10%" style="text-align: center">&nbsp;<?php echo $row["fdate"]; ?></td>
									<td height="29" width="61%">&nbsp;<?php echo $row["remark"]; ?></td>
									<td height="29" width="12%">&nbsp;<?php echo $row["nxtdate"]; ?></td>
									<td height="29" width="9%">&nbsp;<?php echo $row["curstatus"]; ?></td>
								</tr>
								
								<?php
								$i=$i+1;

								}
								
								
								?>
							</table>
							
							
								<p><font color="#000080"><u><b>Post Feedback</b></u></font></p>

							
							<form name="frmhlp" id="frmhlp" method="post" action="ViewEnqStatus.php" >
							
							<input type="hidden" name="eid" value ="<?php echo $eid; ?> ">  
								<input type="hidden" name="aid" value ="<?php echo $aid; ?> ">   
							
							<table border="0" width="100%" id="table5" style="border-collapse: collapse">
								<tr>
									<td width="169">&nbsp; Remark</td>
									<td>
							
							<textarea name="remark" rows="6" cols="60" ></textarea></td>
								</tr>
								<tr>
									<td width="169" height="42">&nbsp; Next Follow up</td>
									<td height="42">
								<p>
								
							
							
							
								<INPUT TYPE="text" NAME="tdate" VALUE="<?php echo date('d-m-Y'); ?>" size="17"  >
							<A HREF="#" onClick="cal.select(document.forms['frmhlp'].tdate,'anchor1','dd-MM-yyyy'); return false;"  NAME="anchor1" ID="anchor1">
								<img src="../Admin/cal.gif" width="16" height="16" border="0" alt="Pick a date"></A>&nbsp;&nbsp; </td>
								</tr>
								<tr>
									<td width="169" height="43">&nbsp; Status</td>
									<td height="43">
									<select name="curstatus" class="selbox"   >
									<option>Open</option>
									<option>Closed</option>
									</select>
									</td>
								</tr>
								<tr>
									<td width="169" height="58">&nbsp;</td>
									<td height="58">
									<input  class="subbox" type="submit" value="Save Feedback" name="submit0"   /></td>
								</tr>
							</table>
							</form>
							<?php
							
							}
							?>
				
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
<?php
require_once "config.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (empty($_SESSION['admin'])) {
    header("Location: index.php?r=0");
    exit;
}
$msg=0;
if (isset($_POST["submit0"]))
{
$eid       = (int)$_POST['eid'];
$aid       = (int)$_POST['aid'];
$remark    = mysqli_real_escape_string($con, trim($_POST['remark']));
$tdate     = mysqli_real_escape_string($con, trim($_POST['tdate']));
$curstatus = mysqli_real_escape_string($con, trim($_POST['curstatus']));

$st = "INSERT INTO enqfeedback
VALUES
(
NULL,
$eid,
$aid,
'".date('d-m-Y')."',
'$remark',
'$tdate',
'$curstatus',
'-'
)";
if(!mysqli_query($con,$st)){
    die(mysqli_error($con));
}

$eid = (int)$_POST['eid'];

$st = "UPDATE agenquiry
SET
    cdate='".date('d-m-Y')."',
    estatus='$curstatus',
    ndate='$tdate'
WHERE eid=$eid";
if(!mysqli_query($con,$st)){
    die(mysqli_error($con));
}

//echo $st;
$msg=1;
} 	// end of if (submit)
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
			<td height="50" align="center" valign="top">	<?php  require_once "../header.php"; ?>		</td>		</tr>
		<tr>
			<td height="12" align="center" valign="top" bgcolor="#697779">			
					</td>
		</tr>
		<tr>
			<td>
			<table border="0" width="100%" id="table2" style="border-collapse: collapse" bordercolor="#CCCCCC" height="206" cellpadding="0">
				<tr>
					<td width="228" valign="top" bgcolor="#EEEEEE">			<?php if (!empty($_SESSION['id'])) include("sidemenu.php"); ?></td>
					<td align="center" valign="top" bgcolor="#FFFFFF">
					<h1>View Enquiry Status Report/Feedback<br>
&nbsp;</h1>	
<?php			
if (isset($_GET['eid']) || isset($_POST['eid']))
{
if(isset($_GET['eid'])){
    $eid = (int)$_GET['eid'];
}
elseif(isset($_POST['eid'])){
    $eid = (int)$_POST['eid'];
}
else{
    die("Invalid Request");
}
			
$eid = (int)$eid;

$st = "SELECT * FROM agenquiry WHERE eid=$eid";

//echo $st;
$i=1;
$result=mysqli_query($con,$st);
if (!$result) {
    die(mysqli_error($con));
}
	if ($row=mysqli_fetch_assoc($result))
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
	
<span style="font-size: 9pt; font-weight: 700">&nbsp;<?php echo htmlspecialchars($row["ename"]); ?></span></td>
							<td>
	&nbsp;</td>
						</tr>
						<tr>
							<td width="143" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#D2D2D2" height="25">
							<font color="#000080">
							<span style="font-size: 9pt; font-weight: 700">
							Category</span></font></td>
							<td width="424" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#D2D2D2" height="25">
	
<span style="font-size: 9pt; font-weight: 700">&nbsp;<?php echo htmlspecialchars($row["cate"]); ?></span></td>
							<td>
	&nbsp;</td>
						</tr>
						<tr>
							<td width="143" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#D2D2D2" height="25">
							<font color="#000080">
							<span style="font-size: 9pt; font-weight: 700">City</span></font></td>
							<td width="424" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#D2D2D2" height="25">
	
<span style="font-size: 9pt; font-weight: 700">&nbsp;<?php echo htmlspecialchars($row["city"]); ?></span></td>
							<td>
	&nbsp;</td>
						</tr>
						<tr>
							<td width="143" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#D2D2D2" height="25">
							<font color="#000080">
							<span style="font-size: 9pt; font-weight: 700">
							Contact No.</span></font></td>
							<td width="424" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#D2D2D2" height="25">
	
<span style="font-size: 9pt; font-weight: 700">&nbsp;<?php echo htmlspecialchars($row["mobile"]); ?></span></td>
							<td>
	&nbsp;</td>
						</tr>
						<tr>
							<td width="143" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#D2D2D2" height="25">
							<font color="#000080">
							<span style="font-size: 9pt; font-weight: 700">Email</span></font></td>
							<td width="424" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#D2D2D2" height="25">
	
<span style="font-size: 9pt; font-weight: 700">&nbsp;<?php echo htmlspecialchars($row["email"]); ?></span></td>
							<td>
	&nbsp;</td>
						</tr>
						<tr>
							<td width="143" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#D2D2D2" height="25">
							<font color="#000080">
							<span style="font-weight: 700; font-size: 9pt">Website</span></font></td>
							<td width="424" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#D2D2D2" height="25">
	
&nbsp;<?php echo htmlspecialchars($row["web"]); ?></td>
							<td>
	&nbsp;</td>
						</tr>
						<tr>
							<td width="143" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#D2D2D2" height="25">
							<font color="#000080">
							<span style="font-size: 9pt; font-weight: 700">
							Enquiry Date</span></font></td>
							<td width="424" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#D2D2D2" height="25">
	
<span style="font-size: 9pt; font-weight: 700">&nbsp;<?php echo htmlspecialchars($row["edate"]); ?></span></td>
							<td>
	&nbsp;</td>
						</tr>
						<tr>
							<td width="143" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#D2D2D2" height="25">
							<font color="#000080">
							<span style="font-size: 9pt; font-weight: 700">
							Status</span></font></td>
							<td width="424" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#D2D2D2" height="25">
	
<span style="font-size: 9pt; font-weight: 700">&nbsp;<?php echo htmlspecialchars($row["estatus"]); ?></span></td>
							<td>
	&nbsp;</td>
						</tr>
						<tr>
							<td width="143" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#D2D2D2" height="25">
							<font color="#000080">
							<span style="font-size: 9pt; font-weight: 700">Last 
							follow up Date</span></font></td>
							<td width="424" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#D2D2D2" height="25">
	
<span style="font-size: 9pt; font-weight: 700">&nbsp;<?php echo htmlspecialchars($row["cdate"]); ?></span></td>
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
			$eid = (int)$eid;

$st = "SELECT *
       FROM enqfeedback
       WHERE eid=$eid
       ORDER BY fid";
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
									<td height="29" width="10%" style="text-align: center">&nbsp;<?php echo htmlspecialchars($row["fdate"]); ?></td>
									<td height="29" width="61%">&nbsp;<?php echo htmlspecialchars($row["remark"]); ?></td>
									<td height="29" width="12%">&nbsp;<?php echo htmlspecialchars($row["nxtdate"]); ?></td>
									<td height="29" width="9%">&nbsp;<?php echo htmlspecialchars($row["curstatus"]); ?></td>
								</tr>
								<?php
								$i=$i+1;
								}
								?>
							</table>
								<p><font color="#000080"><u><b>Post Feedback</b></u></font></p>
							<form name="frmhlp" id="frmhlp" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" >
							<input type="hidden" name="eid" value="<?php echo (int)$eid; ?>">
<input type="hidden" name="aid" value="<?php echo (int)$aid; ?>">
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
			<td height="57" align="center" valign="top">			<?php  require_once "../footer.php"; ?></td>
		</tr>
	</table>
</div>
</body>
</html>
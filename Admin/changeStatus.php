<?php
require_once "config.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (empty($_SESSION['user'])) {
    header("Location: index.php?r=0");
    exit;
} ?>
<html>
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta charset="UTF-8">
<title>Online Directory : Admin Panel</title>
 <link rel="stylesheet" type="text/css" href="../akc.css" />

  <SCRIPT LANGUAGE="JavaScript" SRC="../CalendarPopup.js"></SCRIPT>
	<SCRIPT LANGUAGE="JavaScript">
	var cal = new CalendarPopup();
	</SCRIPT>
<style type="text/css"> 
body
{
background-image:url('img/bg.png');
background-repeat:repeat-x;
background-color: #70828F
} 
</style>
</head>
<?php
$msg=0;
			
if (isset( $_POST["submit"]))
{
$current_date = strtotime($_POST['tdate0'] ?? '');
$expdate = date('Y-m-d', mktime(0,0,0,date('m',$current_date),date('d',$current_date),date('Y',$current_date)));
		 
$mid = (int)($_POST['mid'] ?? 0);
$mverify = mysqli_real_escape_string($con, $_POST['mverify'] ?? '');
$mstar = mysqli_real_escape_string($con, $_POST['mstar'] ?? '');
$tdate = mysqli_real_escape_string($con, $_POST['tdate'] ?? '');
$mplan = mysqli_real_escape_string($con, $_POST['mplan'] ?? '');
$rating = (int)($_POST['rating'] ?? 0);

$s = "UPDATE member SET
verify='$mverify',
a='$mstar',
x='$tdate',
z='$expdate',
expdate='$expdate',
mplan='$mplan',
rating='$rating'
WHERE mid=$mid";
mysqli_query($con,$s);
if (!mysqli_query($con, $s)) {
    die(mysqli_error($con));
}
//echo $s;
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
					<td width="228" valign="top" bgcolor="#E3E3E3">			<?php if (!empty($_SESSION['id'])) include("sidemenu.php"); ?></td>
					<td align="center" valign="top" bgcolor="#FFFFFF">
					<h1>&nbsp;View Member Plan/Ratings</h1>
					<p><?php if ($msg==1) echo "<h3>Member Plan-Rating Update</h3>" ;  
					
					//  echo $s;  
					  ?></p>
					<table border="0" width="96%" id="table3" style="border-collapse: collapse">
						<tr>
							<td>
							
			<?php 
		$id = isset($_GET['id'])
    ? (int)$_GET['id']
    : (int)($_POST['mid'] ?? 0);

$st = "SELECT * FROM member WHERE mid=$id";
		
		$result=mysqli_query($con,$st);
if (!$result) {
    die(mysqli_error($con));
}
		if ($row = mysqli_fetch_assoc($result))
		{
		?>
			<form name="example" id="example" method="post" action="changeStatus.php" >
			<table border="0" width="100%" id="table2" cellpadding="0" style="border-collapse: collapse" height="319">
			
<tr>
	<td width="268" height="30" align="right"><font size="2" color="#000000">Company/Firm/Shop Name 
	:&nbsp;&nbsp;&nbsp; </font>
	<input type="hidden"  name="mid"  value="<?php echo htmlspecialchars($row['mid']);  ?>">
	</td>
	<td width="290" height="30" align="left"><b><font color="#000000" size="2"><?php echo htmlspecialchars($row['compname']); ?>
	</font></b>
	</td>
	<td height="30" width="197">
	&nbsp;</td>
				</tr>
<tr><td width="268" height="30" align="right"><font size="2" color="#000000">Owner/Contact Person Name 
	:&nbsp;&nbsp;&nbsp; </font> </td>
	<td width="290" height="30" align="left"><b><font color="#000000" size="2"><?php echo htmlspecialchars($row['mname']);  ?>
	</font></b>
	</td>
	<td height="30" width="197">
	&nbsp;</td>
				</tr>
<tr>
	<td width="268" height="30" align="right"><font size="2" color="#000000">Shop No./Plot No 
	:&nbsp;&nbsp;&nbsp; </font> </td>
	<td width="290" height="30" align="left"><b><font color="#000000" size="2"><?php  echo htmlspecialchars($row['shopno']);  ?>
	</font></b>
	</td>
	<td height="30" valign="top" width="197">
	&nbsp;</td>
</tr>
<tr>
	<td width="268" height="30" align="right"><font size="2" color="#000000">Address Area City 
	:&nbsp;&nbsp; &nbsp; </font> </td>
	<td width="290" height="30" align="left"><b><font color="#000000" size="2"><?php  echo htmlspecialchars($row['address']);   ?><?php  echo htmlspecialchars($row['area']);   ?><?php echo htmlspecialchars($row['city']);  ?>
	</font></b>
	</td>
	<td height="30" valign="top" width="197">
	&nbsp;</td>
</tr>
<tr>
	<td width="1010" height="15" align="right" colspan="3" bgcolor="#FFFFFF">&nbsp;</td>
</tr>
<tr>
	<td width="1010" height="15" align="right" colspan="3" bgcolor="#F4F4F4"></td>
</tr>
<tr>
	<td width="268" height="20" align="right">&nbsp;</td>
	<td width="290" height="20" align="left">
	&nbsp;</td>
	<td height="20" valign="top" width="197">
	&nbsp;</td>
</tr>
<tr>
	<td width="268" height="38" align="right"><font size="2" color="#000000">Member Plan 
	:&nbsp;&nbsp;&nbsp; </font> </td>
	<td width="290" height="38" align="left">
	<select  class="selbox" name="mplan" id="mplan" size="1" tabindex="5">
	<option <?php if ('Demo'==$row["mplan"]) echo "Selected" ;?> >Demo</option>
	<option <?php if ('Silver'==$row["mplan"]) echo "Selected" ;?>>Silver</option>
	<option  <?php if ('Gold'==$row["mplan"]) echo "Selected" ;?>>Gold</option>
	<option <?php if ('Platinum'==$row["mplan"]) echo "Selected" ;?> >Platinum</option>
	</select></td>
	<td height="38" valign="top" width="197">
	&nbsp;</td>
</tr>
<tr>
	<td width="268" height="39" align="right"><font size="2" color="#000000">Plan Start Date 
	:&nbsp;&nbsp;&nbsp; </font></td>
	<td width="290" height="39" align="left">
	<INPUT TYPE="text" NAME="tdate" VALUE="<?php
echo ($row['x'] != '-')
    ? $row['x']
    : ($_POST['tdate'] ?? date('d-m-Y'));
?>" size="17"  >
<A HREF="#" onClick="cal.select(document.forms['example'].tdate,'anchor1','dd-MM-yyyy'); return false;"  NAME="anchor1" ID="anchor1">
	<img src="cal.gif" width="16" height="16" border="0" alt="Pick a date"></A>&nbsp;&nbsp;</td>
	<td height="39" valign="top" width="197">
	&nbsp;</td>
</tr>

<tr>
	<td width="268" height="39" align="right"><font size="2" color="#000000">Expiry Date 
	:&nbsp;&nbsp;&nbsp; </font></td>
	<td width="290" height="39" align="left">
<?php if ($row['z']<>'-')
{	$current_date = strtotime($row["z"]);
		 $resultant_date = date('d-m-Y', mktime(0,0,0,date('m',$current_date),date('d',$current_date),date('Y',$current_date)));
}
?>

	<INPUT TYPE="text" NAME="tdate0" VALUE="<?php
echo ($row['z'] != '-')
    ? $resultant_date
    : ($_POST['tdate0'] ?? date('d-m-Y'));
?>" size="17"  >
<A HREF="#" onClick="cal.select(document.forms['example'].tdate0,'anchor2','dd-MM-yyyy'); return false;"  NAME="anchor2" ID="anchor2">
	<img src="cal.gif" width="16" height="16" border="0" alt="Pick a date"></A></td>
	<td height="39" valign="top" width="197">
	&nbsp;</td>
</tr>

<tr>
	<td width="268" height="39" align="right"><font size="2" color="#000000">Member 
	search Rating 
	:&nbsp;&nbsp;&nbsp; </font> </td>
	<td width="290" height="39" align="left">
	<select  class="selbox" name="rating" id="rating" size="1" tabindex="5">
<option value='0' <?php if ('0'==$row["rating"]) echo "Selected" ;?>  >Default</option>
<option value='1' <?php if ('1'==$row["rating"]) echo "Selected" ;?> >1</option>
<option value='2' <?php if ('2'==$row["rating"]) echo "Selected" ;?> >2</option>
<option value='3' <?php if ('3'==$row["rating"]) echo "Selected" ;?> >3</option>
<option value='4' <?php if ('4'==$row["rating"]) echo "Selected" ;?> >4</option>
<option value='5' <?php if ('5'==$row["rating"]) echo "Selected" ;?> >5</option>
<option value='6' <?php if ('6'==$row["rating"]) echo "Selected" ;?> >6</option>
<option value='7' <?php if ('7'==$row["rating"]) echo "Selected" ;?> >7</option>
<option value='8' <?php if ('8'==$row["rating"]) echo "Selected" ;?> >8</option>
<option value='9' <?php if ('9'==$row["rating"]) echo "Selected" ;?> >9</option>
	</select></td>
	<td height="39" valign="top" width="197">
	&nbsp;</td>
</tr>

<tr><td width="268" height="40" align="right"><font size="2" color="#000000">Member 
	Verified : &nbsp;&nbsp;&nbsp; </font> 
	</td>
	<td width="290" height="40" align="left">
	<select  class="selbox" name="mverify" id="mverify" size="1" tabindex="5">
	<option <?php if ('Verified'==$row["verify"]) echo "Selected" ;?> >Verified</option>
	<option <?php if ('-'==$row["verify"]) echo "Selected" ;?> value="-">Not Verified</option>
	</select></td>
	<td height="40" width="197">
	&nbsp;</td></tr>

<tr><td width="268" height="40" align="right"><font size="2" color="#000000">Member 
	Star Rating 
	:&nbsp;&nbsp;&nbsp; </font> 
	</td>
	<td width="290" height="40" align="left">
	<select  class="selbox" name="mstar" id="mstar" size="1" tabindex="5">
	<option <?php if ('-'==$row["a"]) echo "Selected" ;?> >-</option>
	<option <?php if ('1'==$row["a"]) echo "Selected" ;?> >1</option>
	<option <?php if ('2'==$row["a"]) echo "Selected" ;?> >2</option>
	<option <?php if ('3'==$row["a"]) echo "Selected" ;?> >3</option>
	<option <?php if ('4'==$row["a"]) echo "Selected" ;?> >4</option>
	<option <?php if ('5'==$row["a"]) echo "Selected" ;?> >5</option>
	</select></td>
	<td height="40" width="197">
	&nbsp;</td></tr>

<tr><td width="268" height="67">&nbsp;</td>
	<td width="290" height="67" align="left">
	<input  class="subbox" type="submit" value="Update Status" name="submit"/></td>
	<td height="67" width="197">
	&nbsp;
	</td></tr>
		</table></form>
		<?php
		}
		?>
		</td>
						</tr>
					</table>
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
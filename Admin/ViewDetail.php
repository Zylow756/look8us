<?php
require_once "config.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (empty($_SESSION['admin'])) {
    header("Location: index.php?r=0");
    exit;
} ?>
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
background-color: #70828F
} 
</style>
</head>
<?php
$msg=0;
			
if (empty( $_POST["submit"]))
{
	$mname     = mysqli_real_escape_string($con, ucwords(trim($_POST['mname'])));
$compname  = mysqli_real_escape_string($con, ucwords(trim($_POST['compname'])));
$tagline   = mysqli_real_escape_string($con, trim($_POST['tagline']));
$shopno    = mysqli_real_escape_string($con, trim($_POST['shopno']));
$address   = mysqli_real_escape_string($con, ucwords(trim($_POST['address'])));
$area      = mysqli_real_escape_string($con, ucwords(trim($_POST['area'])));
$city      = mysqli_real_escape_string($con, ucwords(trim($_POST['city'])));
$state1    = mysqli_real_escape_string($con, ucwords(trim($_POST['state1'])));
$pincode   = mysqli_real_escape_string($con, trim($_POST['pincode']));
$phone     = mysqli_real_escape_string($con, trim($_POST['phone']));
$phone1    = mysqli_real_escape_string($con, trim($_POST['phone0']));
$mobile    = mysqli_real_escape_string($con, trim($_POST['mobile']));
$mobile1   = mysqli_real_escape_string($con, trim($_POST['mobile0']));
$email     = mysqli_real_escape_string($con, trim($_POST['txtmail']));
$website   = mysqli_real_escape_string($con, trim($_POST['website']));
$remark    = mysqli_real_escape_string($con, trim($_POST['remark']));
$remark1   = mysqli_real_escape_string($con, trim($_POST['remark0']));
$estyear   = mysqli_real_escape_string($con, trim($_POST['establish']));
$mid       = (int)$_POST['mid'];
$pass      = base64_encode(trim($_POST['pass']));

$s="update member  set pass='".$pass. "', mname='". $mname. "',compname='". $compname. "',tagline='". $tagline. "',shopno='". $shopno. "',address='". $address. "',area='". $area. "',city='". $city. "',state1='". $state1. "',pin='". $pincode. "',phone='". $phone. "',phone1='". $phone1. "',mobile='".$mobile."',mobile1='". $mobile1. "',email='".$email."',web='".$website."',remark='". $remark. "',remark1='". $remark1. "',estyear='".$estyear."' where mid=".$_POST["mid"] ;
if(mysqli_query($con,$s)){
    $msg=1;
}else{
    die(mysqli_error($con));
}
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
					<td width="228" valign="top" bgcolor="#E3E3E3">			<?php if (!empty($_SESSION['id']))
{
    include("sidemenu.php");
} ?></td>
					<td align="center" valign="top" bgcolor="#FFFFFF">
					<h1>&nbsp;View Member Information</h1>
					<p><?php if ($msg==1) echo "<h3>Information Update</h3>" ;  
					
					//  echo $s;  
					  ?></p>
					<table border="0" width="96%" id="table3" style="border-collapse: collapse">
						<tr>
							<td>
							
			<?php 
		$id = 0;

if(isset($_GET['id'])){
    $id = (int)$_GET['id'];
}elseif(isset($_POST['mid'])){
    $id = (int)$_POST['mid'];
}else{
    die("Invalid Request");
}

$st = "SELECT * FROM member WHERE mid = $id";
$result = mysqli_query($con, $st);

if (!$result) {
    die(mysqli_error($con));
}
		if ($row=mysqli_fetch_assoc($result))
		{
		?>
			<form name="frmhlp" id="frmhlp" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" >
			<table border="0" width="100%" id="table2" cellpadding="0" style="border-collapse: collapse" height="809">	
<tr>
	<td width="295" height="25" align="right">Company/Firm/Shop Name
	<input type="hidden"  name="mid"  value="<?php echo htmlspecialchars($row['mid']);  ?>">
	</td>
	<td width="257" height="25" align="center">
	<input class="txtbox" type="text" name="compname" id="compname" tabindex="2" value="<?php echo htmlspecialchars($row['compname']); ?>"  size="1"/></td>
	<td height="25" width="458">
	&nbsp;</td>
				</tr>
<tr><td width="295" height="25" align="right">Owner/Contact Person Name</td>
	<td width="257" height="25" align="center">
	<input class="txtbox" type="text" name="mname" id="mname" tabindex="1" value="<?php echo htmlspecialchars($row['mname']);  ?>"  size="1"/></td>
	<td height="25" width="458">
	&nbsp;</td>
				</tr>
<tr><td width="295" height="25" align="right">Company Tag line if any </td>
	<td width="257" height="25" align="center">
	
	<input class="txtbox" type="text" name="tagline" id="tagline" tabindex="2" value="<?php  echo htmlspecialchars($row['tagline']);  ?>"  size="1"/></td></tr>
<tr>
	<td width="295" height="25" align="right">Shop No./Plot No</td>
	<td width="257" height="25" align="center">
	<input  class="txtbox" type="text" name="shopno" id="shopno" tabindex="3" value="<?php  echo htmlspecialchars($row['shopno']);  ?>"  size="1"/></td>
	<td height="25" valign="top" width="458">
	&nbsp;</td>
</tr>
<tr>
	<td width="295" height="25" align="right">Address</td>
	<td width="257" height="25" align="center">
	<input  class="txtbox" type="text" name="address" id="address" tabindex="3" value="<?php  echo htmlspecialchars($row['address']);   ?>"  size="1"/></td>
	<td height="25" valign="top" width="458">
	&nbsp;</td>
</tr>
<tr>
	<td width="295" height="25" align="right">Area</td>
	<td width="257" height="25" align="center">
	<input  class="txtbox" type="text" name="area" id="area" tabindex="3" value="<?php  echo htmlspecialchars($row['area']);   ?>"  size="1"/></td>
	<td height="25" valign="top" width="458">
	&nbsp;</td>
</tr>
<tr>
	<td width="295" height="25" align="right">City</td>
	<td width="257" height="25" align="center">
	<input  class="txtbox" type="text" name="city" id="city" tabindex="4" value="<?php echo htmlspecialchars($row['city']);  ?>"  size="1"/></td>
	<td height="25" valign="top" width="458">
	&nbsp;</td>
</tr>
<tr><td width="295" height="30" align="right">State</td>
	<td width="257" height="30" align="center">
	<input  class="txtbox" type="text" name="state1" value="<?php  echo htmlspecialchars($row['state1']);  ?>"  id="state1" tabindex="9" size="1"/></td>
	<td height="30" valign="top" width="458">
	&nbsp;</td></tr>
<tr><td width="295" height="30" align="right">Pin</td>
	<td width="257" height="30" align="center">
	<input  class="txtbox" type="text" name="pincode" id="pincode" tabindex="3" value="<?php  echo htmlspecialchars($row['pin']);   ?>"  size="1"/></td>
	<td height="30" valign="top" width="458">
	&nbsp;</td></tr>
				<tr>
					<td width="295" height="30" align="right">Phone Number</td>
					<td width="257" height="30" align="center">
	<input  class="txtbox" type="text" name="phone" id="phone" value="<?php echo htmlspecialchars($row['phone']);  ?>"  tabindex="10" size="1"/></td>
	<td height="30" valign="top" width="458">
	&nbsp;</td>
				</tr>
				<tr>
					<td width="295" height="30" align="right">Phone Number-2</td>
					<td width="257" height="30" align="center">
	<input  class="txtbox" type="text" name="phone0" id="phone0" value="<?php  echo htmlspecialchars($row['phone1']);  ?>"  tabindex="10" size="1"/></td>
	<td height="30" valign="top" width="458">
	&nbsp;</td>
				</tr>
<tr><td width="295" height="30" align="right">Mobile Number</td>
	<td width="257" height="30" align="center">
	<input  class="txtbox" type="text" name="mobile" id="mobile" value="<?php  echo htmlspecialchars($row['mobile']);    ?>" tabindex="10" size="1"/></td>
	<td height="30" valign="top" width="458">
	&nbsp;</td></tr>
				<tr>
					<td width="295" height="30" align="right">Mobile Number-2</td>
					<td width="257" height="30" align="center">
	<input  class="txtbox" type="text" name="mobile0" id="mobile0" value="<?php echo htmlspecialchars($row['mobile1']);    ?>" size="1"/></td>
	<td height="30" valign="top" width="458">
	&nbsp;</td>
				</tr>
<tr><td width="295" height="30" align="right">Email ID</td>
	<td width="257" height="30" align="center">
	<input class="txtbox" type="text" name="txtmail" readonly id="txttmail" value="<?php  echo htmlspecialchars($row['email']);     ?>"  tabindex="4" size="1" /></td>
	<td height="30" width="458">
	&nbsp;<b><font size="2" color="#FF0000">Can't Update (User ID)</font></b></td></tr>
<tr><td width="295" height="30" align="right">Website</td>
	<td width="257" height="30" align="center">
	<input  class="txtbox" type="text" name="website" id="website" tabindex="3" value="<?php  echo htmlspecialchars($row['web']);   ?>"  size="1"/></td>
	<td height="30" valign="top" width="458">
	&nbsp;</td></tr>
<tr><td width="295" height="78" align="right"><font size="2">Brief Introduction<br>
	or <br>
	About us </font>
	</td>
	<td width="715" height="78" align="center" colspan="2">
	
<textarea name="remark" rows="10" cols="64" ><?php  echo htmlspecialchars($row['remark']);  ?></textarea>
	</td>
	</tr>
<tr><td width="295" height="20" align="right">&nbsp;</td>
	<td width="715" height="20" align="center" colspan="2">
	
&nbsp;</td>
	</tr>
<tr><td width="295" height="172" align="right"><font size="2">Company Profile<br>
	[Show at landing page]</font></td>
	<td width="715" height="172" align="center" colspan="2">
	
<textarea name="remark0" rows="10" cols="64" ><?php  echo htmlspecialchars($row['remark1']);  ?></textarea>
</td>
	</tr>
<tr><td width="295" height="30" align="right">Establishment Year</td>
	<td width="257" height="30" align="center">
	<input  class="txtbox" type="text" name="establish" id="establish" tabindex="3" value="<?php echo htmlspecialchars($row['estyear']);   ?>"  size="1"/></td>
	<td height="30" valign="top" width="458">
	&nbsp;</td></tr>
<tr><td width="295" height="28" align="right">Password </td>
	<td width="257" height="28" align="center">
		<input type="password" name="pass" class="txtbox">
	<input  class="txtbox" type="text" name="pass" id="pass" tabindex="3" value="<?php echo htmlspecialchars($pass);  ?>"  size="1"/></td>
	<td height="28" width="458">
	&nbsp;</td></tr>

<tr><td width="295" height="130">&nbsp;</td>
	<td width="257" height="130" align="center">
	<input  class="subbox" type="submit" value="Update Member" name="submit"/></td>
	<td height="130" width="458">
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
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
background-color: #70828F;;
} 
</style>
<script type="text/javascript">
function vfhfn()
{
var fllnme1=document.frmhlp.cname.value;

if(fllnme1==null||fllnme1=="")
{alert("Required Category Name");
document.frmhlp.cname.focus();
return false;
}

if(fllnme1=="Category Name")
{alert("Required Category Name");
document.frmhlp.cname.focus();
return false;
}
if(document.frmhlp.mobile.value=="")
{
    alert("Enter Mobile Number");
    document.frmhlp.mobile.focus();
    return false;
}

if(document.frmhlp.email.value!="")
{
    var email=/^\S+@\S+\.\S+$/;

    if(!email.test(document.frmhlp.email.value))
    {
        alert("Invalid Email");
        document.frmhlp.email.focus();
        return false;
    }
}
return true;
}
</script>
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
			<?php
			$msg=0;
if (isset($_POST['submit'])) {

    $s = mysqli_prepare(
        $con,
        "UPDATE agenquiry
        SET
            ename=?,
            cate=?,
            address=?,
            city=?,
            email=?,
            mobile=?,
            web=?
        WHERE eid=?"
    );
$eid = isset($_POST['eid']) ? (int)$_POST['eid'] : 0;
$aname = trim($_POST['aname']);
$cate = trim($_POST['cate']);
$address = trim($_POST['address']);
$city = trim($_POST['city']);
$email = trim($_POST['email']);
$mobile = trim($_POST['mobile']);
$web = trim($_POST['web']);
    mysqli_stmt_bind_param(
        $s,
        "sssssssi",
        $aname,
        $cate,
        $address,
        $city,
        $email,
        $mobile,
        $web,
        $eid
    );

    mysqli_stmt_execute($s);

    mysqli_stmt_close($s);
}
//echo $s;
if (mysqli_stmt_execute($s)) {
    $msg = 1;
	echo "Enquiry updated successfully.";
} else {
    $msg = 2;
    echo "Unable to update enquiry.";
}
?>
			<table border="0" width="100%" id="table2" style="border-collapse: collapse" bordercolor="#CCCCCC" height="206" cellpadding="0">
				<tr>
					<td width="228" valign="top" bgcolor="#EEEEEE">			<?php if ($_SESSION["aid"]!="") include("sidemenu.php"); ?></td>
					<td align="center" valign="top" bgcolor="#FFFFFF">
					<h1>View /Edit/ Enquiry</h1>
					<h3>
<?php
if($msg==1)
    echo "Enquiry updated successfully.";
?>
</h3>
					<table border="0" width="90%" id="table13" cellpadding="0" style="border-collapse: collapse" bordercolor="#697779" height="128">
						<tr>
							<td valign="top" width="402">
							<table class="table3" border="0" width="434"  id="table14" cellpadding="0" style="border-collapse: collapse" bordercolor="#697779" height="174">
						
	<?php
	if (isset( $_GET["id"]))
	{
		$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$s = mysqli_prepare($con, "SELECT * FROM agenquiry WHERE eid=?");

mysqli_stmt_bind_param($s, "i", $id);

mysqli_stmt_execute($s);

$result = mysqli_stmt_get_result($s);

$row = mysqli_fetch_assoc($result);
	   $r=mysqli_query($con,$s);
if (!$r) {
    die(mysqli_error($con));
}
	   if($row=mysqli_fetch_assoc($r))
		{
		?>
			<form
method="post"
action="EditEnq.php"
name="frmhlp"
id="frmhlp"
autocomplete="off"
onsubmit="return vfhfn();">
<tr>
	<td width="103" height="30">Enquiry Date</td><td width="331" height="30">
	&nbsp;<b><?php echo htmlspecialchars($row['edate']); ?></b>
	<input  type="hidden" name="eid" id="eid" tabindex="4" value="<?php echo htmlspecialchars($row['eid']); ?>"  size="1"/>
	</td>
</tr>
<tr>
	<td width="103" height="30">Company&nbsp; Name
	</td><td width="331" height="30">
	<input  class="txtbox" type="text" name="aname" id="cname" tabindex="4" value="<?php echo htmlspecialchars($row['ename']); ?>"  size="1"/></td>
</tr>
<tr>
	<td width="103" height="30">Contact Person</td><td width="331" height="30">
	<input  class="txtbox" type="text" name="cate" id="aname0" tabindex="4" onfocus="if(this.value=='Agent Name'){this.value='';}" onblur="if(this.value==''){this.value='Agent Name';}" size="24" value="<?php echo htmlspecialchars($row['cate']); ?>"/></td>
</tr>
<tr>
	<td width="103" height="30">Address/ Area</td><td width="331" height="30">
	<input  class="txtbox" type="text" name="address" id="remark" tabindex="4"  value="<?php echo htmlspecialchars($row['address']); ?>" size="1"/></td>
</tr>
<tr>
	<td width="86" height="28">City</td><td width="222" height="28">
	<input  class="txtbox" type="text" name="city" id="mobile0" tabindex="4"  size="1" value="<?php echo htmlspecialchars($row['city']); ?>"/></td>
	</tr>
<tr>
	<td width="86" height="37">Mobile</td><td width="222" height="37">
	<input  class="txtbox" type="tel" name="mobile" id="mobile1" tabindex="4"  size="1" value="<?php echo htmlspecialchars($row['mobile']); ?>"/></td>
	</tr>
<tr>
	<td width="86" height="43">Email</td><td width="222" height="43">
	<input  class="txtbox" type="email" name="email" id="mobile2"  value="<?php echo htmlspecialchars($row['email']); ?>"/></td>
	</tr>
<tr>
	<td width="103" height="41">Website</td><td width="331" height="41">
	<input  class="txtbox" type="url" name="web" id="mobile3" tabindex="4"  size="1" value="<?php echo htmlspecialchars($row['web']); ?>"/></td>
</tr>
<tr>
	<td width="103" height="30">Status</td><td width="331" height="30">
	&nbsp;<?php echo htmlspecialchars($row['estatus']); ?></td>
</tr>
<tr><td width="103" height="55">&nbsp;</td><td width="331" height="55">
	<input  class="subbox" type="submit" value="Update" name="submit"/>&nbsp;
	</td>
	</tr>
</form>
<?php
}
}
?>
					</table>
							<table class="table3" border="0" width="96%"  id="table16" cellpadding="0" style="border-collapse: collapse" bordercolor="#697779">
						</td>
						</tr>
					</table>
							</td>
						</tr>
					</table></p>
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
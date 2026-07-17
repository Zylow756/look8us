<?php
require_once __DIR__ . "/../config.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (empty($_SESSION['admin'])) {
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
background-image:url('img/bg.png');
background-repeat:repeat-x;
background-color: #70828F;;
} 
</style>
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
					<h1>View All Enquiry<br>
&nbsp;</h1>
<form name="frmhlp" id="frmhlp" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

	<table border="0" width="100%" id="table4" style="border-collapse: collapse" height="146">
						<tr>
							<td width="141" height="52">&nbsp; <font color="#000000"><b>&nbsp; 
							<font size="2">Select Member</font></b></font></td>
							<td width="426" height="52">
	
<select name="mid" class="selbox4" >
<?php
$st="Select * from member order by mname,compname";
$i=1;
$result=mysqli_query($con,$st);
if (!$result) {
    die(mysqli_error($con));
}

	while ($row=mysqli_fetch_assoc($result))
	{	
	?>
	<option value="<?php echo htmlspecialchars($row['mid']) ; ?>" <?php echo (isset($_POST['mid']) && (int)$_POST['mid'] === (int)$row['mid']) ? 'selected' : ''; ?>  > <?php echo htmlspecialchars($row["mname"])." (". htmlspecialchars($row["compname"]).")"." - ".htmlspecialchars($row["mplan"]) ; ?></option>
	<?php
	}
	?>
					</select>								
							</td>
							<td height="52">
	<input  class="subbox" type="submit" value="Show" name="submit"/></td>
						</tr>
						<tr>
							<td width="141">&nbsp;&nbsp;&nbsp;
							<font color="#000000"><b><font size="2">Select </font></b></font>
							<font size="2" color="#000000"><b>Company</b></font></td>
							<td width="426">
<select name="mid0" class="selbox4" >
<?php
$st="Select * from member order by compname,mname";
$i=1;
$result=mysqli_query($con,$st);
if (!$result) {
    die(mysqli_error($con));
}

	while ($row=mysqli_fetch_assoc($result))
	{	
	?>
	<option value="<?php echo htmlspecialchars($row['mid']) ; ?>" <?php echo (isset($_POST['mid0']) && (int)$_POST['mid0'] === (int)$row['mid']) ? 'selected' : ''; ?> > <?php echo htmlspecialchars($row["compname"])." (". htmlspecialchars($row["mname"]).")"." - ".htmlspecialchars($row["mplan"]) ; ?></option>
	<?php
	}
	?>
	</select></td>
							<td>
	<input  class="subbox" type="submit" value="Show" name="submit0"/></td>
						</tr>
						<tr>
							<td width="141">&nbsp;</td>
							<td width="426">
&nbsp;</td>
							<td>
	&nbsp;</td>
						</tr>
						<tr>
							<td height="32" colspan="3" align="center">
<?php
if (isset($_POST['submit']) || isset($_POST['submit0'])) {

    $mid = isset($_POST['mid'])
        ? (int)$_POST['mid']
        : (isset($_POST['mid0']) ? (int)$_POST['mid0'] : 0);

    $st = "SELECT * FROM member WHERE mid=$mid";
    $result = mysqli_query($con, $st);

    if (!$result) {
        die(mysqli_error($con));
    }

    if ($row = mysqli_fetch_assoc($result)) {
        echo "<h3>"
            . htmlspecialchars($row['mname'])
            . " - "
            . htmlspecialchars($row['compname'])
            . "</h3>";
    }
}
?>
	
&nbsp;</td>
						</tr>
					</table>
					<?php
					if( (isset($_POST["submit"]))|| (isset($_POST["submit0"])) )
					{
					?>
					<table class="table2"  width="94%" id="table3" border="1"    >
								<tr>
									<td bgcolor="#D2D2D2" width="5%">&nbsp;SNO.</td>
									<td bgcolor="#D2D2D2" width="10%" style="text-align: center">
									Date</td>
									<td bgcolor="#D2D2D2" width="17%">&nbsp; Name</td>
									<td bgcolor="#D2D2D2" width="13%">&nbsp;Mobile</td>
									<td bgcolor="#D2D2D2" width="14%" style="text-align: left">
									&nbsp;Email</td>
									<td bgcolor="#D2D2D2" width="8%" style="text-align: left">
									&nbsp;City</td>
									<td bgcolor="#D2D2D2" width="30%" style="text-align: left">
									&nbsp;Message</td>
								</tr>
			<?php	
$mid = isset($_POST['mid']) ? (int)$_POST['mid'] : (int)$_POST['mid0'];

$st = "SELECT *
       FROM enquiry
       WHERE mid=$mid
       ORDER BY qid DESC";

$i=1;

$result=mysqli_query($con,$st);
if (!$result) {
    die(mysqli_error($con));
}
//echo $st;

	while ($row=mysqli_fetch_assoc($result))
	{	
	?>
			<tr>
										<td height="29" width="5%" style="text-align: center">&nbsp;<?php echo $i; ?></td>
										<td height="29" width="10%" style="text-align: center">&nbsp;<?php echo htmlspecialchars($row["qdate"]); ?></td>
										<td height="29" width="17%">&nbsp;<?php echo htmlspecialchars($row["qname"]); ?></td>
										<td height="29" width="13%">&nbsp;<?php echo htmlspecialchars($row["mobile"]); ?></td>
										<td height="29" width="14%" style="text-align: left">&nbsp;<?php 	echo htmlspecialchars($row["email"]);  ?></td>
										<td height="29" width="8%" style="text-align: left">&nbsp;<?php echo htmlspecialchars($row["city"]); ?></td>
										<td height="29" width="30%" style="text-align: left">&nbsp;<?php echo htmlspecialchars($row["query"]); ?></td>
									</tr>
								
								<?php
								$i=$i+1;
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
			<td height="57" align="center" valign="top">			<?php  require_once "../footer.php"; ?></td>
		</tr>
	</table>
</div>
</body>
</html>
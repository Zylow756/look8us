<?php
require_once "config.php";

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
<script language="JavaScript1.2">
 
//Disable select-text script (IE4+, NS6+)- By Andy Scott
//Exclusive permission granted to Dynamic Drive to feature script
//Visit http://www.dynamicdrive.com for this script
 
function disableselect(e){
return false
}
 
function reEnable(){
return true
}
 
//if IE4+
document.onselectstart=new Function ("return false")
 
//if NS6
if (window.sidebar){
document.onmousedown=disableselect
document.onclick=reEnable
}
</script> 
</head>
<?php
$msg=0;
?>
<body >
<script language=JavaScript>
<!--

//Disable right mouse click Script
//By Maximus (maximus@nsimail.com) w/ mods by DynamicDrive
//For full source code, visit http://www.dynamicdrive.com

var message="Sorry, The Right Click is Disabled!";

///////////////////////////////////
function clickIE4(){
if (event.button==2){
alert(message);
return false;
}
}

function clickNS4(e){
if (window.sidebar||document.getElementById&&!document.all){
if (e.which==2||e.which==3){
alert(message);
return false;
}
}
}

if (window.sidebar){
document.captureEvents(Event.MOUSEDOWN);
document.onmousedown=clickNS4;
}
else if (document.all&&!document.getElementById){
document.onmousedown=clickIE4;
}

document.onselectstart=new Function("alert(message);return false")

// --> 
</script>
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
					<h1>Search Member</h1>
					
					</p>
					<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="get">
					
					<table border="1" width="96%" id="table6" style="border-collapse: collapse" bordercolor="#F4F4F4" height="83">
						<tr>
							<td height="43" bgcolor="#F4F4F4" width="95">
							<font size="2">&nbsp;Enter Char</font></td>
							<td height="43" bgcolor="#F4F4F4">
	<input type="text" class="txtbox" id="q" size="38" name="q" value="<?php echo htmlspecialchars($_GET['q'] ?? ''); ?>"></td>
						</tr>
						<tr>
							<td bgcolor="#E3E3E3" width="95"><font size="2">&nbsp;Search By</font></td>
							<td bgcolor="#E3E3E3">
	<select  class="selbox" name="qtyp" id="qtyp" size="1" tabindex="5">
	<option value="0" <?php if (isset($_GET["qtyp"])) if ($_GET["qtyp"]=="0")  echo "Selected" ; ?> >Member Name</option>
	<option value="1" <?php if (isset($_GET["qtyp"])) if ($_GET["qtyp"]=="1")  echo "Selected" ; ?>>Company Name</option>
	
	</select> 
	<input type="submit" name="submit1" style="width: 100px; height: 26" id="submit1" value="Search" ></td>
						</tr>
					</table>
				
<br>	<?php						

if (isset($_GET["q"]))
{

?>

	<table class="table2"  width="96%" id="table5" border="1"    >
								<tr>
									<td bgcolor="#D2D2D2" width="8%">&nbsp;SNO.</td>
									<td bgcolor="#D2D2D2" width="17%">&nbsp;Company Name</td>
									<td bgcolor="#D2D2D2" width="16%">&nbsp;Member&nbsp; 
									Name</td>
									<td bgcolor="#D2D2D2" width="8%" style="text-align: center">
									Address</td>
									<td bgcolor="#D2D2D2" width="8%" style="text-align: center">
									Area</td>
									<td bgcolor="#D2D2D2" width="8%" style="text-align: center">
									City</td>
									<td bgcolor="#D2D2D2" width="8%" style="text-align: center">
									Mobile</td>
									<td bgcolor="#D2D2D2" width="10%" style="text-align: center">
									View</td>
									<td bgcolor="#D2D2D2" width="8%" style="text-align: center">
									&nbsp;Status</td>
									<td bgcolor="#D2D2D2" width="6%" style="text-align: center">
									&nbsp;Plan</td>
									<td bgcolor="#D2D2D2" width="6%" style="text-align: center">
									Expiry</td>
								</tr>
			<?php						

$q = trim($_GET['q'] ?? '');

if ($_GET['qtyp'] == "0") {

    $stmt = mysqli_prepare(
        $con,
        "SELECT * FROM member
         WHERE mname LIKE ?
         ORDER BY compname,mname"
    );

} else {

    $stmt = mysqli_prepare(
        $con,
        "SELECT * FROM member
         WHERE compname LIKE ?
         ORDER BY compname,mname"
    );

}

$search = "%".$q."%";

mysqli_stmt_bind_param($stmt,"s",$search);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
//echo $st;
$i=1;
$result=mysqli_query($con,$st);
if (!$result) {
    die(mysqli_error($con));
}

	while($row=mysqli_fetch_assoc($result))
	{	
	
	?>
				
								<tr>
									<td height="29" width="8%">&nbsp;<?php echo $i; ?></td>
									<td height="29" width="17%">&nbsp;<?php echo htmlspecialchars($row["compname"]); ?></td>
									<td height="29" width="16%">&nbsp;<?php echo htmlspecialchars($row["mname"]); ?></td>
									<td height="29" width="8%" style="text-align: center">&nbsp;<?php 	echo htmlspecialchars($row["address"]);  ?></td>
									<td height="29" width="8%" style="text-align: center">&nbsp;<?php echo htmlspecialchars($row["area"]); ?></td>
									<td height="29" width="8%" style="text-align: center">&nbsp;<?php echo htmlspecialchars($row["city"]); ?></td>
									<td height="29" width="8%" style="text-align: center">&nbsp;<?php echo htmlspecialchars($row["mobile"]); ?></td>
									<td height="29" width="10%" style="text-align: center">&nbsp;<a class="a5" href="ViewDetail.php?id=<?php echo urlencode($row['mid']); ?>">
View
</a></td>
									<td height="29" width="8%" style="text-align: center">&nbsp;
									<?php 
									echo ($row['mstatus']==0)
    ? "Enabled"
    : "<strong>Disabled</strong>";
									?>
									</td>
									<td height="29" width="6%" style="text-align: center">&nbsp;<?php echo htmlspecialchars($row["mplan"]); ?></td>
									<td height="29" width="6%" style="text-align: center">
									
										<?php 
									if (!empty($row["z"]) && $row["z"] != "-")
									{
										echo date("d-m-Y", strtotime($row["z"]));
									}
									else
									echo "-";

								 ?>
								 
								 </td>
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
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
<SCRIPT LANGUAGE="JavaScript" SRC="../CalendarPopup.js"></SCRIPT>
	<SCRIPT LANGUAGE="JavaScript">
	var cal = new CalendarPopup();
</SCRIPT>
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
function add_date($original_date,$d,$m,$y)
{
    $current_date = strtotime($original_date);
    $resultant_date = date('Y-m-d', mktime(0,0,0,date('m',$current_date)+$m,date('d',$current_date)+$d,date('Y',$current_date)+$y));
    return $resultant_date;
}
$msg=0;


if ( isset($_POST['submit']))
{
	$ag1= $_POST["tdate"];
	$ag2= add_date($ag1, "0","0","0");
	$fp="-";
		
		$valid_formats = array("jpg","JPG","png","PNG","gif","GIF","bmp","BMP");
		
				if (isset($_FILES['photoimg']) && $_FILES['photoimg']['error'] === UPLOAD_ERR_OK)
{
    $name = $_FILES["photoimg"]["name"];
    $size = $_FILES["photoimg"]["size"];

    if (!empty($name))
    {
        $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
        $txt = pathinfo($name, PATHINFO_FILENAME);

        if (in_array($ext, $valid_formats))
        {
            if ($size <= (1024 * 1024))
            {
                $fp = date('d')."_".date('M')."_".date('Y')."_".time()."_".substr(str_replace(" ", "_", $txt),0,5).".jpg";

                if (!move_uploaded_file($_FILES["photoimg"]["tmp_name"], "logo/".$fp))
                {
                    $fp = "-";
                }
            }
            else
            {
                $msg = 2;
            }
        }
    }
}
				$stmt = mysqli_prepare(
    $con,
    "INSERT INTO activity
    VALUES (NULL, ?, ?, ?, ?, ?, ?, 'Pending')"
);

$mid = $_SESSION["mid"] ?? '';
$eventhead = trim($_POST['eventhead'] ?? '');
$remark    = trim($_POST['remark'] ?? '');
$tdate     = trim($_POST['tdate'] ?? '');

if ($eventhead === '' || $remark === '' || $tdate === '') {
    $msg = 3;
}

mysqli_stmt_bind_param(
    $stmt,
    "ssssss",
    $eventhead,
    $remark,
    $fp,
    $mid,
    $ag1,
    $ag2
);

mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);	
					
		mysqli_query($con,$stmt);
		
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
					<td width="228" valign="top" bgcolor="#E3E3E3">			<?php if (!empty($_SESSION["mid"])) include("sidemenu.php"); ?></td>
					<td align="center" valign="top" bgcolor="#FFFFFF">
					<h1>&nbsp;Add Event/Activity</h1>
					<p>&nbsp;<?php 
					if ($msg==1) echo "<h3>Activity Add Successfully.</h3>" ; 
					elseif  ($msg==2) echo "<h3>>Image size exceeds the allowed limit.</h3>" ;
					
					//  echo $s;  
					  ?></p>
					<table border="0" width="98%" id="table17" cellpadding="0" style="border-collapse: collapse" bordercolor="#697779" height="128">
						<tr>
							<td valign="top" >
							<table class="table3" border="0" width="99%"  id="table20" cellpadding="0" style="border-collapse: collapse" bordercolor="#697779">
						
						<form name="frmhlp" id="frmhlp" method="post" action="AddActivity.php" enctype="multipart/form-data">
						
<tr>
	<td width="150" height="30">Event Date</td><td width="580" height="30">
	<input type="text" name="tdate" value="" size="17"  >
<A HREF="#" onClick="cal.select(document.forms['frmhlp'].tdate,'anchor1','dd-MM-yyyy'); return false;"  NAME="anchor1" ID="anchor1">
	<img src="../Admin/cal.gif" width="16" height="16" border="0" alt="Pick a date"></A>&nbsp;&nbsp; </td>
</tr>
						

<tr>
	<td width="150" height="30">Event Heading</td><td width="580" height="30">
	



	<input  type="text" name="eventhead" id="eventhead" tabindex="2"  size="77"/></td>
</tr>
						

<tr>
	<td width="150" height="84" valign="top">Event Detail</td>
	<td width="580" height="84">
	
<textarea name="remark" rows="11" cols="66" ></textarea></td>
</tr>
<tr>
	<td width="150" height="22">&nbsp;</td><td width="580" height="22">
	&nbsp;</td>
</tr>
<tr>
	<td width="150" height="30">Event Image if any</td>
	<td width="580" height="30">
	<input type="file" name="photoimg"   id="photoimg" size="50"  accept=".jpg,.jpeg,.png,.gif,.bmp"/></td>
</tr>
<tr>
	<td width="150" height="20">&nbsp;</td><td width="580" height="20">
	&nbsp;</td>
</tr>
<tr>
	<td width="150" height="38">&nbsp;</td><td width="580" height="38">
	<input  class="subbox" type="submit" value="Add Activity" name="submit"/></td>
</tr>
<tr><td width="150" height="71">&nbsp;</td><td width="580" height="71">
	&nbsp;</td>
	</tr>
</form>
					</table>
							
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
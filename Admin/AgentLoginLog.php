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
background-color: #70828F;;
} 
</style>


<script>
 
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
			
if (isset($_GET["eid"]))
{
$hid = (int)($_GET['hid'] ?? 0);
$eid = (int)($_GET['eid'] ?? 0);

$st = "UPDATE agenquiry SET hid=$hid WHERE eid=$eid";

if (!mysqli_query($con, $st)) {
    die(mysqli_error($con));
}
mysqli_query($con,$st);
}	


				

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
if (document.layers||document.getElementById&&!document.all){
if (e.which==2||e.which==3){
alert(message);
return false;
}
}
}

if (document.layers){
document.captureEvents(Event.MOUSEDOWN);
document.onmousedown=clickNS4;
}
else if (document.all&&!document.getElementById){
document.onmousedown=clickIE4;
}

document.oncontextmenu=new Function("alert(message);return false")

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
					<td width="228" valign="top" bgcolor="#EEEEEE">			<?php
if (!empty($_SESSION['id'])) {
    include("sidemenu.php");
}
?></td>
					<td align="center" valign="top" bgcolor="#FFFFFF">
					<h1>&nbsp;Login Log Detail for Agent</h1>
					<h1><br>
&nbsp;</h1>
				

<table class="table2"  width="92%" id="table3" border="1">
                            <thead>
                                <tr>
                                    <th style="width:8px;" bgcolor="#C0C0C0">SNO</th>
                                    <th bgcolor="#C0C0C0">User Name</th>
                                    <th bgcolor="#C0C0C0">Date</th>
                                    <th bgcolor="#C0C0C0" >Time</th>
                                    <th bgcolor="#C0C0C0" >Server-IP</th>
                                    <th class="hidden-phone" bgcolor="#C0C0C0">Remote-IP</th>
                                   <th class="hidden-phone" bgcolor="#C0C0C0">Remark</th>
                                  

                                   
                                </tr>
                            </thead>
                            <tbody>
                            
                            
				 <?php						
				
				$st="Select * from loginlog where uid<>2  order by logid desc limit 100";
				
				//echo $st;
				$amt=0;
				$pn=0;
				$i=1;
				$result=mysqli_query($con,$st);
if (!$result) {
    die(mysqli_error($con));
}
				
					while ($row = mysqli_fetch_assoc($result))
					{	
					
					?>
								

                                <tr class="odd gradeX">
                                    <td><?php echo $i; ?></td>
                                    <td>  <?php echo htmlspecialchars($row["uname"]); ?> </td>
                                    <td>  <?php echo htmlspecialchars($row["ldate"]); ?> </td>
                                      <td ><?php echo htmlspecialchars($row["ltime"]); ?></td>
                                     <td ><?php echo htmlspecialchars($row["logip"]); ?></td>
                                    <td class="hidden-phone"><?php echo htmlspecialchars($row["logip1"]);  ?></td>
                                    <td class="hidden-phone"><?php echo htmlspecialchars($row["x"]); ?></td>
                                    
                                     
                                </tr>
                                
                   			  <?php
								$i=$i+1;

								
								
								}
								?>
           
                                
                                
                                
                                </tbody>
                        </table>
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
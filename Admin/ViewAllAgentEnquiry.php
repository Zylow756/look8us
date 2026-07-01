<?php

session_start();


if ( isset($_SESSION['user']))
 {
   if($_SESSION['user']=="") 
 	header("location: index.php?r=0"); 
 }
else
 		header("location: index.php?r=0"); 




  
  
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
include("../config.php"); 

$msg=0;
			
if (isset($_GET["eid"]))
{
$st="update agenquiry set hid=".$_GET["hid"]." where eid=".$_GET["eid"];
mysql_query($st,$con);
echo $st;
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
					<h1>Search Enquiry by Agent<br>
&nbsp;</h1>
				

<form name="frmhlp" id="frmhlp" method="post" action="ViewAllAgentEnquiry.php" >

Enter Company Name or Mobile No

<input type="text" name="pname" size="16" value="<?php if (isset($_POST['pname'])) echo $_POST['pname']; ?>"  >
<input type="submit" value="Show" name="submit">&nbsp;&nbsp; 
<input type="radio" value="1" name="hid" <?php if (isset($_POST['hid'])){ if ($_POST['hid']==1)echo 'checked'; } else echo 'checked'; ?> > Show Data
<input type="radio" value="0" name="hid"  <?php if (isset($_POST['hid'])) if ($_POST['hid']==0)echo 'checked';  ?> > Hide Data&nbsp;&nbsp; <br>&nbsp;

<br>&nbsp;
					
				
					
					
					<table class="table2"  width="99%" id="table3" border="1"    >
								<tr>
									<td bgcolor="#D2D2D2"  height="33">&nbsp;SNO.</td>
									<td bgcolor="#D2D2D2"  style="text-align: center" height="33">
									Agent Name</td>
									<td bgcolor="#D2D2D2"  style="text-align: center" height="33">
									Enq.Date</td>
									<td bgcolor="#D2D2D2"  height="33">&nbsp; 
									Company Name</td>
									<td bgcolor="#D2D2D2"  height="33">
									&nbsp;Contact Person</td>
									<td bgcolor="#D2D2D2"  height="33" style="text-align: center">&nbsp;Show/<br>
&nbsp;Hide</td>
									<td bgcolor="#D2D2D2"  height="33">Mobile</td>
									<td bgcolor="#D2D2D2"  height="33">&nbsp; Address</td>
									<td bgcolor="#D2D2D2"  height="33">
									&nbsp;Area </td>
									<td bgcolor="#D2D2D2" height="33">&nbsp;Last 
									Feedback</td>
									<td bgcolor="#D2D2D2"  height="33">
									Next Follow</td>
									<td bgcolor="#D2D2D2"  height="33">&nbsp;Status</td>
								</tr>
			<?php						


if (isset($_POST["submit"]))
{

if ($_POST["hid"]==1)
	$st="Select agenquiry.*,agent.aname from agenquiry,agent where agent.aid=agenquiry.aid and hid=1 and ((ename like '%".$_POST["pname"]."%')or ( agenquiry.mobile like '%".$_POST["pname"]."%') ) order by eid desc";
else
	$st="Select agenquiry.*,agent.aname from agenquiry,agent where agent.aid=agenquiry.aid and hid=0 and ((ename like '%".$_POST["pname"]."%')or ( agenquiry.mobile like '%".$_POST["pname"]."%') ) order by eid desc";

}

else
	$st="Select agenquiry.*,agent.aname from agenquiry,agent where agent.aid=agenquiry.aid and hid=1 order by eid desc";


//echo $st;

$i=1;
$result=mysql_query($st,$con);

$num_rows = mysql_num_rows($result);

	while ($row=mysql_fetch_array($result))
	{	
	
	?>
				
								<tr>
									<td height="29"  style="text-align: center">&nbsp;<?php echo $num_rows; ?></td>
									<td height="29"  style="text-align: center">&nbsp;<?php echo $row["aname"]; ?></td>
									<td height="29"  style="text-align: center">&nbsp;<?php echo $row["edate"]; ?></td>
									<td height="29" >&nbsp;
									<a class="a5"  href="ViewEnqStatus.php?eid=<?php echo $row['eid']; ?> " >
									<?php echo $row["ename"]; ?>	
									</a>
									</td>
									<td height="29" >&nbsp;<?php echo $row["cate"]; ?></td>
									<td height="29" style="text-align: center" >
									<?php if ($row['hid']==1){ ?>
									<a class="a5" href="ViewAllAgentEnquiry.php?hid=0&eid=<?php echo $row['eid']; ?>" >Hide </a>
									<?php }
									else
									{?>
									<a class="a2" href="ViewAllAgentEnquiry.php?hid=1&eid=<?php echo $row['eid']; ?>" >Show </a>
										<?php
										}
										?>
								
									
									</td>
									<td height="29" >&nbsp;<?php echo $row["mobile"]; ?></td>
									<td height="29" >&nbsp;<?php echo $row["address"]; ?></td>
									<td height="29" >&nbsp;<?php echo $row["area"]; ?></td>
									<td height="29" >&nbsp;<?php echo $row["cdate"]; ?></td>
									<td height="29" >&nbsp;<?php echo $row["ndate"]; ?></td>
									<td height="29" >&nbsp;<?php echo $row["estatus"]; ?></td>
								</tr>
								
								<?php
								$num_rows=$num_rows-1;
								}
								
								
								?>
							</table>
							
							
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
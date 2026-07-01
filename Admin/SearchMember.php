
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
					<h1>Search Member</h1>
					
					</p>
					<form action="Searchmember.php" method="get">
					
					<table border="1" width="96%" id="table6" style="border-collapse: collapse" bordercolor="#F4F4F4" height="83">
						<tr>
							<td height="43" bgcolor="#F4F4F4" width="95">
							<font size="2">&nbsp;Enter Char</font></td>
							<td height="43" bgcolor="#F4F4F4">
	<input type="text" class="txtbox" id="q" size="38" name="q" value='<?php if (isset($_GET["q"])){ echo $_GET["q"];} ?>' ></td>
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

if ($_GET["qtyp"]=="0")
	$st="Select * from member where mname like '%".$_GET["q"]."%' order by compname, mname";
else if ($_GET["qtyp"]=="1")
	$st="Select * from member where compname like '%".$_GET["q"]."%' order by compname, mname";

//echo $st;
$i=1;
$result=mysql_query($st,$con);

	while ($row=mysql_fetch_array($result))
	{	
	
	?>
				
								<tr>
									<td height="29" width="8%">&nbsp;<?php echo $i; ?></td>
									<td height="29" width="17%">&nbsp;<?php echo $row["compname"]; ?></td>
									<td height="29" width="16%">&nbsp;<?php echo $row["mname"]; ?></td>
									<td height="29" width="8%" style="text-align: center">&nbsp;<?php 	echo $row["address"];  ?></td>
									<td height="29" width="8%" style="text-align: center">&nbsp;<?php echo $row["area"]; ?></td>
									<td height="29" width="8%" style="text-align: center">&nbsp;<?php echo $row["city"]; ?></td>
									<td height="29" width="8%" style="text-align: center">&nbsp;<?php echo $row["mobile"]; ?></td>
									<td height="29" width="10%" style="text-align: center">&nbsp;<?php echo "<a class='a5' href='ViewDetail.php?id=".$row['mid']."'>View</a>"; ?></td>
									<td height="29" width="8%" style="text-align: center">&nbsp;
									<?php 
									if ($row["mstatus"]==0)
										echo "Enable"; 
									else
										echo "<b>Disable</b>"; 
									
									?>
									</td>
									<td height="29" width="6%" style="text-align: center">&nbsp;<?php echo $row["mplan"]; ?></td>
									<td height="29" width="6%" style="text-align: center">
									
										<?php 
									if ($row["z"]<>"-")
									{
									$current_date = strtotime($row["z"]);
								 $resultant_date = date('d-m-Y', mktime(0,0,0,date('m',$current_date),date('d',$current_date),date('Y',$current_date)));
									echo $resultant_date; 
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
			<td height="57" align="center" valign="top">			<?php  include("../footer.php"); ?></td>
		</tr>
	</table>
</div>

</body>

</html>
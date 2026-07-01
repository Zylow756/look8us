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
				$result=mysql_query($st,$con);
				
					while ($row=mysql_fetch_array($result))
					{	
					
					?>
								

                                <tr class="odd gradeX">
                                    <td><?php echo $i; ?></td>
                                    <td>  <?php echo $row["uname"]; ?> </td>
                                    <td>  <?php echo $row["ldate"]; ?> </td>
                                      <td ><?php echo $row["ltime"]; ?></td>
                                     <td ><?php echo $row["logip"]; ?></td>
                                    <td class="hidden-phone"><?php echo $row["logip1"];  ?></td>
                                    <td class="hidden-phone"><?php echo $row["x"]; ?></td>
                                    
                                     
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
			<td height="57" align="center" valign="top">			<?php  include("../footer.php"); ?></td>
		</tr>
	</table>
</div>

</body>

</html>
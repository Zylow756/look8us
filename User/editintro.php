

<?php

session_start();

if (isset($_SESSION['user']))
 {	if ($_SESSION['user']=="")
		  header("location: login.php?r=0");
 }
else
 	 header("location: login.php?r=0");
	
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
background-image:url('../Admin/img/bg.png');
background-repeat:repeat-x;
background-color: #70828F
} 
</style>








</head>

<?php
include("../config.php"); 

$msg=0;
			
if (isset( $_POST["submit"]))
{
$s="update member  set remark='". $_POST['remark']. "',remark1='". $_POST['remark0']. "',gmap='". $_POST['gmap']. "' where mid=".$_SESSION["mid"] ;
mysql_query($s,$con);
//echo $s;
$msg=1;
}


				

?>


	
<body >

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
					<td width="228" valign="top" bgcolor="#E3E3E3">			<?php if ($_SESSION["mid"]!="") include("sidemenu.php"); ?></td>
					<td align="center" valign="top" bgcolor="#FFFFFF">
					<h1>&nbsp;Set Company Profile</h1>
					<p><?php if ($msg==1) echo "<h3>Information Update</h3>" ;  
					
					//  echo $s;  
					  ?></p>
					<table border="0" width="96%" id="table3" style="border-collapse: collapse">
						<tr>
							<td>
							
			<?php 
		$st="Select * from member where mid=".$_SESSION["mid"];
		$result=mysql_query($st,$con);
		if ($row=mysql_fetch_array($result))
		{
		?>
			
			
			<form name="frmhlp" id="frmhlp" method="post" action="editintro.php" >
			<table border="0" width="100%" id="table2" cellpadding="0" style="border-collapse: collapse">
			
				
<tr><td width="1010" align="left" colspan="3"><font color="#0033CC"><b>Brief Introduction
	</b></font>
	</td>
	</tr>

	
<tr><td width="1010" height="30" align="left" colspan="3">

<textarea name="remark" rows="4" cols="86" ><?php  echo $row['remark'];  ?></textarea>
	</tr>

	

							
							
							<tr><td width="295" height="30" align="right">&nbsp;</td>
	<td width="257" height="30" align="center">
	&nbsp;</td>
	<td height="30" valign="top" width="458">
	&nbsp;</td></tr>
			
					<?php	
							if (isset($_SESSION['mplan']))
							{
							
							if ($_SESSION['mplan']=="Platinum")
							{
							?>				
							<tr><td width="1010" height="30" align="left" colspan="3">
								<font color="#0000FF"><b>Google Map Path</b></font></td>
	</tr>
			
							
							<tr><td width="1010" height="30" align="left" colspan="3">

<textarea name="gmap" rows="4" cols="86" ><?php  echo $row['gmap'];  ?></textarea></td>
	</tr>
			
							
							<tr><td width="1010" height="30" align="left" colspan="3">
								<b><font color="#0033CC">Company Profile</font></b></td>
	</tr>
			
							
							<tr><td width="1010" height="30" align="left" colspan="3">

<textarea name="remark0" rows="15" cols="86" ><?php  echo $row['remark1'];  ?></textarea></td>
	</tr>
			
			<?php
							 }
							 else
							 {
							 ?>
							 
							<tr><td width="1010" height="30" align="left" colspan="3">

							 <input  type="hidden" name="remark0"  value="<?php echo $row['remark1'];   ?>"  />


</td>
	</tr>
							 
							 <?php
							 
							 }
							 
							 }
							?> 


<tr><td width="295" height="63">&nbsp;</td>
	<td width="257" height="63" align="center">
	<input  class="subbox" type="submit" value="Update Info" name="submit"/></td>
	<td height="63" width="458">
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
			<td height="57" align="center" valign="top">			<?php  include("../footer.php"); ?></td>
		</tr>
	</table>
</div>

</body>

</html>
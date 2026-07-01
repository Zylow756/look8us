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
session_start();
include("../config.php"); 

$msg=0;
			
if (isset( $_POST["submit"]))
{
$s="update member  set ytube='".$_POST['ytube']."',facebook='".$_POST['facebook']."',twiter='".$_POST['twiter']."',linken='".$_POST['linken']."' where mid=".$_SESSION["mid"] ;
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
					<h1>&nbsp;Add Social Link</h1>
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
			
			
			<form name="frmhlp" id="frmhlp" method="post" action="AddSocialLink.php" >
			<table border="0" width="100%" id="table2" cellpadding="0" style="border-collapse: collapse">
			
				
<tr><td width="295" height="35" align="right">You Tube Link</td>
	<td width="257" height="35" align="center">
	<input  class="txtbox" type="text" name="ytube" id="establish0" tabindex="3" value="<?php echo $row['ytube'];   ?>"  size="1"/></td>
	<td height="35" valign="top" width="458">
	</td></tr>
<tr><td width="295" height="35" align="right">Facebook Link</td>
	<td width="257" height="35" align="center">
	<input  class="txtbox" type="text" name="facebook" id="establish1" tabindex="3" value="<?php echo $row['facebook'];   ?>"  size="1"/></td>
	<td height="35" valign="top" width="458">
	</td></tr>
<tr><td width="295" height="35" align="right">Twitter Link</td>
	<td width="257" height="35" align="center">
	<input  class="txtbox" type="text" name="twiter" id="establish2" tabindex="3" value="<?php echo $row['twiter'];   ?>"  size="1"/></td>
	<td height="35" valign="top" width="458">
	</td></tr>
<tr><td width="295" height="35" align="right">Linden ID</td>
	<td width="257" height="35" align="center">
	<input  class="txtbox" type="text" name="linken" id="establish3" tabindex="3" value="<?php echo $row['linken'];   ?>"  size="1"/></td>
	<td height="35" valign="top" width="458">
	</td></tr>
<tr><td width="295" height="63">&nbsp;</td>
	<td width="257" height="63" align="center">
	<input  class="subbox" type="submit" value="Update Links" name="submit"/></td>
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
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


</head>

<?php
include("../config.php"); 

$msg=0;
			


				

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
					<td width="228" valign="top" bgcolor="#EEEEEE">			<?php if ($_SESSION["id"]!="") include("sidemenu.php"); ?></td>
					<td align="center" valign="top" bgcolor="#FFFFFF">
					<h1>View All Entry by Agent<br>
&nbsp;</h1>
				

<form name="frmhlp" id="frmhlp" method="post" action="viewAgent.php" >

	<table border="0" width="100%" id="table4" style="border-collapse: collapse" height="70">
						<tr>
							<td width="141">&nbsp; <font color="#000000"><b>&nbsp; 
							<font size="2">Select Agent</font></b></font></td>
							<td width="426">
	
<select name="aid" class="selbox4" >
<?php
$st="Select * from agent order by aname";
$i=1;
$result=mysql_query($st,$con);

	while ($row=mysql_fetch_array($result))
	{	
	
	?>
	<option value="<?php echo $row['acode'] ; ?>" <?php if (isset($_POST['aid'])) if($_POST['aid']==$row['acode']) echo 'selected'; ?>  > <?php echo $row["aname"] ; ?></option>
	
	
	<?php
	}
	?>

					</select>								
							</td>
							<td>
	<input  class="subbox" type="submit" value="Show" name="submit"/></td>
						</tr>
					</table>
					
					
					<?php
					
					if (isset($_POST["aid"]))
					{
					?>
					
					
					<table class="table2"  width="94%" id="table3" border="1"    >
								<tr>
									<td bgcolor="#D2D2D2" width="5%">&nbsp;SNO.</td>
									<td bgcolor="#D2D2D2" width="23%" style="text-align: center">
									Date</td>
									<td bgcolor="#D2D2D2" width="34%">&nbsp; Name</td>
									<td bgcolor="#D2D2D2" width="37%">&nbsp;Company</td>
								</tr>
			<?php						

$st="Select * from member where acode='".$_POST['aid']."' order by mid DESC";

//echo $st;
$i=1;
$result=mysql_query($st,$con);

	while ($row=mysql_fetch_array($result))
	{	
	
	?>
				
								<tr>
									<td height="29" width="5%" style="text-align: center">&nbsp;<?php echo $i; ?></td>
									<td height="29" width="23%" style="text-align: center">&nbsp;<?php echo $row["y"]; ?></td>
									<td height="29" width="34%">&nbsp;<?php echo $row["mname"]; ?></td>
									<td height="29" width="37%">&nbsp;<?php echo $row["compname"]; ?></td>
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
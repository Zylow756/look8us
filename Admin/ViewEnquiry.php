

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
session_start();
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
					<h1>View All Enquiry<br>
&nbsp;</h1>
				

<form name="frmhlp" id="frmhlp" method="post" action="viewenquiry.php" >

	<table border="0" width="100%" id="table4" style="border-collapse: collapse" height="146">
						<tr>
							<td width="141" height="52">&nbsp; <font color="#000000"><b>&nbsp; 
							<font size="2">Select Member</font></b></font></td>
							<td width="426" height="52">
	
<select name="mid" class="selbox4" >
<?php
$st="Select * from member order by mname,compname";
$i=1;
$result=mysql_query($st,$con);

	while ($row=mysql_fetch_array($result))
	{	
	
	?>
	<option value="<?php echo $row['mid'] ; ?>" <?php if (isset($_POST['mid'])) if($_POST['mid']==$row['mid']) echo 'selected'; ?>  > <?php echo $row["mname"]." (". $row["compname"].")"." - ".$row["mplan"] ; ?></option>
	
	
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
$result=mysql_query($st,$con);

	while ($row=mysql_fetch_array($result))
	{	
	
	?>
	<option value="<?php echo $row['mid'] ; ?>" <?php if (isset($_POST['mid0'])) if($_POST['mid0']==$row['mid']) echo 'selected'; ?>  > <?php echo $row["compname"]." (". $row["mname"].")"." - ".$row["mplan"] ; ?></option>
	
	
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


if (isset($_POST['submit']))
{	$st="Select * from member  where mid=".$_POST['mid'];}
elseif (isset($_POST['submit0']))
{	$st="Select * from member where mid=".$_POST['mid0'];}


	$result=mysql_query($st,$con);
	if($row=mysql_fetch_array($result))
	echo "<h3>".$row["mname"] . " - " .$row["compname"]."</h3>";
			


	
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


if (isset($_POST['submit']))
{	$st="Select * from enquiry where mid=".$_POST['mid']." order by qid DESC";}
elseif (isset($_POST['submit0']))
{	$st="Select * from enquiry where mid=".$_POST['mid0']." order by qid DESC";}


$i=1;

$result=mysql_query($st,$con);
//echo $st;

	while ($row=mysql_fetch_array($result))
	{	
	
	?>
				
									<tr>
										<td height="29" width="5%" style="text-align: center">&nbsp;<?php echo $i; ?></td>
										<td height="29" width="10%" style="text-align: center">&nbsp;<?php echo $row["qdate"]; ?></td>
										<td height="29" width="17%">&nbsp;<?php echo $row["qname"]; ?></td>
										<td height="29" width="13%">&nbsp;<?php echo $row["mobile"]; ?></td>
										<td height="29" width="14%" style="text-align: left">&nbsp;<?php 	echo $row["email"];  ?></td>
										<td height="29" width="8%" style="text-align: left">&nbsp;<?php echo $row["city"]; ?></td>
										<td height="29" width="30%" style="text-align: left">&nbsp;<?php echo $row["query"]; ?></td>
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
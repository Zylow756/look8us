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

	
<body  onselectstart="return false">

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
					<h1>View All Enquiry by Agent<br>
&nbsp;</h1>
				
					<?php
					
					if (isset($_GET["msg"]))
					{ echo "Email Send Successfully " ; }  
					
					?>
					

<form name="frmhlp" id="frmhlp" method="post" action="viewAgentEnquiry.php" >

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
	<option value="<?php echo $row['aid'] ; ?>" <?php if (isset($_POST['aid'])) if($_POST['aid']==$row['aid']) echo 'selected'; ?>  > <?php echo $row["aname"] ; ?></option>
	
	
	<?php
	}
	?>

					</select>								
							</td>
							<td>
	<input  class="subbox" type="submit" value="Show" name="submit"/> <br>
	
	
					<?php
					
					if (isset($_POST["aid"]))
					{
					?>

&nbsp;<a href="asp-mail/email_purchase_order.aspx?x=<?php echo $_POST['aid'] ; ?> " class="email"  ><font color="#FF0000" size="4">Click for Email >></font></a>
				<?php
				}
				?>
							
							</td>
						</tr>
					</table>
					
					
					<?php
					
					if (isset($_POST["aid"]))
					{
					?>
					
					
					<table class="table2"  width="99%" id="table3" border="1"    >
								<tr>
									<td bgcolor="#D2D2D2" width="5%" height="33">&nbsp;SNO.</td>
									<td bgcolor="#D2D2D2" width="10%" style="text-align: center" height="33">
									Date</td>
									<td bgcolor="#D2D2D2" width="23%" height="33" style="text-align: left">&nbsp; Name</td>
									<td bgcolor="#D2D2D2" width="13%" height="33" style="text-align: left">
									&nbsp; Qualification</td>
									<td bgcolor="#D2D2D2" width="10%" height="33" style="text-align: center">Mobile</td>
									<td bgcolor="#D2D2D2" width="200" height="33" style="text-align: left">
									Mobile2</td>
									<td bgcolor="#D2D2D2" width="8%" height="33" style="text-align: left">&nbsp;Address</td>
									<td bgcolor="#D2D2D2" width="6%" height="33">
									&nbsp;Area </td>
									<td bgcolor="#D2D2D2" width="11%" height="33">&nbsp;Last 
									Feedback </td>
									<td bgcolor="#D2D2D2" width="11%" height="33">&nbsp;Next 
									Follow</td>
									<td bgcolor="#D2D2D2" width="4%" height="33">&nbsp;Status</td>
									<td bgcolor="#D2D2D2" width="3%" height="33">
									View</td>
								</tr>
			<?php						

$st="Select * from agenquiry where aid=" . $_POST['aid'] ." and hid=1  order by eid desc";

//echo $st;
$i=1;

$result=mysql_query($st,$con);

$num_rows = mysql_num_rows($result);

	while ($row=mysql_fetch_array($result))
	{	
	
	?>				<tr>
									<td height="29" width="5%" style="text-align: center">&nbsp;<?php echo $num_rows; ?></td>
									<td height="29" width="10%" style="text-align: center">&nbsp;<?php echo $row["edate"]; ?></td>
									<td height="29" width="23%" style="text-align: left">&nbsp;<?php echo $row["ename"]; ?></td>
									<td height="29" width="13%" style="text-align: left">&nbsp;<?php echo $row["cate"]; ?></td>
									<td height="29" width="10%" style="text-align: center">&nbsp;<?php echo $row["mobile"]; ?></td>
									<td height="29" width="200" style="text-align: left">&nbsp;<?php echo $row["email"]; ?> &nbsp; <?php echo $row["web"]; ?></td>
									<td height="29" width="8%" style="text-align: left">&nbsp;<?php echo $row["address"]; ?></td>
									<td height="29" width="6%">&nbsp;<?php echo $row["area"]; ?></td>
									<td height="29" width="11%">&nbsp;<?php echo $row["cdate"]; ?></td>
									<td height="29" width="11%">&nbsp;<?php echo $row["ndate"]; ?></td>
									<td height="29" width="4%">&nbsp;<?php echo $row["estatus"]; ?></td>
									<td height="29" width="3%">&nbsp;<?php echo "<a class='a2' href='ViewEnqStatus.php?eid=".$row['eid']."'>Detail</a>"; ?></td>
								</tr>
								
								<?php
//								$i=$i+1;
$num_rows=$num_rows-1;

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
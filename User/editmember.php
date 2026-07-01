

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
$s="update member  set mname='". ucwords($_POST['mname']). "',compname='". ucwords($_POST['compname']). "',tagline='". $_POST['tagline']. "',shopno='". $_POST['shopno']. "',address='". ucwords($_POST['address']). "',area='". ucwords($_POST['area']). "',city='". ucwords($_POST['city']). "',state1='". ucwords($_POST['state1']). "',pin='". $_POST['pincode']. "',phone='". $_POST['phone']. "',phone1='". $_POST['phone0']. "',mobile='".$_POST["mobile"]."',mobile1='". $_POST['mobile0']. "',web='".$_POST['website']."',estyear='".$_POST['establish']."' where mid=".$_SESSION["mid"] ;
//$s="update member  set mname='". $_POST['mname']. "',compname='". $_POST['compname']. "',tagline='". $_POST['tagline']. "',shopno='". $_POST['shopno']. "',address='". $_POST['address']. "',area='". $_POST['area']. "',city='". $_POST['city']. "',state1='". $_POST['state1']. "',pin='". $_POST['pincode']. "',phone='". $_POST['phone']. "',phone1='". $_POST['phone0']. "',mobile='".$_POST["mobile"]."',mobile1='". $_POST['mobile0']. "',web='".$_POST['website']."',remark='". $_POST['remark']. "',remark1='". $_POST['remark0']. "',estyear='".$_POST['establish']."' where mid=".$_SESSION["mid"] ;

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
					<h1>&nbsp;Edit Information</h1>
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
			
			
			<form name="frmhlp" id="frmhlp" method="post" action="editmember.php" >
			<table border="0" width="100%" id="table2" cellpadding="0" style="border-collapse: collapse" height="809">
			
				
<tr>
	<td width="295" height="25" align="right">Company/Firm/Shop Name</td>
	<td width="257" height="25" align="center">
	<input class="txtbox" type="text" name="compname" id="compname" tabindex="2" value="<?php echo $row['compname']; ?>"  size="1"/></td>
	<td height="25" width="458">
	&nbsp;</td>
				</tr>
<tr><td width="295" height="25" align="right">Owner/Contact Person Name</td>
	<td width="257" height="25" align="center">
	<input class="txtbox" type="text" name="mname" id="mname" tabindex="1" value="<?php echo $row['mname'];  ?>"  size="1"/></td>
	<td height="25" width="458">
	&nbsp;</td>
				</tr>
<tr><td width="295" height="25" align="right">Company Tag line if any </td>
	<td width="257" height="25" align="center">
	
	<input class="txtbox" type="text" name="tagline" id="tagline" tabindex="2" value="<?php  echo $row['tagline'];  ?>"  size="1"/></td></tr>
<tr>
	<td width="295" height="25" align="right">Shop No./Plot No</td>
	<td width="257" height="25" align="center">
	<input  class="txtbox" type="text" name="shopno" id="shopno" tabindex="3" value="<?php  echo $row['shopno'];  ?>"  size="1"/></td>
	<td height="25" valign="top" width="458">
	&nbsp;</td>
</tr>
<tr>
	<td width="295" height="25" align="right">Address</td>
	<td width="257" height="25" align="center">
	<input  class="txtbox" type="text" name="address" id="address" tabindex="3" value="<?php  echo $row['address'];   ?>"  size="1"/></td>
	<td height="25" valign="top" width="458">
	&nbsp;</td>
</tr>
<tr>
	<td width="295" height="25" align="right">Area</td>
	<td width="257" height="25" align="center">
	<input  class="txtbox" type="text" name="area" id="area" tabindex="3" value="<?php  echo $row['area'];   ?>"  size="1"/></td>
	<td height="25" valign="top" width="458">
	&nbsp;</td>
</tr>
<tr>
	<td width="295" height="25" align="right">City</td>
	<td width="257" height="25" align="center">
	<input  class="txtbox" type="text" name="city" id="city" tabindex="4" value="<?php echo $row['city'];  ?>"  size="1"/></td>
	<td height="25" valign="top" width="458">
	&nbsp;</td>
</tr>
<tr><td width="295" height="30" align="right">State</td>
	<td width="257" height="30" align="center">
	<input  class="txtbox" type="text" name="state1" value="<?php  echo $row['state1'];  ?>"  id="state1" tabindex="9" size="1"/></td>
	<td height="30" valign="top" width="458">
	&nbsp;</td></tr>
<tr><td width="295" height="30" align="right">Pin</td>
	<td width="257" height="30" align="center">
	<input  class="txtbox" type="text" name="pincode" id="pincode" tabindex="3" value="<?php  echo $row['pin'];   ?>"  size="1"/></td>
	<td height="30" valign="top" width="458">
	&nbsp;</td></tr>
				<tr>
					<td width="295" height="30" align="right">Phone Number</td>
					<td width="257" height="30" align="center">
	<input  class="txtbox" type="text" name="phone" id="phone" value="<?php echo $row['phone'];  ?>"  tabindex="10" size="1"/></td>
	<td height="30" valign="top" width="458">
	&nbsp;</td>
				</tr>
				<tr>
					<td width="295" height="30" align="right">Phone Number-2</td>
					<td width="257" height="30" align="center">
	<input  class="txtbox" type="text" name="phone0" id="phone0" value="<?php  echo $row['phone1'];  ?>"  tabindex="10" size="1"/></td>
	<td height="30" valign="top" width="458">
	&nbsp;</td>
				</tr>
<tr><td width="295" height="30" align="right">Mobile Number</td>
	<td width="257" height="30" align="center">
	<input  class="txtbox" type="text" name="mobile" id="mobile" value="<?php  echo $row['mobile'];    ?>" tabindex="10" size="1"/></td>
	<td height="30" valign="top" width="458">
	&nbsp;</td></tr>
				<tr>
					<td width="295" height="30" align="right">Mobile Number-2</td>
					<td width="257" height="30" align="center">
	<input  class="txtbox" type="text" name="mobile0" id="mobile0" value="<?php echo $row['mobile1'];    ?>" size="1"/></td>
	<td height="30" valign="top" width="458">
	&nbsp;</td>
				</tr>
<tr><td width="295" height="30" align="right">Email ID</td>
	<td width="257" height="30" align="center">
	<input class="txtbox" type="text" name="txtmail" readonly id="txttmail" value="<?php  echo $row['email'];     ?>"  tabindex="4" size="1" /></td>
	<td height="30" width="458">
	&nbsp;Can't Update (User ID)</td></tr>
<tr><td width="295" height="30" align="right">Website</td>
	<td width="257" height="30" align="center">
	<input  class="txtbox" type="text" name="website" id="website" tabindex="3" value="<?php  echo $row['web'];   ?>"  size="1"/></td>
	<td height="30" valign="top" width="458">
	&nbsp;</td></tr>
<tr><td width="295" height="9" align="right">Establishment Year</td>
	<td width="257" height="9" align="center">
	<input  class="txtbox" type="text" name="establish" id="establish" tabindex="3" value="<?php echo $row['estyear'];   ?>"  size="1"/></td>
	<td height="9" valign="top" width="458">
	</td></tr>
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
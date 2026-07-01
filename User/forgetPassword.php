<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Online Directory : Admin Panel</title>
 <link rel="stylesheet" type="text/css" href="../akc.css" />

<style type="text/css"> 

body
{
background-image:url('../img/bg.png');
background-repeat:repeat-x;
background-color: #70828F;;
} 
</style>
</head>

<body bgcolor="#748592">

<div align="center">
	<table border="0" width="980" id="table1" style="border-collapse: collapse" bordercolor="#C0C0C0" cellpadding="0">
		<tr>
			<td height="50" align="center" valign="top">
			
			<?php  include("../header.php");
			
include("../config.php");
$msg=0;
if (isset($_POST["submit"]))
{
$s="select * from member  where  email='".$_POST['txtmail']."' and mobile='".$_POST['mobile']."'" ;
		$r=mysql_query($s,$con);
        // echo $s;
		if ($row=mysql_fetch_array($r))
			{
				$msg=1;
			
			header("location:../email.aspx?pass=".base64_decode($row["pass"])."&mid='".$row["mid"]."'");
			//header("location: login.php?r=0");
	
			}	
		else
		{
		$msg=2;
		}		

}

 ?>
</td>
		</tr>
		<tr>
			<td>
			<table border="1" width="100%" id="table2" style="border-collapse: collapse" bordercolor="#808080" height="206">
				<tr>
					<td width="23" valign="top" bgcolor="#C1C1C1">&nbsp;</td>
					<td align="center" valign="top" bgcolor="#85939F" background="../Admin/img/login-whisp.png">
					<br>
&nbsp;<p><?php if (isset($_GET["msg"])) if ($_GET["msg"]==1) echo "<h5>Your Password Send Successfully.</h5>"; ?>
<?php if ($msg==2) echo "<h5>Error : User ID Not found with this Email ID & Mobile Number. </h5>";

elseif ($msg==1) echo "<h5>Your Password Send Successfully.</h5>";

 ?>
</p>
<form action="forgetPassword.php" method="post" >

								<table border="0" width="41%" id="table3" style="border-collapse: collapse" height="166" bordercolor="#E0E2FE" bgcolor="#F1F1F1">
									<tr>
										<td colspan="2" bgcolor="#02203E" height="29">
										<font face="Arial" size="2">
										<font color="#C0C0C0">&nbsp;</font><b><font color="#C0C0C0">Enter 
										Your Detail</font></b></font></td>
									</tr>
									<tr>
										<td width="22%">
										<font face="Arial" size="2" color="#333333">&nbsp;Email ID</font></td>
										<td width="48%"><font face="Arial">&nbsp;
	<input class="txtbox" type="text" name="txtmail" id="txttmail" tabindex="4" /></font></td>
									</tr>
									<tr>
										<td width="22%">
										<font face="Arial" size="2" color="#333333">&nbsp;Mobile Number</font></td>
										<td width="48%"><font face="Arial">&nbsp;
	<input  class="txtbox" type="text" name="mobile" id="txtmble" tabindex="10" size="1"/></font></td>
									</tr>
									<tr>
										<td width="22%">&nbsp;</td>
										<td width="48%">&nbsp;
	<input  class="subbox" type="submit" value="Get Password" name="submit"/></td>
									</tr>
								</table></form>
								<p>&nbsp;</p>
					<p>&nbsp;</p>
					<p>&nbsp;</td>
				</tr>
			</table>
			</td>
		</tr>
		<tr>
			<td align="center" valign="top">			<?php  include("../footer.php"); ?></td>
		</tr>
	</table>
</div>

</body>

</html>
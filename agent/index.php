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
			
			<?php  include("../header.php"); ?>
</td>
		</tr>
		<tr>
			<td>
			<table border="1" width="100%" id="table2" style="border-collapse: collapse" bordercolor="#808080" height="206">
				<tr>
					<td width="23" valign="top" bgcolor="#C1C1C1">&nbsp;</td>
					<td align="center" valign="top" bgcolor="#85939F" background="../Admin/img/login-whisp.png">
					<br>
&nbsp;<table border="0" width="350" id="table2" height="333" background="../Admin/img/login.png" style="border-collapse: collapse">
						<tr>
							<td><form action="home.php" method="post"> 
							<table border="0" class="table4" width="99%" id="table4" style="border-collapse: collapse" height="227">
								<tr>
									<td width="7%" height="41">&nbsp;</td>
									<td height="41" colspan="2" style="text-align: center">
									<font size="4" color="#FF0000">AGENT LOGIN&nbsp;
									</font></td>
								</tr>
								<tr>
									<td width="7%" height="58">&nbsp;</td>
									<td width="26%" height="58" valign="bottom">
									<font color="#333333" size="2">User Name</font></td>
									<td height="58" valign="bottom" width="65%">
									<input type="text" name="t1" class="txtbox" size="27" onfocus="if(this.value=='Your User Name'){this.value='';}" onblur="if(this.value==''){this.value='Your User Name';}"  >  </td>
								</tr>
								<tr>
									<td width="7%" height="47">&nbsp;</td>
									<td width="26%" height="47">
									<font color="#333333" size="2">Password</font></td>
									<td height="47" width="65%"><input type="password" name="t2" class="txtbox1" >  </td>
								</tr>
								<tr>
									<td width="7%" height="31">&nbsp;</td>
									<td colspan="2" height="31">&nbsp;&nbsp;<?php  if (isset($_GET["r"])) echo "Invalid User Name OR Password<br><font size='1' face='Arial' color='#FF0000'>(Please Note User Name & Password is Case Sensitive)</font>"; ?> </td>
								</tr>
								<tr>
									<td width="7%">&nbsp;</td>
									<td width="26%">&nbsp;</td>
									<td width="65%">&nbsp; <input type="submit" name="submit" value="Submit" class="subbox"></td>
								</tr>
								<tr>
									<td width="7%" height="20">&nbsp;</td>
									<td width="26%" height="20">&nbsp;</td>
									<td height="20" width="65%">&nbsp;&nbsp;
									<a href="../index.php" class="a2">Go to 
									Home&gt;</a></td>
								</tr>
							</table>
							<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
							</form>
							</td>
						</tr>
					</table>
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
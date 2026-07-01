<?php
if(!isset($_SESSION))
{
session_start();
}
?>


<?php include("config.php");

$msg=0;

	if (isset($_GET["submit"]))
		{
		
		$st="insert into enquiry values (NULL ,". $_GET["id"]. ",'". $_GET["city"]. "','". $_GET["mname"]. "','". $_GET["mobile"]. "','". $_GET["txtmail"]. "','". $_GET["remark"]. "','".date("d-m-Y")."')" ;
		mysql_query($st,$con);
		//echo $st;
		$msg=1;
			
		}


?>


<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Online Directory Service</title>
 <link rel="stylesheet" type="text/css" href="akc.css" />

</head>

<body topmargin="0" leftmargin="0" rightmargin="0" bottommargin="2" background="images/bg.png">


<?php include("header.php"); ?>
<table border="0" width="100%"  cellpadding="0" style="border-collapse: collapse">
	<tr>
		<td valign="top">
		<div align="center"><?php if ($msg==1) echo "<br><h5>Your Message Successfully Send.</h5>"; ?>
		
			<table border="0" width="1010" id="table33" style="border-collapse: collapse" height="40" cellpadding="0">
			
					
						<?php						

	if (isset($_GET["id"]))
{
$st="Select * from member,memberdetail where member.mid=memberdetail.mid and member.mid =".$_GET["id"];

	//$st="Select * from category,catedetail where category.cateid=catedetail.cateid and cdname like '%".$_POST["item"]."%' and  order by cdname";

//echo $st;
$i=1;
$result=mysql_query($st,$con);

	if ($row=mysql_fetch_array($result))
	{
	?>
	
	<tr>
					<td width="599" align="center" valign="top" style="border-left-width: 1px; border-right-style: dotted; border-right-width: 1px; border-top-width: 1px; border-bottom-width: 1px">
					<br>
					
					<?php echo $row['gmap'];  ?> </td>
					<td width="410" valign="top">
	
	&nbsp;<div align="right">
	
	<table border="0" width="96%" id="table37" style="border-collapse: collapse">
		<tr>
			<td width="21%" align="center" height="105"><a href="http://<?php  echo $row['website'] ; ?>" target="_blank" class="a5">
			<img border="0" src="user/logo/<?php  echo $row['logo'] ; ?>" width="82" height="91"></a></td>
			<td width="79%" height="105">&nbsp;<font color="#333333" size="5"><?php	echo $row["compname"] ; ?>
	



					
					</font></td>
		</tr>
		<tr>
			<td colspan="2" align="center" height="37" valign="top">&nbsp;<a  target="_blank" href="http://<?php  echo $row['twiter'] ; ?>"><img border="0" src="<?php echo $path; ?>images/twitter-icon.png" width="32" height="32"></a>
									<a  target="_blank" href="http://<?php  echo $row['facebook'] ; ?>">
									<img border="0" src="<?php echo $path; ?>images/facebook-icon.png" width="32" height="32"></a>
									<a  target="_blank" href="http://<?php  echo $row['linken'] ; ?>">
									<img border="0" src="<?php echo $path; ?>images/linkedin-icon.png" width="32" height="32"></a>
			<a href="http://<?php  echo $row['ytube'] ; ?>">
									<img border="0" src="<?php echo $path; ?>images/uTube.png" width="32" height="32"></a>
								
								
									&nbsp;
&nbsp;

									</td>
		</tr>
		<tr>
			<td colspan="2" align="center" height="37" valign="top">
									
	
				
									
									<div align="left">
									
	
				
									
									<table class="table1" border="0" width="99%" id="table42" style="border-collapse: collapse" bordercolor="#E3E3E3" cellpadding="0">
										<tr>
											<td width="47%" height="8">
											</td>
										</tr>
										<tr>
											<td width="47%" height="25">
											<p style="line-height: 25px"><b>
											<font size="3" color="#003366">Contact Person : <?php echo $row["mname"] ; ?></font></b><font size="3" color="#003366">
											</font>
											</td>
										</tr>
										<tr>
											<td width="47%" height="25"><b>
											<font color="#003366">&nbsp;Address&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</font></b><font color="#003366" size="2"> <?php echo ucwords($row["shopno"]) ; ?>
											<?php echo ucwords($row["address"]) ; ?>
											<?php echo ucwords($row["area"]) ; ?>
											<?php echo $row["city"] ; ?>
											<?php echo $row["state1"] ; ?>




											</font>




</td>
										</tr>
										<tr>
											<td width="47%" height="25">
											<font color="#003366"><b>
											&nbsp;Contact No. :</b></font><font size="2" color="#003366"> <?php echo $row["phone"] ; ?>,
											<?php echo $row["mobile"] ; ?>
											</font>



</td>
										</tr>
										<tr>
											<td width="47%" height="25">
											<font color="#003366">
											<b>
											&nbsp;Email&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</b><font size="2"> <?php echo $row["email"] ; ?> 
											


											</font>



											</font>



</td>
										</tr>
										<tr>
											<td width="47%" height="25">
											<font color="#003366"><b>
											&nbsp;Website&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</b><font size="2">  
								
			<a href="https://<?php  echo $row['web'] ; ?>" target="_blank" class="a5">
			<?php echo $row["web"] ; ?>
			</a>



											</font>



											</font>



											</td>
										</tr>
										<tr>
			<td align="center" height="3" valign="bottom" bgcolor="#D3D3D3"></td>
										</tr>
										<tr>
											<td height="20">
											</td>
										</tr>
										<tr>
											<td height="25">
											<div align="center">
											
											</div>
											</td>
										</tr>
										<tr>
											<td height="200" style="border-left-width: 1px; border-right-width: 1px; border-top-style: dotted; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px">
			
<marquee>
						<?php						

	
$st="Select * from memberimage where mid=".$_GET["id"];

$result2=mysql_query($st,$con);

	while ($row2=mysql_fetch_array($result2))
	{
	?>
			
			<img border="0" src="user/logo/<?php  echo $row2['img'] ; ?>" width="156" height="169"> &nbsp;&nbsp;&nbsp;
		<?php
		}
		?>
		</marquee>	
			</td>
										</tr>
										</table>
									</div>

									</td>
		</tr>
		</table>
		</div>
</td>
				</tr>
	
	<tr>
					<td align="center" colspan="2" bgcolor="#FFFFFF" height="50" >
					<table border="0" width="99%" id="table40" cellspacing="1" style="border-collapse: collapse">
						<tr>
							<td bgcolor="#E3E3E3" height="8"></td>
						</tr>
						<tr>
							<td width="98%" valign="top" height="5"></td>
						</tr>
						<tr>
							<td width="98%" valign="top" bgcolor="#FFFFFF">
							<p style="line-height: 25px; margin-left: 10px; margin-right: 20px; margin-top: 10px; margin-bottom: 5px" align="justify">
							<b><font color="#003366" size="2">About Us :</font></b><font color="#003366" size="2">&nbsp;&nbsp; <?php echo $row["remark1"] ; ?></font><br><br></td>
						</tr>
					</table>
					</td>
				</tr>
<?php
				
				}
	
	}
	
?>
			</table>
		</div>
		</td>
	</tr>
</table>
	

<div align="center">
	<?php include("footer.php"); ?>
</div>

</body>

</html>
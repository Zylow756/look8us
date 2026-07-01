<?php
include("config.php"); 

session_set_cookie_params(0,"/",".Look8us .com");


if(!isset($_SESSION))
{
session_start();
}
?>

<table  border="0" width="100%" id="table7" style="border-collapse: collapse" height="40" bgcolor="#FAD605" cellpadding="0">
	<tr>
							<td height="55" width="100%" align="center">
					
					<div align="center">
						<table class="table3" border="0" width="1020" id="table15" style="border-collapse: collapse">
							<tr>
								<td width="272" align="left">
						&nbsp;
						<img border="0" src="<?php echo $path; ?>headlogo.png" ></td>
								<td width="69">&nbsp;</td>
								<td align="right">
								<p style="margin-left:5px; margin-right:20px; margin-top:5px; margin-bottom:5px">
				
					<?php
	if (! isset($_SESSION['user']))
		 {
		   $_SESSION['uname']="";
		   $_SESSION['utype']="";
		  // echo "Guest User";		
		  ?>
		<a class="a4" href="<?php echo $path; ?>user/login.php">Member login >></a> &nbsp;<font face="Arial" color="#FFFFFF" style="font-size: 8pt; font-weight: 700">Or</font>
	
	<a class="a3" href="<?php echo $path; ?>user/index.php">Signup New </a> &nbsp;&nbsp;
		<?php
	      }	
	elseif ( $_SESSION['user']<>"" )

	{
	?>	
								
									
								<font color="#CCCCCC">&nbsp;</font>Welcome<font color="#CCCCCC">,</font><font color="#0000FF">&nbsp;<b><?php echo $_SESSION['user'] ; ?></b>&nbsp;
										
							</font>
										
							<?php	
							if (isset($_SESSION['typ'])) if ($_SESSION['typ']=="A")
							{
							echo "<a href='".$path."admin/home.php'>(Administrator)</a>";
							}
							?>  
							
							<?php	
							if (isset($_SESSION['mid'])) if ($_SESSION['mid']<>"")
							{
							echo "<a href='".$path."user/home.php'>(Member)</a>";
							}
							?>  

	| <a class="a4" href="<?php echo $path; ?>logout.php">Logout</a>
							
							
	
	<?php
	}
	elseif ( $_SESSION['user']=="" )
	{
	?>
	  

	<a class="a4" href="<?php echo $path; ?>user/login.php">Member login >></a> &nbsp;<font face="Arial" color="#FFFFFF" style="font-size: 8pt; font-weight: 700">Or</font>
	
	<a class="a3" href="<?php echo $path; ?>user/index.php">Signup New </a> &nbsp;&nbsp;
	<?php 
	} 
	?>
	
	
  	
	</p>
	</td>
							</tr>
						</table>
					</div>
					
					</td>
						</tr>
</table>

<table border="0" width="100%" id="table9" cellpadding="0"  style="border-collapse: collapse">
	<tr>
		<td align="center" bgcolor="#0E2941"><div align="center">

<table border="0" width="1020" id="table13" cellpadding="0" style="border-collapse: collapse">
	<tr>
					<td width="20%" height="100" rowspan="2" align="right">
					
					<img border="0" src="<?php echo $path; ?>images/logon.png"></td>
					<td valign="bottom" height="100" valign="bottom">
					
					<table class="table3" border="0" width="100%" id="table14" cellpadding="0" style="border-collapse: collapse">
											
						<tr>
							<td align="right" width="64%" height="20"></td>
							<td  width="36%" align="right" height="20" >						
							
									</td>
						</tr>
											
						<tr>
							<td align="right" width="64%" height="40">&nbsp;
							

 
</td>
							<td  width="36%" align="right" height="40" >
									
							
									<a  target="_blank" href="https://twitter.com/#">
									
							
									<img border="0" src="<?php echo $path; ?>images/twitter-icon.png" width="32" height="32"></a>
									<a  target="_blank" href="http://www.facebook.com/#">
									<img border="0" src="<?php echo $path; ?>images/facebook-icon.png" width="32" height="32"></a>
									<a  target="_blank" href="http://www.linkedin.com/profile/view?id=#trk=nav_responsive_tab_profile">
									<img border="0" src="<?php echo $path; ?>images/linkedin-icon.png" width="32" height="32"></a>
									<img border="0" src="<?php echo $path; ?>images/email-icon.png" width="32" height="32">
									<img border="0" src="<?php echo $path; ?>images/rss-icon.png" width="32" height="32">&nbsp;
&nbsp;

									</td>
						</tr>
											
						<tr>
							<td align="right" width="100%" colspan="2" height="40"><?php include("menu1.php");  ?></td>
						</tr>
											
						</table>
					</td>
				</tr></table></div></td>
	</tr>
	<tr>
		<td align="center" bgcolor="#FAD605" height="5">

</td>
	</tr>
</table>
	
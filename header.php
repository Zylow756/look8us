<?php
require_once __DIR__ . "/../config.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (empty($_SESSION['user'])) {
    header("Location: index.php?r=0");
    exit;
}
//session_set_cookie_params(0,"/",".Look8us .com");


?>

<table  border="0" width="100%" id="table7" style="border-collapse: collapse" height="44" cellpadding="0" bgcolor="#00AAE8">
	<tr>
							<td height="24" width="6%" align="center">
					
					&nbsp;</td>
							<td width="21%" align="right" rowspan="2">
					
						<img border="0" src="<?php echo $path; ?>headlogo.png" ></td>
							<td height="24" width="74%" align="center">
					
					<div align="left">
						<table class="table3" border="0" width="800" id="table8" style="border-collapse: collapse" cellpadding="0">
							<tr>
								<td width="118" align="left">
						&nbsp;
						</td>
								<td align="right" height="30">
								<p style="margin-left:5px; margin-right:5px; margin-top:2px; margin-bottom:1px">
				
					<?php
	if (! isset($_SESSION['user']))
		 {
		   $_SESSION['uname']="";
		   $_SESSION['utype']="";
		  // echo "Guest User";		
		  ?>
		<a class="a4" href="<?php echo $path; ?>user/login.php">Login</a> <font face="Arial" color="#FFFFFF" style="font-size: 8pt; font-weight: 700">||</font>
	
	<a class="a3" href="<?php echo $path; ?>user/index.php">Signup</a>
		<?php
	      }	
	elseif ( $_SESSION['user']<>"" )

	{
	?>	
Welcome<font color="#CCCCCC">,</font><font color="#0000FF">&nbsp;<b><?php echo ucwords($_SESSION['user']) ; ?></b>&nbsp;
										
							</font>
										
							<?php	
							if (isset($_SESSION['typ'])) if ($_SESSION['typ']=="A")
							{
							echo "<a class='a3' href='".$path."admin/home.php'>(Administrator)</a>";
							}
							?>  
							
							<?php	
							if (isset($_SESSION['mid'])) if ($_SESSION['mid']<>"")
							{
							echo "<a class='a3' href='".$path."user/home.php'>(Member)</a>";
							}
							?>  

	| <a class="a1" href="<?php echo $path; ?>logout.php">Logout</a> &nbsp;&nbsp;&nbsp;
							
							
	
	<?php
	}
	elseif ( $_SESSION['user']=="" )
	{
	?>
	  

	<a class="a4" href="<?php echo $path; ?>user/login.php">Login</a>
					<font face="Arial" color="#FFFFFF" style="font-size: 8pt; font-weight: 700"> &nbsp;|| </font>
	
	<a class="a3" href="<?php echo $path; ?>user/index.php">Signup</a>
	<?php 
	} 
	?></p></td>
								<?php
	if ((!isset( $_SESSION['user'])) or ( $_SESSION['user']=="" ))
	{
	?>	<td align="left" width="35" valign="bottom">
	
<a href="<?php echo $path; ?>user/index.php">
	
<img border="0" src="<?php echo $path; ?>Users.png" width="26" height="26"></a>
</td><?php
}
?>


							</tr>
						</table>
					</div>
					
					</td>
						</tr>
						
						<tr>
						<td>
						&nbsp;</td>
						<td>
						<div align="left">

<table border="0" width="800" id="table9" cellpadding="0" style="border-collapse: collapse">
	<tr>
					<td width="20%"  rowspan="2" align="right">
					
					&nbsp;</td>
					<td valign="bottom" height="20" valign="bottom"><?php require_once "menu1.php";  ?>
					
					</td>
				</tr></table></div></td>
						</tr>
						
						
						<tr>
						<td height="5" bgcolor="#CCCCCC" colspan="3">
						</td></tr>
</table>


	



	
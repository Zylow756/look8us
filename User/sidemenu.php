<?php
require_once __DIR__ . "/../config.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (empty($_SESSION['user'])) {
    header("Location: index.php?r=0");
    exit;
}
?>


<div align="center">
	<table  border="0" width="100%" id="table1"  class="table3" style="border-collapse: collapse" cellpadding="0">
		<tr>
			<td height="25" align="left" bgcolor="#000000" >
			&nbsp;<a href="<?php echo $path; ?>user/home.php" class="a2" >Member Home</a>
		
			</td>
		</tr>
		<tr>
			<td height="20" align="left" valign="top" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; " bordercolor="#D3D3D3">
			
			
	<table border="0" class="table1" width="100%" id="table2" style="border-collapse: collapse" bordercolor="#D2D2D2">
		<tr>
			<td bgcolor="#99CCFF">&nbsp;<b>Member Area</b></td>
		</tr>
		
							<?php	
							if (isset($_SESSION['mplan']))
							{
							if (($_SESSION['mplan']=="Gold")||($_SESSION['mplan']=="Platinum"))
							{
							?>
							
							<tr>
								<td height="22">&nbsp;<a class="a" href="<?php echo $path; ?>user/Addlogo.php">Add Company Logo</a></td>
							</tr>				
							<?php
							 }
							 }
							?>  
		
		<tr>
			<td height="22">&nbsp;<a class="a" href="<?php echo $path; ?>user/AddCate.php">Add your Company</a></td>
		</tr>
		
			<?php	
							if (isset($_SESSION['mplan']))
							{
							if ($_SESSION['mplan']=="Platinum")
							{
							?>
	
		
						
							
		<tr>
			<td height="22">&nbsp;<a class="a" href="<?php echo $path; ?>user/AddAdvert.php">Add Catalogue Image</a></td>
		</tr>
		
		<?php
							 }
							 }
							?> 
							
		<?php	
							if (isset($_SESSION['mplan']))
							{
							if (($_SESSION['mplan']=="Gold")||($_SESSION['mplan']=="Platinum"))
							{
							?>
			<tr>
			<td height="22">&nbsp;<a class="a" href="<?php echo $path; ?>user/Addimage.php">Add Image to Gallery</a></td>
		</tr>			
		<tr>
			<td height="22">&nbsp;<a class="a" href="<?php echo $path; ?>user/AddSocialLink.php">Add Social Link</a></td>
		</tr>
		
			<tr>
			<td height="22">&nbsp;<a class="a" href="<?php echo $path; ?>user/AddActivity.php">Add Activity</a></td>
		</tr>
		
			<tr>
			<td height="22">&nbsp;<a class="a" href="<?php echo $path; ?>user/editintro.php">Set Company Profile</a></td>
		</tr>
		
		<?php
							 }
							 }
							?> 
		
		<tr>
			<td height="22">&nbsp;<a class="a" href="<?php echo $path; ?>user/ViewUserCate.php">View your Category</a></td>
		</tr>
		
			<?php	
							if (isset($_SESSION['mplan']))
							{
							if ($_SESSION['mplan']=="Platinum")
							{
							?>
		<tr>
			<td style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#D3D3D3" height="22">
			&nbsp;<a class="a" href="<?php echo $path; ?>user/ViewActivity.php">View Activity</a></td>
		</tr>
		<tr>
			<td style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#D3D3D3" height="22">
			&nbsp;<a class="a" href="<?php echo $path; ?>user/enquiry.php">View Enquiry</a></td>
		</tr>
		
			<?php
							 }
							 }
							?> 
							
		<tr>
			<td bgcolor="#99CCFF">&nbsp;<b>Payment </b></td>
		</tr>
		<tr>
			<td height="22">&nbsp;<a class="a" href="<?php echo $path; ?>user/payment.php">Pay for Membership</a></td>
		</tr>
		<tr>
			<td height="22">&nbsp;<a class="a" href="<?php echo $path; ?>user/paymenthistory.php">Payment History</a></td>
		</tr>
		<tr>
			<td bgcolor="#99CCFF">&nbsp;<b>Your Account </b></td>
		</tr>
		<tr>
			<td height="22">&nbsp;<a class="a" href="<?php echo $path; ?>user/editmember.php">Edit Profile</a></td>
		</tr>
		<tr>
			<td height="22">&nbsp;<a class="a" href="<?php echo $path; ?>user/Password.php">Change Password</a></td>
		</tr>
		<tr>
			<td height="22">&nbsp;<a class="a" href="<?php echo $path; ?>logout.php">Logout</a></td>
		</tr>
		</table>
			</td>
		</tr>
		</table>
		<br><br>
</div>
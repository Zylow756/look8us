<?php
require_once "config.php";

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
			&nbsp;<a href="<?php echo $path; ?>agent/home.php" class="a2" >Agent Home</a>
		
			</td>
		</tr>
		<tr>
			<td height="20" align="left" valign="top" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; " bordercolor="#D3D3D3">
			
			
	<table border="0" class="table2" width="100%" id="table2" style="border-collapse: collapse" bordercolor="#D2D2D2">
		<tr>
			<td style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px">&nbsp;<a class="a" href="NewEnquiry.php">New 
			Enquiry</a></td>
		</tr>
		<tr>
			<td style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#D3D3D3" height="25">&nbsp;<a class="a" href="ViewEnq.php">View All Enquiry</a></td>
		</tr>
		<tr>
			<td style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#D3D3D3" height="25">&nbsp;<a class="a" href="ViewEnq-FollowupDate.php">Enquiry by Followup Date</a></td>
		</tr>
		<tr>
			<td style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#D3D3D3" height="25">&nbsp;<a class="a" href="PostFeedback.php">Post Feedback</a></td>
		</tr>
		<tr>
			<td style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#D3D3D3" height="25">&nbsp;<a class="a" href="ViewMember.php">View All Member</a></td>
		</tr>
		<tr>
			<td style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" height="25">&nbsp;<a class="a" href="Password.php">Change Password</a></td>
		</tr>
		<tr>
			<td height="25" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px">&nbsp;<a class="a" href="../logout.php">Logout</a></td>
		</tr>
		</table>
			</td>
		</tr>
		</table>
		<br><br>
</div>
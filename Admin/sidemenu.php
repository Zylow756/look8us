<?php
require_once "config.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (empty($_SESSION['admin'])) {
    header("Location: index.php?r=0");
    exit;
}
?>

<div align="center">
	<table  border="0" width="100%" id="table1"  class="table3" style="border-collapse: collapse" cellpadding="0">
		<tr>
			<td height="25" align="left" bgcolor="#000000" >
			&nbsp;<a href="<?php echo $path ?? ''; ?>admin/home.php" class="a2" >Admin Home</a>
		
			</td>
		</tr>
		<tr>
			<td height="20" align="left" valign="top" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; " bordercolor="#D3D3D3">
			
			
	<table border="0" class="table2" width="100%" id="table2" style="border-collapse: collapse" bordercolor="#D2D2D2">
		<tr>
			<td bgcolor="#D3D3D3">&nbsp;<b>Category</b></td>
		</tr>
		<tr>
			<td style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px">&nbsp;<a class="a" href="NewCate.php">New Category</a></td>
		</tr>
		<tr>
			<td style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px">&nbsp;<a class="a" href="NewSubCate.php">New Sub-Category</a></td>
		</tr>
		<tr>
			<td style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px">&nbsp;<a class="a" href="ViewCate.php">View Category</a></td>
		</tr>
		<tr>
			<td style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px">&nbsp;<a class="a" href="ViewSubCate.php">View Sub-Category</a></td>
		</tr>
		<tr>
			<td style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px">&nbsp;<a class="a" href="NewAgent.php">New Agent</a></td>
		</tr>
		<tr>
			<td style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px">&nbsp;<a class="a" href="ViewAgent.php">View Agent Member </a></td>
		</tr>
		<tr>
			<td style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px">&nbsp;<a class="a" href="ViewAgentEnquiry.php">View Agent Enquiry</a></td>
		</tr>
		
		<tr>
			<td style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px">&nbsp;<a class="a" href="ViewAllAgentEnquiry.php">Search Agent Enquiry</a></td>
		</tr>

		<tr>
			<td style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px">&nbsp;<a class="a" href="ViewAgentEnquiry_dateWise.php">Agent Enquiry by Date</a></td>
		</tr>
		
		
		
		<tr>
			<td style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px">&nbsp;<a class="a" href="AgentLoginLog.php">Agent Login Logs</a></td>
		</tr>
		
		<tr>
			<td style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px">&nbsp;<a class="a" href="ExcelImport-agentEnqiry.php">Agent Enquiry Import</a></td>
		</tr>
		<tr>
			<td bgcolor="#D3D3D3">&nbsp;<b>Member</b></td>
		</tr>
		<tr>
			<td height="25" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px">&nbsp;<a class="a" href="ViewMember.php">View All Member </a> </td>
		</tr>
		<tr>
			<td style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#D3D3D3">&nbsp;<a class="a" href="SearchMember.php">Search 
			Member</a></td>
		</tr>
		<tr>
			<td style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px">&nbsp;<a class="a" href="viewMemberStatus.php">Change Status</a></td>
		</tr>
		<tr>
			<td style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#D3D3D3">&nbsp;<a class="a" href="AddCateMember.php">Add Category to Member </a></td>
		</tr>
		<tr>
			<td style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#D3D3D3">&nbsp;<a class="a" href="AddImageMember.php">Add Image to Member </a></td>
		</tr>
		<tr>
			<td style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#D3D3D3">&nbsp;<a class="a" href="ViewEnquiry.php">View Enquiry</a></td>
		</tr>
		<tr>
			<td style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#D3D3D3">&nbsp;<a class="a" href="NewAdvert.php">New Verified Business</a></td>
		</tr>
		<tr>
			<td style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#D3D3D3">&nbsp;<a class="a" href="ViewAdvert.php">View Verified Business</a></td>
		</tr>
		<tr>
			<td style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#D3D3D3">&nbsp;<a class="a" href="NewHomeImg.php">Set Home Image [Jacket]</a></td>
		</tr>
		<tr>
			<td style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#D3D3D3">&nbsp;<a class="a" href="ViewHomeImg.php">View Home Image[Jacket]</a></td>
		</tr>
		<tr>
			<td height="25" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px">&nbsp;<a class="a" href="ViewFranchise.php">View Franchise </a> </td>
		</tr>
		<tr>
			<td height="25" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px">&nbsp;<a class="a" href="Paymenthistory.php">Payment History</a></td>
		</tr>
		<tr>
			<td height="25" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px">&nbsp;<a class="a" href="DuePayment.php">Due Expiry</a></td>
		</tr>
		<tr>
			<td height="25" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px">&nbsp;<a class="a" href="ViewActivityStatus.php">View Activity</a></td>
		</tr>
		<tr>
			<td bgcolor="#D3D3D3">&nbsp;<b>E-commerce </b></td>
		</tr>
		<tr>
			<td style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#D3D3D3" height="25">&nbsp;<a class="a" href="eNewCate.php">New Category</a></td>
		</tr>
		<tr>
			<td style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" height="25">&nbsp;<a class="a" href="eNewWebLink.php">Add Website Link</a></td>
		</tr>
		<tr>
			<td bgcolor="#D3D3D3">&nbsp;<b>Career &amp; Jobs </b></td>
		</tr>
		<tr>
			<td height="25" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px">&nbsp;<a class="a" href="ViewCareer.php">View All CV 
			@ Career</a> </td>
		</tr>
		<tr>
			<td style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#D3D3D3" height="25">&nbsp;<a class="a" href="ViewJobSeeker.php">View Job Seeker</a></td>
		</tr>
		<tr>
			<td style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" height="25">&nbsp;<a class="a" href="ViewJobOffers.php">View Job Offers</a></td>
		</tr>
		<tr>
			<td bgcolor="#D3D3D3">&nbsp;<b>Account </b></td>
		</tr>
		<tr>
			<td style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#D3D3D3" height="25">&nbsp;<a class="a" href="ViewFeedback.php">View Feedback</a></td>
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
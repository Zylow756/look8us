<?php
require_once __DIR__ . "/../config.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (empty($_SESSION['admin'])) {
    header("Location: index.php?r=0");
    exit;
}
?>
<html>

<head>
<meta charset="UTF-8">
<title>Online Directory : Admin Panel</title>
 <link rel="stylesheet" type="text/css" href="../akc.css" />

<style type="text/css"> 

body
{
background-image:url('../img/bg.png');
background-repeat:repeat-x;
background-color: #70828F;
} 
</style>
<script type="text/javascript" src="scripts/jquery.min.js"></script>
<script type="text/javascript" src="scripts/jquery.form.js"></script>
<script type="text/javascript" >
 $(document).ready(function()
  { 
	
/*  
$('#sname').click('change', function()
    { 
	   		$("#imageform").ajaxForm(
   			{	 success: function (response)
				  {
                     $('#result').text(response); 
                 }
			});
		    		
      });
  */
      
      
 $("#acode").click(function () 
  {
     
    	/* 
    	$.post("ajCode.php",
  			  {
  		   		 uid: $("#t1").val()
  			  },
  			  function(data,status){
  			   // alert("Data: " + data + "\nStatus: " + status);
  			   $("#gen").html(data);

  			  });
  			  
  		
  			  
  			   $.post("ajCode.aspx",
  			  {
  		   		 uid: $("#t1").val()
  			  },
  			  function(data,status){
  			   // alert("Data: " + data + "\nStatus: " + status);
  			   $("#gen1").html(data);

  			  });

  		*/
  			  
    
  			   $.post("asp-mail/email_mimimum_qty_alert.aspx",
  			  {
  		   		 uid: $("#t1").val()
  			  },
  			  function(data,status){
  			   // alert("Data: " + data + "\nStatus: " + status);
  			   $("#gen1").html(data);

  			  });


 });



  }); 
  
</script>

</head>

<body bgcolor="#748592">

<div align="center">
	<table border="0" width="980" id="table1" style="border-collapse: collapse" bordercolor="#C0C0C0" cellpadding="0">
		<tr>
			<td height="50" align="center" valign="top">
			
			<?php  require_once "../header.php"; ?>
</td>
		</tr>
		<tr>
			<td>
			<table border="1" width="100%" id="table2" style="border-collapse: collapse" bordercolor="#808080" height="206">
				<tr>
					<td width="23" valign="top" bgcolor="#C1C1C1">&nbsp;</td>
					<td align="center" valign="top" bgcolor="#85939F" background="img/login-whisp.png">
					<br>
&nbsp;<table border="0" width="350" id="table2" height="333" background="img/login.png" style="border-collapse: collapse">
						<tr>
							<td><form action="home.php" method="post"> 
							<table border="0" class="table4" width="99%" id="table4" style="border-collapse: collapse" height="227">
								<tr>
									<td width="7%" height="41">&nbsp;</td>
									<td height="41" colspan="2" style="text-align: center">
									<font size="4" color="#FF0000">ADMIN LOGIN&nbsp;
									</font></td>
								</tr>
								<tr>
									<td width="7%" height="58">&nbsp;</td>
									<td width="26%" height="58" valign="bottom">
									<font color="#333333" size="2">User Name</font></td>
									<td height="58" valign="bottom" width="65%">
									<input type="text" name="t1" id="t1"  class="txtbox" size="27" onfocus="if(this.value=='Your User Name'){this.value='';}" onblur="if(this.value==''){this.value='Your User Name';}"  required >  </td>
								</tr>
								<tr>
									<td width="7%" height="24">&nbsp;</td>
									<td width="26%" height="24">
									<font color="#333333" size="2">Password</font></td>
									<td height="24" width="65%"><input type="password" name="t2" class="txtbox1" required >  </td>
								</tr>
								<tr>
									<td width="7%" height="23">&nbsp;</td>
									<td width="26%" height="23">
									<font size="2">Access Code</font></td>
									<td height="23" width="65%">
									<input type="text" name="t3" class="txtbox4" size="27" onfocus="if(this.value=='Code'){this.value='';}" onblur="if(this.value==''){this.value='Code';}" required >
									<span id="gen" style="font-weight: 400">.
									</span><span id="gen1" style="font-weight: 300; font-size:8pt;">-</span>
									</td>
								</tr>
								<tr>
									<td width="7%" height="21">&nbsp;</td>
									<td colspan="2" height="11">&nbsp;&nbsp;&nbsp; <font size="2">
									<a id="acode" href="#" ><font color="#FF0000">Click 
									here for generate Access code</font></a></font></td>
								</tr>
								<tr>
									<td width="7%" height="22">&nbsp;</td>
									<td colspan="2" height="22">&nbsp;&nbsp;<?php  if (!empty($_GET['r'])) echo "Invalid User Name OR Password<br><font size='1' face='Arial' color='#FF0000'>(Please Note User Name & Password is Case Sensitive)</font>"; ?> 
									</td>
								</tr>
								<tr>
									<td width="7%">&nbsp;</td>
									<td width="26%">&nbsp;</td>
									<td width="65%">&nbsp; <input type="submit" name="submit" value="Submit" class="subbox"></td>
								</tr>
								<tr>
									<td width="7%" height="20">&nbsp;</td>
									<td width="91%" height="20" colspan="2"><p align="center">
							&nbsp;<a href="../index.php" class="a2">Go to 
									Home&gt;</a><br>
							<a  class="a5" href="../User/index-agent.php">Click here for 
							agent login [Create New Member]</a><br>
							<a  class="a5" href="../agent/index.php">Click here for 
							agent Report [Enquiry & Reports] </a></p></td>
								</tr>
							</table>
							
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
			<td align="center" valign="top">			<?php  require_once "../footer.php"; ?></td>
		</tr>
	</table>
</div>

</body>

</html>
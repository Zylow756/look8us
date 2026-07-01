<?php

session_start();


if ( isset($_SESSION['user']))
 {
   if($_SESSION['user']=="") 
 	header("location: index.php?r=0"); 
 }
else
 		header("location: index.php?r=0"); 

  
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
background-image:url('img/bg.png');
background-repeat:repeat-x;
background-color: #70828F;;
} 
</style>



<script type="text/javascript">
function vfhfn()
{


var fllnme1=document.frmhlp.cname.value;


var num =/^[0-9]+$/;
var alpha =/^[a-z]+$/;


if(fllnme1==null||fllnme1=="")
{alert("Required Category Name");
document.frmhlp.cname.focus();
return false;
}

if(fllnme1=="Category Name")
{alert("Required Category Name");
document.frmhlp.cname.focus();
return false;
}


return true;

}

</script>
</head>

<?php include("../config.php");

$msg=0;

if (isset($_POST["submit"]))
{
$y=0;
		 $st="Select * from agent order by aid desc";
 		 $result=mysql_query($st,$con);
			if ($row=mysql_fetch_array($result))
				$y=$row["aid"];
				
	$y=$y+1;	
		
$x=strtoupper(substr($_POST["aname"],0,3));
$z=$x.$y;

$st="insert into agent values (NULL ,'". $_POST["aname"]. "','". $_POST["address"]. "','". $_POST["mobile"]. "','".$z."','".$z."','".$z."')" ;

mysql_query($st,$con);
//echo $st;
$msg=1;


	

} 	// end of if (submit)

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
					<td width="228" valign="top" bgcolor="#EEEEEE">			<?php if ($_SESSION["id"]!="") include("sidemenu.php"); ?></td>
					<td align="center" valign="top" bgcolor="#FFFFFF">
					<h1>Create New Enquiry</h1>
					<p><h3><?php if ($msg==1) echo "Agent Create"; ?></h3>
</p>
					<table border="0" width="98%" id="table13" cellpadding="0" style="border-collapse: collapse" bordercolor="#697779" height="128">
						<tr>
							<td valign="top" width="338">
							<table class="table3" border="0" width="99%"  id="table14" cellpadding="0" style="border-collapse: collapse" bordercolor="#697779" height="181">
						
						<form name="frmhlp" id="frmhlp" method="post" action="NewAgent.php" onSubmit="return vfhfn();">
						

<tr>
	<td width="86" height="50">Agent Name</td><td width="222" height="50">
	<input  class="txtbox" type="text" name="aname" id="aname" tabindex="4" value="Agent Name" onfocus="if(this.value=='Agent Name'){this.value='';}" onblur="if(this.value==''){this.value='Agent Name';}" size="24"/></td>
</tr>
<tr>
	<td width="86" height="40">Address</td><td width="222" height="40">
	<input  class="txtbox" type="text" name="address" id="address" tabindex="4"  size="1"/></td>
</tr>
<tr><td width="86" height="28">Mobile</td><td width="222" height="28">
	<input  class="txtbox" type="text" name="mobile" id="mobile" tabindex="4"  size="1"/></td>
	</tr>
<tr><td width="86" height="63">&nbsp;</td><td width="222" height="63">
	<input  class="subbox" type="submit" value="Submit" name="submit"/>

	</td>
	</tr>
</form>
					</table>
							<table class="table3" border="0" width="96%"  id="table16" cellpadding="0" style="border-collapse: collapse" bordercolor="#697779">
						</td>
						</tr>
					</table>
							</td>
							<td valign="top">
							<h2>Already Created </h2>
							<table class="table2"  border="1" width="96%" id="table17">
								<tr>
									<td bgcolor="#E0E2FE" width="190">&nbsp;Agent 
									Name</td>
									<td bgcolor="#E0E2FE" width="99">&nbsp;Agent Code</td>
									<td bgcolor="#E0E2FE" width="74">&nbsp;Password</td>
									<td bgcolor="#E0E2FE" width="74">&nbsp;View/Edit </td>
								</tr>
								
								
		<?php 
		 $st="Select * from agent order by aname";
		 		 $result=mysql_query($st,$con);
		while ($row=mysql_fetch_array($result))
			{
			?>
								<tr>
									<td width="190">&nbsp;&nbsp;<?php echo $row["aname"]; ?></td>
									<td width="99">&nbsp;&nbsp;<?php echo $row["acode"]; ?></td>
									<td width="74">&nbsp;<?php echo $row["pass"]; ?></td>
									<td width="74">&nbsp;&nbsp;&nbsp;<?php echo "<a class='a5' href='EditAgent.php?id=".$row['aid']."'>View</a>"; ?></td>
								</tr>
								
								<?php
								}
								?>
							
							</table>
							</td>
						</tr>
					</table></p>
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
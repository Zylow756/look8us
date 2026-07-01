

<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Online Directory : Admin Panel</title>
 <link rel="stylesheet" type="text/css" href="../akc.css" />

<style type="text/css"> 

body
{
background-image:url('../Admin/img/bg.png');
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

<?php include("../config.php"); ?>
	
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
			
			
			<?php
			
			$msg=0;
			
if (isset( $_POST["submit"]))
{


$s="UPDATE agenquiry  SET ename= '". $_POST['aname']."',cate = '". $_POST['cate']."' , address='". $_POST['address']."',city = '". $_POST['city']."' ,email = '". $_POST['email']."' ,mobile ='". $_POST['mobile']."',web ='". $_POST['web']."'  where eid=".$_POST['eid'] ;
//echo $s;
mysql_query($s,$con);
$msg=1;

}

				

?>

			<table border="0" width="100%" id="table2" style="border-collapse: collapse" bordercolor="#CCCCCC" height="206" cellpadding="0">
				<tr>
					<td width="228" valign="top" bgcolor="#EEEEEE">			<?php if ($_SESSION["aid"]!="") include("sidemenu.php"); ?></td>
					<td align="center" valign="top" bgcolor="#FFFFFF">
					<h1>View /Edit/ Enquiry</h1>
					<p><h3><?php if ($msg==1) echo "Enquiry Detail Update"; ?>
					
					</h3>
</p>
					
					
					
					<table border="0" width="90%" id="table13" cellpadding="0" style="border-collapse: collapse" bordercolor="#697779" height="128">
						<tr>
							<td valign="top" width="402">
							<table class="table3" border="0" width="434"  id="table14" cellpadding="0" style="border-collapse: collapse" bordercolor="#697779" height="174">
						
	<?php
	if (isset( $_GET["id"]))
	{
		$s="select * from agenquiry where eid=". $_GET["id"] ;
	   $r=mysql_query($s,$con);
	   if($row=mysql_fetch_array($r))
		{
		
		?>
						<form name="frmhlp" id="frmhlp" method="post" action="EditEnq.php" >
						

<tr>
	<td width="103" height="30">Enquiry Date</td><td width="331" height="30">
	&nbsp;<b><?php echo $row['edate']; ?></b>
	
	<input  type="hidden" name="eid" id="eid" tabindex="4" value="<?php echo $row['eid']; ?>"  size="1"/>
	
	</td>
</tr>
						

<tr>
	<td width="103" height="30">Company&nbsp; Name
	
	
	</td><td width="331" height="30">
	<input  class="txtbox" type="text" name="aname" id="cname" tabindex="4" value="<?php echo $row['ename']; ?>"  size="1"/></td>
</tr>
<tr>
	<td width="103" height="30">Contact Person</td><td width="331" height="30">
	<input  class="txtbox" type="text" name="cate" id="aname0" tabindex="4" onfocus="if(this.value=='Agent Name'){this.value='';}" onblur="if(this.value==''){this.value='Agent Name';}" size="24" value="<?php echo $row['cate']; ?>"/></td>
</tr>
<tr>
	<td width="103" height="30">Address/ Area</td><td width="331" height="30">
	<input  class="txtbox" type="text" name="address" id="remark" tabindex="4"  value="<?php echo $row['address']; ?>" size="1"/></td>
</tr>
<tr>
	<td width="86" height="28">City</td><td width="222" height="28">
	<input  class="txtbox" type="text" name="city" id="mobile0" tabindex="4"  size="1" value="<?php echo $row['city']; ?>"/></td>
	</tr>
<tr>
	<td width="86" height="37">Mobile</td><td width="222" height="37">
	<input  class="txtbox" type="text" name="mobile" id="mobile1" tabindex="4"  size="1" value="<?php echo $row['mobile']; ?>"/></td>
	</tr>
<tr>
	<td width="86" height="43">Email</td><td width="222" height="43">
	<input  class="txtbox" type="text" name="email" id="mobile2" tabindex="4"  size="1" value="<?php echo $row['email']; ?>"/></td>
	</tr>
<tr>
	<td width="103" height="41">Website</td><td width="331" height="41">
	<input  class="txtbox" type="text" name="web" id="mobile3" tabindex="4"  size="1" value="<?php echo $row['web']; ?>"/></td>
</tr>
<tr>
	<td width="103" height="30">Status</td><td width="331" height="30">
	&nbsp;<?php echo $row['estatus']; ?></td>
</tr>
<tr><td width="103" height="55">&nbsp;</td><td width="331" height="55">
	<input  class="subbox" type="submit" value="Update" name="submit"/>&nbsp;
	</td>
	</tr>
</form>


<?php
}

}

?>

					</table>
							<table class="table3" border="0" width="96%"  id="table16" cellpadding="0" style="border-collapse: collapse" bordercolor="#697779">
						</td>
						</tr>
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
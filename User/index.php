<?php
require_once "config.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (empty($_SESSION['user'])) {
    header("Location: index.php?r=0");
    exit;
}

include("../thecaptcha/captcha.function.php");
$captcha_text = 'Please tell me you\'re not a spambot';
$error = 0;
$flag=0;


session_start();



if ( isset($_POST['submit']))
{
 	if (!captcha_verify_word())
 	 {
		$error .= 1;
		$captcha_text = '<span><b><h5>Wrong image code</h5><b></span>';
	} else {
		$error .= 0;
	}
	
	if ($error <= 0)
		 {
				$st2="Select * from member where email='".$_POST['txtmail']."'";
				$result2=mysqli_query($con,$st2);
if (!$result2) {
    die(mysqli_error($con));
}
				if($row2=mysqli_fetch_assoc($result2)) $flag=1;
				 
			
		if ($flag==0)
			{
				$t=substr($_POST['mname'],0,4);
				
				$st="select mid from member order by mid desc";
				$r=mysqli_query($con,$st);
if (!$r) {
    die(mysqli_error($con));
}
				if ($row=mysqli_fetch_assoc($r))
				 $us=$t.$row["mid"];
				else
				 $us=$t."1";
					
				$pass=base64_encode($_POST['pass']);
				
				$s="insert into member  values (NULL ,'" .$us."','".$pass. "','". ucwords($_POST['mname']). "','". ucwords($_POST['compname']). "','-','-','-','-','". ucwords($_POST['city']). "','-','-','-','-','".$_POST["mobile"]."','-','".$_POST['txtmail']."','-','-','-','0','-','-',0,'-','-','".date("d-m-Y")."','-',0,'Demo','-','-','-','-','-','2000-01-01','-','-','-','-','-','-')" ;
			// $s="insert into member  values (NULL ,'" .$us."','".$pass. "','". $_POST['mname']. "','". $_POST['compname']. "','". $_POST['tagline']. "','". $_POST['shopno']. "','". $_POST['address']. "','". $_POST['area']. "','". $_POST['city']. "','". $_POST['state1']. "','". $_POST['pincode']. "','". $_POST['phone']. "','". $_POST['phone0']. "','".$_POST["mobile"]."','". $_POST['mobile0']. "','".$_POST['txtmail']."','".$_POST['website']."','". $_POST['remark']. "','". $_POST['remark0']. "','0','-','-',0,'".$_POST['establish']."','-','-','-',0,'Demo','-','-','-','-','-','-','-')" ;

				mysqli_query($con,$s);
				
			 		$_SESSION['user']=$_POST['txtmail'];
					$_SESSION['mtyp']="0";
					$_SESSION['mplan']="Demo";

					$_SESSION['mid']=$row['mid']+1;

						//header("location: next.php?flag=2&us=".$us);
		    	
		    	//ECHO "a".$_SESSION['user'];
		    	
		   	header("location: ../email1.aspx?mid=".$_SESSION['mid']."&us=".$us."&pass=".$_POST['pass']."&mplan='Demo'");

            //    header("location: home.php?user=".$_SESSION['user']."&mid=".$_SESSION['mid']."&mtyp=0&mplan='Demo'");

				//echo $s;
				$flag=2;
				
			}
			
		}

}

?>

<html>

<head>
<meta charset="UTF-8">
<title>Online Directory</title>
 <link rel="stylesheet" type="text/css" href="../akc.css" />


<script type="text/javascript">
function vfhfn()
{

/*
var x=document.frmhlp.file1.value;
if(x==null||x=="")
{
alert("Please Select Your Photo(JPG/Gif)");
 return false;
}
*/

var x=document.frmhlp.txttmail.value;
var atpos=x.indexOf("@");
var dotpos=x.lastIndexOf(".");
if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
  {
  alert("Not a valid e-mail address");
  document.frmhlp.txttmail.focus();

  return false;
  }

var fllnme1=document.frmhlp.compname.value;
var fllnme2=document.frmhlp.mname.value;

var mle=document.frmhlp.mobile.value;

var cty=document.frmhlp.city.value;

var pa=document.frmhlp.pass.value;
var pa1=document.frmhlp.pass1.value;



if(fllnme1==null||fllnme1=="")
{alert("Required Company Name");
document.frmhlp.compname.focus();
return false;
}

if(fllnme1=="Company Name")
{alert("Required Company Name");
document.frmhlp.compname.focus();
return false;
}



if(fllnme2==null||fllnme2=="")
{alert("Required Contact Person Name");
document.frmhlp.mname.focus();
return false;
}

if(fllnme2=="Member Name")
{alert("Required Contact Person Name");
document.frmhlp.mname.focus();
return false;
}


if(mle==null||mle=="")
{alert("Required Mobile No.");
document.frmhlp.mobile.focus();
return false;
}

if(mle=="Mobile")
{alert("Required Mobile No");
document.frmhlp.mobile.focus();
return false;
}



if(cty==null||cty=="")
{alert("Required City");
document.frmhlp.city.focus();
return false;
}

if(cty=="City")
{alert("Required City");
document.frmhlp.city.focus();
return false;
}

if(pa.length <6)
{alert("Password atleast 6 Char Long");
document.frmhlp.pass.focus();
return false;
}

if(pa!=pa1)
{alert("Password & Confirm Password are NOT Same");
document.frmhlp.pass1.focus();
return false;
}
else
{
return true;
}

}

</script>




</head>



<body topmargin="0" leftmargin="0" rightmargin="0" bottommargin="0">

<table border="0" width="100%" id="table1" style="border-collapse: collapse" bordercolor="#C0C0C0" cellpadding="0">
	<tr>
		<td height="20" bgcolor="#E2E2E2"><?php  require_once "../header.php"; ?></td>
	</tr>
	<tr>
		<td align="center" ><h3>
		<?php 
		if ($flag==1) echo "This E-Mail ID Already Registered"; 
		if ($flag==2) echo "Member Registered, Your User ID :".$us; 
 ?></h3>
		<br><form name="frmhlp" id="frmhlp" method="post" action="index.php" onSubmit="return vfhfn();">
			<table border="0" width="1010" id="table2" cellpadding="0" style="border-collapse: collapse" bgcolor="#F4F4F4">
			
				
<tr><td width="1010" height="25" bgcolor="#E2E2E2" colspan="3" align="center">
	<b><font color="#000000">&nbsp;&nbsp; Register Your firm/shop/company </font>
	</b></td>
				</tr>
<tr><td width="396" height="25" align="right">&nbsp;</td>
	<td width="233" height="25" align="center">
	&nbsp;</td>
	<td height="25" width="381">
	&nbsp;</td>
	
	</tr>
<tr>
	<td width="396" height="35" align="right"><font color="#333333">Company/Firm/Shop Name</font></td>
	<td width="233" height="35" align="center">
	<input class="txtbox" type="text" name="compname" id="compname" tabindex="1" value="<?php if (isset($_POST['compname'])) $compname = $_POST['compname'] ?? ''; echo $compname; else echo 'Company Name';  ?>"  onfocus="if(this.value=='Company Name'){this.value='';}" onblur="if(this.value==''){this.value='Company Name';}" size="1"/></td>
	<td height="35" width="381">
	&nbsp;</td>
				</tr>
<tr><td width="396" height="35" align="right"><font color="#333333">Owner/Contact Person </font></td>
	<td width="233" height="35" align="center">
	<input class="txtbox" type="text" name="mname" id="mname" tabindex="2" value="<?php if (isset($_POST['mname'])) $mname = $_POST['mname'] ?? ''; echo $mname; else echo 'Member Name';  ?>" onfocus="if(this.value=='Member Name'){this.value='';}" onblur="if(this.value==''){this.value='Member Name';}" size="1"/></td>
	<td height="35" width="381">
	&nbsp;</td>
				</tr>
<tr>
	<td width="396" height="35" align="right"><font color="#333333">City</font></td>
	<td width="233" height="35" align="center">
	<input  class="txtbox" type="text" name="city" id="city" tabindex="3" value="<?php if (isset($_POST['city'])) $city = $_POST['city'] ?? ''; echo $city; else echo 'City';  ?>" onfocus="if(this.value=='City'){this.value='';}" onblur="if(this.value==''){this.value='City';}" size="1"/></td>
	<td height="35" valign="top" width="381">
	&nbsp;</td>
</tr>
<tr>
	<td width="396" height="35" align="right"><font color="#333333">Mobile Number</font></td>
	<td width="233" height="35" align="center">
	<input  class="txtbox" type="text" name="mobile" id="mobile" value="<?php if (isset($_POST['mobile'])) $mobile = $_POST['mobile'] ?? ''; echo $mobile;  else echo 'Mobile';  ?>" onfocus="if(this.value=='Mobile'){this.value='';}" onblur="if(this.value==''){this.value='Mobile';}" tabindex="4" size="1"/></td>
	<td height="35" valign="top" width="381">
	&nbsp;</td>
</tr>
<tr>
	<td width="396" height="35" align="right"><font color="#333333">Email ID</font></td>
	<td width="233" height="35" align="center">
	<input class="txtbox" type="text" name="txtmail" id="txttmail" value="<?php if (isset($_POST['txtmail'])) $txtmail = $_POST['txtmail'] ?? ''; echo $txtmail;   else echo 'Email ID';  ?>" onfocus="if(this.value=='Email ID'){this.value='';}" onblur="if(this.value==''){this.value='Email ID';}" tabindex="5" /></td>
	<td height="35" valign="top" width="381">
	<p class="p1">Valid Email Id .</p> <?php if ($flag==1) echo "<h5>This E-Mail ID already Register !</h5>"; ?></td>
</tr>
<tr>
	<td width="396" height="35" align="right"><font color="#333333">Password 
	</font> </td>
	<td width="233" height="35" align="center">
	<input class="txtbox" type="password" name="pass" id="pass" tabindex="6" /></td>
	<td height="35" valign="top" width="381">
	<p class="p1">At least 6 character.</p></td>
</tr>
<tr>
	<td width="396" height="38" align="right"><font color="#333333">Confirm Password 
	</font> </td>
	<td width="233" height="38" align="center">
	<input class="txtbox" type="password" name="pass1" id="pass1" tabindex="7" /></td>
	<td height="38" width="381">
		
	&nbsp;</td>
</tr>
<tr>
	<td width="396" height="42" align="right"><font color="#333333">Enter Captcha Code
	</font> </td>
	<td width="233" height="42" align="center">
	<img src="../thecaptcha/captcha.image.php?nocache=<?php echo md5(time()); ?>" border="0"></td>
	<td height="42" width="381">
	&nbsp;</td>
</tr>
<tr>
	<td width="396" height="35" align="right">&nbsp;</td>
	<td width="233" height="25" align="center">
	<input name="magicword" class="txtbox" type="text" tabindex="8"></td>
	<td height="25" width="381">
	&nbsp;&nbsp;&nbsp;<?php echo $GLOBALS['captcha_text']; ?></td>
</tr>
<tr><td width="396" height="25" align="right">&nbsp;</td>
	<td width="233" height="25" align="center">
	
	<input  class="subbox" type="submit" value="Submit" name="submit"/></td></tr>
<tr><td width="396" height="25" align="right">&nbsp;</td>
	<td width="233" height="25" align="center">
	
	&nbsp;</td></tr>
<tr><td width="396">&nbsp;</td>
	<td width="233" align="center">
	&nbsp;</td>
	<td width="381">
	&nbsp;
	</td></tr>

		</table></form>
		</td>
	</tr>
	<tr>
		<td bgcolor="#F5F5F5" height="20"><?php  require_once "../footer.php"; ?></td>
	</tr>
</table>

</body>

</html>
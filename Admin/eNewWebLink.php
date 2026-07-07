<?php
require_once "config.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (empty($_SESSION['user'])) {
    header("Location: index.php?r=0");
    exit;
}

if ( isset($_SESSION['user']))
 {
   if($_SESSION['user']=="") 
 	{
		header("Location: index.php?r=0");
exit;
	}
 }
else{
	header("Location: index.php?r=0");
exit;
}

  
 ?>
 
 

<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta charset="UTF-8">
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



<script type="text/javascript" src="scripts/jquery.min.js"></script>
<script type="text/javascript" src="scripts/jquery.form.js"></script>


<script type="text/javascript" >
 $(document).ready(function()
  { 
	
      
$("#cate").change(function () 
  {
     
    	 $.post("ajWlink.php",
  			  {
  		    id: $("#cate").val()
  			  },
  			  function(data,status){
  			   // alert("Data: " + data + "\nStatus: " + status);
  			   $("#res").html(data);

  			  });
  	
 });



  }); 
  
</script>


</head>

<?php 
$msg=0;

if (isset($_POST["submit"]))
{
	$cate    = $_POST['cate'] ?? 0;
$wname   = trim($_POST['wname'] ?? '');
$wlink   = trim($_POST['wlink'] ?? '');
$address = trim($_POST['address'] ?? '');
$city    = trim($_POST['city'] ?? '');
$mobile  = trim($_POST['mobile'] ?? '');

$stmt = $con->prepare("INSERT INTO eweblink (ecateid, wname, wlink, address, city, mobile, status)
VALUES (?, ?, ?, ?, ?, ?, ?)");

$status = 0;

$stmt->bind_param(
    "isssssi",
    $_POST['cate'],
    $_POST['wname'],
    $_POST['wlink'],
    $_POST['address'],
    $_POST['city'],
    $_POST['mobile'],
    $status
);

$stmt->execute();
$stmt->close();
//echo $st;
$msg=1;
	
} 	// end of if (submit)

?>



	
<body >

<div align="center">
	<table border="0" width="980" id="table1" style="border-collapse: collapse" bordercolor="#E2E2E2" cellpadding="0">
		<tr>
			<td height="50" align="center" valign="top">	<?php  require_once "../header.php"; ?>		</td>		</tr>
		<tr>
			<td height="12" align="center" valign="top" bgcolor="#697779">			
					</td>
		</tr>
		<tr>
			<td>
			<table border="0" width="100%" id="table2" style="border-collapse: collapse" bordercolor="#CCCCCC" height="206" cellpadding="0">
				<tr>
					<td width="228" valign="top" bgcolor="#EEEEEE">			<?php if (!empty($_SESSION['id'])) include("sidemenu.php"); ?></td>
					<td align="center" valign="top" bgcolor="#FFFFFF">
					<h1>Create New e-commerce Web-Link</h1>
					<p>
					<h3>
						<?php if ($msg==1) echo "E-Commerce Link Add Successfully."; ?>
					
					</h3>
</p>
					<table border="0" width="96%" id="table13" cellpadding="0" style="border-collapse: collapse" bordercolor="#697779" height="128">
						<tr>
							<td valign="top" width="482">
							<table class="table3" border="0" width="123%"  id="table14" cellpadding="0" style="border-collapse: collapse" bordercolor="#697779">
						
						<!--webbot BOT="GeneratedScript" PREVIEW=" " startspan --><script Language="JavaScript" Type="text/javascript"><!--
function FrontPage_Form1_Validator(theForm)
{

  if (theForm.wname.value == "")
  {
    alert("Please enter a value for the \"Company Name\" field.");
    theForm.wname.focus();
    return (false);
  }

  if (theForm.wlink.value == "")
  {
    alert("Please enter a value for the \"website Link\" field.");
    theForm.wlink.focus();
    return (false);
  }
  return (true);
}
//--></script><!--webbot BOT="GeneratedScript" endspan --><form name="FrontPage_Form1" id="frmhlp" method="post" action="eNewWebLink.php" enctype="multipart/form-data" onsubmit="return FrontPage_Form1_Validator(this)" language="JavaScript">
						

<tr>
	<td width="127" height="46">Category Name</td><td width="389" height="46">
	
	<select name="cate" class="selbox" id="cate" required>
	<option value="">Please Select</option>

	<?php 
		 $st="Select * from ecate order by catename";
		 		 $result=mysqli_query($con,$st);
if (!$result) {
    die(mysqli_error($con));
}
		while ($row = mysqli_fetch_assoc($result))
			{
			?>

	<option value="<?php echo htmlspecialchars($row['ecateid']); ?>"><?php echo htmlspecialchars($row["catename"]); ?> </option>
			<?php
			
			}
			?>
	 </select>
	 
	</td>
</tr>
						

<tr>
	<td width="127" height="46">Name</td><td width="389" height="46">
	<!--webbot bot="Validation" S-Display-Name="Company Name" B-Value-Required="TRUE" -->
	<input  class="txtbox" type="text" name="wname" id="cname3" tabindex="4"  size="1" required/></td>
</tr>
						

<tr>
	<td width="127" height="46">Web Link</td><td width="389" height="46">
	<!--webbot bot="Validation" S-Display-Name="website Link" B-Value-Required="TRUE" -->
	<input  class="txtbox" type="text" name="wlink" id="cname2" tabindex="4"  size="1" required/></td>
</tr>
						

<tr>
	<td width="127" height="46">Address</td><td width="389" height="46">
	<input  class="txtbox" type="text" name="address" id="cname1" tabindex="4"  size="1"/></td>
</tr>
						

<tr>
	<td width="127" height="46">City</td><td width="389" height="46">
	<input  class="txtbox" type="text" name="city" id="cname0" tabindex="4"  size="1"/></td>
</tr>
						

<tr>
	<td width="127" height="46">Phone</td><td width="389" height="46">
	<input  class="txtbox" type="text" name="mobile" id="cname" tabindex="4" size="1"/></td>
</tr>
<tr><td width="127" height="38">&nbsp;</td><td width="389" height="38">
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
							<h2>Already Add Web Link </h2>
							<div id="res"><table class="table2"  border="1" width="96%" id="table12">
								<tr>
									<td bgcolor="#E0E2FE" width="353">&nbsp; 
									Name</td>
								</tr>
								
								
							</table></div>
							</td>
						</tr>
					</table></p>
					<p>&nbsp;</td>
				</tr>
			</table>
			</td>
		</tr>
		<tr>
			<td height="57" align="center" valign="top">			<?php  require_once "../footer.php"; ?></td>
		</tr>
	</table>
</div>

</body>

</html>
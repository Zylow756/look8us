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

<?php 
$msg=0;

if (isset($_POST["submit"]))
{

if (( ($_FILES["photoimg"]["type"] == "image/jpeg") || ($_FILES["photoimg"]["type"] == "image/gif")) && ($_FILES["photoimg"]["size"] < 5 * 1024 * 1024))
{

$name = $_FILES['photoimg']['name'];
$ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));

//$fp=date('d')."_".date('M')."_".date('Y')."_".date('h')."_".date('i')."_".date('s')."_".substr(str_replace(" ", "_", $txt),0,5).".".$ext;                    
$fp = uniqid().".".$ext;
if (!is_dir("../user/logo")) {
    mkdir("../user/logo", 0755, true);
}
if (!move_uploaded_file($_FILES["photoimg"]["tmp_name"],"../user/logo/".$fp)) {
    die("Image upload failed.");
}

//echo $_FILES["photoimg"]["type"];
//echo "<br>";
//echo $fp;

$stmt = $con->prepare("INSERT INTO ecate (catename, img, remark, status) VALUES (?, ?, ?, ?)");
$status = 0;
$stmt->bind_param("sssi", $_POST['cname'], $fp, $_POST['remark'], $status);
$stmt->execute();
//echo $st;
$msg=1;
	
}
else
{
$msg=2;
}

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
					<h1>Create New e-commerce category</h1>
					<p>
					<h3><?php if ($msg==1) echo "E-Commerce Category Create"; ?>
					<?php if ($msg==2) echo "Error : Please Check Image Format(Gif/JPG) or Size"; ?>
					</h3>
</p>
					<table border="0" width="90%" id="table13" cellpadding="0" style="border-collapse: collapse" bordercolor="#697779" height="128">
						<tr>
							<td valign="top" width="418">
							<table class="table3" border="0" width="100%"  id="table14" cellpadding="0" style="border-collapse: collapse" bordercolor="#697779">
						
						<!--webbot BOT="GeneratedScript" PREVIEW=" " startspan --><script Language="JavaScript" Type="text/javascript"><!--
function FrontPage_Form1_Validator(theForm)
{

  if (theForm.cname.value == "")
  {
    alert("Please enter a value for the \"Category Name\" field.");
    theForm.cname.focus();
    return (false);
  }
  return (true);
}
//--></script><!--webbot BOT="GeneratedScript" endspan --><form name="FrontPage_Form1" id="frmhlp" method="post" action="eNewCate.php" enctype="multipart/form-data" onsubmit="return FrontPage_Form1_Validator(this)" language="JavaScript">
						

<tr>
	<td width="116" height="50">Category Name</td>
	<td width="286" height="50">
	&nbsp;<!--webbot bot="Validation" s-display-name="Category Name" b-value-required="TRUE" -->
	<input
    type="text"
    name="cname"
    class="txtbox"
    placeholder="Category Name"
    required></td>
</tr>
<tr>
	<td width="116" height="30">Remark</td><td width="286" height="30">
	<input  class="txtbox" type="text" name="remark" id="remark" tabindex="4"  size="1"/></td>
</tr>
<tr>
	<td width="116" height="39">Category Images</td><td width="286" height="39">
		
<input type="file" name="photoimg" size="27" required></td>
</tr>
<tr><td width="116" height="38">&nbsp;</td><td width="286" height="38">
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
									<td bgcolor="#E0E2FE" width="353">&nbsp;Category 
									Name</td>
								</tr>
								
								
		<?php 
		 $st="Select * from ecate order by catename";
		 		 $result=mysqli_query($con,$st);
if (!$result) {
    die(mysqli_error($con));
}
		while ($row=mysqli_fetch_assoc($result))
			{
			?>
						<tr>
									<td width="353">&nbsp;&nbsp;
									<a href="vieweCate.php?id=<?php echo htmlspecialchars($row['ecateid']); ?>" class="a2" ><?php echo htmlspecialchars($row["catename"]); ?></a>
									
									
									</td>
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
			<td height="57" align="center" valign="top">			<?php  require_once "../footer.php"; ?></td>
		</tr>
	</table>
</div>

</body>

</html>
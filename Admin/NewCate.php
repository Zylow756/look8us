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
if(trim($_POST['cname'])=="")
{
    die("Category name required");
}

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

$stmt = $con->prepare(
"INSERT INTO category (cname, remark, gstatus)
 VALUES (?, ?, ?)"
);

$stmt->bind_param(
"ssi",
$_POST['cname'],
$_POST['remark'],
$_POST['gstatus']
);

$stmt->execute();
mysqli_query($con,$stmt);
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
					<h1>Create New Category</h1>
					<p><h3><?php if ($msg==1) echo "Category Create"; ?></h3>
</p>
					<table border="0" width="90%" id="table13" cellpadding="0" style="border-collapse: collapse" bordercolor="#697779" height="128">
						<tr>
							<td valign="top" width="402">
							<table class="table3" border="0" width="100%"  id="table14" cellpadding="0" style="border-collapse: collapse" bordercolor="#697779">
						
						<form name="frmhlp" id="frmhlp" method="post" action="NewCate.php" onsubmit="return vfhfn();">
						

<tr>
	<td width="116" height="50">Category Name</td><td width="286" height="50">
	<input  class="txtbox" type="text" name="cname" id="cname" tabindex="4" value="Category Name" onfocus="if(this.value=='Category Name'){this.value='';}" onblur="if(this.value==''){this.value='Category Name';}" size="1" required/></td>
</tr>
<tr>
	<td width="116" height="30">Remark</td><td width="286" height="30">
	<input  class="txtbox" type="text" name="remark" id="remark" tabindex="4"  size="1" /></td>
</tr>
<tr>
	<td width="116" height="39">Status</td><td width="286" height="39">
	<select  class="selbox" name="gstatus" id="selectGender0" size="1" tabindex="5">
	<option value="1" >Enable</option>
	<option value="0">Disable</option>
	</select></td>
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
		 $st="Select * from category order by cname";
		 		 $result=mysqli_query($con,$st);
if (!$result) {
    die(mysqli_error($con));
}
		while ($row=mysqli_fetch_assoc($result))
			{
			?>
								<tr>
									<td width="353">&nbsp;&nbsp;<?php echo htmlspecialchars($row["cname"]); ?></td>
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

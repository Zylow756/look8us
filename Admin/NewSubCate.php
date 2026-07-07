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
   if($_SESSION['user']=="") {
 	header("location: index.php?r=0"); 
	exit;
   }
 }
else {
 		header("location: index.php?r=0"); 
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
      
      
 $("#cname").change(function () 
  {
     
     $("#preview1").html('<img src="img/loader.gif" alt="Uploading...."/>');

  		 $.post("ajCate.php",
  			  {
  		    sid: $("#cname").val()
  			  },
  			  function(data,status){
  			   // alert("Data: " + data + "\nStatus: " + status);
  			   $("#res").html(data);

  			  });
  			  
    $('#h3').text('');

  	 $('#preview1').text('');

 });



  }); 
  
</script>


<script type="text/javascript">
function vfhfn()
{


var fllnme1=document.frmhlp.subname.value;


var num =/^[0-9]+$/;
var alpha =/^[a-z]+$/;


if(fllnme1==null||fllnme1=="")
{alert("Required Sub-Category Name");
document.frmhlp.subname.focus();
return false;
}

if(fllnme1=="Sub-Category Name")
{alert("Required Sub-Category Name");
document.frmhlp.subname.focus();
return false;
}


return true;

}

</script>



</head>

<?php 
$msg=0;

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
	$stmt = mysqli_prepare(
    $con,
    "SELECT COUNT(*) FROM catedetail WHERE cateid=? AND subcatename=?"
);

mysqli_stmt_bind_param($stmt,"ss",$cname,$subname);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt,$count);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

if($count>0)
{
    die("Subcategory already exists.");
}

$stmt = mysqli_prepare(
    $con,
    "INSERT INTO catedetail VALUES (NULL, ?, ?, ?, ?)"
);
$subname = trim($_POST['subname'] ?? '');
$cname   = $_POST['cname'] ?? '';
$remark  = trim($_POST['remark'] ?? '');
$status  = (int)($_POST['gstatus'] ?? 0);

if(trim($subname)=="")
{
    die("Subcategory name required.");
}

mysqli_stmt_bind_param(
    $stmt,
    "sssi",
    $_POST['cname'],
    $_POST['subname'],
    $_POST['remark'],
    $_POST['gstatus']
);

mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

$msg = 1;
if(!mysqli_stmt_execute($stmt))
{
    die(mysqli_error($con));
}
} 	// end of if (submit)

?>
	
<body >

<div align="center">
	<table border="0" width="980" id="table1" style="border-collapse: collapse" bordercolor="#E2E2E2" cellpadding="0">
		
<tbody>
	<tr>
			<td height="50" align="center" valign="top">	<?php  require_once "../header.php"; ?>		</td>		</tr>
		<tr>
			<td height="12" align="center" valign="top" bgcolor="#697779">			
					</td>
		</tr>
		<tr>
			<td>
			<table border="0" width="100%" id="table2" style="border-collapse: collapse" bordercolor="#CCCCCC" height="206" cellpadding="0">
				
<tbody>
			<tr>
					<td width="228" valign="top" bgcolor="#EEEEEE">			<?php if (!empty($_SESSION['id'])) include("sidemenu.php"); ?></td>
					<td align="center" valign="top" bgcolor="#FFFFFF">
					<h1>Create New Sub-Category</h1>
					<p><?php if ($msg==1) echo "<h3>Sub-Category Created Successfully.</h3>"; ?>
</p>
					<table border="0" width="90%" id="table13" cellpadding="0" style="border-collapse: collapse" bordercolor="#697779" height="128">
						
<tbody>
					<tr>
							<td valign="top" width="402">
							<table class="table3" border="0" width="100%"  id="table14" cellpadding="0" style="border-collapse: collapse" bordercolor="#697779">
						
						<form name="frmhlp" id="frmhlp" method="post" action="NewSubCate.php" onSubmit="return vfhfn();">
						

<tr>
	<td width="116" height="50">Select Category </td><td width="286" height="50">
	



	<select  class="selbox" name="cname" id="cname" size="1" tabindex="5">
	<option value='0' >Please Select</option>
		<?php 
if($cname == 0)
{
    die("Please select a category.");
}

		 $st="Select * from category order by cname";
		 $result=mysqli_query($con,$st);
if (!$result) {
    die(mysqli_error($con));
}
		while ($row=mysqli_fetch_assoc($result))
			{
			?>
		<option value='<?php echo htmlspecialchars($row["cateid"]); ?>' <?php if (isset($_POST["cname"])){if ($_POST["cname"]==$row["cateid"]) echo "Selected" ;} ?> > <?php echo htmlspecialchars($row["cname"]); ?></option>
			<?php
			}
			?>
	
	</select></td>
</tr>
						

<tr>
	<td width="116" height="50">Sub-Category Name</td><td width="286" height="50">
	<input  class="txtbox" type="text" name="subname" id="subname" tabindex="4" value="Sub-Category Name"  size="1"/></td>
</tr>
<tr>
	<td width="116" height="30">Remark</td><td width="286" height="30">
	<input  class="txtbox" type="text" name="remark" id="remark" tabindex="4"  size="1"/></td>
</tr>
<tr>
	<td width="116" height="39">Status</td><td width="286" height="39">
	<select  class="selbox" name="gstatus" id="gstatus" size="1" tabindex="5">
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
</tbody>
					</table>
							</td>
							<td valign="top">
							<h2>Already Created </h2>
							<div id="res">
								<table class="table2"  border="1" width="96%" id="table12">

<tbody>
								<tr>
									<td bgcolor="#E0E2FE" width="353">&nbsp;Sub-Category 
									Name</td>
								</tr>
								
								
</tbody>
							</table></div>
							</td>
						</tr>

</tbody>
					</table></p>
					<p>&nbsp;</td>
				</tr>
</tbody>
			</table>
			</td>
		</tr>
		<tr>
			<td height="57" align="center" valign="top">			<?php  require_once "../footer.php"; ?></td>
		</tr>
</tbody>
	</table>
</div>

</body>

</html>
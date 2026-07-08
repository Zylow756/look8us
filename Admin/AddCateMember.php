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
<meta http-equiv="Content- type" content="text/html; charset=windows-1252">
<title>Online Directory : Admin Panel</title>
 <link rel="stylesheet"  type="text/css" href="../akc.css" />


<script  type="text/javascript" src="scripts/jquery.min.js"></script>
<script  type="text/javascript" src="scripts/jquery.form.js"></script>



<script  type="text/javascript" >
 $(document).ready(function()
  { 
	
     
      
 $("#cname").on("change", function ()
  {
     

  		 $.post("ajCate1.php",
  			  {
  		    sid: $("#cname").val()
  			  },
  			  function(data,status){
  			   // alert("Data: " + data + "\nStatus: " + status);
  			   $("#subcate").html(data);

  			  });
  			  
 
 });



  }); 
  
</script>


<style  type="text/css"> 

body
{
background-image:url('img/bg.png');
background-repeat:repeat-x;
background-color: #70828F;;
} 
</style>


</head>

<?php
$msg=0;
			
if ( isset($_POST['submit0']))
{
if ((int)$_POST['subcate'] !== 0)
{
$mid     = (int)$_POST['mid'];
$cname   = (int)$_POST['cname'];
$subcate = (int)$_POST['subcate'];

$s = "insert into memberdetail VALUES (NULL,$mid,$cname,$subcate)";
if (!mysqli_query($con, $s)) {
    die(mysqli_error($con));
}
$msg=1;
 }
}


if ( isset($_GET['id']))
{

$id = (int)($_GET['id'] ?? 0);

$s = "DELETE FROM memberdetail WHERE mdid=$id";
mysqli_query($con, $s);
if (!mysqli_query($con, $s)) {
    die(mysqli_error($con));
}

$msg=2;

}				

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
					<td width="228" valign="top" bgcolor="#EEEEEE">			<?php if (!empty($_SESSION['id'])) {
    require_once "sidemenu.php";
} require_once "sidemenu.php"; ?></td>
					<td align="center" valign="top" bgcolor="#FFFFFF">
					<h1>Add Category to Member<br>
&nbsp;</h1>
				
<?php 
if ($msg==1) echo "<h3>Category Add to Member</h3>" ;
elseif  ($msg==2) echo "<h3>Category Delete from your Acccount</h3>" ;

 ?>
					  <form name="frmhlp" id="frmhlp" method="post" action="AddCateMember.php" >

	<table border="0" width="100%" id="table4" style="border-collapse: collapse" height="70">
						<tr>
							<td width="141">&nbsp; <font color="#000000"><b>&nbsp; 
							<font size="2">Select Member</font></b></font></td>
							<td width="398">
	
<select name="mid" class="selbox4" >
<?php
$st="Select * from member order by compname, mname";
$i=1;
$result=mysqli_query($con,$st);
if (!$result) {
    die(mysqli_error($con));
}

	while ($row = mysqli_fetch_assoc($result))
	{	
	
	?>
	<option value="<?php echo htmlspecialchars($row['mid']); ?>" <?php if (isset($_POST['mid'])) if($_POST['mid']==$row['mid']) echo 'selected'; ?>  > <?php echo htmlspecialchars($row["compname"]." (". $row["mname"].")"); ?></option>
	
	
	<?php
	}
	?>

					</select>								
							</td>
							<td>
	<input  class="subbox"  type="submit" value="Show" name="submit"/></td>
						</tr>
					</table>
					
					
					<?php
					
					if (isset($_POST["mid"]))
					{
					?>
					
					
					<table class="table2"  width="94%" id="table3" border="1"    >
								<tr>
									<td bgcolor="#D2D2D2" width="6%" height="34">&nbsp;SNO.</td>
									<td bgcolor="#D2D2D2" width="41%" style="text-align: left" height="34">
									&nbsp;Category</td>
									<td bgcolor="#D2D2D2" width="43%" height="34" style="text-align: left">&nbsp; 
									Sub Category</td>
									<td bgcolor="#D2D2D2" width="9%" style="text-align: left" height="34">
									&nbsp;Delete</td>
								</tr>
			<?php						

$mid = (int)$_POST['mid'];

$st = "SELECT * FROM memberdetail,category,catedetail
WHERE memberdetail.cateid=category.cateid
AND memberdetail.catdid=catedetail.catdid
AND mid=$mid";

//echo $st;
$i=1;
$result=mysqli_query($con,$st);
if (!$result) {
    die(mysqli_error($con));
}

	while ($row = mysqli_fetch_assoc($result))
	{	
	
	?>
				
								<tr>
									<td height="29" width="6%" style="text-align: center">&nbsp;<?php echo $i; ?></td>
									<td height="29" width="41%" style="text-align: left">&nbsp;<?php echo htmlspecialchars($row["cname"]); ?></td>
									<td height="29" width="43%" style="text-align: left">&nbsp;<?php echo htmlspecialchars($row["cdname"]); ?></td>
									<td height="29" width="9%" style="text-align: left">&nbsp;
									
			<a href="AddCateMember.php?id=<?php echo htmlspecialchars($row['mdid']); ?>"
   onclick="return confirm('Delete this category?');">
   Delete
</a>  
</td>
								</tr>
								
								<?php
								$i=$i+1;

								}
								
								
								?>
							</table>
							
	<table border="0" width="100%" id="table5" style="border-collapse: collapse" height="197">
		<tr>
			<td width="104">&nbsp;</td>
			<td width="191">&nbsp;</td>
			<td width="451" colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td width="103" height="32">&nbsp;</td>
			<td width="508" height="32" colspan="2" bgcolor="#E3E3E3" style="border-style: dotted; border-width: 1px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<b><font color="#000080">&nbsp;&nbsp; </font><font color="#000000">
			Add category to Selected Member</font></b></td>
			<td width="132" height="32">&nbsp;</td>
		</tr>
		<tr>
			<td width="103" height="46">&nbsp;</td>
			<td width="191" height="46" style="border-left-style: dotted; border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#C0C0C0">&nbsp;<b><font size="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Select Category</font></b></td>
			<td width="315" height="46" style="border-left-width: 1px; border-right-style: dotted; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#C0C0C0">
	



	<select  class="selbox" name="cname" id="cname" size="1" tabindex="5">
	<option value='0' >Please Select</option>
		<?php 
		 $st="Select * from category order by cname";
		 $result=mysqli_query($con,$st);
if (!$result) {
    die(mysqli_error($con));
}
		while ($row = mysqli_fetch_assoc($result))
			{
			?>
		<option value='<?php echo htmlspecialchars($row["cateid"]); ?>' <?php if (isset($_POST["cname"])){if ($_POST["cname"]==$row["cateid"]) echo "Selected" ;} ?> > <?php echo htmlspecialchars($row["cname"]); ?></option>
			<?php
			}
			?>
	
	</select></td>
			<td width="132" height="46">
	



	&nbsp;</td>
		</tr>
		<tr>
			<td width="103" height="42">&nbsp;</td>
			<td width="191" height="42" style="border-left-style: dotted; border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#C0C0C0">
			<b><font size="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Select Sub Category</font></b></td>
			<td width="315" height="42" style="border-left-width: 1px; border-right-style: dotted; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#C0C0C0">
	<select  class="selbox" name="subcate" id="subcate" size="1" tabindex="5">
	<option  value="0">Please Select</option>
	
	<?php 
	if (isset($_POST["cname"]))
	{
		 $cateid = (int)$_POST['cname'];

$st = "SELECT * FROM catedetail
WHERE cateid=$cateid
ORDER BY cdname";
		 $result=mysqli_query($con,$st);
if (!$result) {
    die(mysqli_error($con));
}
		while ($row = mysqli_fetch_assoc($result))
			{
			?>
		<option value='<?php echo htmlspecialchars($row["catdid"]); ?>' > <?php echo htmlspecialchars($row["cdname"]); ?></option>
			<?php
			}
	}
			?>

	
	</select></td>
			<td width="132" height="42">
	&nbsp;</td>
		</tr>
		<tr>
			<td width="103">&nbsp;</td>
			<td width="191" style="border-left-style: dotted; border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#C0C0C0">&nbsp;</td>
			<td width="315" style="border-left-width: 1px; border-right-style: dotted; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#C0C0C0">
	<input  class="subbox"  type="submit" value="Add Category" name="submit0"/></td>
			<td width="132">
	&nbsp;</td>
		</tr>
	</table>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
							
							<?php
							
							}
							?>
					</form>
					</td>
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
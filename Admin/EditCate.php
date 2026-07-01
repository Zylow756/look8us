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


$s="UPDATE category SET cname = '". $_POST['cname']."', remark='". $_POST['remark']."',cstatus = ". $_POST['gstatus']." where cateid=".$_POST['cateid'] ;
//echo $s;
mysql_query($s,$con);
$msg=1;

}


				

?>

			<table border="0" width="100%" id="table2" style="border-collapse: collapse" bordercolor="#CCCCCC" height="206" cellpadding="0">
				<tr>
					<td width="228" valign="top" bgcolor="#EEEEEE">			<?php if ($_SESSION["id"]!="") include("sidemenu.php"); ?></td>
					<td align="center" valign="top" bgcolor="#FFFFFF">
					<h1>Edit Category</h1>
					<p><h3><?php if ($msg==1) echo "Category Detail Update"; ?></h3>
</p>
					
					
					
					<table border="0" width="90%" id="table13" cellpadding="0" style="border-collapse: collapse" bordercolor="#697779" height="128">
						<tr>
							<td valign="top" width="402">
							<table class="table3" border="0" width="76%"  id="table14" cellpadding="0" style="border-collapse: collapse" bordercolor="#697779">
						
	<?php
	if (isset( $_GET["id"]))
	{
		$s="select * from category where cateid=". $_GET["id"] ;
	   $r=mysql_query($s,$con);
	   if($row=mysql_fetch_array($r))
		{
		
		?>
						<form name="frmhlp" id="frmhlp" method="post" action="EditCate.php" >
						

<tr>
	<td width="116" height="50">Category Name
	<input  type="hidden" name="cateid" id="cateid" tabindex="4" value="<?php echo $row['cateid']; ?>"  size="1"/>
	
	
	</td><td width="190" height="50">
	<input  class="txtbox" type="text" name="cname" id="cname" tabindex="4" value="<?php echo $row['cname']; ?>"  size="1"/></td>
</tr>
<tr>
	<td width="116" height="30">Remark</td><td width="190" height="30">
	<input  class="txtbox" type="text" name="remark" id="remark" tabindex="4"  value="<?php echo $row['remark']; ?>" size="1"/></td>
</tr>
<tr>
	<td width="116" height="39">Status</td><td width="190" height="39"><select  class="selbox" name="gstatus" id="gstatus" size="1" tabindex="5">
	<option value="1" <?php if ( $row['cstatus']=='1' ) echo 'Selected' ; ?>  >Enable</option>
	<option value="0"  <?php if ($row['cstatus']=='0') echo 'Selected' ; ?>  >Disable</option>
	</select>
	
	
	</td>
</tr>
<tr><td width="116" height="38">&nbsp;</td><td width="190" height="38">
	<input  class="subbox" type="submit" value="Edit" name="submit"/>

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
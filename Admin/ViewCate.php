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

$st="insert into category values (NULL ,'". $_POST["cname"]. "','". $_POST["remark"]. "',". $_POST["gstatus"]. ")" ;
mysql_query($st,$con);
//echo $st;
$msg=1;

} 	// end of if (submit)



if (isset( $_GET["id"]))
{

if( $_GET["a"]==2)
	$s="update category set cstatus=1 where cateid=".$_GET['id'] ;
elseif( $_GET["a"]==1)
	$s="update category set cstatus=0 where cateid=".$_GET['id'] ;

//echo $s;
mysql_query($s,$con);
//$msg=1;


}






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
					<h1>View All Category</h1>
					
					</p>
					<p>&nbsp;
					<table class="table2"  width="94%" id="table5" border="1"    >
								<tr>
									<td bgcolor="#D2D2D2" width="5%">&nbsp;SNO.</td>
									<td bgcolor="#D2D2D2" width="36%">&nbsp;Category&nbsp; Name</td>
									<td bgcolor="#D2D2D2" width="32%" style="text-align: center">
									Remark</td>
									<td bgcolor="#D2D2D2" width="10%" style="text-align: center">
									Edit</td>
									<td bgcolor="#D2D2D2" width="8%" style="text-align: center">
									&nbsp;Delete</td>
									<td bgcolor="#D2D2D2" width="7%" style="text-align: center">
									Status</td>
								</tr>
			<?php						

$st="Select * from category order by cname";

//echo $st;
$i=1;
$result=mysql_query($st,$con);

	while ($row=mysql_fetch_array($result))
	{	
	
	?>
				
								<tr>
									<td height="29" width="5%">&nbsp;<?php echo $i; ?></td>
									<td height="29" width="36%">&nbsp;<?php echo $row["cname"]; ?></td>
									<td height="29" width="32%" style="text-align: center">&nbsp;<?php 	echo $row["remark"];  ?></td>
									<td height="29" width="10%" style="text-align: center">&nbsp;<?php echo "<a class='a3' href='EditCate.php?id=".$row['cateid']."'>Edit</a>"; ?></td>
									<td height="29" width="8%" style="text-align: center">&nbsp;<?php echo "<a class='a3' href='DelCate.php?id=".$row['cateid']."'>Delete</a>"; ?></td>
									<td height="29" width="7%" style="text-align: center">
									
					&nbsp;<?php //if ($row["cstatus"]==1) echo "Enable" ; else echo "<b>Disable</b>"; ?>

								<?php 
									
									if ($row["cstatus"]==1)
									echo "<a class='a5' href='viewCate.php?a=1&id=".$row['cateid']."'>Enable</a>"; 
									else
									echo "<a class='a' href='viewCate.php?a=2&id=".$row['cateid']."'>Disable</a>"; 
									
									?>	
	
	
	</td>
								</tr>
								
								<?php
								$i=$i+1;

								}
								
								
								?>
							</table>
					
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


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


if ( isset($_GET['id']))
{

$s="delete from homeimg  where aid=".$_GET["id"];
mysql_query($s,$con);

$msg=2;

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
					<h1>View Home Imgage/Ads</h1>
					<p><?php if ($msg==2) echo "<h3>Image Delete from Gallery</h3>" ;  ?>

</p>
					<table border="1" width="90%" id="table13" cellpadding="0" style="border-collapse: collapse" bordercolor="#697779" height="128">
						<tr>
							<td width="26%" height="37" align="center" bgcolor="#98C5FC">
							<b><font size="2" color="#000000">Name</font></b></td>
							<td width="53%" height="37" align="center" bgcolor="#98C5FC">
							<b><font size="2" color="#000000">Image</font></b></td>
							<td width="13%" height="37" align="center" bgcolor="#98C5FC">
							<b><font size="2" color="#000000">Delete</font></b></td>
						</tr>
						
						
						<?php 
		 $st="Select * from homeimg order by aname";
		 		 $result=mysql_query($st,$con);
		 		 
		 		 $i=1;
		while ($row=mysql_fetch_array($result))
			{
			if ($row['img']<>"-")
			{
			?>
				
		
		

						
						<tr>
							<td width="26%" align="justify">
							<p style="line-height: 22px; margin-left: 10px">
							<?php  echo $row["aname"] ; ?> <br>

							<?php  echo $row["website"] ; ?> <br>
							<?php  echo $row["mobile"] ; ?> <br>
							
							
							
							</td>
							<td width="53%" align="center">
							<img border="1" src="<?php echo "../user/logo/".$row['img']; ?>"  width="243" height="246"></td>
							<td width="13%" align="center">
							<?php
				echo "<br>";
			echo "<a class='a2' href='viewHomeImg.php?id=".$row['aid']."'>Delete</a>";  
			echo "<br><br>";?>
							&nbsp;</td>
						</tr>
						
						
							<?php
			$i=$i+1;
			}
			

		}
		?>
		
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
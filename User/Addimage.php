

<?php

session_start();

if (isset($_SESSION['user']))
 {	if ($_SESSION['user']=="")
		  header("location: login.php?r=0");
 }
else
 	 header("location: login.php?r=0");
	
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
background-image:url('../Admin/img/bg.png');
background-repeat:repeat-x;
background-color: #70828F
} 
</style>

<script type="text/javascript">
function vfhfn()
{


var x=document.frmhlp.photoimg.value;
if(x==null||x=="")

alert("Please Select Your Photo(JPG/Gif)");
 return false;
}
else
{
return true;
}

}


</script>

</head>

		<?php
include("../config.php");
$msg=0;

if ( isset($_POST['submit']))
{
				
$st="Select * from memberimage  where mid=".$_SESSION["mid"];
$result=mysql_query($st,$con);
$num_rows = mysql_num_rows($result);
if ($num_rows<5)
{
	$valid_formats = array("jpg","JPG","png","PNG","gif","GIF","bmp","BMP");
		
				$name = $_FILES["photoimg"]["name"];
				$size = $_FILES['photoimg']['size'];
				
				if(strlen($name))
					{
					list($txt, $ext) = explode(".", $name);
							if(in_array($ext,$valid_formats))
								{
										if($size<(500*550))
											{

									$fp = date('d')."_".date('M')."_".date('Y')."_".time()."_".substr(str_replace(" ", "_", $txt),0,5).".jpg";

									//$fp=date('d')."_".date('M')."_".date('Y')."_".date('h')."_".date('i')."_".date('s')."_".$_FILES["photoimg"]["name"];
												
												move_uploaded_file($_FILES["photoimg"]["tmp_name"],"logo/".$fp);
												
												$s="insert memberimage  values(NULL,".$_SESSION["mid"].",'".$fp . "')";
												mysql_query($s,$con);
												
												$msg=1;
											}
											else
											 {
											 	$msg=2; 
											 	//echo "Image file size max 1 MB";					
											 }
									}	  
								else
									{  
									$msg=3;  
									//echo "Invalid file format..";	 
									}
						}			
					
	}
	else
	{
	$msg=4; //Max no of image
	}

}



if ( isset($_GET['id']))
{

$s="delete from memberimage where id=".$_GET["id"];
mysql_query($s,$con);

$msg=5;

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
					<td width="228" valign="top" bgcolor="#E3E3E3">			<?php if ($_SESSION["mid"]!="") include("sidemenu.php"); ?></td>
					<td align="center" valign="top" bgcolor="#FFFFFF">
					<h1>&nbsp;Add Images to Gallery</h1>
					<p>&nbsp;
					<?php 
							if ($msg==1) echo "<h3>Image Add to Gallery</h3>" ; 
							elseif ($msg==2) echo "<h3>Please select Small Logo Size</h3>" ;
							elseif ($msg==3) echo "<h3>Please Select JPG/GIF Logo</h3>" ; 
					  		elseif ($msg==5) echo "<h3>Image Delete from Gallery</h3>" ;  
							elseif ($msg==4) echo "<h3>Can't Add more Image (Max. 5 Image)</h3>" ;
					 ?>

					</p>
					<table class="table3" border="0" width="99%"  id="table4" cellpadding="0" style="border-collapse: collapse" bordercolor="#697779">
						<form name="frmhlp" id="frmhlp" method="post" action="Addimage.php" enctype="multipart/form-data" >



<tr>
	<td width="15%" height="35" bgcolor="#FFFFFF" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; text-align:right" valign="top">&nbsp; 
	Select logo Image&nbsp;&nbsp;&nbsp; 
	</td>
	<td width="52%" height="35" bgcolor="#FFFFFF" colspan="2" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; " valign="top">
<input type="file" name="photoimg"   id="photoimg" size="38"/><br>
<font color="#FF0000"><b>&nbsp; Image&nbsp; file should be JPG/GIF , Max 200*200 
Pixel </font> 
<font color="#0033CC">(Max. 5 Image)</font><font color="#FF0000"><br>
<br>
</font> 
</b>&nbsp;<input  class="subbox" type="submit" value="Upload Image" name="submit"  onclick="return vfhfn();"/></td>
	<td width="36%" bgcolor="#FFFFFF" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; text-align:center" rowspan="2">
		
		<p style="text-align: center"><u><font color="#FF0000"><b>Current Images</b></font></u></p>
		<p>
		
		<?php 
		 $st="Select * from memberimage where mid=".$_SESSION["mid"];
		 		 $result=mysql_query($st,$con);
		while ($row=mysql_fetch_array($result))
			{
			if ($row['img']<>"-")
			{
			?>
				<img border="1" src="<?php echo "logo/".$row['img']; ?>"  width="164" height="166">
		
			<?php
			}
			echo "<br>";
			echo "<a class='a2' href='Addimage.php?id=".$row['id']."'>Delete</a>";  
			echo "<br><br>";

		}
		?>
		
		</td>
</tr>
<tr><td width="15%">&nbsp;</td><td width="35%" height="55" valign="top">
	&nbsp;</td>
	<td width="16%">
	&nbsp;</td></tr>
	
	
	
</form></td>
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
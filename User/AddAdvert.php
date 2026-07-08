<?php
require_once __DIR__ . "/../config.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (empty($_SESSION['user'])) {
    header("Location: index.php?r=0");
    exit;
}

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
<meta charset="UTF-8">
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
$msg=0;

if ( isset($_POST['submit']))
{
		
				$valid_formats = array("jpg","JPG","png","PNG","gif","GIF","bmp","BMP");
		
				$name = $_FILES["photoimg"]["name"];
				$size = $_FILES['photoimg']['size'];
				
				if(strlen($name))
					{
					list($txt, $ext) = explode(".", $name);
							if(in_array($ext,$valid_formats))
								{
										if($size<(1250*1550))
											{
									
											//	$fp=date('d')."_".date('M')."_".date('Y')."_".date('h')."_".date('i')."_".date('s')."_".$_FILES["photoimg"]["name"];
												$fp = date('d')."_".date('M')."_".date('Y')."_".time()."_".substr(str_replace(" ", "_", $txt),0,5).".jpg";

												move_uploaded_file($_FILES["photoimg"]["tmp_name"],"logo/".$fp);
												
												$s="update member set catelog ='". $fp . "' where mid=".$_SESSION["mid"] ;
												mysqli_query($con,$s);
												
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
					else
						{
						$s="update member set catelog ='-' where mid=".$_SESSION["mid"] ;
						mysqli_query($con,$s);
						$msg=1;

						}	

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
					<td width="228" valign="top" bgcolor="#E3E3E3">			<?php if ($_SESSION["mid"]!="") include("sidemenu.php"); ?></td>
					<td align="center" valign="top" bgcolor="#FFFFFF">
					<h1>&nbsp;Set Landing Page Images :</h1>
					<p>&nbsp;
					<?php
					 if ($msg==1) echo "<h3>Logo Update</h3>" ;
					elseif ($msg==2) echo "<h3>Please select Small Logo Size</h3>" ;
					elseif ($msg==3) echo "<h3>Please Select JPG/GIF Logo</h3>" ;  
					
					//  echo $s;  
					  ?></p>
					<table class="table3" border="0" width="99%"  id="table4" cellpadding="0" style="border-collapse: collapse" bordercolor="#697779">
						<form name="frmhlp" id="frmhlp" method="post" action="AddAdvert.php" enctype="multipart/form-data" >



<tr>
	<td width="15%" height="35" bgcolor="#FFFFFF" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; text-align:right" valign="top">&nbsp; 
	Select Image&nbsp;&nbsp;&nbsp; </td>
	<td width="49%" height="35" bgcolor="#FFFFFF" colspan="2" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; ">
<input type="file" name="photoimg"   id="photoimg" size="38"/><p>
<font color="#FF0000"><b>Image&nbsp; file should be JPG/GIF , Max width 550 
pixel&nbsp; &amp; height : 650 Pixel</b></font> </td>
</tr>
<tr><td width="15%">&nbsp;</td><td width="34%" height="55">
	<input  class="subbox" type="submit" value="Upload Images" name="submit"  onclick="return vfhfn();"/></td>
	<td width="16%">
	&nbsp;</td></tr>
	
	
	<tr><td colspan="3" style="text-align: center">
		<p style="text-align: center"><u><font color="#FF0000"><b>Current Images</b></font></u></p>
		<p>
		
		<?php 
		 $st="Select * from member where mid=".$_SESSION["mid"];
		 		 $result=mysqli_query($con,$st);
if (!$result) {
    die(mysqli_error($con));
}

		if ($row=mysqli_fetch_assoc($result))
			{
			if ($row['catelog']<>"-")
			{
			?>
				<img border="1" src="<?php echo "logo/".$row['catelog']; ?>"  width="566" height="672">
		
		 
		<?php
		}
		else
		{
		
		?>
		<img border="1" src="logo/noimages.jpg">

		<?php
		}
		}
		?></td></tr>
	
	
	
</form>
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
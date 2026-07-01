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


<script type="text/javascript" src="scripts/jquery.min.js"></script>
<script type="text/javascript" src="scripts/jquery.form.js"></script>




<style type="text/css"> 

body
{
background-image:url('img/bg.png');
background-repeat:repeat-x;
background-color: #70828F;;
} 
</style>


</head>

<?php

include("../config.php");
$msg=0;

if ( isset($_POST['submit1']))
{
				
$st="Select * from memberimage  where mid=".$_POST["mid"];
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

									//$fp=date('d')."_".date('M')."_".date('Y')."_".date('h')."_".date('i')."_".date('s')."_".$_FILES["photoimg"]["name"];
									$fp = date('d')."_".date('M')."_".date('Y')."_".time()."_".substr(str_replace(" ", "_", $txt),0,5).".jpg";
	
												move_uploaded_file($_FILES["photoimg"]["tmp_name"],"../user/logo/".$fp);
												
												$s="insert memberimage  values(NULL,".$_POST["mid"].",'".$fp . "')";
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
					<td width="228" valign="top" bgcolor="#EEEEEE">			<?php if ($_SESSION["id"]!="") include("sidemenu.php"); ?></td>
					<td align="center" valign="top" bgcolor="#FFFFFF">
					<h1>Add Product Image to Member<br>
&nbsp;</h1>
				
<?php 
if ($msg==1) echo "<h3>Image Add to Member</h3>" ;
elseif  ($msg==5) echo "<h3>Image Delete from Member Acccount</h3>" ;
elseif  (($msg==2)||($msg==3)||($msg==4)) echo "<h3>Image NOT Add to Member Acccount,Invalid file format/Size..</h3>" ;

 ?>
					  <form name="frmhlp" id="frmhlp" method="post" action="AddImageMember.php" enctype="multipart/form-data" >

	<table border="0" width="100%" id="table4" style="border-collapse: collapse" height="70">
						<tr>
							<td width="141">&nbsp; <font color="#000000"><b>&nbsp; 
							<font size="2">Select Member</font></b></font></td>
							<td width="398">
	
<select name="mid" class="selbox4" >
<?php
$st="Select * from member order by compname, mname";
$i=1;
$result=mysql_query($st,$con);

	while ($row=mysql_fetch_array($result))
	{	
	
	?>
	<option value="<?php echo $row['mid'] ; ?>" <?php if (isset($_POST['mid'])) if($_POST['mid']==$row['mid']) echo 'selected'; ?>  > <?php echo $row["compname"]." (". $row["mname"].")" ; ?></option>
	
	
	<?php
	}
	?>

					</select>								
							</td>
							<td>
	<input  class="subbox" type="submit" value="Show" name="submit"/></td>
						</tr>
					</table>
					
					
					<?php
					
					if (isset($_POST["mid"]))
					{
					?>
					
					
					<table   width="94%" id="table3" border="0" style="border-collapse: collapse"    >
								<tr>
									<td bgcolor="#D2D2D2" width="99%" height="34" align="center">
									<b><font color="#000000">&nbsp;Current 
									Images</font></b></td>
								</tr>
								<tr>
									<td width="99%" height="34" align="center">&nbsp;<?php 
		 $st="Select * from memberimage where mid=".$_POST["mid"];
		 		 $result=mysql_query($st,$con);
		while ($row=mysql_fetch_array($result))
			{
			if ($row['img']<>"-")
			{
			?>
				<img border="1" src="<?php echo "../user/logo/".$row['img']; ?>"  width="164" height="166">
		
			<?php
			}
			echo "<br>";
			echo "<a class='a2' href='AddImageMember.php?id=".$row['id']."'>Delete</a>";  
			echo "<br><br>";

		}
		?>
</td>
								</tr>
			
							</table>
							
	<table border="0" width="100%" id="table5" style="border-collapse: collapse" height="197">
		<tr>
			<td width="34">&nbsp;</td>
			<td width="145">&nbsp;</td>
			<td width="567" colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td width="33" height="30">&nbsp;</td>
			<td width="580" height="31" colspan="2" bgcolor="#E3E3E3" style="border-style: dotted; border-width: 1px" align="center">
			<font color="#000000"><b>&nbsp;Upload New Image</b></font></td>
			<td width="132" height="30">&nbsp;</td>
		</tr>
		<tr>
			<td width="33" height="48">&nbsp;</td>
			<td width="145" height="48" style="border-left-style: dotted; border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#C0C0C0">
			<b><font size="2">Select Images</font></b></td>
			<td width="433" height="48" style="border-left-width: 1px; border-right-style: dotted; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#C0C0C0">
	



<input type="file" name="photoimg"   id="photoimg" size="42"/></td>
			<td width="132" height="48">
	



	&nbsp;</td>
		</tr>
		<tr>
			<td width="33" height="42">&nbsp;</td>
			<td width="145" height="42" style="border-left-style: dotted; border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#C0C0C0">
			&nbsp;</td>
			<td width="433" height="42" style="border-left-width: 1px; border-right-style: dotted; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#C0C0C0">
	<input  class="subbox" type="submit" value="Upload Image" name="submit1"  /></td>
			<td width="132" height="42">
	&nbsp;</td>
		</tr>
		<tr>
			<td width="33">&nbsp;</td>
			<td width="145" style="border-left-style: dotted; border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#C0C0C0">&nbsp;</td>
			<td width="433" style="border-left-width: 1px; border-right-style: dotted; border-right-width: 1px; border-top-width: 1px; border-bottom-style: dotted; border-bottom-width: 1px" bordercolor="#C0C0C0">
	&nbsp;</td>
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
			<td height="57" align="center" valign="top">			<?php  include("../footer.php"); ?></td>
		</tr>
	</table>
</div>

</body>

</html>
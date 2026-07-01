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


<script type="text/javascript" src="scripts/jquery.min.js"></script>
<script type="text/javascript" src="scripts/jquery.form.js"></script>


<script type="text/javascript" >
 $(document).ready(function()
  { 
	
     
      
 $("#cname").click('change',function()
  {
     
     $("#preview1").html('<img src="img/loader.gif" alt="Uploading...."/>');

  		 $.post("ajCate.php",
  			  {
  		    sid: $("#cname").val()
  			  },
  			  function(data,status){
  			   // alert("Data: " + data + "\nStatus: " + status);
  			   $("#subcate").html(data);

  			  });
  			  
    $('#h3').text('');

  	 $('#preview1').text('');

 });



  }); 
  
</script>



</head>

<?php
session_start();
if ($_SESSION['user']=="")
	header("location: ../index.php?r=0");


include("../config.php");

$msg=0;
if ( isset($_POST['submit']))
{
if ($_POST["subcate"]<>0)
{
$s="insert into memberdetail values (NULL,".$_SESSION['mid'].",".$_POST["cname"].",".$_POST["subcate"].")"  ;
mysql_query($s,$con);
$msg=1;
 }
}


if ( isset($_GET['id']))
{

$s="delete from memberdetail where mdid=".$_GET["id"];
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
					<td width="228" valign="top" bgcolor="#E3E3E3">			<?php if ($_SESSION["mid"]!="") include("sidemenu.php"); ?></td>
					<td align="center" valign="top" bgcolor="#FFFFFF">
					<h1>&nbsp;Add Category</h1>
					<p>&nbsp;<?php 
					if ($msg==1) echo "<h3>Category Add to Your Account</h3>" ; 
					elseif  ($msg==2) echo "<h3>Category Delete from your Acccount</h3>" ;
					
					//  echo $s;  
					  ?></p>
					<table border="0" width="90%" id="table17" cellpadding="0" style="border-collapse: collapse" bordercolor="#697779" height="128">
						<tr>
							<td valign="top" width="339">
							<table class="table3" border="0" width="100%"  id="table18" cellpadding="0" style="border-collapse: collapse" bordercolor="#697779">
						
						<form name="frmhlp" id="frmhlp" method="post" action="AddCate.php" onSubmit="return vfhfn();">
						

<tr>
	<td width="116" height="50">Select Category </td><td width="286" height="50">
	



	<select  class="selbox" name="cname" id="cname" size="1" tabindex="5">
	<option value='0' >Please Select</option>
		<?php 
		 $st="Select * from category order by cname";
		 $result=mysql_query($st,$con);
		while ($row=mysql_fetch_array($result))
			{
			?>
		<option value='<?php echo $row["cateid"]; ?>' <?php if (isset($_POST["cname"])){if ($_POST["cname"]==$row["cateid"]) echo "Selected" ;} ?> > <?php echo $row["cname"]; ?></option>
			<?php
			}
			?>
	
	</select></td>
</tr>
						

<tr>
	<td width="116" height="50">Sub-Category </td><td width="286" height="50">
	<select  class="selbox" name="subcate" id="subcate" size="1" tabindex="5">
	<option  value="0">Please Select</option>
	
	<?php 
	if (isset($_POST["cname"]))
	{
		 $st="Select * from catedetail where cateid=".$_POST["cname"]." order by cdname";
		 $result=mysql_query($st,$con);
		while ($row=mysql_fetch_array($result))
			{
			?>
		<option value='<?php echo $row["catdid"]; ?>' > <?php echo $row["cdname"]; ?></option>
			<?php
			}
	}
			?>

	
	</select></td>
</tr>
<tr>
	<td width="116" height="30">&nbsp;</td><td width="286" height="30">
	&nbsp;</td>
</tr>
<tr>
	<td width="116" height="39">&nbsp;</td><td width="286" height="39">
	<input  class="subbox" type="submit" value="Add Category" name="submit"/></td>
</tr>
<tr><td width="116" height="38">&nbsp;</td><td width="286" height="38">
	&nbsp;</td>
	</tr>
</form>
					</table>
							<table class="table3" border="0" width="96%"  id="table19" cellpadding="0" style="border-collapse: collapse" bordercolor="#697779">
						</td>
						</tr>
					</table>
							</td>
							<td valign="top">
							<h2>Already Add Category </h2>
							<div id="res">
								<table class="table2"  border="1" width="96%" id="table20">
								<tr>
									<td bgcolor="#E0E2FE" width="277">&nbsp;<b>Category 
									=&gt; Sub-Category </b> </td>
								</tr>
								
							<?php 
		 $st="Select * from memberdetail,category,catedetail where memberdetail.cateid=category.cateid and memberdetail.catdid=catedetail.catdid and  mid=".$_SESSION["mid"];
		 		 $result=mysql_query($st,$con);
		while ($row=mysql_fetch_array($result))
			{
			?>
								<tr>
									<td width="277">&nbsp;&nbsp;<?php echo $row["cname"]."  => ".$row["cdname"]; ?></td>
								</tr>
								
								<?php
								}
								?>

								

							</table></div>
							</td>
						</tr>
					</table>
					<p>&nbsp;</p>
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
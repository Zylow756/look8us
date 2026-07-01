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


</head>

<?php
include("../config.php"); 

$msg=0;

$ino=0;

$connect = mysqli_connect("ish.genxwhosting.com:3306", "websofts_look8us", "*Akc12345", "websofts_look8us");//databse connectivity

//$connect = mysqli_connect("localhost", "root", "", "look8us");//databse connectivity

	if(isset($_POST["submit"]))
	{
		$aid=$_POST["aid"];
		
		if($_FILES['file']['name'])
		{
				$filename = explode(".", $_FILES['file']['name']);
				if($filename[1] == 'csv')
				{
					$handle = fopen($_FILES['file']['tmp_name'], "r");
					while($data = fgetcsv($handle))//handling csv file 
						{
							$item1 = mysqli_real_escape_string($connect, $data[0]);  
							$item2 = mysqli_real_escape_string($connect, $data[1]);
							$item3 = mysqli_real_escape_string($connect, $data[2]);  
							$item4 = mysqli_real_escape_string($connect, $data[3]);
							$item5 = mysqli_real_escape_string($connect, $data[4]);  
							$item6 = mysqli_real_escape_string($connect, $data[5]);
							$item7 = mysqli_real_escape_string($connect, $data[6]);  
							$item8 = mysqli_real_escape_string($connect, $data[7]);  

							
							if (($ino>0)&&($item1<>"")) //=======remove coloum name, not insert =============
							{
								//insert data from CSV file 
								$query = "INSERT into agenquiry(aid,ename, cate,address,area,city,mobile,email,edate,estatus,hid) values('$aid','$item1','$item2','$item3','$item4','$item5','$item6','$item7','$item8','Open',1)";
							 	mysqli_query($connect, $query);
						 	}
						//	mysql_query($query,$con);
						$ino=$ino+1;
						
						}
					fclose($handle);
					$msg=2;
				//	echo "File sucessfully imported";
				}
		}
	}
				

?>

	
<body  onselectstart="return false">

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
					<h1>Excel Import- Enquiry by Agent<br>
&nbsp;</h1>
					<b><font color="#FF0000"><br>

					<?php
					
					if ($msg==2)
					{ echo "Excel Import Successfully, Total Record Import : ".$ino-1 ; }  
					
					?>
					

</font></b>

<form name="frmhlp" id="frmhlp" method="post" action="ExcelImport-agentEnqiry.php"  enctype="multipart/form-data">

	<table border="0" width="100%" id="table4" style="border-collapse: collapse" height="70">
						<tr>
							<td width="151"> &nbsp;</td>
							<td width="416">
	
&nbsp;</td>
							<td>
	&nbsp;</td>
						</tr>
						<tr>
							<td width="151"> <font color="#000000"><b>&nbsp;<font size="2">Select Agent</font></b></font></td>
							<td width="416">
	
&nbsp;<select name="aid" class="selbox4" >
<?php
$st="Select * from agent order by aname";
$i=1;
$result=mysql_query($st,$con);

	while ($row=mysql_fetch_array($result))
	{	
	
	?>
	<option value="<?php echo $row['aid'] ; ?>" <?php if (isset($_POST['aid'])) if($_POST['aid']==$row['aid']) echo 'selected'; ?>  > <?php echo $row["aname"] ; ?></option>
	
	
	<?php
	}
	?>

					</select></td>
							<td>
	&nbsp;</td>
						</tr>
						<tr>
							<td width="151"><font size="2" color="#000000"><b>&nbsp;Select Excel CSV File</b></font></td>
							<td width="416">
	
&nbsp;<input type="file" name="file">
</td>
							<td>
	<input  class="subbox" type="submit" value="Import Excel" name="submit"/> <br>
	
	
					
							
							</td>
						</tr>
						<tr>
							<td width="151">&nbsp;</td>
							<td width="416">
	
   <a class="btn btn-danger" role="button" href="img/look8us.csv"
								   download="look8us_sample.csv">
								  Download Sample Excel file
								</a>
</td>
							<td>
	&nbsp;</td>
						</tr>
					</table>
					
					<br>

					<?php
					
					if (isset($_POST["aid"]))
					{
					?>
					
					<br>

					<table class="table2"  width="99%" id="table3" border="1"    >
								<tr>
									<td bgcolor="#D2D2D2" width="5%" height="33">&nbsp;SNO.</td>
									<td bgcolor="#D2D2D2" width="10%" style="text-align: center" height="33">
									Date</td>
									<td bgcolor="#D2D2D2" width="23%" height="33" style="text-align: left">&nbsp; Company Name</td>
									<td bgcolor="#D2D2D2" width="13%" height="33" style="text-align: left">&nbsp;Contact Person</td>
									<td bgcolor="#D2D2D2" width="10%" height="33" style="text-align: center">Mobile</td>
									<td bgcolor="#D2D2D2" width="200" height="33" style="text-align: left">
									Email/
									Website</td>
									<td bgcolor="#D2D2D2" width="8%" height="33" style="text-align: left">&nbsp;Address</td>
									<td bgcolor="#D2D2D2" width="6%" height="33">
									&nbsp;Area </td>
									<td bgcolor="#D2D2D2" width="11%" height="33">&nbsp;Last 
									Feedback </td>
									<td bgcolor="#D2D2D2" width="11%" height="33">&nbsp;Next 
									Follow</td>
									<td bgcolor="#D2D2D2" width="4%" height="33">&nbsp;Status</td>
									<td bgcolor="#D2D2D2" width="3%" height="33">
									View</td>
								</tr>
			<?php						

		$st="Select * from agenquiry where aid=" . $_POST['aid'] ." and hid=1   order by eid desc limit ".$ino;
		
		//echo $st;
		$i=1;
		
		$result=mysql_query($st,$con);
		
		$num_rows = mysql_num_rows($result);

	while ($row=mysql_fetch_array($result))
	{	
	
	?>				<tr>
									<td height="29" width="5%" style="text-align: center">&nbsp;<?php echo $num_rows; ?></td>
									<td height="29" width="10%" style="text-align: center">&nbsp;<?php echo $row["edate"]; ?></td>
									<td height="29" width="23%" style="text-align: left">&nbsp;<?php echo $row["ename"]; ?></td>
									<td height="29" width="13%" style="text-align: left">&nbsp;<?php echo $row["cate"]; ?></td>
									<td height="29" width="10%" style="text-align: center">&nbsp;<?php echo $row["mobile"]; ?></td>
									<td height="29" width="200" style="text-align: left">&nbsp;<?php echo $row["email"]; ?> &nbsp; <?php echo $row["web"]; ?></td>
									<td height="29" width="8%" style="text-align: left">&nbsp;<?php echo $row["address"]; ?></td>
									<td height="29" width="6%">&nbsp;<?php echo $row["area"]; ?></td>
									<td height="29" width="11%">&nbsp;<?php echo $row["cdate"]; ?></td>
									<td height="29" width="11%">&nbsp;<?php echo $row["ndate"]; ?></td>
									<td height="29" width="4%">&nbsp;<?php echo $row["estatus"]; ?></td>
									<td height="29" width="3%">&nbsp;<?php echo "<a class='a2' href='ViewEnqStatus.php?eid=".$row['eid']."'>Detail</a>"; ?></td>
								</tr>
								
								<?php
//								$i=$i+1;
$num_rows=$num_rows-1;

								}
								
								
								?>
							</table>
							
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
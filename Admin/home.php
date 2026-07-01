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
background-color: #70828F
} 
</style>
</head>

<?php
session_start();

 
include("../config.php");
 
 if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
	{

// $pass=base64_encode($_POST['t2']);

 $pass=$_POST['t2'];
		
$ty=$_POST['t1'];
$t=substr($ty,0,1);
//echo $t;
	
	 	$s="select * from admin  where uname='".$_POST['t1']."' and pass='".$pass."' " ;
	
	//	$s="select * from admin  where uname='".$_POST['t1']."' and pass='".$pass."' and acode='".$_POST['t3']."'" ;
		$r=mysql_query($s,$con);
      //   echo $s;
         
		if ($row=mysql_fetch_array($r))
			{
				if( ($row['uname']==$_POST['t1']) and ($pass==$row['pass']) )
				{
					$_SESSION['user']=$_POST['t1'];
					$_SESSION['typ']=$row['utyp'];
					$_SESSION['id']=$row['uid'];
					
					$st="update admin set acode='012345' where uname='".$_POST['t1']."'";
					mysql_query($st,$con);
		
				}
				else
				{
						$_SESSION['user']="";
						$_SESSION['typ']="";
						$_SESSION['id']=0;
								
						//header("location: index.php?r=0");
				}
			}
			
		else
			{ 
			//$res="Invalid User Name OR Password";
			$_SESSION['user']="";
			$_SESSION['typ']="";
			$_SESSION['id']=0;
			
			
			header("location: index.php?r=0");
			
			}

	//echo $s;
	
	}
	else
	{
	if ($_SESSION['user']=="")
	header("location: index.php?r=0");

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
					&nbsp;<p>&nbsp;</p>
					<table border="0" width="70%" id="table3" cellpadding="0" style="border-collapse: collapse" bordercolor="#697779" height="128">
						<tr>
							<td bgcolor="#FF0000" align="center">
							&nbsp;<p>&nbsp;</p>
							<p><font size="4" color="#FFFFFF"><b>Welcome at 
							Admin Panel </b></font></p>
							<p><b><font size="4" color="#000000">Admin Panel</font></b></p>
							<p>&nbsp;</p>
							<p>&nbsp;</p>
							<p>&nbsp;</td>
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
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




</head>

<?php
session_start();
include("../config.php"); 

$msg=0;
			
if (isset( $_GET["id"]))
{
$s="delete from memberdetail where mdid=".$_GET['id'] ;
mysql_query($s,$con);
$msg=1;
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
					<h1>&nbsp;View All Category Add</h1>
					<p>&nbsp;<?php if ($msg==1) echo "Category Delete" ;  
					
					//  echo $s;  
					  ?></p>
					  <form method="get" action="ViewUserCate.php">
					<table border="0" width="90%" id="table17" cellpadding="0" style="border-collapse: collapse" bordercolor="#697779" height="128">
						<tr>
							<td valign="top">
							
							<div id="res">
								<table class="table2"  border="1" width="96%" id="table20">
								<tr>
									<td bgcolor="#E0E2FE" width="89"><b>&nbsp;Category&nbsp; 
									</b> </td>
									<td bgcolor="#E0E2FE" width="88"><b>&nbsp;Sub-Category</b></td>
									<td bgcolor="#E0E2FE" width="88"><b>&nbsp;Remove</b></td>
								</tr>
								
							<?php 
		 $st="Select * from memberdetail,category,catedetail where memberdetail.cateid=category.cateid and memberdetail.catdid=catedetail.catdid and  mid=".$_SESSION["mid"];
		 		 $result=mysql_query($st,$con);
		while ($row=mysql_fetch_array($result))
			{
			?>
								<tr>
									<td width="89">&nbsp;&nbsp;<?php echo $row["cname"]; ?></td>
									<td width="88">&nbsp;<?php echo $row["cdname"]; ?></td>
									<td width="88">&nbsp;<?php echo "<a class='a3' href='viewUserCate.php?id=".$row['mdid']."'>Delete</a>"; ?></td>
								</tr>
								
								<?php
								}
								?>

								

							</table></div>
							</td>
						</tr>
					</table></form>
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
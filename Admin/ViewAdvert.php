<?php
require_once "config.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (empty($_SESSION['admin'])) {
    header("Location: index.php?r=0");
    exit;
}
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
background-image:url('img/bg.png');
background-repeat:repeat-x;
background-color: #70828F;;
} 
</style>
<script type="text/javascript">
/*function vfhfn()
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
}*/
</script>
</head>

<?php 
$msg=0;
if ( isset($_GET['id']))
{
	$id = (int)($_GET['id'] ?? 0);

	$stmt = mysqli_prepare(
    $con,
    "SELECT img FROM advert WHERE aid=?"
);

mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if($row = mysqli_fetch_assoc($result))
{
    $file = "../user/logo/".$row['img'];

    if(is_file($file))
    {
        unlink($file);
    }
}

mysqli_stmt_close($stmt);

$stmt = mysqli_prepare(
    $con,
    "DELETE FROM advert WHERE aid=?"
);

mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

$msg = 2;
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
					<td width="228" valign="top" bgcolor="#EEEEEE">			<?php if (!empty($_SESSION["id"])) include("sidemenu.php"); ?></td>
					<td align="center" valign="top" bgcolor="#FFFFFF">
					<h1>View Ads Links</h1>
					<?php
if($msg==2)
{
    echo "<h3>Image deleted successfully.</h3>";
}
?>
					<table border="1" width="90%" id="table13" cellpadding="0" style="border-collapse: collapse" bordercolor="#697779" height="128">
						<tr>
							<td width="25%" height="37" align="center" bgcolor="#98C5FC">
							<b><font size="2" color="#000000">&nbsp;SNO</font></b></td>
							<td width="25%" height="37" align="center" bgcolor="#98C5FC">
							<b><font size="2" color="#000000">Name</font></b></td>
							<td width="25%" height="37" align="center" bgcolor="#98C5FC">
							<b><font size="2" color="#000000">Image</font></b></td>
							<td width="13%" height="37" align="center" bgcolor="#98C5FC">
							<b><font size="2" color="#000000">Delete</font></b></td>
							<td width="12%" height="37" align="center" bgcolor="#98C5FC">
							<b><font size="2" color="#000000">Edit</font></b></td>
						</tr>
						
						
						<?php 
		 $st="Select * from advert order by aname";
		 		 $result=mysqli_query($con,$st);
if (!$result) {
    die(mysqli_error($con));
}
		 		 
		 		 $i=1;
		while($row=mysqli_fetch_assoc($result))
			{
			if (!empty($row['img']) && $row['img'] != "-")
			{
			?>
						<tr>
							<td width="25%" align="center">
							<b>
							<?php  echo $i; ?>
							
							</b>
							
							</td>
							<td width="25%" align="justify">
							<p style="line-height: 22px; margin-left: 10px">
							<?php  echo htmlspecialchars($row["aname"]); ?> <br>

							<?php  echo htmlspecialchars($row["website"]); ?> <br>
							<?php  echo htmlspecialchars($row["mobile"]); ?> <br>
							
							<?php  
							if ($row["astatus"]=="D")  echo "<b>Disable</b>"   ;
							else if ($row["astatus"]=="H")  echo "Home Page"   ;
							else  if ($row["astatus"]=="A" ) echo "Adv Page"   ;

									 ?> 
							
							</td>
							<td width="25%" align="center">
							<img border="1" src="../user/logo/<?php echo rawurlencode($row['img']); ?>"  width="164" height="166"></td>
							<td width="13%" align="center">
							<form method="post">
    <input type="hidden" name="id" value="<?php echo $row['aid']; ?>">
    <input type="submit" name="delete" value="Delete">
</form>
							&nbsp;</td>
							<td width="12%" align="center">
								<?php
				echo "<br>";
			echo "<a class='a2' href='EditAdvert.php?id=".$row['aid']."'>Edit</a>";  
			echo "<br><br>";
			?>
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
			<td height="57" align="center" valign="top">			<?php  require_once "../footer.php"; ?></td>
		</tr>
	</table>
</div>

</body>

</html>
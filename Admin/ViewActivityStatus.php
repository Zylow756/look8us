<?php
require_once "config.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (empty($_SESSION['user'])) {
    header("Location: index.php?r=0");
    exit;
}
if (!isset($_SESSION['user']) || $_SESSION['user'] == "") {
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
</head>
<?php
$msg=0;
			
if (isset( $_GET["id"]))
{
$id = (int)($_GET['id'] ?? 0);

if( $_GET["a"]=="0")
	{
		$stmt = mysqli_prepare(
    $con,
    "DELETE FROM activity WHERE eid=?"
);

mysqli_stmt_bind_param($stmt,"i",$id);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

	}
elseif( $_GET["a"]=="1"){
	$stmt = mysqli_prepare(
    $con,
    "UPDATE FROM activity WHERE eid=?"
);

mysqli_stmt_bind_param($stmt,"i",$id);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

}
elseif( $_GET["a"]=="2")
	{
		$stmt = mysqli_prepare(
    $con,
    "UPDATE FROM activity WHERE eid=?"
);

mysqli_stmt_bind_param($stmt,"i",$id);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

	}

if(!mysqli_query($con,$stmt))
{
    die(mysqli_error($con));
}
$msg=1;
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
					<td width="228" valign="top" bgcolor="#EEEEEE">			<?php if (!empty($_SESSION['id'])) include("sidemenu.php"); ?></td>
					<td align="center" valign="top" bgcolor="#FFFFFF">
					<h1>&nbsp;View All Activity/ Status</h1>
										
					</p>
					<p>&nbsp;<?php if ($msg==1) echo "Activity Update/Delete" ;   ?></p>
<table border="0" width="90%" id="table21" cellpadding="0" style="border-collapse: collapse" bordercolor="#697779" height="128">
						<tr>
							<td valign="top">
							
							<div id="res">
								<table class="table2"  border="1" width="96%" id="table22">
								<tr>
									<td bgcolor="#E0E2FE" >&nbsp;<b>SNO</b></td>
									<td bgcolor="#E0E2FE" ><b>&nbsp;Activity 
									Heading&nbsp; 
									</b> </td>
									<td bgcolor="#E0E2FE" ><b>&nbsp;Date</b></td>
									<td bgcolor="#E0E2FE" >&nbsp;<b>&nbsp;Status</b></td>
									<td bgcolor="#E0E2FE" ><b>&nbsp;Remove</b></td>
								</tr>
								
							<?php 
		 $st="Select * from activity  order by eid desc limit 100" ;
		 		 $result=mysqli_query($con,$st);
if (!$result) {
    die(mysqli_error($con));
}
		 		 $i=1;
		while($row=mysqli_fetch_assoc($result))
			{
			?>
								<tr>
									<td width="29">&nbsp;<?php echo $i; ?></td>
									<td width="403">&nbsp;&nbsp;<?php echo htmlspecialchars($row["eventhead"]); ?></td>
									<td width="94">&nbsp;<?php echo htmlspecialchars($row["edate"]); ?></td>
									<td width="86">&nbsp;
									
									<?php 
									echo ($row['estate']=="Pending")
    ? "<a class='a5' href='ViewActivityStatus.php?a=1&id=".$row['eid']."'>Pending</a>"
    : "<a class='a' href='ViewActivityStatus.php?a=2&id=".$row['eid']."'>Approved</a>";
									?>	
									</td>
									<td width="82">&nbsp;<?php echo "<a class='a2' href='ViewActivityStatus.php?a=0&id=".$row['eid']."'>Delete</a>"; ?></td>
								</tr>
								
								<?php
								$i=$i+1;
								}
								?>
							</table>
								<p align="center"><b>
								<font size="2" color="#0066FF">&nbsp;Click on 
								status for change status mode.</font></b></div>
							</td>
						</tr>
					</table>
					
					</td>
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
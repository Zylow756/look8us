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
<?php 
if (isset($_GET["id"], $_GET["a"])) {

    $id = (int)$_GET["id"];
    $action = (int)$_GET["a"];

    if ($action == 2) {
        $status = 1;
    } elseif ($action == 1) {
        $status = 0;
    }

    if (isset($status)) {
        $sql = "UPDATE catedetail SET cdstatus=$status WHERE catdid=$id";

        if (!mysqli_query($con, $sql)) {
            die(mysqli_error($con));
        }
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
					<td width="228" valign="top" bgcolor="#EEEEEE">			<?php if (!empty($_SESSION['id'])) include("sidemenu.php"); ?></td>
					<td align="center" valign="top" bgcolor="#FFFFFF">
					<h1>View Sub-Category</h1>
					<p>&nbsp;</p>
						<form name="frmhlp" id="frmhlp" method="post" action="" >

					<table border="0" width="100%" id="table6" style="border-collapse: collapse">
						<tr>
							<td width="168">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Select Category 
							</td>
							<td width="213">
	<select  class="selbox" name="cname" id="cname" size="1" tabindex="5">
	<option value='0' >Please Select</option>
		<?php 
		 $st="Select * from category order by cname";
		 if (isset($st)) {
    mysqli_query($con, $st);
}
		 $result=mysqli_query($con,$st);
if (!$result) {
    die(mysqli_error($con));
}
		while ($row=mysqli_fetch_assoc($result))
			{
			?>
		<option value='<?php echo htmlspecialchars($row["cateid"]); ?>' <?php if (isset($_POST["cname"])){if ($_POST["cname"]==$row["cateid"]) echo "Selected" ;}elseif (isset($_GET["cid"])){if ($_GET["cid"]==$row["cateid"]) echo "Selected" ;} ?> > <?php echo htmlspecialchars($row["cname"]); ?></option>
			<?php
			}
			?>
	</select></td>
							<td> <input  class="subbox" type="submit" value="Show" name="submit"/></td>
						</tr>
					</table>
					<p>&nbsp;<table class="table2"  width="94%" id="table5" border="1"    >
								<tr>
									<td bgcolor="#D2D2D2" width="8%">&nbsp;SNO.</td>
									<td bgcolor="#D2D2D2" width="33%">&nbsp;Sub-Category&nbsp; Name</td>
									<td bgcolor="#D2D2D2" width="32%" style="text-align: center">
									Remark</td>
									<td bgcolor="#D2D2D2" width="10%" style="text-align: center">
									Edit</td>
									<td bgcolor="#D2D2D2" width="8%" style="text-align: center">
									&nbsp;Delete</td>
									<td bgcolor="#D2D2D2" width="7%" style="text-align: center">
									Status</td>
								</tr>
			<?php						
if ((isset($_POST["submit"]))or (isset($_GET["cid"])))
{ 

 if (isset($_POST["submit"]))
	{
		$cateid = (int)$_POST["cname"];

$st = "SELECT * FROM catedetail
       WHERE cateid=$cateid
       ORDER BY cdname";
	}
 else 
	{
		$cateid = (int)$_GET["cid"];

$st = "SELECT * FROM catedetail
       WHERE cateid=$cateid
       ORDER BY cdname";
	}

//echo $st;
$i=1;
$result=mysqli_query($con,$st);
if (!$result) {
    die(mysqli_error($con));
}
	while ($row=mysqli_fetch_assoc($result))
	{	
	?>
								<tr>
									<td height="29" width="8%">&nbsp;<?php echo $i; ?></td>
									<td height="29" width="33%">&nbsp;<?php echo htmlspecialchars($row["cdname"]); ?></td>
									<td height="29" width="32%" style="text-align: center">&nbsp;<?php 	echo htmlspecialchars($row["remark1"]);  ?></td>
									<td height="29" width="10%" style="text-align: center">&nbsp;<?php echo "<a class='a3' href='EditsubCate.php?id=".$row['catdid']."'>Edit</a>"; ?></td>
									<td height="29" width="8%" style="text-align: center">&nbsp;<?php echo "<a class='a3'
href='DelsubCate.php?id=".$row['catdid']."'
onclick=\"return confirm('Delete this sub-category?');\">
Delete
</a>"; ?></td>
									<td height="29" width="7%" style="text-align: center">	&nbsp;
									
									<?php //if ($row["cdstatus"]==1) echo "Enable" ; else echo "<b>Disable</b>"; ?>
									
								<?php 
									if ($row["cdstatus"]==1)
									echo "<a class='a5' href='viewSubCate.php?a=1&id=".$row['catdid']."&cid=".$row["cateid"]."'>Enable</a>"; 
									else
									echo "<a class='a' href='viewSubCate.php?a=2&id=".$row['catdid']."&cid=".$row["cateid"]."'>Disable</a>"; 
									?>	
									</td>
								</tr>
								<?php
								$i=$i+1;
								}
								}
								?>
							</table>
							</form>
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
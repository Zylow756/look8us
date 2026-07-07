 <?php
require_once "config.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (empty($_SESSION['user'])) {
    header("Location: index.php?r=0");
    exit;
}
?>
 <option  value='0'>Please Select</option>
 
 <?php 
$st="Select * from catedetail where cateid=".$_POST["sid"]." order by cdname";
//$st='Select * from subsubject where sid='.$_POST["sid"].' order by subname';
$result=mysqli_query($con,$st);
if (!$result) {
    die(mysqli_error($con));
}

 

	while ($row=mysqli_fetch_assoc($result))
	{
	?>
		<option value='<?php echo htmlspecialchars($row["catdid"]); ?>' > <?php echo htmlspecialchars($row["cdname"]); ?></option>
				
	<?php
	}
	?>				
							
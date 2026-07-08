 <?php
	require_once __DIR__ . "/../config.php";

	$sid = (int)($_POST['sid'] ?? 0);

	$st = "SELECT * FROM catedetail
       WHERE cateid = $sid
       ORDER BY cdname";
	//$st='Select * from subsubject where sid='.$_POST["sid"].' order by subname';
	$result = mysqli_query($con, $st);
	if (!$result) {
		die(mysqli_error($con));
	}

	?>

 <option value="0">Please Select</option>

 <?php


	while ($row = mysqli_fetch_assoc($result)) {
	?>
 	<option value='<?php echo htmlspecialchars($row["catdid"]); ?>'> <?php echo htmlspecialchars($row["cdname"]); ?></option>

 <?php
	}
	?>
 <option  value='0'>Please Select</option>
 
 <?php 

include("../config.php");

$st="Select * from catedetail where cateid=".$_POST["sid"]." order by cdname";
//$st='Select * from subsubject where sid='.$_POST["sid"].' order by subname';
$result=mysql_query($st,$con);

 

	while ($row=mysql_fetch_array($result))
	{
	?>
		<option value='<?php echo $row["catdid"]; ?>' > <?php echo $row["cdname"]; ?></option>
				
	<?php
	}
	?>				
							
<?php
require_once __DIR__ . "/../config.php";
?>
<div id="res"><table class="table2"  border="1" width="96%" id="table12">
								<tr>
									<td bgcolor="#E0E2FE" width="353">&nbsp;Sub-Subject 
									Name</td>
								</tr>
								<?php 
								 $sid = (int)($_POST['sid'] ?? 0);

$st = "SELECT * FROM catedetail
        WHERE cateid = $sid
        ORDER BY cdname";
								 $result=mysqli_query($con,$st);
if (!$result) {
    die(mysqli_error($con));
}
								 while ($row = mysqli_fetch_assoc($result))
								  {
								  ?>
								<tr>
									<td width="353">&nbsp; <?php echo htmlspecialchars($row["cdname"]); ?></td>
								</tr>
								<?php
								}
								
								?>
								
</table>
</div>
							
							
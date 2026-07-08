<?php
require_once __DIR__ . "/../config.php";
?>
<div id="res"><table class="table2"  border="1" width="96%" id="table12">
								<tr>
									<td bgcolor="#E0E2FE" width="353">&nbsp;
									Name</td>
								</tr>
								<?php 
								 $cateid = (int)($_POST['id'] ?? 0);

$st = "SELECT *
       FROM eweblink
       WHERE cateid = $cateid
       ORDER BY wname";
								 $result=mysqli_query($con,$st);
if (!$result) {
    die(mysqli_error($con));
}
								 while ($row = mysqli_fetch_assoc($result))
								  {
								  ?>
								<tr>
									<td width="353">&nbsp;
									
								<a href="vieweEditWebLink.php?id=<?php echo htmlspecialchars($row['wid']); ?>" class="a2" ><?php echo htmlspecialchars($row["wname"]); ?></a>
										
									 
									 
									 </td>
								</tr>
								<?php
								}
								
								?>
								
</table>
</div>							
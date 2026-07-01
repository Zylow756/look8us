<div id="res"><table class="table2"  border="1" width="96%" id="table12">
								<tr>
									<td bgcolor="#E0E2FE" width="353">&nbsp;Sub-Subject 
									Name</td>
								</tr>
								<?php 
								include("../config.php");
								 
								 $st='Select * from catedetail where cateid='.$_POST["sid"].' order by cdname';
								 $result=mysql_query($st,$con);
								 while ($row=mysql_fetch_array($result))
								  {
								  ?>
								<tr>
									<td width="353">&nbsp; <?php echo $row["cdname"]; ?></td>
								</tr>
								<?php
								}
								
								?>
								
</table>
</div>
							
							
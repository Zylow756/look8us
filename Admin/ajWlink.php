
<div id="res"><table class="table2"  border="1" width="96%" id="table12">
								<tr>
									<td bgcolor="#E0E2FE" width="353">&nbsp;
									Name</td>
								</tr>
								<?php 
								include("../config.php");
								 
								 $st="Select * from eweblink where cateid=".$_POST["id"]." order by wname";
								 $result=mysql_query($st,$con);
								 while ($row=mysql_fetch_array($result))
								  {
								  ?>
								<tr>
									<td width="353">&nbsp;
									
								<a href="vieweEditWebLink.php?id=<?php echo $row['wid']; ?>" class="a2" ><?php echo $row["wname"]; ?></a>
										
									 
									 
									 </td>
								</tr>
								<?php
								}
								
								?>
								
</table>
</div>							
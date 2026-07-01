
								<?php 
								include("../config.php");
								 
								 $st="Select * from admin where uname='".$_GET["uid"]."'";
								 $result=mysql_query($st,$con);
								 if ($row=mysql_fetch_array($result))
								  {
								 	
								 	$acode= substr(md5(uniqid(mt_rand(), true)) , 0, 8);
								 	
								//	echo $acode;
										$st="update admin set acode='".$acode."' where uname='".$_GET["uid"]."'";
										mysql_query($st,$con);
										
									echo "Your Access Code for Login : ".$acode;
								
									}
								
								?>
								
							
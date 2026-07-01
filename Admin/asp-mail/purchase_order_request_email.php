<?php 

include("setup.php");

			
			if (isset( $_GET["id"]))
			{
				$i=1;	
				$st="Select * from pur_request where purid=".$_GET["id"];
				$result0=mysql_query($st,$con);
				  if ($row0=mysql_fetch_array($result0))
					{
						//echo $st ;
					?>
						
<!DOCTYPE html>
<body >
						
<div >
<table border="0" width="100%" style="border-collapse: collapse">
<tr>
<td height="65" width="39%" align="left" >
<?php 
$st="Select * from store  where storeid=1";
							$result=mysql_query($st,$con);
							if ($row=mysql_fetch_array($result))
								{
								?>
								<p align="left"><font color="#000000"><b><font size="3"><?php echo $row['storename']; ?><br></font>Address : </b>:	<?php echo $row['address']; ?> <br>
								<?php echo $row['city']; ?> &nbsp;,  <?php echo $row['state']; ?>
								
								<br> <b>Phone : </b><?php echo $row['phone']; ?>
								<br> <b>Email : </b><?php echo $row['email']; ?>
								<br> <b>Website : </b><?php echo $row['helpline']; ?>&nbsp;</font>

								<?php
								}
								?> </td>
								<td height="65" width="61%" align="right">
								  <img src="http://store.conceptgroups.com/logo/logo.png" alt="CONCEPT"  />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								</td>
							</tr>
							<tr>
								<td colspan="2" height="36" bgcolor="#F7F7F7" style="border-left-width: 1px; border-right-width: 1px; border-top-style: dotted; border-top-width: 1px; border-bottom-width: 1px" bordercolor="#616161">
								<p align="center"><u><b>
								<font color="#000000" size="4">Purchase Order</font></b></u></td>
							</tr>
							<tr>
								<td><br>
								   <?php						
									$st="Select * from supplier where sid=".$row0['suppid'];
									$result=mysql_query($st,$con);
									if ($row=mysql_fetch_array($result))
									{	
									?>
									 
							<font color="#000000"><b><font size="3">
								<b><?php echo $row["sname"]; ?></b>	</font>	
														
								<br> Address </b>:	<?php echo $row['address']; ?> <br>
								<?php echo $row['city']; ?> &nbsp;,  <?php echo $row['pincode']; ?>
								
								<br> <b>Phone : </b><?php echo $row['mobile']; ?>
								<br> <b>GST : </b><?php echo $row['gst']; ?>
								<br> <b>Email : </b><?php echo $row['email']; ?></font>

								 <?php 								
									}
									?> 
								</td>
								<td>
								<div align="right">
								<table border="0" width="75%" cellspacing="1">
									<tr>
										<td width="132"><font color="#000000">Suppl.Code 
										</font> </td>
										<td width="14" align="center">
									 
							<font color="#000000">:</font></td>
										<td><font color="#000000">&nbsp;<?php echo $row['scode']; ?></font></td>
									</tr>
									<tr>
										<td width="132"><font color="#000000">PO No. 
										</font> </td>
										<td width="14" align="center">
									 
							<font color="#000000">:</font></td>
										<td><font color="#000000">&nbsp;<?php echo $row0['pono']; ?></font></td>
									</tr>
									<tr>
										<td width="132"><font color="#000000">Date 
										</font> </td>
										<td width="14" align="center">
									 
							<font color="#000000">:</font></td>
										<td><font color="#000000">&nbsp;<?php echo $row0['podate']; ?></font></td>
									</tr>
									<tr>
										<td width="132"><font color="#000000">Deli.Period 
										</font> </td>
										<td width="14" align="center">
									 
							<font color="#000000">:</font></td>
										<td><font color="#000000">&nbsp;<?php echo $row0['deliper']; ?></font></td>
									</tr>
									<tr>
										<td width="132"><font color="#000000">Disp. Through
										</font> </td>
										<td width="14" align="center">
									 
							<font color="#000000">:</font></td>
										<td><font color="#000000">&nbsp;<?php echo $row0['dispthro']; ?></font></td>
									</tr>
									<tr>
										<td width="132"><font color="#000000">Freight 
										</font> </td>
										<td width="14" align="center">
									 
							<font color="#000000">:</font></td>
										<td><font color="#000000">&nbsp;<?php echo $row0['freight']; ?></font></td>
									</tr>
									<tr>
										<td width="132"><font color="#000000">Payment Terms 
										</font> </td>
										<td width="14" align="center">
									 
							<font color="#000000">:</font></td>
										<td><font color="#000000">&nbsp;<?php echo $row0['payterm']; ?></font></td>
									</tr>
								</table>
								</div>
								</td>
							</tr>
							</table>
							<hr>
							<div align="left">
							<table border="1" width="95%" style="border-collapse: collapse">
								<tr>
									<td bgcolor="#F7F7F7" height="28" align="left">
									<font color="#000000">&nbsp;SNO</font></td>
									<td bgcolor="#F7F7F7" height="28"><font color="#000000">&nbsp;&nbsp;Product 
									Name / Code/ Discription</font></td>
									<td bgcolor="#F7F7F7" align="center" height="28">
									<font color="#000000">HSN/SAC</font></td>
									<td bgcolor="#F7F7F7" align="center" height="28">
									<font color="#000000">GST %</font></td>
									<td bgcolor="#F7F7F7" align="center" height="28"><font color="#000000">&nbsp;QTY</font></td>
									<td bgcolor="#F7F7F7" height="28" align="center">
									<font color="#000000">&nbsp;
									Rate (Rs.)</font></td>
									<td bgcolor="#F7F7F7" height="28" align="center">
									<font color="#000000">&nbsp;UOM</font></td>
									<td bgcolor="#F7F7F7" height="28" align="center">
									<font color="#000000">Dis.%</font></td>
									<td bgcolor="#F7F7F7" height="28" align="center">
									<font color="#000000">&nbsp;Total</font></td>
								</tr>
							<?php	
								
						$i=1;
						$toti=0;
						$totj=0;
					 $x=1;					
						
						if (isset($_GET["id"]))
						{
						
						
						 
						$st="Select * from pur_request_detail,product,punit where unitid=uid and pur_request_detail.pid=product.pid and purid=".$_GET["id"]." order by purdid";
						//echo $st;
						
						$result1=mysql_query($st,$con);
						while ($row1=mysql_fetch_array($result1))
						 { 
						
						
						
						 ?>	 <tr><td align="center"><font color="#000000">&nbsp;<?php echo $i; ?>
									</font>
									</td>
									<td align="left"> <font color="#000000">&nbsp;<?php  echo $row1['pname']; ?> &nbsp;( <?php  echo $row1['ptitle']; ?> ) <br>&nbsp;[<?php  echo $row1['pdetail']; ?>]
									</font>
									</td>
									<td align="center"><font color="#000000"><?php  echo $row1['hsn']; ?>
									</font>
									</td>
									<td align="center"><font color="#000000"><?php  echo $row1['pgst']; ?>
									</font>
									</td>
									<td align="center"><font color="#000000"><?php  echo $row1['pqty']; ?>
									</font>
									</td>									
									<td align="center"><font color="#000000"><?php  echo $row1['prate']; ?>
									</font>
									</td>
									<td align="center"><font color="#000000"><?php  echo $row1['uom']; ?>
									</font>
									</td>
									<td align="center"><font color="#000000"><?php  echo $row1['pdis']; ?>
									</font>
									</td>									
									<td align="center"><font color="#000000"><?php  echo $row1['ptot']; ?>
									</font>
									</td>							
						</tr><?php
						
					$totj=$totj+$row1['ptot']-$row1['pgstamt'];

						$toti=$toti+$row1['ptot'];
						 $x= $x+1;
						 
						$i=$i+1;
						
						}
					
					}
					?>
					
					
					<?php
					
					while ($i<=12)
					{
					?>
					 <tr>
									<td align="left">
									&nbsp;</td>
									<td align="center">
									&nbsp;</td>
									<td align="center">
									&nbsp;</td>
									<td align="center">
									&nbsp;</td>
									<td align="center">
									&nbsp;</td>									
									<td>&nbsp;</td>
									<td align="center">
									&nbsp;</td>
									<td align="center">
									&nbsp;</td>
									<td>&nbsp;</td>
						</tr>
						<?php
						$i=$i+1;						
						}
						?>
						</table>
						</div>
						<br>
                           <table border="0" width="96%" style="border-collapse: collapse">
							<tr>
								<td width="60%" height="22">&nbsp;</td>
								<td width="133" height="22"><b>
								<font color="#000000" face="Arial">Total Amount </font>
								</b></td>
								<td width="9" height="22">
                                 <font color="#000000" face="Arial"><b>:</b></font></td>
								<td height="22">
								<font face="Arial" color="#000000"><b>Rs.<?php echo $totj; ?>/-
                                 </b></font>
                                 </td>
							</tr>
							<tr>
								<td width="60%" height="22">&nbsp;</td>
								<td width="133" height="22"><b>
								<font color="#000000" face="Arial">C/S GST</font></b></td>
								<td width="9" height="22">
                                 <font color="#000000" face="Arial"><b>:</b></font></td>
								<td height="22">
                                <font face="Arial" color="#000000">Rs.<?php echo $row0['cgstamt']+$row0['sgstamt']; ?>/-</font>
						</td>
							</tr>
							<tr>
								<td width="60%" height="22">&nbsp;</td>
								<td width="133" height="22"><b>
								<font color="#000000" face="Arial">IGST</font></b></td>
								<td width="9" height="22">
                                 <font color="#000000" face="Arial"><b>:</b></font></td>
								<td height="22">
                                 <font face="Arial" color="#000000">Rs.<?php echo $row0['igstamt']; ?>/-</font>
										</td>
							</tr>
							<tr>
								<td width="60%" height="22">&nbsp;</td>
								<td width="133" height="22"><b>
								<font color="#000000" face="Arial">Net Amount 
								</font> </b> </td>
								<td width="9" height="22">
                                 <font color="#000000" face="Arial"><b>:</b></font></td>
								<td height="22">
								<font face="Arial" color="#000000"><b>Rs.<?php echo $row0['netamt']; ?>/-
                                 </b></font>
                                 </td>
							</tr>
							</table>
							<hr>     
                           <div class="control-group">
                              <div class="controls">
                                 </div>
								<table border="0" width="96%" height="121">
									<tr>
										<td colspan="3"><font color="#000000">
										<b>Note :</b> 
								Please Mention P.O No, Item Code &amp; HSN/SAC Code 
								in Inovice &amp; Challan without these detail 
								Material will not accepted.</font></td>
									</tr>
									<tr>
										<td width="46%"><font color="#000000">Company' 
								GSTIN NO. : 08ABJPA7453R1Z2<br>Company' PAN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
								: ABJPA7453R</font></td>
										<td width="45%" align="right" valign="top">
										<b>
										<font color="#000000">For Concept 
								Technostcrutures</font></b></td>
										<td width="8%" align="right" valign="top">
										&nbsp;</td>
									</tr>
									<tr>
										<td width="46%" height="27">&nbsp;</td>
										<td width="45%" align="right" height="27">
										<font color="#000000">Authorised Sign.</font></td>
										<td width="8%" align="right" height="27">
										&nbsp;</td>
									</tr>
								</table></div>
                           </div>                        
                        <?php
                        }
                        }
 ?>
 
 </body>
</html>


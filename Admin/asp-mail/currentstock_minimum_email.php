<?php 
if(!isset($_SESSION))
	{
	session_start();
	}
include("setup.php");

$msg=0;


?>


<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<head>
   <meta charset="utf-8" />
   <title>Product Stock</title>
  


     
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body >
  
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
								<p align="center"><font size="4"><b>Product 
								Minimum Quantity Alert&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; 
								Date : <?php echo date("d-M-Y"); ?></b></font></td>
							</tr>
							</table>
  
                            <table  style="border-collapse: collapse" border="1" bordercolor="#C0C0C0" width="100%" cellspacing="1" cellpadding="3" >
                            <thead>
                                <tr>
                                    <th style="width:8px;" bgcolor="#E8E8E8" height="30">
									<font face="Arial" size="2">SNO</font></th>
                                    
                                    <th class="hidden-phone" bgcolor="#E8E8E8" height="30" align="left">
									<font face="Arial" size="2">&nbsp;Item Type</font></th>
                                    <th bgcolor="#E8E8E8" height="30" align="left" >
									<font face="Arial" size="2">&nbsp;Category</font></th>
                                    
                                    <th bgcolor="#E8E8E8" height="30" align="left">
									<font face="Arial" size="2">&nbsp;Product Name/model</font></th>
                                    <th bgcolor="#E8E8E8" height="30" align="left" >
									<font face="Arial" size="2">&nbsp;Item Code</font></th>
                                    
                                    <th bgcolor="#E8E8E8" height="30" >
									<font face="Arial" size="2">Minimum<br>
																		Qty</font></th>
                                    
                                    <th   bgcolor="#E8E8E8" height="30">
									<font face="Arial" size="2">Current<br>
									Qty                <th class="hidden-phone" bgcolor="#E8E8E8" height="30">
									<font face="Arial" size="2">Unit</font></th>
                                    
                                    <th bgcolor="#E8E8E8" height="30" >
									<font face="Arial" size="2">Reqested<br>
									Qty</font></th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                            
                            
				 <?php						
				
				$st="Select * from product,category,cate,punit where qty < minqty and unitid=uid and qty>0 and category.cateid=product.cateid and product.ecate=cate.catid  order by catname,cname,pname";

				//echo $st;
				$i=1;
				$tot=0;
				$result=mysql_query($st,$con);
				
					while ($row=mysql_fetch_array($result))
					{	
					
					?>
								

                                <tr class="odd gradeX">
                                    <td height="24"><font face="Arial" size="2"><?php echo $i; ?></font></td>
                                    <td class="hidden-phone" height="24">
									<font face="Arial" size="2"><?php echo $row["catname"]; ?></font></td>
                                    <td height="24" >
									<font face="Arial" size="2"><?php echo $row["cname"]; ?></font></td>
                                    
                                    <td height="24"><font face="Arial" size="2"><?php echo $row["pname"]; ?></font></td>
                                     <td height="24" >
										<font face="Arial" size="2"><?php echo $row["ptitle"]; ?></font></td>
                                    
                                    <td  align="center" height="24">
									<font face="Arial" size="2"><?php echo $row["minqty"]; ?></font></td>
                                   
                                    <td  align="center" height="24">
                                    
                                     <font face="Arial" size="2">
                                    
                                     <?php if ($row["qty"]<$row["minqty"]) 
                                     { ?>
                                    <span class="label label-important">
                                    <?php echo $row["qty"]; ?>
                                    </span>
                                    <?php
                                    }
                                    else
                                    {
                                     echo $row["qty"]; 
                                    
									}
									  ?>
								
                                    
                                    </font>
								
                                    
                                    </td>
                                   
                                    <td class="center hidden-phone" align="center" height="24">
									<font face="Arial" size="2"><?php echo $row["uname"]; ?></font></td>
                                   
                                    <td  align="center" height="24">
									<font face="Arial" size="2"><?php echo $row["reqqty"]; ?></font></td>
                                    
                                   
                                    
                                </tr>
                                
                   			  <?php
								$i=$i+1;

								
								
								}
								?>
           
                                
                                
                                
                                </tbody>
                        </table>
                        
                        &nbsp;<br>
                      <font face="Arial">
                      <font size="4"><b>Total Products below 
							Alert Level  : </b></font>
                        	<b>
                        	<font size="4">
                        	<?php echo $i-1; ?>
   
</body>
</html></font></b></font>
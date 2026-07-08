<?php
require_once __DIR__ . "/../config.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (empty($_SESSION['user'])) {
    header("Location: index.php?r=0");
    exit;
}
?>


<?php 
	$msg=0;

	
?>


<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta charset="UTF-8">
<title>Online Directory Service</title>
 <link rel="stylesheet" type="text/css" href="akc.css" />

<link href="css/templatemo_style1.css" rel="stylesheet" type="text/css" />
<link href="css/jquery.ennui.contentslider.css" rel="stylesheet" type="text/css" media="screen,projection" />

</head>

<body topmargin="0" leftmargin="0" rightmargin="0" bottommargin="2" background="images/bg.png">


<?php require_once "header.php"; ?>
<table border="0" width="100%"  cellpadding="0" style="border-collapse: collapse">
	<tr>
		<td valign="top">
		<div align="center"><?php if ($msg==1) echo "<br><h5>Your Message Successfully Send.</h5>"; ?>
		
			<table border="0" width="1010" id="table33" style="border-collapse: collapse" cellpadding="0" bordercolor="#E3E3E3" height="587">
			
					
						<?php						

	if (isset($_GET["id"]))
{
$st="Select * from member,memberdetail where member.mid=memberdetail.mid and member.mid =".$_GET["id"];

	//$st="Select * from category,catedetail where category.cateid=catedetail.cateid and cdname like '%".$_POST["item"]."%' and  order by cdname";

//echo $st;
$i=1;
$result=mysqli_query($con,$st);

if (!$result) {
    die(mysqli_error($con));
}

	if ($row=mysqli_fetch_assoc($result))
	{
	?>
	
	<tr>
					<td width="1010" valign="top" height="112" colspan="2">
	
	<table border="0" width="100%" id="table50" style="border-collapse: collapse" height="113">
		<tr>
			<td width="127" align="center"><?php
			if ($row['logo']<>"-")
			{
			?>
			<a href="http://<?php  echo htmlspecialchars($row['website']); ?>" target="_blank" class="a5">
			<img border="0" src="user/logo/<?php  echo htmlspecialchars($row['logo']); ?>" width="82" height="91"></a>
			<?php
			}
			?></td>
			<td>&nbsp;&nbsp;<font color="#0000CC" size="6"> <?php	echo htmlspecialchars($row["compname"]); ?></td>
			<td width="349">
									<table border="0" width="100%" id="table51" style="border-collapse: collapse">
									
<?php 
										if (($row['mplan']=="Gold") ||($row['mplan']=="Platinum"))
										{
										?>

	<tr>
											<td width="100" valign="bottom">
											<p style="margin-bottom: 15px"><b>
											<font size="2" color="#003366">&nbsp; </font>
											<font color="#02203E">Follow Us :</font></b></td>
											<td><font color="#003366"><?php if ($row['twiter']<>"-") { ?>			
											</font>			<a  target="_blank" href="http://<?php  echo htmlspecialchars($row['twiter']); ?>">
											<font color="#003366"><img border="0" src="<?php echo $path; ?>images/twitter-icon.png" width="32" height="32"></font></a><font color="#003366"> <?php } ?>
<?php if ($row['facebook']<>"-") { ?>				</font>				<a  target="_blank" href="http://<?php  echo htmlspecialchars($row['facebook']); ?>"> 
											<font color="#003366"> <img border="0" src="<?php echo $path; ?>images/facebook-icon.png" width="32" height="32"></font></a><font color="#003366"> <?php } ?>
<?php if ($row['linken']<>"-") { ?>				</font>				<a  target="_blank" href="http://<?php  echo htmlspecialchars($row['linken']); ?>">
											<font color="#003366"><img border="0" src="<?php echo $path; ?>images/linkedin-icon.png" width="32" height="32"></font></a><font color="#003366">  <?php } ?>
<?php if ($row['ytube']<>"-") { ?>				</font>				<a href="http://<?php  echo htmlspecialchars($row['ytube']); ?>"> 
											<font color="#003366"> <img border="0" src="<?php echo $path; ?>images/uTube.png" width="32" height="32"></font></a><font color="#003366">  <?php } ?>
								
<?php if ($row['gmap']<>"-") { ?>		</font>		<a href="<?php  echo htmlspecialchars($path.'clientmap.php?id='.$_GET['id']); ?>"> 
											<font color="#003366"> <img border="0" src="<?php echo $path; ?>images/gmap.png" width="49" height="62"></font></a><font color="#003366">	<?php } ?>
									&nbsp;
&nbsp;
</font>
</td>
										</tr>
										<?php
										}
										?>	
			</table>
			</td>
		</tr>
	</table>
					</td>
				</tr>
	
	<tr>
					<td width="1010" valign="top" height="8" colspan="2" bgcolor="#02203E">
	
	</td>
				</tr>
	
	<tr>
					<td width="341" valign="top" height="397">
	
	&nbsp;<div align="center">
	
	<table border="0" width="98%" id="table46" style="border-collapse: collapse">
		<tr>
			<td align="center" height="20" valign="top">
			<p>&nbsp;</td>
		</tr>
		<tr>
			<td align="center" height="37" valign="top">
									
	
				
									
									<div align="left">
									
	
				
									
									<table class="table1" border="0" width="99%" id="table48" style="border-collapse: collapse" bordercolor="#E3E3E3" cellpadding="0">
										<tr>
											<td width="47%" height="8">
											</td>
										</tr>
										<tr>
											<td width="47%" height="30">
											<p style="line-height: 25px"><b>
											<font size="3" color="#0000CC">&nbsp;Contact : <?php echo htmlspecialchars($row["mname"]); ?></font></b><font size="3" color="#0000CC">
											</font>
											</td>
										</tr>
										<tr>
											<td width="47%" height="30"><b>
											<table border="0" width="100%" id="table52" style="border-collapse: collapse">
												<tr>
													<td width="77" valign="top"><b><font color="#02203E" size="2">&nbsp;Address&nbsp;&nbsp;&nbsp;&nbsp;:</font></b></td>
													<td valign="top"><font color="#02203E" size="2"> <?php echo htmlspecialchars(ucwords($row["shopno"])); ?>
											<?php echo htmlspecialchars(ucwords($row["address"])); ?>
											<?php echo htmlspecialchars(ucwords($row["area"])); ?>
											<?php echo htmlspecialchars($row["city"]); ?>
											<?php echo htmlspecialchars($row["state1"]); ?>




											&nbsp; 




											</font></td>
												</tr>
											</table>




</td>
										</tr>
										<tr>
											<td width="47%" height="30">
											<font color="#02203E"><b>
											&nbsp;Contact No. :</b></font><font size="2" color="#02203E"> <?php echo htmlspecialchars($row["phone"]); ?>,
											<?php echo htmlspecialchars($row["mobile"]); ?>
											</font>



</td>
										</tr>
										<tr>
											<td width="47%" height="30">
											<font color="#02203E">
											<b>
											&nbsp;Email&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</b><font size="2"> <?php echo htmlspecialchars($row["email"]); ?> 
											


											</font>



											</font>



</td>
										</tr>
										<tr>
											<td width="47%" height="30">
											<font color="#02203E"><b>
											&nbsp;Website&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</b></font><font color="#02203E" size="2">



											</font>



											<font color="#003366" size="2">  
								
			<a href="http://<?php  echo htmlspecialchars($row['web']); ?>" target="_blank" class="a5">
											<font color="#02203E">
			<?php echo htmlspecialchars($row["web"]); ?>
			</font>
			</a>



											</font>



											</td>
										</tr>
																				
										
										</table>
									</div>

									</td>
		</tr>
		</table>
		</div>
</td>
					<td width="669" align="center" valign="top" height="397"  >
					
					
							&nbsp;<table border="1" width="650" id="table49" bgcolor="#F7F7F7" style="border-collapse: collapse" height="430" bordercolor="#F4F4F4" cellspacing="1">
						<tr>
							<td align="center">
								<div id="templatemo_slider_wrapper">
	<div id="templatemo_slider">
    
        <div id="one" class="contentslider">
        <div class="cs_wrapper">
            <div class="cs_slider" style="position: absolute; left: 0px; top: 0px">
            
          

  		<?php						
	
		$st="Select * from memberimage where mid=".$row["mid"];
		$result2=mysqli_query($con,$st);
if (!$result2) {
    die(mysqli_error($con));
}
		while ($row2=mysqli_fetch_assoc($result2))
		{
		?>
   				
			<div class="cs_article">
                	
                    <div class="article">                
                                              
                        <div class="right">
                            <a href="#" target="_parent">
                                
                                <img src="user/logo/<?php  echo htmlspecialchars($row2['img']); ?>" alt="Slider 01"  />

                            </a>
                        </div>
                        
                    </div>
                    
                </div><!-- End cs_article -->
                
            <?php
            }
            ?>
     
			 
                
               
                
          
            </div><!-- End cs_slider -->
        </div><!-- End cs_wrapper -->
        </div><!-- End contentslider -->
        
        <!-- Site JavaScript -->
        <script type="text/javascript" src="js/jquery-1.3.1.min.js"></script>
        <script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
        <script type="text/javascript" src="js/jquery.ennui.contentslider.js"></script>
        <script type="text/javascript">
        $(function() {
        $('#one').ContentSlider({
        width : '650px',
        height : '370px',
        speed : 500,
        easing : 'easeOutQuart'
        });
        });
        </script>
       
	
    </div> <!-- end of slider -->
</div>
        
            
							</td>
						</tr>
					</table>
					<br></td>
				</tr>
	
	<tr>
					<td width="1007" valign="top" colspan="2" bgcolor="#E3E3E3" height="7">
					</td>
				</tr>
	
	<tr>
					<td width="1007" valign="top" colspan="2" bgcolor="#FFFFFF">
					<?php 
										if ($row["remark"]<>"-")
										{
										?>

										
											<p style="line-height: 22px; margin-left: 10px; margin-right: 10px; margin-top: 10px">
											<font color="#02203E" size="2" face="Arial"><b>About Us :</b>&nbsp;&nbsp; <?php echo htmlspecialchars($row["remark"]) ; ?>
											&nbsp;
											<?php
										}
										?>
	
	&nbsp;</font></td>
				</tr>
	
	<tr>
					<td width="1007" valign="top" colspan="2" bgcolor="#FFFFFF" height="20">
					&nbsp;</td>
				</tr>
	
<?php
				
				}
	
	}
	
?>
			</table>
			</div>
		</td>
	</tr>
</table>
	

<div align="center">
	<?php require_once "footer.php"; ?>
&nbsp; 
</div>

</body>

</html>
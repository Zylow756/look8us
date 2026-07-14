<?php
declare(strict_types=1);

require_once __DIR__ . "/config.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . "/thecaptcha/captcha.function.php";

$captcha_text = "Please tell me you're not a spambot";
$msg = 0;

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit"])) {
    $hasError = false;

    if (!captcha_verify_word()) {
        $hasError = true;
        $captcha_text = "<span><b><h5>Wrong image code</h5></b></span>";
    }

    if (!$hasError) {
        if (
            isset($_FILES["photoimg"]) &&
            $_FILES["photoimg"]["error"] === UPLOAD_ERR_OK
        ) {
            $allowedMimeTypes = [
                "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
                "application/msword",
                "image/jpeg",
                "application/pdf",
            ];

            $maxFileSize = 41100000;
            $fileTmpPath = $_FILES["photoimg"]["tmp_name"];
            $fileSize = (int) $_FILES["photoimg"]["size"];

            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $mimeType = $finfo->file($fileTmpPath);

            if (in_array($mimeType, $allowedMimeTypes, true) && $fileSize < $maxFileSize) {
                $originalName = $_FILES["photoimg"]["name"];
                $pathInfo = pathinfo($originalName);

                $baseName = $pathInfo["filename"] ?? "cv";
                $extension = strtolower($pathInfo["extension"] ?? "");

                $safeBaseName = preg_replace("/[^a-zA-Z0-9_-]/", "_", $baseName);
                $safeBaseName = substr($safeBaseName, 0, 5);

                $fp = date("d_M_Y_h_i_s") . "_" . $safeBaseName . "." . $extension;

                $uploadDir = __DIR__ . "/user/logo/";
                $uploadPath = $uploadDir . $fp;

                if (move_uploaded_file($fileTmpPath, $uploadPath)) {
                    $stmt = mysqli_prepare(
                        $con,
                        "INSERT INTO cv 
                        VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
                    );

                    if ($stmt) {
                        $rname = $_POST["rname"] ?? "";
                        $mobile = $_POST["mobile"] ?? "";
                        $email = $_POST["email"] ?? "";
                        $post = $_POST["post"] ?? "";
                        $city = $_POST["city"] ?? "";
                        $qual = $_POST["qual"] ?? "";
                        $expr = $_POST["expr"] ?? "";
                        $createdDate = date("d-m-Y");

                        mysqli_stmt_bind_param(
                            $stmt,
                            "sssssssss",
                            $rname,
                            $mobile,
                            $email,
                            $post,
                            $city,
                            $qual,
                            $expr,
                            $fp,
                            $createdDate
                        );

                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_close($stmt);

                        $msg = 1;
                    } else {
                        $msg = 2;
                    }
                } else {
                    $msg = 2;
                }
            } else {
                $msg = 2;
            }
        } else {
            $msg = 2;
        }
    }
}
?>

<html>
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta charset="UTF-8">
<title>Look8US :Business Directory Kota, Rajasthan , India, Online Business Directory Kota,  Yellow Pages  kota Rajasthan , Trusted & Verified Businesses, Exporters, Manufacturers, Suppliers Directory, B2B Business Directory </title>
<meta name="description" content="Look8us.com from Kota Rajasthan is Your local Business Directory , yellow pages  Business Directory. Business Details, Contacts, Products, Services & Verified Businesses, Exporters, Manufacturers, Suppliers Directory">
<meta name="keywords" content=" Look8us.com , yellow pages Kota Rajasthan , business directory Kota Rajasthan india,business search engine, indian business directory, online business directory, Indian manufacturers, suppliers, Indian exporters directory, b2b portal, b2b business directory,manufacturer, importers, traders, dealers, buyers, ">
 <link rel="stylesheet" type="text/css" href="akc.css" />
</head>
<body topmargin="0" leftmargin="0" rightmargin="0" bottommargin="2" background="images/bg.png">
<div align="center">
<?php require_once "header.php"; ?>
<table border="0" width="100%" height="100" cellpadding="0" style="border-collapse: collapse">
	<tr>
		<td bgcolor="#D2D2D2">
		<div align="center">
			<table border="0" width="1010" id="table33" style="border-collapse: collapse" height="40" cellpadding="0">
				<tr>
					<td><font size="6">&nbsp;</font><font color="#333333" size="5">Career 
					@ Look8us</font></td>
				</tr>
			</table>
		</div>
		</td>
	</tr>
</table>
	<table border="0" width="1020" id="table1" style="border-collapse: collapse" bordercolor="#F2F2F2" bgcolor="#FFFFFF" cellpadding="0">
		<tr>
			<td valign="top">
			<div align="center">
			<table border="0" width="100%" id="table2" cellpadding="0" style="border-collapse: collapse" bordercolor="#FFFFCC">
				
				<tr>
					<td valign="top">
					<table border="0" width="100%" id="table8" cellpadding="0" style="border-collapse: collapse">
						<tr>
							<td  valign="top" bgcolor="#FFFFFF">
							<table border="0" width="100%" id="table10" cellpadding="0" style="border-collapse: collapse" height="326" >
								<tr>
									<td align="center" valign="top"> <br>
									<p style="margin-left: 10px; margin-top: 5px; margin-bottom: 5px">
											<b>
											<?php
											if ($msg==1)
											{ 								
											//echo "<h5>Your CV Submitted Successfully.</h5>"; 
											echo "<br><img border='0' src='images/cvupload.jpg' alt='Your CV Submitted Successfully'><br><br>";
											}
											?>
											<?php if ($msg==2) echo "<h5>Error : Please Check File Format(DOC/PDF/JPG) or Size</h5>"; ?>
											</b>
											</p><div align="center">
									<table border="0" width="100%" id="table34" style="border-collapse: collapse" cellpadding="0">
										<tr>
											<td height="40" bgcolor="#E2E2E2" colspan="2">
		<font size="2" color="#000000">&nbsp;Upload your information and CV. </font>
											</td>
										</tr>
										<tr>
											<td width="61%" align="center">	
										
										<table border="0" width="90%" id="table37" cellspacing="1" style="border-collapse: collapse">
										<tr>
											<td>
		<form name="frmhlp" METHOD="post" action="career.php" enctype="multipart/form-data"   >
			<table border="0" width="98%" id="table38" style="BORDER-COLLAPSE: collapse" bordercolor="#f2f2f2" bgcolor="#ffffff">
	<tr>
		<td width="94%" align="left" height="28" colspan="2">
		&nbsp;</td>
	</tr>
	<tr>
		<td width="174" align="left" height="34">
		<font face="Arial" size="2" color="#000000">&nbsp; Your Name</font></td>
		<td align="left" width="66%" height="34">
		<input name="rname" size="65" maxlength="35" onBlur="emailCheck(email.value)" class="txtbox1"   ></td>
	</tr>
	<tr>
		<td width="174" align="left" height="40">
		<font face="Arial" size="2" color="#000000">&nbsp; Mobile/Phone</font></td>
		<td align="left" width="66%" height="40">
		<input name="mobile" size="65" maxlength="35" onBlur="emailCheck(email.value)" class="txtbox1"    ></td>
	</tr>
	<tr>
		<td align="left" height="40">
		<font face="Arial" size="2" color="#000000">&nbsp; Email Id</font></td>
		<td align="left" width="66%" height="40">
		<input name="email" size="65" maxlength="35" onBlur="emailCheck(email.value)" 
		class="txtbox1" ></td>
	</tr>
	<tr>
		<td align="left" height="40">
		<font face="Arial" size="2" color="#000000">&nbsp; Position for Apply</font></td>
		<td align="left" width="66%" height="40"> 
		<select  class="selbox" name="post" id="pos" size="1"  >
<option value='Cordinator' >Cordinator</option>
<option value='Operation' >Operation</option>
<option value='Marketing' >Marketing</option>
<option value='Sales' >Sales & Support</option>
<option value='OTHER' >OTHER</option>
	</select></td>
	</tr>
	<tr>
		<td align="left" height="40">
		<font face="Arial" size="2" color="#000000">&nbsp; Your City</font></td>
		<td align="left" width="66%" height="40">
		<input name="city" size="65" maxlength="35" onBlur="emailCheck(email.value)" 
		class="txtbox1" ></td>
	</tr>
	<tr>
		<td width="174" align="left" height="40">
		<font face="Arial" size="2" color="#000000">&nbsp; Qualification</font></td>
		<td align="left" width="66%" height="40">
		<input name="qual" size="65" maxlength="35" onBlur="emailCheck(email.value)" class="txtbox1"    ></td>
	</tr>
	<tr>
		<td align="left" height="40">
		<font face="Arial" size="2" color="#000000">&nbsp; Experience (Yr.)</font></td>
		<td align="left" width="66%" height="40">
		<input name="expr" size="65" maxlength="35" onBlur="emailCheck(email.value)" 
		class="txtbox1" ></td>
	</tr>
	<tr>
		<td align="left" height="20">
		<font face="Arial" size="2" color="#000000">&nbsp; Upload CV </font></td>
		<td align="left" width="66%" height="20">
<input type="file" name="photoimg" size="26">&nbsp;<br>
&nbsp;<b><font size="2" color="#FF0000">[Select only .DOC or .PDF or .JPG file]</font></b></td>
	</tr>
	<tr>
	<td width="174" height="58" ><font color="#333333">&nbsp;</font><font face="Arial" size="2" color="#000000">Enter Captcha Code</font><font color="#333333">
	</font> </td>
	<td width="66%" height="58" align="left">
	&nbsp;<img src="thecaptcha/captcha.image.php?nocache=<?php echo md5((string) time()); ?>" border="0"> </td>
	
</tr>
	<tr>
		<td align="left" height="46">
		&nbsp;</td>
		<td align="left" width="66%" height="46">
		&nbsp;<input name="magicword" class="txtbox1" type="text" tabindex="8"> &nbsp;<br><font color="#0033CC"><?php echo $captcha_text; ?></font></td>
	</tr>
	<tr>
		<td align="left" height="44">
		&nbsp;</td>
		<td align="left" width="66%" height="44">
		<input type="submit" value="Submit"  name="submit" class="subbox" ></td>
	</tr>
	<tr>
		<td align="middle" colspan="2" height="50">
		</B></FONT></td>
	</tr>
	</table>
	</form></td>
										</tr>
									</table>
											</td>
											<td width="39%" valign="top">&nbsp;<table border="0" width="96%" id="table39" height="406" bgcolor="#FFFFFF" style="border-collapse: collapse" bordercolor="#E3E3E3">
							<tr>
								<td align="left"><a href="images/Ads01.jpg">
								<img border="0" src="images/Ads01.jpg" width="314" height="487"></a></td>
							</tr>
						</table>
											</td>
										</tr>
									</table>
									<?php
											if ($msg==0)
											
											{ 
										?>	
										
										<?php
									}
											?>	
									</div>
									</td>
								</tr>
							</table>
							</td>
						</tr>
						</table>
					</td>
				</tr>
			</table>
			</div>
			</td>
		</tr>
	</table>
</div>
<div align="center">
	<?php require_once "footer.php"; ?>
</div>
</body>
</html>
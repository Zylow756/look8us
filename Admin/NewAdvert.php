<?php
require_once __DIR__ . "/../config.php";

if (session_status() === PHP_SESSION_NONE) {
	session_start();
}
if (empty($_SESSION['admin'])) {
    header("Location: index.php?r=0");
    exit;
}

?>
<html>

<head>
	<meta http-equiv="Content-Language" content="en-us">
	<meta charset="UTF-8">
	<title>Online Directory : Admin Panel</title>
	<link rel="stylesheet" type="text/css" href="../akc.css" />

	<style type="text/css">
		body {
			background-image: url('img/bg.png');
			background-repeat: repeat-x;
			background-color: #70828F;
		}
	</style>
	<script type="text/javascript">
		function vfhfn() {
			var fllnme1 = document.frmhlp.cname.value;
			var num = /^[0-9]+$/;
			var alpha = /^[a-z]+$/;

			if (fllnme1 == null || fllnme1 == "") {
				alert("Required Category Name");
				document.frmhlp.cname.focus();
				return false;
			}

			if (fllnme1 == "Category Name") {
				alert("Required Category Name");
				document.frmhlp.cname.focus();
				return false;
			}
			return true;
		}
	</script>
</head>

<?php
$msg = 0;
if (isset($_POST["submit"])) {$name = $_FILES['photoimg']['name'];
$txt = pathinfo($name, PATHINFO_FILENAME);
$ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));

	$allowed = ['jpg','jpeg','pdf','doc','docx'];
	if (((in_array($ext,$allowed)== "application/vnd.openxmlformats-officedocument.wordprocessingml.document") || ($_FILES["photoimg"]["type"] == "application/msword") || ($_FILES["photoimg"]["type"] == "image/jpeg") || ($_FILES["photoimg"]["type"] == "application/pdf")) && ($_FILES["photoimg"]["size"] < 41100000)) {

		

		//$fp=date('d')."_".date('M')."_".date('Y')."_".date('h')."_".date('i')."_".date('s')."_".$_FILES["photoimg"]["name"];
		$fp = date('d') . "_" .
      date('M') . "_" .
      date('Y') . "_" .
      time() . "_" .
      substr(str_replace(" ", "_", $txt),0,5) .
      "." . $ext;
		if (!is_dir("../user/logo")) {
    mkdir("../user/logo",0755,true);
}

		$st = $con->prepare(
"INSERT INTO advert
(cname,mobile,website,image,gstatus)
VALUES (?,?,?,?,?)");
		mysqli_query($con, $st);
		//echo $st;
		$msg = 1;
	} else {
		$msg = 2;
	}
} 	// end of if (submit)

?>

<body>
	<div align="center">
		<table border="0" width="980" id="table1" style="border-collapse: collapse" bordercolor="#E2E2E2" cellpadding="0">
			<tr>
				<td height="50" align="center" valign="top"> <?php require_once "../header.php"; ?> </td>
			</tr>
			<tr>
				<td height="12" align="center" valign="top" bgcolor="#697779">
				</td>
			</tr>
			<tr>
				<td>
					<table border="0" width="100%" id="table2" style="border-collapse: collapse" bordercolor="#CCCCCC" height="206" cellpadding="0">
						<tr>
							<td width="228" valign="top" bgcolor="#EEEEEE"> <?php if ($_SESSION["id"] != "") include("sidemenu.php"); ?></td>
							<td align="center" valign="top" bgcolor="#FFFFFF">
								<h1>Create New Ads Links</h1>
								<p>
								<h3><?php if ($msg == 1) echo "Category Create"; ?></h3>
								<?php if ($msg == 2) echo "<h5>Error : Please Check File Format(DOC/PDF/JPG) or Size</h5>"; ?>
								</p>
								<table border="0" width="90%" id="table13" cellpadding="0" style="border-collapse: collapse" bordercolor="#697779" height="128">
									<tr>
										<td valign="top" width="100%">
											<table class="table3" border="0" width="96%" id="table14" cellpadding="0" style="border-collapse: collapse" bordercolor="#697779">

												<form name="frmhlp" id="frmhlp" method="post" action="NewAdvert.php" enctype="multipart/form-data">


													<tr>
														<td width="173" height="42">Company/Form/Shop&nbsp; Name</td>
														<td width="430" height="42">
															<input class="txtbox" type="text" name="cname" id="cname" tabindex="4" size="1" required/>
														</td>
													</tr>
													<tr>
														<td width="173" height="31">Contact No</td>
														<td width="430" height="31">
															<input class="txtbox" type="text" name="mobile" id="remark0" tabindex="4" size="1"  required/>
														</td>
													</tr>
													<tr>
														<td width="173" height="37">Website Link</td>
														<td width="430" height="37">
															<input class="txtbox" type="text" name="website" id="remark" tabindex="4" size="1"  required/>
														</td>
													</tr>
													<tr>
														<td width="173" height="39">Image for Upload</td>
														<td width="430" height="39">
															<input type="file" name="photoimg" id="photoimg" size="38" required />
														</td>
													</tr>
													<tr>
														<td width="173" height="39">Status</td>
														<td width="430" height="39">
															<select class="selbox" name="gstatus" id="gstatus" size="1" tabindex="5">

																<option value="D">Disable</option>
																<option value="H">Home Page</option>
																<option value="A">Ads Page(on dummy home page)</option>

															</select>
														</td>
													</tr>
													<tr>
														<td width="173" height="38">&nbsp;</td>
														<td width="430" height="38">
															<input class="subbox" type="submit" value="Submit" name="submit" />

														</td>
													</tr>
												</form>
											</table>
											<table class="table3" border="0" width="96%" id="table16" cellpadding="0" style="border-collapse: collapse" bordercolor="#697779">
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
					</p>
					<p>&nbsp;
				</td>
			</tr>
		</table>
		</td>
		</tr>
		<tr>
			<td height="57" align="center" valign="top"> <?php require_once "../footer.php"; ?></td>
		</tr>
		</table>
	</div>

</body>

</html>
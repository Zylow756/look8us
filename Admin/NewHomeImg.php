<?php
require_once "config.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (empty($_SESSION['user'])) {
    header("Location: index.php?r=0");
    exit;
}

if ( isset($_SESSION['user']))
 {
   if($_SESSION['user']=="") {
 	header("location: index.php?r=0"); 
	exit;
   }
 }
else {
 		header("location: index.php?r=0"); 
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

body
{
background-image:url('img/bg.png');
background-repeat:repeat-x;
background-color: #70828F;;
} 
</style>



<script type="text/javascript">
function vfhfn()
{


var fllnme1=document.frmhlp.cname.value;


var num =/^[0-9]+$/;
var alpha =/^[a-z]+$/;


if(fllnme1==null||fllnme1=="")
{alert("Required Category Name");
document.frmhlp.cname.focus();
return false;
}

if(fllnme1=="Category Name")
{alert("Required Category Name");
document.frmhlp.cname.focus();
return false;
}


return true;

}

</script>
</head>

<?php 
$msg=0;

if(isset($_POST['submit']))
{
    if($_FILES['photoimg']['error'] == UPLOAD_ERR_OK)
    {
        $allowed = [
            'image/jpeg',
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
        ];

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $_FILES['photoimg']['tmp_name']);
        finfo_close($finfo);

        if(in_array($mime,$allowed) && $_FILES['photoimg']['size'] < 41100000)
        {
            $pathInfo = pathinfo($_FILES['photoimg']['name']);

            $txt = $pathInfo['filename'];
            $ext = strtolower($pathInfo['extension']);

            $fp = uniqid('img_',true).".".$ext;

            if(move_uploaded_file($_FILES['photoimg']['tmp_name'], "../user/logo/".$fp))
            {
                $stmt = mysqli_prepare(
                    $con,
                    "INSERT INTO homeimg VALUES(NULL, ?, ?, ?, ?)"
                );

                mysqli_stmt_bind_param(
                    $stmt,
                    "ssss",
                    $_POST['cname'],
                    $_POST['mobile'],
                    $_POST['website'],
                    $fp
                );

                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);

                $msg = 1;
            }
            else
            {
                $msg = 2;
            }
        }
        else
        {
            $msg = 2;
        }
    }
    else
    {
        $msg = 2;
    }
}

?>
	
<body >

<div align="center">
	<table border="0" width="980" id="table1" style="border-collapse: collapse" bordercolor="#E2E2E2" cellpadding="0">
		<tr>
			<td height="50" align="center" valign="top">	<?php  require_once "../header.php"; ?>		</td>		</tr>
		<tr>
			<td height="12" align="center" valign="top" bgcolor="#697779">			
					</td>
		</tr>
		<tr>
			<td>
			<table border="0" width="100%" id="table2" style="border-collapse: collapse" bordercolor="#CCCCCC" height="206" cellpadding="0">
				<tr>
					<td width="228" valign="top" bgcolor="#EEEEEE">			<?php if (!empty($_SESSION['id'])) include("sidemenu.php"); ?></td>
					<td align="center" valign="top" bgcolor="#FFFFFF">
					<h1>Home Pages Images/Ads </h1>
					<p><h3><?php if ($msg==1) echo "Category Create"; ?></h3>
					<?php if ($msg==2) echo "<h5>Error : Please Check File Format(DOC/PDF/JPG) or Size</h5>"; ?>
</p>
					<table border="0" width="90%" id="table13" cellpadding="0" style="border-collapse: collapse" bordercolor="#697779" height="128">
						<tr>
							<td valign="top" width="100%">
							<table class="table3" border="0" width="96%"  id="table14" cellpadding="0" style="border-collapse: collapse" bordercolor="#697779">
						
						<form
    name="frmhlp"
    id="frmhlp"
    method="post"
    action="NewHomeImg.php"
    enctype="multipart/form-data"
    onsubmit="return vfhfn();">

<tr>
	<td width="173" height="42">Company/Form/Shop&nbsp; Name</td>
	<td width="430" height="42">
	<input  class="txtbox" type="text" name="cname" id="cname" tabindex="4"  size="1"/></td>
</tr>
<tr>
	<td width="173" height="31">Contact No</td><td width="430" height="31">
	<input  class="txtbox" type="text" name="mobile" id="remark0" tabindex="4"  size="1"/></td>
</tr>
<tr>
	<td width="173" height="37">Website Link</td><td width="430" height="37">
	<input  class="txtbox" type="text" name="website" id="remark" tabindex="4"  size="1"/></td>
</tr>
<tr>
	<td width="173" height="39">Image for Upload</td>
	<td width="430" height="39">
<input type="file" name="photoimg"   id="photoimg" size="38"/></td>
</tr>
<tr><td width="173" height="38">&nbsp;</td><td width="430" height="38">
	<input  class="subbox" type="submit" value="Submit" name="submit"/>

	</td>
	</tr>
</form>
					</table>
							<table class="table3" border="0" width="96%"  id="table16" cellpadding="0" style="border-collapse: collapse" bordercolor="#697779">
						</td>
						</tr>
					</table>
							</td>
						</tr>
					</table></p>
					<p>&nbsp;</td>
				</tr>
			</table>
			</td>
		</tr>
		<tr>
			<td height="57" align="center" valign="top">			<?php  require_once "../footer.php"; ?></td>
		</tr>
	</table>
</div>

</body>

</html>
 <?php
require_once "config.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (empty($_SESSION['admin'])) {
    header("Location: index.php?r=0");
    exit;
}

								
								 $uid = mysqli_real_escape_string($con, $_GET['uid'] ?? '');

$st = "SELECT * FROM admin WHERE uname='$uid'";
								 $result=mysqli_query($con,$st);
if (!$result) {
    die(mysqli_error($con));
}
								 if ($row = mysqli_fetch_assoc($result))
								  {
								 	
								 	$acode= substr(md5(uniqid(mt_rand(), true)) , 0, 8);
								 	
								//	echo $acode;
										$st = "UPDATE admin
        SET acode='$acode'
        WHERE uname='$uid'";
										if (!mysqli_query($con, $st)) {
    die(mysqli_error($con));
}
										
									echo "Your Access Code for Login : ".$acode;
								
									}
								
								?>
								
							
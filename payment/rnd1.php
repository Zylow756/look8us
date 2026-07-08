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
<html>

<head>
<meta charset="UTF-8">
<title>New Page 2</title>
</head>

<body>
<?php 

include("Crypto.php") ;

$merchant_data="a";
$working_key="123";

//$encrypted_data=encrypt($merchant_data,$working_key); // Method for encrypting the data.

echo $encrypted_data;

echo phpinfo();

?>


</body>

</html>

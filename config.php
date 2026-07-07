<?php


//define('CLIENT_LONG_PASSWORD', 1);

//mysqli_connect('[your server]', '[your username]', '[your password]', false, CLIENT_LONG_PASSWORD);
//$con = mysqli_connect('69.175.21.58:3307', 'look8us', '*Akc123', false, CLIENT_LONG_PASSWORD)or die ("error AQ akc");


// $con = mysqli_connect("localhost:3306","look8us","*look8us123") or die ("error Q akc");
// mysqli_select_db("onlndir", $con) or die ("error in select : akc");


//$con = mysqli_connect("localhost","biagklvj_websoftguest","@Akc12345#") or die ("error Q akc");
//mysqli_select_db($con, "biagklvj_websofts_look8us") or die ("error in select : akc");

$host = "localhost";
$user = "root";
$password = "";
$database = "biagklvj_websoftguest";
$con = mysqli_connect($host, $user, $password, $database);
mysqli_select_db($con, $database) or die ("error in select : akc");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_set_charset($con, "utf8mb4");


$path="http://Look8us.com/" ;

$MERCHANT_KEY = "xjBaV4";  //Live
$SALT = "fEXll9bP"; 		//Live
$PAYU_BASE_URL = "https://secure.payu.in";   // Live


//69.175.21.58
//108.163.233.100
//108.178.25.50

//111.118.190.209
//mysql.adnshost.com

/*


$path="http://localhost/onlnDir/" ;

$con = mysqli_connect("localhost","root","") or die ("error akc");
mysqli_select_db($con, "onlndir") or die ("error in select : akc");
*/


$cMERCHANT_KEY = "C0Dr8m"; // Testing
$cPAYU_BASE_URL = "https://test.payu.in";	 // Testing
$cSALT = "3sf0jURk";  // Testing






?>

<?php


//define('CLIENT_LONG_PASSWORD', 1);

//mysql_connect('[your server]', '[your username]', '[your password]', false, CLIENT_LONG_PASSWORD);
//$con = mysql_connect('69.175.21.58:3307', 'look8us', '*Akc123', false, CLIENT_LONG_PASSWORD)or die ("error AQ akc");


// $con = mysql_connect("localhost:3306","look8us","*look8us123") or die ("error Q akc");
// mysql_select_db("onlndir", $con) or die ("error in select : akc");


$con = mysql_connect("localhost","biagklvj_websoftguest","@Akc12345#") or die ("error Q akc");
mysql_select_db("biagklvj_websofts_look8us", $con) or die ("error in select : akc");


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

$con = mysql_connect("localhost","root","") or die ("error akc");
mysql_select_db("onlndir", $con) or die ("error in select : akc");
*/


$cMERCHANT_KEY = "C0Dr8m"; // Testing
$cPAYU_BASE_URL = "https://test.payu.in";	 // Testing
$cSALT = "3sf0jURk";  // Testing






?>

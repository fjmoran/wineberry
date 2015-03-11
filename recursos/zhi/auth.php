<?php

if (!(isset($ini_array))){
	$ini_array = parse_ini_file("recursos/zhi/config.ini");
}
//if (version_compare(phpversion(), '5.4.0', '>=')) {
//if (session_status() == PHP_SESSION_NONE) {
//    session_start();
//}
//}else{
if (session_id() === ''){
session_start();
}
//}


if (!isset($_SESSION["auth"]) || $_SESSION["auth"]!=1)
{
$host  = $_SERVER['HTTP_HOST'];
$extra = 'login.php?error=2';
header("Location: http://$host/$ini_array[basedir]/$extra");
exit ();
}
?>

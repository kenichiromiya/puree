<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
if ($_POST['_method']) {
	$_SERVER["REQUEST_METHOD"] = strtoupper($_POST['_method']);
	unset($_POST['_method']);
}
/*
if ($_POST['put']){
	$_SERVER["REQUEST_METHOD"] = "PUT";
}
if ($_POST['delete']){
	$_SERVER["REQUEST_METHOD"] = "DELETE";
}
*/
/*
foreach ($_GET as $key => $value) {
	if(preg_match("/id$/",$key)) {
		$_POST[$key] = $value;
	}
}
*/
include_once("system/autoload.php");
include_once("system/define.php");
include_once("system/mypdo.php");
include_once("system/db.php");
//include_once("lang.php");
//include_once("helper.php");
include_once("system/functions.php");
include_once("system/gettext.php");
//include_once("router.php");
//$sanitizer = New Sanitizer();
//$param = $sanitizer->sanitize();
$dispatcher = New Dispatcher();
$dispatcher->dispatch();
?>

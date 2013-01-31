<?php
function __autoload($class_name) {
	$file_name = "";
	if (preg_match_all("/^([A-Z].+)Controller$/",$class_name,$m)) {
		$file_name = "app/controllers/".strtolower($m[1][0]).".php";
	} elseif (preg_match_all("/^([A-Z].+)Model$/",$class_name,$m)) {
		$file_name = "app/models/".strtolower($m[1][0]).".php";
	} elseif (preg_match_all("/^([A-Z].+)$/",$class_name,$m)) {
		$file_name = "system/".strtolower($m[1][0]).".php";
	}
	if ($file_name) {
		include $file_name;
	}
}
?>

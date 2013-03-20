<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
if ($_POST['_method']) {
    $_SERVER["REQUEST_METHOD"] = strtoupper($_POST['_method']);
    unset($_POST['_method']);
}
$cwd = getcwd();
set_include_path(get_include_path() . PATH_SEPARATOR . $cwd);
set_include_path(get_include_path() . PATH_SEPARATOR . $cwd."/app");
set_include_path(get_include_path() . PATH_SEPARATOR . $cwd."/lib");
set_include_path(get_include_path() . PATH_SEPARATOR . $cwd."/app/views");
//set_include_path(get_include_path() . PATH_SEPARATOR . "/var/www/html/puree/views/");
include_once("config.php");
include_once("Pure/Autoload.php");
//include_once("Pure/MyPDO.php");
//include_once("Pure/DB.php");
//include_once("lang.php");
//include_once("helper.php");
include_once("Pure/functions.php");
include_once("Pure/gettext.php");
//include_once("router.php");
//$sanitizer = New Sanitizer();
//$param = $sanitizer->sanitize();
$dispatcher = new Pure\Dispatcher();
$dispatcher->dispatch();
?>

<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
if ($_POST['_method']) {
    $_SERVER["REQUEST_METHOD"] = strtoupper($_POST['_method']);
    unset($_POST['_method']);
}
define("PURE_DIR","/var/www/html/puree/");
include_once(PURE_DIR."config.php");
include_once(PURE_DIR."Pure/Autoload.php");
include_once(PURE_DIR."Pure/MyPDO.php");
include_once(PURE_DIR."Pure/DB.php");
//include_once("lang.php");
//include_once("helper.php");
include_once(PURE_DIR."Pure/functions.php");
include_once(PURE_DIR."Pure/gettext.php");
//include_once("router.php");
//$sanitizer = New Sanitizer();
//$param = $sanitizer->sanitize();
$dispatcher = new Pure\Dispatcher();
$dispatcher->dispatch();
?>

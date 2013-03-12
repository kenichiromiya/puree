<?php
spl_autoload_register('pure_autoloader');

function pure_autoloader($class_name) {
    $file_name = "";
    if (preg_match_all("/^([A-Z].+)Controller$/",$class_name,$m)) {
        $file_name = PURE_DIR."app/controllers/".strtolower($m[1][0]).".php";
    } elseif (preg_match_all("/^([A-Z].+)Model$/",$class_name,$m)) {
        $file_name = PURE_DIR."app/models/".strtolower($m[1][0]).".php";
    } elseif (preg_match_all("/^([A-Z].+)$/",$class_name,$m)) {
        $file_name = PURE_DIR."system/".strtolower($m[1][0]).".php";
    }
    if (is_file($file_name)) {
        include $file_name;
    }
}
?>

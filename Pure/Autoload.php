<?php
spl_autoload_register('pure_autoloader');

function puree_autoloader($class_name) {
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

function pure_autoloader($className)
{
    error_log($className);
    $className = ltrim($className, '\\');
    $fileName  = '';
    $namespace = '';
    if ($lastNsPos = strripos($className, '\\')) {
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
    }
    $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

    require PURE_DIR.$fileName;
}
?>

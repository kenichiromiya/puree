<?php
spl_autoload_register('pure_autoloader');


function pure_autoloader($className)
{
    //error_log($className);
    $className = ltrim($className, '\\');
    $fileName  = '';
    $namespace = '';
    if ($lastNsPos = strripos($className, '\\')) {
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
    }
    $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

    //require PURE_DIR.$fileName;
    //if(is_file($fileName)){
    include $fileName;
    //}
}
?>

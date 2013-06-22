<?php
/*
 * Pure : PHP Utilized Restful Engine
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Kenichiro Miya
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
spl_autoload_register('pure_autoloader');

function pure_autoloader($className)
{
    if (preg_match('/_/',$className)){
        return;
    }
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

    require $fileName;
}
?>

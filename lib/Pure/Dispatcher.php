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
namespace Pure;

class Dispatcher {
    public function __construct() {
        $this->request = Request::getInstance();
        $this->req = $this->request->req;
    }

    public function dispatch() {

        $module = '';
        if ($this->request->get('module')) {
            $module = "\\".ucwords($this->request->get('module'));
        }
        $controller = '';
        if ($this->request->get('controller')) {
            $controller = "\\".ucwords($this->request->get('controller'));
        }
        $controllername = $module."\\Controller".$controller;
        $controller = new $controllername();

        switch ($_SERVER["REQUEST_METHOD"]) {
        case "POST":
            $controller->post();
            break;
        case "PUT":
            $controller->put();
            break;
        case "DELETE":
            $controller->delete();
            break;
        case "GET":
            $controller->get();
            break;
        case "MOVE":
            $controller->move();
            break;
        }
    }
}
?>

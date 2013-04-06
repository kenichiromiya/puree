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
        //$singleton = Request::singleton();
        //$this->request = Request::singleton();
        $this->request = Request::getInstance();
        $this->req = $this->request->req;
    }

    public function dispatch() {

        $vendor = '';
        if ($this->request->get('vendor')) {
            $vendor = "\\".ucwords($this->request->get('vendor'));
        }
        $controller = '';
        if ($this->request->get('controller')) {
            $controller = "\\".ucwords($this->request->get('controller'));
        }
        //$modelname = $vendor.$controller."\\Model";
        $controllername = "\\Puree\\Controller".$controller;
/*
        if (preg_match("/pages/",$this->request->get('controller'))) {
        $controllername = "\\Puree\\Controller".$controller;
        } else {
        $controllername = $vendor.$controller."\\Controller";
        }
*/
        //$controller = new $controllername(new $modelname());
        $controller = new $controllername();
        //$controller->request = $this->request;
        //$controller->req = $this->request->req;
        //$controller->set('model',$model);

/*
        $vendor = '';
        if ($this->request->get('vendor')) {
            $vendor = "\\".ucwords($this->request->get('vendor'));
        }
        $controller = '';
        if ($this->request->get('controller')) {
            $controller = "\\".ucwords($this->request->get('controller'));
        }
*/

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

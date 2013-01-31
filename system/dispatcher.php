<?php

class Dispatcher {
	public function __construct() {
		$singleton = Request::singleton();
		$this->req = $singleton->req;
	}

	public function dispatch() {
		$classname = ucwords($this->req['controller'])."Controller";
		$controller =& new $classname();

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
                        case "GET";
                                $controller->get();
                                break;
                        case "MOVE";
                                $controller->move();
                                break;
                }
	}
}
?>

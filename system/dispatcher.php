<?php

class Dispatcher {
	public function __construct() {
		$singleton = Request::singleton();
		$this->req = $singleton->req;
	}

	public function dispatch() {
                if ($this->req['controller']) {
                        $classname = ucwords($this->req['controller'])."Controller";
                } else {
                        $classname = ucwords(DEFAULT_CONTROLLER)."Controller";
                }
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

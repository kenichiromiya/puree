<?php
namespace Pure;

class Dispatcher {
    public function __construct() {
        //$singleton = Request::singleton();
        $this->request = Request::singleton();
        $this->req = $this->request->req;
    }

    public function dispatch() {
        if ($this->request->get('vendor')) {
            $classname = "\\".ucwords($this->request->get('vendor'));
        } else {
            $classname = "";
        }
        if ($this->request->get('controller')) {
            $classname .= "\\".ucwords($this->request->get('controller'));
        } else {
            $classname .= "\\".ucwords(DEFAULT_CLASS);
        }
        $classname .= "\\Controller";
        $controller = new $classname();

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

<?php
namespace Pure;

class Dispatcher {
    public function __construct() {
        $singleton = Request::singleton();
        $this->req = $singleton->req;
    }

    public function dispatch() {
        if (isset($this->req['controller'])) {
            $classname = "Puree\\".ucwords($this->req['controller']."\\Controller");
        } else {
            $classname = "Puree\\".ucwords(DEFAULT_CLASS)."\\Controller";
        }
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

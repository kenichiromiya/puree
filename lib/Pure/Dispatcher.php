<?php
namespace Pure;

class Dispatcher {
    public function __construct() {
        //$singleton = Request::singleton();
        $this->request = Request::singleton();
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
        $classname = $vendor.$controller."\\Controller";
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

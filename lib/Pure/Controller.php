<?php
namespace Pure;

class Controller
{

    public function __construct() {
        //$singleton = Request::singleton();
        //$container = new DIContainer(new MyComponentFactory);
        //$this->request = $container->get('request');
        //$this->request = Request::singleton();
        $this->request = Request::getInstance();
        $this->req = $this->request->req;

        //if ($model) {
        //    $this->model = $model;
        //} else {
        $vendor = '';
        if ($this->request->get('vendor')) {
            $vendor = "\\".ucwords($this->request->get('vendor'));
        }
        $controller = '';
        if ($this->request->get('controller')) {
            $controller = "\\".ucwords($this->request->get('controller'));
        }
        $classname = $vendor.$controller."\\Model";
        $this->model = new $classname();
        //}

        $this->validator = new Validator();
        $this->var['req'] = $this->req;
        $this->var['base'] = BASE;
        if (preg_match("/\//",$this->req['id'])){
            $this->parent_id = dirname($this->req['id']);
        } else {
            $this->parent_id = "";
        }
        if($this->request->get('id')){
            $name = 'detail';
        } else {
            $name = 'index';
        }
        if ($this->request->get('view')) {
            $name = $this->request->get('view');
        }
        $extention = '';
        if ($this->request->get('extention')) {
            $extention = '.'.$this->request->get('extention');
        }
        $controller = '';
        if ($this->request->get('controller')) {
            $controller = $this->request->get('controller')."/";
        }
        $vendor = '';
        if ($this->request->get('vendor')) {
            $vendor = $this->request->get('vendor')."/";
        }
        $this->template = $vendor.$controller.$name.$extention.'.php';
    }

    public function get() {
        $var = $this->model->get($this->req);
        $this->view = new \Pure\View($this->template);
        $contents = $this->view->getcontents($this->var);
        echo $contents;
    }

    public function put() {
        $this->model->put($this->req);
        header("Location:".BASE.$this->req['controller'].(isset($this->req['controller']) ? "/": "").$this->req['id']);
        //header("Location:".$this->top.$this->req['controller']."/");
    }
    public function post() {
        $this->model->post($this->req);
        header("Location:".BASE.$this->req['controller'].(isset($this->req['controller']) ? "/": "").dirname($this->req['id']));
        //header("Location:".BASE.$this->controller.dirname($this->req['id']));
    }
    public function delete() {
        $this->model->delete($this->req);
        if($this->req['redirect']){
            header("Location:".$this->req['redirect']);
        } else {
        header("Location:".BASE.$this->req['controller'].(isset($this->req['controller']) ? "/": "").dirname($this->req['id']));
        }
    }
}
?>

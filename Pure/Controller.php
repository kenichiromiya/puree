<?php
namespace Pure;

class Controller
{

    public function __construct() {
        //$singleton = Request::singleton();
        $this->request = Request::singleton();
        $this->req = $this->request->req;
        if ($this->request->get('controller')){
            $this->controller = $this->req['controller']."/";
        } else {
            $this->controller = "";
        }
        if ($this->request->get('controller')) {
            $modelname = "\\Puree\\".ucwords($this->request->get('controller'))."\\Model";
        } else {
            $modelname = "\\Puree\\".ucwords(DEFAULT_CLASS)."\\Model";
        }
        $this->model = new $modelname();
        /*
        $this->sessionsmodel = new SessionsModel();
        $var = $this->sessionsmodel->get($this->req);
        $this->session = $var['session'];
                $this->var['session'] = $var['session'];
         */
        $this->validator = new Validator();
        $this->var['req'] = $this->req;
        $this->var['base'] = BASE;
        if (preg_match("/\//",$this->req['id'])){
            $this->parent_id = dirname($this->req['id']);
        } else {
            $this->parent_id = "";
        }
        if (isset($this->req['view'])) {
            $view = ".".$this->req['view'];
        } elseif ($var['view']) {
            $view = ".".$var['view'];
        } else  {
            $view = "";
        }
        if(isset($this->req['view'])){
            $this->template .= $this->req['view'];
        } elseif($this->req['id']){
            $this->template = 'detail';
        } else {
            $this->template = 'index';
        }
        if(isset($this->req['extension'])){
            $this->template .= '.'.$this->req['extension'];
        }
        if(isset($this->req['controller'])){
            $this->template = $this->req['controller']."/".$this->template;
        } else {
            $this->template = $this->template;
        }
        $this->template .= '.php';

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
        //$this->model->post($this->req['post']);
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

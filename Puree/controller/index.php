<?php
namespace Puree\Controller;

class Index extends Puree\Controller\Controller
{

    public function __construct() {
        parent::__construct();
    }

    public function get() {
        $this->view = new Pure\View($this->template);
        $contents = $this->view->getcontents($this->var);
        echo $contents;
    }

    public function put() {
        $this->model->put($this->req);
        header("Location:".BASE.$this->controller.$this->req['id']);
        //header("Location:".$this->top.$this->req['controller']."/");
    }
    public function post() {
        //$this->model->post($this->req['post']);
        $this->model->post($this->req);
        header("Location:".BASE.$this->controller.$this->req['id']);
    }

}
?>

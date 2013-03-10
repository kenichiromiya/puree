<?php

class PagesController extends CommonController
{
    public function __construct() {
        parent::__construct();
    }

    public function put() {
        //$this->model->post($this->req['post']);
        // TODO $req['post']['ids']
        $this->model->put(array_merge(array('user_id'=>$this->session['user_id']),$this->req));
        header("Location:".BASE.$this->controller.$this->req['id']);
        //print_r($this->req);
    }
    public function post() {
        //$this->model->post($this->req['post']);
        $this->model->post(array_merge(array('user_id'=>$this->session['user_id']),$this->req));
        header("Location:".BASE.$this->controller.$this->req['id']);
        //print_r($this->req);
    }
}
?>

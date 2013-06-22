<?php
namespace Puree\Controller;

class Files extends \Puree\Controller\Common
{
    public function __construct() {
        parent::__construct();
        $this->model = new \Puree\Model\Files();
    }

    public function post() {
        //$this->model->post($this->req['post']);
        $var = $this->model->post(array_merge(array('user_id'=>$this->session['user_id']),$this->req));
        header("Content-Type: application/json; charset=utf-8");
        echo json_encode($var);
        //header("Location:".BASE.$this->req['controller'].(isset($this->req['controller']) ? "/": "").dirname($this->req['id']));
        //print_r($this->req);
    }

}
?>

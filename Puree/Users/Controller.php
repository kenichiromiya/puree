<?php
namespace Puree\Users;

class Controller extends \Puree\Common\Controller
{

    public function __construct() {
        parent::__construct();
    }

    public function post() {
        $rule = array(
            "id"=>array("required"=>true),
            "password"=>array("required"=>true),
            "email"=>array("type"=>"email","required"=>true),
            "url"=>array("type"=>"url"),
        );
        $this->validator->rule = $rule;

        if ($this->validator->validate($this->req['post'])) {
            $this->model->post($this->req);
            header("Location:".BASE."users/?view=send");
        } else {
            header("HTTP/1.1 400 Bad Request");
            $this->view = new \Pure\View($this->template);
            $this->var['row'] = $this->req['post'];
            $this->var['errors'] = $this->validator->errors;
            $contents = $this->view->getcontents($this->var);
            echo $contents;
        }
    }

    public function put() {
        $rule = array(
            "id"=>array("required"=>true),
            "password"=>array("required"=>true),
            "email"=>array("type"=>"email","required"=>true),
            "url"=>array("type"=>"url"),
        );
        $this->validator->rule = $rule;
        //if ($this->validator->validate($this->req['post'])) {
        $this->model->put($this->req);
        $this->view = new \Pure\View($this->template);
        $contents = $this->view->getcontents($this->var);
        echo $contents;
/*
            if($this->req['view'] == 'send') {
                $this->view = new View("users/send.php");
                $contents = $this->view->getcontents($this->var);
                echo $contents;
            } elseif($this->req['view'] == 'complete') {
                header("Location:".BASE."sessions/?user_id=".$this->req['id']);
            } else {
                header("Location:".BASE."users/".$this->req['id']);
            }
*/
/*
        } else {
            header("HTTP/1.1 400 Bad Request");
            $this->view = new View("users/add.php");
            $this->var['row'] = $this->req['post'];
            $this->var['errors'] = $this->validator->errors;
            $contents = $this->view->getcontents($this->var);
            echo $contents;

        }
*/
        //header("Location:".$this->top.$this->req['controller']."/");
    }

}
?>

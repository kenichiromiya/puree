<?php
namespace Common;

class Controller extends \Pure\Controller
{

    public function __construct() {
        parent::__construct();
        $this->sessionsmodel = new \Sessions\Model();
        $var = $this->sessionsmodel->get($this->req);
        $this->session = $var['session'];
        $this->var['session'] = $var['session'];
    }

    public function get() {
        $var = $this->model->get($this->req);
        $this->var = $this->var + $var;
        $page = isset($this->req['page']) ? $this->req['page'] : 1;
        $this->var['next'] = $page+1;
   
        // if page not exist
        if($this->req['id'] and !$this->var['row']) {
            $this->template = "edit.php";
        }
        $this->view = new \Pure\View($this->template);
        $contents = $this->view->getcontents($this->var);
        echo $contents;
    }

    public function put() {
        //$this->model->post($this->req['post']);
        // TODO $req['post']['ids']
        $this->model->put(array_merge(array('user_id'=>$this->session['user_id']),$this->req));
        header("Location:".BASE.$this->req['controller'].(isset($this->req['controller']) ? "/": "").$this->req['id']);
        //print_r($this->req);
    }
    public function post() {
        //$this->model->post($this->req['post']);
        $this->model->post(array_merge(array('user_id'=>$this->session['user_id']),$this->req));
        header("Location:".BASE.$this->req['controller'].(isset($this->req['controller']) ? "/": "").dirname($this->req['id']));
        //print_r($this->req);
    }

/*
    public function delete() {
        $this->model->delete($this->req);
        header("Location:".BASE.$this->controller.dirname($this->req['id']));
    }
 */
        // http://support.microsoft.com/kb/290197/ja
/*
    public function move() {
        $this->model->move($this->req);
                header("Location:".BASE.$this->controller.$this->req['id']);
    }
 */

}
?>

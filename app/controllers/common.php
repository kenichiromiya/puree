<?php

class CommonController extends Controller
{

    public function __construct() {
        parent::__construct();
        $singleton = Request::singleton();
        $this->sessionsmodel = new SessionsModel();
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
        $this->view = new View($this->template);
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

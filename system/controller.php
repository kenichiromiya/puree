<?php

class Controller
{

        public function __construct() {
                $singleton = Request::singleton();
                $this->req = $singleton->req;
                $classname = ucwords($this->req['controller'])."Model";
                $this->model =& new $classname();
		$this->sessionsmodel = new SessionsModel();
		$var = $this->sessionsmodel->get($this->req);
		$this->session = $var['session'];
		$this->validator = new Validator();
                $this->var['req'] = $this->req;
                $this->var['base'] = BASE;
                $this->var['session'] = $this->session;
                if ($this->req['controller'] == 'index'){
                        $this->controller = "";
                } else {
                        $this->controller = $this->req['controller']."/";
                }
                if (preg_match("/\//",$this->req['id'])){
                        $this->dirname = dirname($this->req['id'])."/";
                } else {
                        $this->dirname = "";
                }
                if (preg_match("/\//",$this->req['id'])){
                        $this->parent_id = dirname($this->req['id']);
                } else {
                        $this->parent_id = "";
                }
        }

        public function get() {
                $var = $this->model->get($this->req);
                $file = $this->req['controller'].'.php';
                $this->view = new View($file);
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
		header("Location:".BASE.$this->controller.$this->dirname);
        }
        public function delete() {
                $this->model->delete($this->req);
		header("Location:".BASE.$this->controller.$this->dirname);
        }
}
?>

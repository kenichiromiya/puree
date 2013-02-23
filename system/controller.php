<?php

class Controller
{

        public function __construct() {
                $singleton = Request::singleton();
                $this->req = $singleton->req;
		if ($this->req['controller']) {
			$classname = ucwords($this->req['controller'])."Model";
		} else {
			$classname = ucwords(DEFAULT_CLASS)."Model";
		}
                $this->model =& new $classname();
		/*
		$this->sessionsmodel = new SessionsModel();
		$var = $this->sessionsmodel->get($this->req);
		$this->session = $var['session'];
                $this->var['session'] = $var['session'];
		*/
		$this->validator = new Validator();
                $this->var['req'] = $this->req;
                $this->var['base'] = BASE;
                if ($this->req['controller']){
                        $this->controller = $this->req['controller']."/";
                } else {
                        $this->controller = "";
                }
                if (preg_match("/\//",$this->req['id'])){
                        $this->parent_id = dirname($this->req['id']);
                } else {
                        $this->parent_id = "";
                }
                if ($this->req['view']) {
                    $view = ".".$this->req['view'];
                } elseif ($var['view']) {
                    $view = ".".$var['view'];
                } else  {
                    $view = "";
                }
                if($this->req['view']){
                    $this->template .= $this->req['view'];
                } elseif($this->req['id']){
                    $this->template = 'detail';
                } else {
                    $this->template = 'index';
                }
                if($this->req['extension']){
                    $this->template .= '.'.$this->req['extension'];
                }
                if($this->req['controller']){
                    $this->template = $this->req['controller']."/".$this->template;
                }
                $this->template .= '.php';
                //echo $this->template;
/*
                $file = "index".$view.'.php';
                if($this->req['controller']){
                    $this->template = $this->req['controller']."/".$file;
                } else {
                    $this->tamplate = $file;
                }
*/

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
		header("Location:".BASE.$this->controller.dirname($this->req['id']));
        }
        public function delete() {
                $this->model->delete($this->req);
		header("Location:".BASE.$this->controller.dirname($this->req['id']));
        }
}
?>

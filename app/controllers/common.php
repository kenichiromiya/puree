<?php

class CommonController extends Controller
{

        public function __construct() {
		parent::__construct();
                $singleton = Request::singleton();
		if ($this->session['role'] == "admin" or preg_match("#^".$this->session['account_id']."/#",$this->req['id'])) {
			$this->var['editable'] = TRUE;
		}
        }

        public function get() {
                $var = $this->model->get($this->req);
		$this->var = $this->var + $var;
		if ($this->req['view']) {
			$view = ".".$this->req['view'];
		} elseif ($var['view']) {
                        $view = ".".$var['view'];
                } else  {
			$view = "";
		}
		if ($this->req['view'] == "add") {
			$this->var['form'] = array();
			$this->var['form']['_method'] = "post";
		}
		if ($this->req['view'] == "edit") {
			$this->var['form'] = $var;
			$this->var['form']['_method'] = "put";
		}
		/*
		if (preg_match("#[^/]$#",$this->req['id'])) {
			$file = "detail".$view.'.php';
		} else {
			$page = isset($this->req['page']) ? $this->req['page'] : 1;
			$this->var['next'] = $page+1;
			$file = "index".$view.'.php';
		}
		*/
		$page = isset($this->req['page']) ? $this->req['page'] : 1;
		$this->var['next'] = $page+1;
		$file = "index".$view.'.php';
		if($this->req['controller']){
			$file = $this->req['controller']."/".$file;
		} else {
			$file = $file;
		}
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
                header("Location:".BASE.$this->controller.$this->req['id']);
        }
        public function delete() {
		$this->model->delete($this->req);
                header("Location:".BASE.$this->controller.dirname($this->req['id']));
        }
	// http://support.microsoft.com/kb/290197/ja
	public function move() {
		$this->model->move($this->req);
                header("Location:".BASE.$this->controller.$this->req['id']);
	}

}
?>

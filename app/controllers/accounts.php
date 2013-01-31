<?php

class AccountsController extends CommonController
{

        public function __construct() {
		parent::__construct();
        }

        public function put() {
                $rule = array(
			"id"=>array("required"=>true),
			"password"=>array("required"=>true),
			"email"=>array("type"=>"email","required"=>true),
                        "url"=>array("type"=>"url"),
                );
		$this->validator->rule = $rule;
		if ($this->validator->validate($this->req['post'])) {
			$this->model->put($this->req);
			if($this->req['view'] == 'send') {
				$this->view = new View("accounts/index.send.php");
				$contents = $this->view->getcontents($this->var);
				echo $contents;
			} elseif($this->req['view'] == 'complete') {
				header("Location:".BASE."sessions/?account_id=".$this->req['id']);
			} else {
				header("Location:".BASE."accounts/".$this->req['id']);
			}
		} else {
                        header("HTTP/1.1 400 Bad Request");
                        $this->view = new View("accounts/index.php");
			$this->var['errors'] = $this->validator->errors;
                        $contents = $this->view->getcontents($this->var);
                        echo $contents;

/*
			$var = $this->req['post'];
			$var['base'] = BASE;
			$var['session'] = $this->session;
			$var['errors'] = $errors;
			$file = 'accounts/detail.php';
			$this->view = new View($file);
			$contents = $this->view->getcontents($var);
			echo $contents;
*/

		}
                //header("Location:".$this->top.$this->req['controller']."/");
        }

}
?>

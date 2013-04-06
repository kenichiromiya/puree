<?php
namespace Puree\Controller;

class Sessions extends \Puree\Controller\Common
{
    public function __construct() {
        parent::__construct();
        $this->model = new \Puree\Model\Sessions();
    }

    public function post() {
        $var = $this->model->post($this->req);
        if ($var['user']){
            if ($this->req['done']) {
                header("Location:".urldecode($this->req['done']));
            } else {
                header("Location:".BASE);
            }
        } else {
            header("HTTP/1.1 401 Unauthorized");
            $this->view = new Pure\View("sessions/index.php");
            $contents = $this->view->getcontents($this->var);
            echo $contents;
        }
    }

    public function delete() {
        $this->model->delete($this->req);
        header("Location:".BASE);
    }

}
?>

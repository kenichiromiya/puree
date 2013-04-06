<?php
namespace Puree\Controller;

class Files extends \Puree\Controller\Common
{
    public function __construct() {
        parent::__construct();
        $this->model = new \Puree\Model\Files();
    }

}
?>

<?php
namespace Puree\Controller;

class Pages extends \Puree\Controller\Common
{
    public function __construct() {
        parent::__construct();
        $this->model = new \Puree\Model\Pages();
    }

}
?>

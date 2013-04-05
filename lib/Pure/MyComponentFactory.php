<?php
namespace Pure;

class MyComponentFactory extends ComponentFactory
{
    function buildRequest()
    {
        //$request = new \Pure\Request();
        $request = Request::getInstance();
        return $request;
    }

    function buildDB()
    {
        //$request = new \Pure\Request();
        $db = DB::getInstance($this->container->get('MyPDO'));
        return $db;
    }
    function buildMyPDO()
    {
        //$request = new \Pure\Request();
        $mypdo = new MyPDO();
        return $mypdo;
    }
}

?>

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

}

?>

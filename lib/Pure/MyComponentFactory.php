<?php
namespace Pure;

class MyComponentFactory extends ComponentFactory
{
    function buildRequest()
    {
        //$request = new \Pure\Request();
        $request = Request::singleton();
        return $request;
    }

}

?>

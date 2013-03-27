<?php
namespace Pure;

abstract class ComponentFactory
{
    protected $container;
    function get($name)
    {
        return $this->{'build' . $name}();
    }

    function accept(DIContainer $c)
    {
        $this->container = $c;
    }
}
?>

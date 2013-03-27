<?php
namespace Pure;

class DIContainer
{
    protected $componentFactory;
    function __construct(ComponentFactory $c)
    {
        $this->componentFactory = $c;
        $c->accept($this);
    }

    function get($name)
    {
        $name = strtolower($name);
        if (!isset($this->objects[$name])) {
            $this->objects[$name] = $this->componentFactory->get($name);
        }

        return $this->objects[$name];
    }
}
?>

<?php namespace Pimple;

class Container
{
    protected $services = [];

    public function set($name, $callable)
    {
        $this->services[$name] = $callable;
    }

    public function get($name)
    {
        if (!isset($this->services[$name])) {
            throw new \InvalidArgumentException(sprintf('Service "%s" not found.', $name));
        }

        return $this->services[$name]($this);
    }
}
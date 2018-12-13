<?php

namespace GolemAi\Core\Entity;

class Parameter
{
    /**
     * @var string
     */
    private $value;

    /**
     * @var string
     */
    private $name;

    public function __construct($name, $value = '')
    {
        $this->name = $name;
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }
}
<?php

abstract class MyEnum
{
    final public function __construct($value)
    {
        $c = new ReflectionClass($this);
        if(!in_array($value, $c->getConstants())) {
            throw IllegalArgumentException();
        }
        $this->value = $value;
    }

    final public function __toString()
    {
        return $this->value;
    }
}

class TiposBBDD extends MyEnum{
    const MONGODB = 1;
    const MYSQL = 2;
    //const __default = self::MONGODB;
}

?>
<?php

namespace App\Core\Container\Attribute;

#[\Attribute]
class Bind
{
    /**
     * @param string $object
     */
    public function __construct(public string $object)
    {}
}
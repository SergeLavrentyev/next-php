<?php

namespace App\Core\Router\RouteInfo;

use App\Core\Router\Contract\RouteInfoBuilderInterface;

class BuilderFactory
{
    private ?RouteInfoBuilderInterface $builder = null;

    public function create(): RouteInfoBuilderInterface
    {
        if (!$this->builder) {
            $this->builder = new Builder();
        }

        return $this->builder;
    }
}
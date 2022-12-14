<?php

namespace App\Core\Router\Contract;

interface RouteInfoBuilderInterface
{
    /**
     * @param string $route
     * @return RouteInfoInterface
     */
    public function build(string $route): RouteInfoInterface;
}
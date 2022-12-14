<?php

namespace App\Core\Router\RouteInfo;

use App\Core\Router\Contract\RouteInfoBuilderInterface;
use App\Core\Router\Contract\RouteInfoInterface;
use App\Core\Router\RouteInfo;

class Builder implements RouteInfoBuilderInterface
{
    /**
     * @param string $route
     * @return RouteInfoInterface
     */
    public function build(string $route): RouteInfoInterface
    {
        return new RouteInfo($route);
    }

}
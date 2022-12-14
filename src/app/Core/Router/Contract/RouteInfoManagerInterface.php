<?php

namespace App\Core\Router\Contract;

interface RouteInfoManagerInterface
{
    /**
     * @param RouteInfoBuilderInterface $builder
     * @return $this
     */
    public function setBuilder(RouteInfoBuilderInterface $builder): self;

    /**
     * @param string $route
     * @return RouteInfoInterface
     */
    public function createFromRequestRoute(string $route): RouteInfoInterface;

    /**
     * @param string $route
     * @return RouteInfoInterface
     */
    public function createFromControllerRoute(string $route): RouteInfoInterface;
}
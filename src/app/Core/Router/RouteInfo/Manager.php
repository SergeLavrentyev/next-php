<?php

namespace App\Core\Router\RouteInfo;

use App\Core\Router\Contract\RouteInfoBuilderInterface;
use App\Core\Router\Contract\RouteInfoInterface;
use App\Core\Router\Contract\RouteInfoManagerInterface;
use App\Core\Router\RouteInfo;

class Manager implements RouteInfoManagerInterface
{
    private Builder $builder;

    /**
     * @inheritDoc
     */
    public function setBuilder(RouteInfoBuilderInterface $builder): self
    {
        $this->builder = $builder;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function createFromRequestRoute(string $route): RouteInfoInterface
    {
        return $this->builder->build($route)
            ->setFragments()
            ->setModule();
    }

    /**
     * @inheritDoc
     */
    public function createFromControllerRoute(string $route): RouteInfoInterface
    {
        return $this->builder->build($route)
            ->setFragments()
            ->setModule()
            ->setOptions()
            ->setRegex();
    }
}
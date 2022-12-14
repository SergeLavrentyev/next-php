<?php

declare(strict_types=1);

namespace App\Core\Router\Contract;

use App\Core\Container\Contract\ContainerInterface;
use App\Core\Request\Contract\RequestInterface;

interface RouterInterface
{
    /**
     * @return mixed
     */
    public function resolve(RequestInterface $request, ContainerInterface $container): mixed;
}
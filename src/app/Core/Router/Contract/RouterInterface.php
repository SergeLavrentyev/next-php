<?php

declare(strict_types=1);

namespace App\Core\Router\Contract;

use Psr\Container\ContainerInterface;
use App\Core\Request\Contract\RequestInterface;

interface RouterInterface
{
    /**
     * @param RequestInterface $request
     * @param ContainerInterface $container
     * @return mixed
     */
    public function resolve(RequestInterface $request, ContainerInterface $container): mixed;
}
<?php

namespace App\Core;

use Psr\Container\ContainerInterface;
use App\Core\Request\Contract\RequestInterface;
use App\Core\Router\Contract\RouterInterface;

class App
{
    /**
     * @param RequestInterface $request
     * @param RouterInterface $router
     * @param ContainerInterface $container
     */
    public function __construct(
        protected RequestInterface $request,
        protected RouterInterface $router,
        protected ContainerInterface $container
    ) {
    }

    /**
     * @return void
     */
    public function run(): void
    {
        try {
            echo $this->router->resolve($this->request, $this->container);
        } catch (\Exception $exception) {
            http_response_code($exception->getCode());
            echo $exception->getMessage();
        }
    }
}
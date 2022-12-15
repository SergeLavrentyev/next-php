<?php

namespace App\Core\Router;

use App\Core\Request\Contract\RequestInterface;
use App\Core\Router\Attribute\Route;
use App\Core\Router\Contract\RouteInfoManagerInterface;
use App\Core\Router\Contract\RouterInterface;
use App\Core\Router\Enum\HttpMethod;
use App\Core\Router\Exception\NotAllowedHttpMethodException;
use App\Core\Router\Exception\RouteNotFoundException;
use App\Core\Router\RouteInfo\BuilderFactory;
use App\Core\Router\RouteInfo\Manager;
use Psr\Container\ContainerInterface;

class Router implements RouterInterface
{
    /**
     * @inheritDoc
     * @throws RouteNotFoundException
     */
    public function resolve(RequestInterface $request, ContainerInterface $container): mixed
    {
        $requestMethod = HttpMethod::tryFrom($request->getMethod());

        if (is_null($requestMethod)) {
            throw new NotAllowedHttpMethodException();
        }
        $requestRoute = explode('?',$request->getUri())[0];

        $requestRouteInfo = $this->getRouteInfoManager()
            ->createFromRequestRoute($requestRoute);


        $controller = new \ReflectionClass($requestRouteInfo->getController());

        $action = null;

        $args = [];
        foreach ($controller->getMethods() as $method) {
            $attributes = $method->getAttributes(Route::class, \ReflectionAttribute::IS_INSTANCEOF);

            foreach ($attributes as $attribute) {
                $route = $attribute->newInstance();

                if ($route->method !== $requestMethod) {
                    continue;
                }

                $controllerRouteInfo = $this->getRouteInfoManager()
                    ->createFromControllerRoute($route->path);

                $match = preg_match($controllerRouteInfo->getRegex(), $requestRoute);

                if (empty($match)) {
                    continue;
                }

                $action = [$controller->getName(), $method->getName()];

                if ($controllerRouteInfo->hasOptions()) {
                    $options = $controllerRouteInfo->getOptions();

                    foreach ($options as $index => $name) {
                        $fragments = $requestRouteInfo->getFragments();

                        $args[$name] = $fragments[$index];
                    }

                }
                break;
            }
        }

        if (!$action) {
            throw new RouteNotFoundException();
        }

        if (is_callable($action)) {
            return call_user_func($action);
        }

        if (!is_array($action)) {
            throw new RouteNotFoundException();
        }

        [$class, $method] = $action;

        if (!class_exists($class) || !method_exists($class, $method)) {
            throw new RouteNotFoundException();
        }

        $instance = $container->get($class);

        return call_user_func_array([$instance, $method], array_values($args));
    }

    /**
     * @return RouteInfoManagerInterface
     */
    protected function getRouteInfoManager(): RouteInfoManagerInterface
    {
        $builder = (new BuilderFactory())->create();

        return (new Manager())->setBuilder($builder);
    }
}
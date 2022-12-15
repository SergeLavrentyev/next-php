<?php

namespace App\Core\Container;

use App\Core\Container\Attribute\Bind;
use App\Core\Container\Contract\ContainerInterface;

class Container implements ContainerInterface
{

    private array $entries = [];
    private array $resolved = [];

    /**
     * @inheritDoc
     * @throws \ReflectionException
     */
    public function get(string $id): mixed
    {
        if (isset($this->resolved[$id])) {
            return $this->resolved[$id];
        }

        if (!$this->has($id)) {
            return $this->resolve($id);
        }

        $entry = $this->entries[$id];

        if (is_callable($entry)) {
            return $entry($this);
        }

        return $this->resolve($entry);
    }

    /**
     * @inheritDoc
     */
    public function has(string $id): bool
    {
        return isset($this->entries[$id]);
    }

    /**
     * @param string $id
     * @param callable|string $concrete
     * @return void
     */
    public function bind(string $id, callable|string $concrete)
    {
        $this->entries[$id] = $concrete;
    }

    /**
     * @param string $id
     * @return mixed
     * @throws \ReflectionException
     */
    protected function resolve(string $id): mixed
    {
        $reflectionClass = new \ReflectionClass($id);
        $class = $id;

        if ($reflectionClass->isInterface()) {
            $bindAttribute = $reflectionClass->getAttributes(Bind::class);

            foreach ($bindAttribute as $attribute) {
                $class = $attribute->newInstance()->object;
                $reflectionClass = new \ReflectionClass($class);
            }
        }

        if (!$reflectionClass->isInstantiable()) {
            throw new \Exception('non extenciable');
        }

        $constructor = $reflectionClass->getConstructor();

        if (is_null($constructor)) {
            return $this->resolved[$id] = new $class();
        }

        $parameters = $constructor->getParameters();

        if (empty($parameters)) {
            return $this->resolved[$id] = new $class();
        }

        $dependencies = array_map(function (\ReflectionParameter $parameter) use ($id): mixed {
            $type = $parameter->getType();

            if ($parameter->isDefaultValueAvailable()) {
                return $parameter->getDefaultValue();
            }

            if (is_null($type)) {
                throw new \Exception("Constructor $id error: type not specified for $type");
            }

            if ($type instanceof \ReflectionUnionType) {
                throw new \Exception('Reflection type');
            }

            if ($type instanceof \ReflectionNamedType && !$type->isBuiltin()) {
                return $this->get($type->getName());
            }

            throw new \Exception('Failed to resolve class');
        }, $parameters);

        return $this->resolved[$id] = $reflectionClass->newInstanceArgs($dependencies);
    }
}
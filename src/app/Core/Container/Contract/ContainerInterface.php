<?php

namespace App\Core\Container\Contract;

interface ContainerInterface
{
    public function get(string $id): mixed;
}
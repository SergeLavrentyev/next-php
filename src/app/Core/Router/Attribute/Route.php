<?php

declare(strict_types=1);

namespace App\Core\Router\Attribute;

use App\Core\Router\Enum\HttpMethod;

#[\Attribute]
class Route
{
    /**
     * @param string $method
     * @param string $path
     */
    public function __construct(
        public HttpMethod $method,
        public string $path
    ) {}
}
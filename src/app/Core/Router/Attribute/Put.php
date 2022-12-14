<?php

namespace App\Core\Router\Attribute;

use App\Core\Router\Enum\HttpMethod;

#[\Attribute]
class Put extends Route
{
    public function __construct(string $path)
    {
        parent::__construct(HttpMethod::PUT, $path);
    }
}
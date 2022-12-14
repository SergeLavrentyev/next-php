<?php

declare(strict_types=1);

namespace App\Core\Router\Attribute;

use App\Core\Router\Enum\HttpMethod;

#[\Attribute]
class Get extends Route
{
    public function __construct(string $path)
    {
        parent::__construct(HttpMethod::GET, $path);
    }
}
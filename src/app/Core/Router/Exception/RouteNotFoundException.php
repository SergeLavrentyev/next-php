<?php

namespace App\Core\Router\Exception;

use App\Core\Router\Enum\HttpStatus;
use Throwable;

class RouteNotFoundException extends HttpException
{
    /**
     * @param string $message
     * @param Throwable|null $previous
     */
    public function __construct(string $message = '', ?Throwable $previous = null)
    {
        parent::__construct(HttpStatus::NOT_FOUND, $message, $previous);
    }
}
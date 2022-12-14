<?php

namespace App\Core\Router\Enum;

enum HttpStatus: int
{
    case NOT_FOUND = 404;
    case METHOD_NOT_ALLOWED = 405;
    case SERVER_ERROR = 500;

    public function getErrorText(): string
    {
        return match ($this) {
            HttpStatus::NOT_FOUND => 'Requested page not found',
            HttpStatus::METHOD_NOT_ALLOWED => 'Request method is not allowed',
            HttpStatus::SERVER_ERROR => 'Server error'
        };
    }
}
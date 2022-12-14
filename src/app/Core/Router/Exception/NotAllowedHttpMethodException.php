<?php

namespace App\Core\Router\Exception;

use App\Core\Router\Enum\HttpStatus;
use JetBrains\PhpStorm\Internal\LanguageLevelTypeAware;
use Throwable;

class NotAllowedHttpMethodException extends HttpException
{
    /**
     * @param string $message
     * @param Throwable|null $previous
     */
    public function __construct(string $message = '', ?Throwable $previous = null)
    {
        parent::__construct(HttpStatus::METHOD_NOT_ALLOWED, $message, $previous);
    }
}
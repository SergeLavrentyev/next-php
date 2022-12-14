<?php

namespace App\Core\Router\Exception;

use App\Core\Router\Enum\HttpStatus;
use Throwable;

class HttpException extends \Exception
{
    /**
     * @param HttpStatus $httpStatus
     * @param string $errorInfo
     * @param Throwable|null $previous
     */
    public function __construct(
        HttpStatus $httpStatus, string $errorInfo = '', ?Throwable $previous = null)
    {
        $message = $httpStatus->getErrorText() . "\n" . $errorInfo;
        $code = $httpStatus->value;

        parent::__construct($message, $code, $previous);
    }
}
<?php

namespace App\Core\Request;

use App\Core\Request\Contract\RequestInterface;

class Request implements RequestInterface
{

    /**
     * @param array $query
     * @param array $request
     * @param string $method
     * @param string $path
     */
    public function __construct(
        protected array $query,
        protected array $request,
        protected string $method,
        protected string $path
    ) {
    }

    /**
     * @inheritDoc
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @inheritDoc
     */
    public function getUri(): string
    {
        return $this->path;
    }
}
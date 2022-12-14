<?php

namespace App\Core\Request;

use App\Core\Request\Contract\RequestInterface;
use JetBrains\PhpStorm\ArrayShape;

class RequestFactory
{
    private ?RequestInterface $request = null;

    /**
     * @return RequestInterface
     */
    public function createFromGlobals(): RequestInterface
    {
        if (is_null($this->request)) {
            $globals = $this->getGlobals();

            $this->request = new Request(...$globals);
        }
        return $this->request;
    }

    /**
     * @return array
     */
    #[ArrayShape(['query' => "array", 'request' => "array", 'method' => "string", 'path' => "string"])]
    protected function getGlobals(): array
    {
        return [
            'query' => $_GET,
            'request' => $_REQUEST,
            'method' => $_SERVER['REQUEST_METHOD'],
            'path' => $_SERVER['REQUEST_URI']
        ];
    }
}
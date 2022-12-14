<?php

namespace App\Core\Request\Contract;

interface RequestInterface
{
    /**
     * @return string
     */
    public function getMethod(): string;

    /**
     * @return string
     */
    public function getUri(): string;
}
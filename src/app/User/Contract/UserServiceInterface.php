<?php

namespace App\User\Contract;

use App\Core\Container\Attribute\Bind;
use App\User\Service\UserService;

#[Bind(UserService::class)]
interface UserServiceInterface
{
    /**
     * @return string
     */
    public function get(): string;
}
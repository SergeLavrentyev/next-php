<?php

namespace App\User\Service;

use App\User\Contract\UserServiceInterface;

class UserService implements UserServiceInterface
{
    /**
     * @inheritDoc
     */
    public function get(): string
    {
        return 'test';
    }
}
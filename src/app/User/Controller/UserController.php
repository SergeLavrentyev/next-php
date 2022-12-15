<?php

declare(strict_types=1);

namespace App\User\Controller;

use App\Core\Router\Attribute\Get;
use App\User\Contract\UserServiceInterface;

class UserController
{
    /**
     * @param UserServiceInterface $userService
     */
    public function __construct(
        protected UserServiceInterface $userService
    ) {
    }

    #[Get('/user')]
    public function index()
    {
        echo 'USER:INDEX ' . $this->userService->get();
    }

    /**
     * @param int $id
     * @return void
     */
    #[Get('/user/:id')]
    public function getUserById(int $id)
    {
        echo 'USER:USERBYID + ' . $id;
    }

    #[Get('/user/:id/category')]
    public function getUserCategoryList(int $id)
    {
        echo 'USER:USER:CATEGORY + ' . $id;
    }
}
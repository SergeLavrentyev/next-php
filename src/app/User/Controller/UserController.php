<?php

declare(strict_types=1);

namespace App\User\Controller;

use App\Core\Router\Attribute\Get;

class UserController
{
    #[Get('/user')]
    public function index()
    {
        echo 'USER:INDEX';
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
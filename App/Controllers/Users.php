<?php

namespace App\Controllers;


use App\Models\User;
use App\Models\UserQuery;
use Core\Controller;
use Propel\Runtime\Exception\PropelException;

class Users extends Controller
{
    public function __construct(string $extensionTemplate = "php")
    {
        parent::__construct($extensionTemplate);
    }

    public function index(): void
    {
        try {
            $users = UserQuery::create()->find();
            echo $users->toJSON();
        } catch (PropelException $propelException) {
            echo $propelException->getMessage();
        }
    }

    public function add(): void
    {

    }
    public function update($id): void
    {
        try {
            $user = UserQuery::create()->findPk($id);
        } catch (PropelException $propelException) {
            echo  $propelException->getMessage();
        }
    }

    public function remove($id): void
    {
        try {
            $user = UserQuery::create()->findPk($id);
            $user->delete();
        } catch (PropelException $propelException) {
            echo  $propelException->getMessage();
        }
    }
}
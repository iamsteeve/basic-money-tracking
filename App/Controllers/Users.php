<?php

namespace App\Controllers;


use App\Models\User;
use App\Models\UserQuery;
use Core\Controller;
use Core\View;
use Josantonius\Session\Session;
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
            View::sendActionSessionToView();
            View::setData("title", "Usuarios disponibles");
            View::setData("users", $users);
            View::render("index");
        } catch (PropelException $propelException) {
            echo $propelException->getMessage();
        }
    }

    public function add(): void
    {
        if ($_POST) {
            try {
                $user = new User();
                $user->setId(null);
                $user->setName($_POST["name"]);
                $user->setDisplayname($_POST["displayname"]);
                $user->setEmail($_POST["email"]);
                $user->setPassword($_POST["password"]);
                $user->setRol($_POST["rol"]);
                $user->save();
                Session::set('action', 'Usuario agregado');
                $this->redirect(array("controller" => "users"));
                exit();
            } catch (PropelException $propelException) {
                echo $propelException->getMessage();
            }
        }
        if ($_GET) {
            View::sendActionSessionToView();
            View::setData("title", "Crea un nuevo usuario");
            View::render("add");
        }
    }

    public function update($id): void
    {

        try {

            $user = UserQuery::create()->findPk($id);
            if ($_GET) {
                View::sendActionSessionToView();
                View::setData("title", "Actualizar Usuario");
                View::setData("user",$user);
                View::render("update");
            }
            if ($_POST) {

                $user->setName($_POST["name"]);
                $user->setDisplayname($_POST["displayname"]);
                $user->setEmail($_POST["email"]);
                $user->setPassword($_POST["password"]);
                $user->setRol($_POST["rol"]);
                $user->save();
                Session::set('action', 'Usuario actualizado');
                $this->redirect(array("controller" => "users"));
                exit();
            }
        } catch (PropelException $propelException) {
            echo $propelException->getMessage();
        }

    }

    public function delete($id): void
    {
        try {
            $user = UserQuery::create()->findPk($id);
            $user->delete();
            Session::set("action", 'Se Eliminó un usuario');
            $this->redirect(array("controller" => "users"));
            exit();
        } catch (PropelException $propelException) {
            echo $propelException->getMessage();
        }
    }
}
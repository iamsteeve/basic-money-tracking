<?php

namespace App\Controllers;


use App\Models\User;
use App\Models\UserQuery;
use App\Services\Authentication;
use App\Services\Sanatize;
use Core\Controller;
use Core\View;
use Josantonius\Session\Session;
use Propel\Runtime\Exception\PropelException;

/**
 * Class Users
 * @package App\Controllers
 */
class Users extends Controller
{
    /**
     * Users constructor.
     * @param string $extensionTemplate
     */
    public function __construct(string $extensionTemplate = "php")
    {
        parent::__construct($extensionTemplate);
    }

    /**
     * Método principal para el controlador de usuarios
     */
    public function index(): void
    {
        if (Authentication::isLogged() && Authentication::checkUniqueRole("admin")){
            try {
                $users = UserQuery::create()->find();
                View::sendActionSessionToView();
                View::setData("title", "Usuarios disponibles");
                View::setData("users", $users);
                View::render("index");
            } catch (\Exception $exception) {
                echo $exception->getMessage();
            }
        } else {
            Session::set("action","Módulo no encontrado");
            $this->toDefaultController();
        }
    }

    /**
     * Método para agregar Usuarios
     */
    public function add(): void
    {
        if (Authentication::isLogged() && Authentication::checkUniqueRole("admin")){
            if ($_POST) {
                try {
                    $user = new User();
                    $user->setId(null);
                    $user->setName(Sanatize::sanitizeText($_POST["name"]));
                    $user->setDisplayname(Sanatize::sanitizeText($_POST["displayname"]));
                    $user->setEmail(Sanatize::isEmail($_POST["email"]));
                    $user->setPassword($_POST["password"]);
                    $user->setRol(Sanatize::sanitizeText($_POST["rol"]));
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
        } else {
            Session::set("action","Módulo no encontrado");
            $this->toDefaultController();
        }
    }

    /**
     * Método para actualizar Usuarios
     * @param $id
     */
    public function update($id): void
    {

        if (Authentication::isLogged() && Authentication::checkUniqueRole("admin")){
            try {

                $user = UserQuery::create()->findPk($id);
                if ($_GET) {
                    View::sendActionSessionToView();
                    View::setData("title", "Actualizar Usuario");
                    View::setData("user",$user);
                    View::render("update");
                }
                if ($_POST) {

                    $user->setName(Sanatize::sanitizeText($_POST["name"]));
                    $user->setDisplayname(Sanatize::sanitizeText($_POST["displayname"]));
                    $user->setEmail(Sanatize::isEmail($_POST["email"]));
                    $user->setPassword($_POST["password"]);
                    $user->setRol(Sanatize::sanitizeText($_POST["rol"]));
                    $user->save();
                    Session::set('action', 'Usuario actualizado');
                    $this->toMain();
                    exit();
                }
            } catch (PropelException $propelException) {
                Session::set("action", "No se ha podido actualizar el usuario");
                $this->toMain();
            }
        } else {
            Session::set("action","Módulo no encontrado");
            $this->toDefaultController();
        }

    }

    /**
     * Método para borrar Usuarios
     * @param $id
     */
    public function delete($id): void
    {
        if (Authentication::isLogged() && Authentication::checkUniqueRole("admin")){
            try {
                $user = UserQuery::create()->findPk($id);
                $user->delete();
                Session::set("action", 'Se Eliminó un usuario');
                $this->redirect(array("controller" => "users"));
                exit();
            } catch (PropelException $propelException) {
                Session::set("action", "No se pudo eliminar el usuario");
                $this->toMain();

            }
        } else {
            Session::set("action","Módulo no encontrado");
            $this->toDefaultController();
        }
    }
}
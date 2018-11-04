<?php

namespace App\Controllers;


use App\Models\User;
use App\Models\UserQuery;
use App\Services\Authentication;
use Core\Controller;
use Core\View;
use Josantonius\Session\Session;
use Propel\Runtime\Exception\PropelException;

class Home extends Controller
{
    public function __construct(string $extensionTemplate = "php")
    {
        parent::__construct($extensionTemplate);
    }

    public function index(): void
    {
        if (Authentication::isLogged()){
            $this->toDefaultController();
        } else {
            View::setData("title","MoneyTracking");
            View::sendActionSessionToView();
            View::render("index");
        }
    }

    // TODO: Validación de los datos
    public function login(): void
    {
        if ($_GET){
            if (Authentication::isLogged()){
                $this->toDefaultController();
            } else {
                View::setData("title", "Inicia sesión");
                View::sendActionSessionToView();
                View::render("login");
            }
        }
        if ($_POST){
            $user = UserQuery::create()
                ->filterByEmail($_POST['email'])
                ->filterByPassword($_POST['password'])
                ->findOne();
            if ($user && Authentication::signIn($user->getDisplayname(),$user->getId(),$user->getRol())){
                Session::set("action", "¡Se iniciado sesión!");
                $this->toDefaultController();
            } else {
                Session::set("action", "Ha fallado el inicio de sesión compruebe sus datos");
                $this->redirect(array("controller"=>"home", "action" =>"login"));
                exit();
            }
        }
    }
    public function logOut():void{
        if ($_GET && Authentication::logOut()){
            Session::set("action", "Se ha cerrado la sesión");
            $this->toLogin();
        } else {
            Session::set("action", "No se ha podido cerrar la sesión");
            $this->toMain();
        }
    }

    // TODO: Validación de los datos
    public function signup():void
    {
        if (Authentication::isLogged()){
            $this->toDefaultController();
        } else {
            if ($_GET){
                View::setData("title", "Regístrate en MoneyTracking");
                View::sendActionSessionToView();
                View::render("signup");
            }
            if ($_POST){

                    $user = UserQuery::create()
                        ->filterByEmail($_POST['email'])
                        ->findOne();
                    if ($user){
                        Session::set('action','Ya se encuentra registrado en el sistema');
                        $this->redirect(array("controller"=>"home", "action" => "signup"));
                        exit();
                    } else {
                        try {

                            $newUser = new User();
                            $newUser->setId(null);
                            $newUser->setPassword($_POST['password']);
                            $newUser->setEmail($_POST['email']);
                            $newUser->setDisplayname($_POST['displayname']);
                            $newUser->setRol('user');
                            $newUser->setName($_POST['name']);
                            $newUser->save();
                            if (Authentication::signIn($newUser->getDisplayname() ? $newUser->getDisplayname() : $newUser->getEmail(), $newUser->getId(), $newUser->getRol())) {
                                Session::set('action', 'Se ha iniciado sesión con éxito');
                                $this->toDefaultController();
                            } else {
                                Session::set('action', 'No se ha podido iniciar sesión pero ya está registrado, ingrese nuevamente');
                                $this->toLogin();
                            }
                        } catch (PropelException $exception){
                            Session::set('action','Ha sucedido un error al registrarlo');
                            $this->redirect(array("controller"=>"home", "action" => "signup"));
                            exit();
                        }
                    }

            }

        }
    }

}
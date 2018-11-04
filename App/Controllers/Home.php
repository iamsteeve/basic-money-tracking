<?php

namespace App\Controllers;


use App\Models\UserQuery;
use App\Services\Authentication;
use Core\Controller;
use Core\View;
use Josantonius\Session\Session;

class Home extends Controller
{
    public function __construct(string $extensionTemplate = "php")
    {
        parent::__construct($extensionTemplate);
    }

    public function index(): void
    {
        if (Authentication::isLogged()){
            $this->redirect(array("controller"=>"transactions"));
            exit();
        } else {
            View::setData("title","MoneyTracking");
            View::sendActionSessionToView();
            View::render("index");
        }
    }
    public function login(): void
    {
        if ($_GET){
            if (Authentication::isLogged()){
                $this->redirect(array("controller"=>"transactions"));
                exit();
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
            if ($user && Authentication::signIn($user->getDisplayname(),$user->getId(),"admin")){
                Session::set("action", "¡Se iniciado sesión!");
                $this->redirect(array("controller"=>"transactions"));
                exit();
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
            $this->redirect(array("controllers"=> "home"));
            exit();
        }
    }

    public function signup():void
    {
        if (Authentication::isLogged()){
            $this->redirect(array("controller"=>"transactions"));
            exit();
        } else {
            View::setData("title", "Regístrate");
            View::sendActionSessionToView();
            View::render("signup");
        }
    }
}
<?php

namespace App\Controllers;


use App\Models\Account;
use App\Models\AccountQuery;
use App\Services\Authentication;
use Core\Controller;
use Core\View;
use Josantonius\Session\Session;
use Propel\Runtime\Exception\PropelException;

class Accounts extends Controller
{

    public function __construct(string $extensionTemplate = "php")
    {
        parent::__construct($extensionTemplate);
    }

    public function index(): void
    {
        if (Authentication::isLogged()){
            try {
                $accounts = AccountQuery::create()
                    ->filterById(Session::get('userId'))
                    ->find();
                View::setData("accounts", $accounts);
                View::setData("title", "Mira tus Cuentas");
                View::sendActionSessionToView();
                View::render("index");
            } catch (\Exception $exception) {
                echo $exception->getMessage();
            }
        } else {
            $this->toLogin();
        }

    }

    public function add(): void
    {
        if (Authentication::isLogged()){
            if ($_POST) {

                try {
                    $account = new Account();
                    $account->setName($_POST["name"]);
                    $account->setUserId(Session::get("userId"));
                    $account->save();
                    Session::set('action','Cuenta agregada');
                    $this->redirect(array("controller" => "accounts"));
                    exit();

                } catch (PropelException $e) {
                    echo $e->getMessage();
                }
            }
            if ($_GET) {
                View::sendActionSessionToView();
                View::setData("title", "Agrega una Cuenta");
                View::render("add");
            }
        } else {
            $this->toLogin();
        }
    }
    public function update($id): void
    {
        if (Authentication::isLogged()){
            try {
                $account = AccountQuery::create()
                    ->filterById(Session::get('userId'))
                    ->findPk($id);
                if ($account){
                    if ($_GET) {
                        View::setData("account", $account);
                        View::sendActionSessionToView();
                        View::setData("title", "Actualiza la cuenta");
                        View::render("update");
                    }
                    if ($_POST) {

                        $account->setName($_POST["name"]);
                        $account->save();
                        Session::set('action', 'Cuenta Actualizada');
                        $this->redirect(array("controller" => "accounts"));
                        exit();
                    }
                } else {
                    Session::set("action", "No se ha encontrado la cuenta");
                    $this->redirect(array("controller"=>"accounts"));
                    exit();
                }

            } catch (PropelException $propelException) {
                echo $propelException->getMessage();
            }
        } else {
            $this->toLogin();
        }


    }

    public function delete($id): void
    {
        if (Authentication::isLogged()){
            try {
                $account = AccountQuery::create()
                    ->filterByUserId(Session::get("userId"))
                    ->findPk($id);
                if ($account){
                    $account->delete();
                    Session::set("action", "Se ha eliminado una cuenta");
                    $this->redirect(array("controller"=> "accounts"));
                    exit();
                } else{
                    Session::set("action","Acceso denegado");
                    $this->redirect(array("controller"=> "accounts"));
                    exit();
                }

            } catch (PropelException $propelException){
                echo $propelException->getMessage();
            }
        } else{
            $this->toLogin();
        }
    }
}
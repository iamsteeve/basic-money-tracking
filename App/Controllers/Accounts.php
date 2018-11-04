<?php

namespace App\Controllers;


use App\Models\Account;
use App\Models\AccountQuery;
use App\Services\Authentication;
use App\Services\Sanatize;
use Core\Controller;
use Core\View;
use Josantonius\Session\Session;
use Propel\Runtime\Exception\PropelException;
use Valitron\Validator;

class Accounts extends Controller
{

    public function __construct(string $extensionTemplate = "php")
    {
        parent::__construct($extensionTemplate);
    }

    public function index(): void
    {
        if (Authentication::isLogged() && (Authentication::checkUniqueRole("user") || Authentication::checkUniqueRole("admin"))){
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
        if (Authentication::isLogged() && (Authentication::checkUniqueRole("user") || Authentication::checkUniqueRole("admin"))){
            if ($_POST) {
                $v = new Validator($_POST);
                $v->rule('required', ['name']);
                if($v->validate()) {
                    try {
                        $account = new Account();
                        $account->setName(Sanatize::sanitizeText($_POST['name']));
                        $account->setUserId(Session::get("userId"));
                        $account->save();
                        Session::set('action','Cuenta agregada');
                        $this->toMain();

                    } catch (PropelException $e) {
                        Session::set("action","No se ha podido agregar el registro");
                        $this->toMain();
                    }
                } else {
                    Session::set("action", "El nombre es requerido");
                    $this->redirect(array("controller"=>"accounts", "action" => "add"));
                    exit();
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
        if (Authentication::isLogged() && (Authentication::checkUniqueRole("user") || Authentication::checkUniqueRole("admin"))){
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
                        $v = new Validator($_POST);
                        $v->rule('required', ['name']);
                        if($v->validate()) {
                            $account->setName(Sanatize::sanitizeText($_POST['name']));
                            $account->save();
                            Session::set('action', 'Cuenta Actualizada');
                            $this->toMain();
                        } else{
                            Session::set("action", "Nombre es requerido");
                            $this->redirect(array("controller"=>"accounts", "action" => "update/".$id));
                            exit();
                        }


                    }
                } else {
                    Session::set("action", "No se ha encontrado la cuenta");
                    $this->toMain();
                }

            } catch (PropelException $propelException) {
                Session::set("action","No se ha podido actualizar el registro");
                $this->toMain();
            }
        } else {
            $this->toLogin();
        }


    }

    public function delete($id): void
    {
        if (Authentication::isLogged() && (Authentication::checkUniqueRole("user") || Authentication::checkUniqueRole("admin"))){
            try {
                $account = AccountQuery::create()
                    ->filterByUserId(Session::get("userId"))
                    ->findPk($id);
                if ($account){
                    $account->delete();
                    Session::set("action", "Se ha eliminado una cuenta");
                    $this->toMain();
                } else{
                    Session::set("action","No se ha encontrado el registro");
                    $this->toMain();
                }

            } catch (PropelException $propelException){
                Session::set("action","No se ha podido eliminar el registro");
                $this->toMain();
            }
        } else{
            $this->toLogin();
        }
    }
}
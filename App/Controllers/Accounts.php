<?php

namespace App\Controllers;


use App\Models\Account;
use App\Models\AccountQuery;
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
        try {
            $accounts = AccountQuery::create()->find();
            View::setData("accounts", $accounts);
            View::setData("title", "Mira tus Cuentas");
            View::sendActionSessionToView();
            View::render("index");
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }

    }

    public function add(): void
    {
        if ($_POST) {

            try {
                $account = new Account();
                $account->setName($_POST["name"]);
                $account->setUserId(2);
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
    }
    public function update($id): void
    {
        try {
            $account = AccountQuery::create()->findPk($id);
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
        } catch (PropelException $propelException) {
            echo $propelException->getMessage();
        }


    }

    public function delete($id): void
    {
        try {
            $account = AccountQuery::create()->findPk($id);
            $account->delete();
            $this->redirect(array("controller"=> "accounts"));
            exit();
        } catch (PropelException $propelException){
            echo $propelException->getMessage();
        }
    }
}
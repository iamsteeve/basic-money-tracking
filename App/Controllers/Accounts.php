<?php

namespace App\Controllers;


use App\Models\AccountQuery;
use Core\Controller;
use Core\View;
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
            echo $accounts->toJSON();
        } catch (PropelException $propelException) {
            echo $propelException->getMessage();
        }
        View::setData("title", "Mira tus Cuentas");
        View::sendSessionToView();
        View::render("index");
    }

    public function add(): void
    {

        echo "<h1>Add</h1>";
    }
    public function update($id): void
    {
        try {
            $account = AccountQuery::create()->findPk($id);
        } catch (PropelException $propelException){
            echo $propelException->getMessage();
        }
    }

    public function remove($id): void
    {
        try {
            $account = AccountQuery::create()->findPk($id);
            $account->delete();
        } catch (PropelException $propelException){
            echo $propelException->getMessage();
        }
    }
}
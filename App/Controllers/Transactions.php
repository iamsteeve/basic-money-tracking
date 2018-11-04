<?php

namespace App\Controllers;


use App\Models\AccountQuery;
use App\Models\CategoryQuery;
use App\Models\Transaction;
use App\Models\TransactionQuery;
use App\Extensions\Transactions as TransactionsExtension;
use Core\Controller;
use Core\View;
use Josantonius\Session\Session;
use Propel\Runtime\Exception\PropelException;

class Transactions extends Controller
{
    public function __construct(string $extensionTemplate = "php")
    {
        parent::__construct($extensionTemplate);
        View::loadExtension(new TransactionsExtension());
    }

    public function index(): void
    {
        try{
            $categories = CategoryQuery::create()->find();
            $accounts = AccountQuery::create()->find();
            $transactions = TransactionQuery::create()
                ->filterByCategory($categories)
                ->filterByAccount($accounts)
                ->find();
            $balance = 0;
            $ingress = 0;
            $egress = 0;
            foreach ($transactions as $transaction){
                $balance += $transaction->getAmount();
                if ($transaction->getAmount()>0){
                    $ingress += $transaction->getAmount();
                } elseif ($transaction->getAmount()<0) {
                    $egress += $transaction->getAmount();
                } else {
                    $egress += $transaction->getAmount();
                }
            }
            View::sendActionSessionToView();
            View::setData("title", "Transacciones de la cuenta");
            View::setData("transactions", $transactions);
            View::setData("balance", $balance);
            View::setData("ingress",$ingress);
            View::setData("egress", $egress);
            View::render("index");
        } catch (PropelException $propelException){
            echo $propelException->getMessage();
        }
    }


    public function add(): void
    {
        if ($_POST) {
            try {
                $transaction = new Transaction();
                $transaction->setId(null);
                $transaction->setDescription($_POST['description']);
                $transaction->setDate($_POST['date']);
                $transaction->setAmount($_POST['amount']);
                $transaction->setCategoryId($_POST['category_id']);
                $transaction->setAccountId($_POST['account_id']);
                $transaction->save();
                Session::set("action", "Transacción agregada con éxito");
                $this->redirect(array("controller"=>"transactions"));
                exit();
            } catch (PropelException $propelException) {
                echo $propelException->getMessage();
            }
        }
        if ($_GET) {
            $categories = CategoryQuery::create()->find();
            $accounts = AccountQuery::create()->find();
            View::sendActionSessionToView();
            View::setData("title", "Crea una nueva transacción");
            View::setData("categories", $categories);
            View::setData("accounts", $accounts);
            View::render("add");
        }
    }
    public function update($id): void
    {
        try {
            $transaction = TransactionQuery::create()->findPk($id);
            if ($_GET){
                $categories = CategoryQuery::create()->find();
                $accounts = AccountQuery::create()->find();
                View::sendActionSessionToView();

                View::setData("title", "Actualiza la transacción");
                View::setData("categories", $categories);
                View::setData("accounts", $accounts);
                View::setData("transaction", $transaction);
                View::render("update");
            }
            if ($_POST){

                $transaction->setDescription($_POST['description']);
                $transaction->setDate($_POST['date']);
                $transaction->setAmount($_POST['amount']);
                $transaction->setCategoryId($_POST['category_id']);
                $transaction->setAccountId($_POST['account_id']);
                $transaction->save();
                Session::set('action', 'Transacción actualizada');
                $this->redirect(array("controller" => "transactions"));
                exit();
            }
        } catch (PropelException $propelException) {
            echo $propelException->getMessage();
        }
    }

    public function delete($id): void
    {
        try {
            $transaction = TransactionQuery::create()->findPk($id);
            $transaction->delete();
            Session::set("action", "Se eliminó una transacción");
            $this->redirect(array("controller"=> "transactions"));
            exit();
        } catch (PropelException $propelException) {
            echo $propelException->getMessage();
        }
    }

}
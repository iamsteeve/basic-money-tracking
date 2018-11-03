<?php

namespace App\Controllers;


use App\Models\TransactionQuery;
use Core\Controller;
use Propel\Runtime\Exception\PropelException;

class Transactions extends Controller
{
    public function __construct(string $extensionTemplate = "php")
    {
        parent::__construct($extensionTemplate);
    }

    public function index(): void
    {
        try{
            $transactions = TransactionQuery::create()->find();
            echo $transactions->toJSON();
        } catch (PropelException $propelException){
            echo $propelException->getMessage();
        }
    }

    public function add(): void
    {
        echo "<h1>Add</h1>";
    }
    public function update($id): void
    {
        try {
            $transaction = TransactionQuery::create()->findPk($id);
        } catch (PropelException $propelException) {
            echo $propelException->getMessage();
        }
    }

    public function remove($id): void
    {
        try {
            $transaction = TransactionQuery::create()->findPk($id);
            $transaction->delete();
        } catch (PropelException $propelException) {
            echo $propelException->getMessage();
        }
    }

}
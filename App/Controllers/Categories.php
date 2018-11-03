<?php

namespace App\Controllers;


use App\Models\CategoryQuery;
use Core\Controller;
use Propel\Runtime\Exception\PropelException;

class Categories extends Controller
{
    public function __construct(string $extensionTemplate = "php")
    {
        parent::__construct($extensionTemplate);
    }

    public function index(): void
    {
        try {
            $categories = CategoryQuery::create()->find();
            echo $categories->toJSON();
        } catch (PropelException $propelException) {
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
            $category = CategoryQuery::create()->findPk($id);
        } catch (PropelException $propelException){
            echo $propelException->getMessage();
        }
    }

    public function remove($id): void
    {
        try {
            $category = CategoryQuery::create()->findPk($id);
            $category->delete();
        } catch (PropelException $propelException){
            echo $propelException->getMessage();
        }
    }
}
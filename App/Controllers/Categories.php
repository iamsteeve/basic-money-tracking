<?php

namespace App\Controllers;


use App\Models\Category;
use App\Models\CategoryQuery;
use App\Services\Authentication;
use Core\Controller;
use Core\View;
use Josantonius\Session\Session;
use Propel\Runtime\Exception\PropelException;

class Categories extends Controller
{
    public function __construct(string $extensionTemplate = "php")
    {
        parent::__construct($extensionTemplate);
    }


    public function index(): void
    {
        if(Authentication::isLogged()){
            try {
                $categories = CategoryQuery::create()
                    ->filterByUserId(Session::get("userId"))
                    ->find();
                View::sendActionSessionToView();
                View::setData("title", "Mira todas las Categorías");
                View::setData("categories", $categories);
                View::render("index");

            } catch (PropelException $propelException) {
                echo $propelException->getMessage();
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
                    $category = new Category();
                    $category->setId(null);
                    $category->setName($_POST["name"]);
                    $category->setUserId(Session::get("userId"));
                    $category->save();
                    Session::set('action','Categoría agregada');
                    $this->redirect(array("controller" => "categories"));
                    exit();

                } catch (PropelException $e) {
                    echo $e->getMessage();
                }
            }
            if ($_GET) {
                View::sendActionSessionToView();
                View::setData("title", "Agrega una Categoría");
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

                $category = CategoryQuery::create()
                    ->filterByUserId(Session::get("userId"))
                    ->findPk($id);
                if ($category){
                    if ($_GET) {
                        View::sendActionSessionToView();
                        View::setData("title", "Actualizar categoría");
                        View::setData("category",$category);
                        View::render("update");
                    }
                    if ($_POST) {

                        $category->setName($_POST["name"]);
                        $category->save();
                        Session::set('action', 'Categoría Actualizada');
                        $this->redirect(array("controller" => "categories"));
                        exit();
                    }
                } else {
                    Session::set("action","No se encontró el registo");
                    $this->toLogin();
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
                $category = CategoryQuery::create()
                    ->filterByUserId(Session::get("userId"))
                    ->findPk($id);
                if ($category){
                    $category->delete();
                    Session::set('action', 'Categoría eliminada');
                    $this->redirect(array("controller" => "categories"));
                    exit();
                } else {
                    Session::set("action", "No existe el registo");
                    $this->redirect(array("controller" => "categories"));
                    exit();
                }
            } catch (PropelException $exception) {
                echo $exception->getMessage();
            }
        } else {
            $this->toLogin();
        }
    }
}
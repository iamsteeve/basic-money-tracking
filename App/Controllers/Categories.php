<?php

namespace App\Controllers;


use App\Models\Category;
use App\Models\CategoryQuery;
use App\Services\Authentication;
use App\Services\Sanatize;
use Core\Controller;
use Core\View;
use Josantonius\Session\Session;
use Propel\Runtime\Exception\PropelException;
use Valitron\Validator;

class Categories extends Controller
{
    public function __construct(string $extensionTemplate = "php")
    {
        parent::__construct($extensionTemplate);
    }


    public function index(): void
    {
        if(Authentication::isLogged() && (Authentication::checkUniqueRole("user") || Authentication::checkUniqueRole("admin"))){
            try {
                $categories = CategoryQuery::create()
                    ->filterByUserId(Session::get("userId"))
                    ->find();
                View::sendActionSessionToView();
                View::setData("title", "Mira todas las Categorías");
                View::setData("categories", $categories);
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
                        $category = new Category();
                        $category->setId(null);
                        $category->setName(Sanatize::sanitizeText($_POST["name"]));
                        $category->setUserId(Session::get("userId"));
                        $category->save();
                        Session::set('action','Categoría agregada');
                        $this->redirect(array("controller" => "categories"));
                        exit();

                    } catch (PropelException $e) {
                        Session::set("action", "No se ha podido agregar la categoría");
                        $this->toMain();
                    }
                } else {
                    Session::set("action", "Nombre es requerido");
                    $this->redirect(array("controller" => "categories", "action" => "add"));
                    exit();
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
        if (Authentication::isLogged() && (Authentication::checkUniqueRole("user") || Authentication::checkUniqueRole("admin"))){
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
                        $v = new Validator($_POST);
                        $v->rule('required', ['name']);
                        if($v->validate()) {
                            $category->setName(Sanatize::sanitizeText($_POST['name']));
                            $category->save();
                            Session::set('action', 'Categoría Actualizada');
                            $this->redirect(array("controller" => "categories"));
                            exit();
                        } else {
                            Session::set("action", "Nombre es requerido");
                            $this->redirect(array("controller" => "categories", "action" => "update/".$id));
                            exit();
                        }

                    }
                } else {
                    Session::set("action","No se encontró el registo");
                    $this->toLogin();
                }
            } catch (PropelException $propelException) {
                Session::set("action", "No se ha podido actualizar el registro");
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
                Session::set("action", "No se ha podido eliminar la categoría");
                $this->toMain();
            }
        } else {
            $this->toLogin();
        }
    }
}
<?php

namespace App\Controllers;


use Core\Controller;
use Core\View;

class Accounts extends Controller
{

    public function __construct(string $extensionTemplate = "php")
    {
        parent::__construct($extensionTemplate);
    }

    public function index(): void
    {
        View::setData("title", "Mira tus Cuentas");
        View::sendSessionToView();
        View::render("index");
    }

    public function add(): void
    {
        echo "<h1>Add</h1>";
    }
    public function update(): void
    {
        echo "<h1>Update</h1>";
    }

    public function remove(): void
    {
        echo "<h1>Remove</h1>";
    }
}
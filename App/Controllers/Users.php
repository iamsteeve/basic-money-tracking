<?php

namespace App\Controllers;


use Core\Controller;

class Users extends Controller
{
    public function __construct(string $extensionTemplate = "php")
    {
        parent::__construct($extensionTemplate);
    }

    public function index(): void
    {
        echo "<h1>Users</h1>";
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
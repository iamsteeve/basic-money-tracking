<?php

namespace Core;


abstract class Controller
{
    public function __construct()
    {

    }

    public abstract function index();
}
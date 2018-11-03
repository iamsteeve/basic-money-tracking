<?php

namespace Core;


abstract class Controller
{

    /**
     * @var Request
     */
    private $request;

    public function __construct($extensionTemplate = "php")
    {
        $this->request = new Request();
        View::createEngineOfTemplates($this->request, $extensionTemplate);
    }

    public function redirect($url = array()): void {
        $path = "";
        if ($url["controller"]){
            $path .= $url["controller"];
        }
        if (isset($url["action"])) {
            $path.= "/".$url["action"];
        }

        header("Location: ". APP_URL.$path);

    }

    public abstract function index():void;
}
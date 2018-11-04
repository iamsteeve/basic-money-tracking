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
    public function toLogin(){
        $this->redirect(array("controller"=>"home", "action"=>"login"));
        exit();
    }
    public function toMain(){

        $this->redirect(array("controller" => $this->request->getController()));
        exit();
    }
    public function toDefaultController(){
        $this->redirect(array("controller"=> DEFAULT_CONTROLLER));
        exit();
    }


    public abstract function index():void;
}
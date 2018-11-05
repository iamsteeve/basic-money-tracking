<?php

namespace Core;

/**
 * Class Controller
 * @package Core
 */
abstract class Controller
{

    /**
     * Atributo que contiene la Request del usuario
     * @var Request
     */
    private $request;

    /**
     * Controller constructor.
     * @param string $extensionTemplate
     */
    public function __construct($extensionTemplate = "php")
    {
        $this->request = new Request();
        View::createEngineOfTemplates($this->request, $extensionTemplate);

    }

    /**
     * Método que permite redirigir a una page.
     * @param array $url
     */
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

    /**
     * Método Que redirige a la página Login esto es azucar
     */
    public function toLogin(){
        $this->redirect(array("controller"=>"home", "action"=>"login"));
        exit();
    }

    /**
     * Método que redirige al controlador actual hacia el método index
     */
    public function toMain(){

        $this->redirect(array("controller" => $this->request->getController()));
        exit();
    }

    /**
     * Método que redirige al controlador por default
     */
    public function toDefaultController(){
        $this->redirect(array("controller"=> DEFAULT_CONTROLLER));
        exit();
    }


    /**
     * Método principal de un controlador
     */
    public abstract function index():void;
}
<?php

namespace Core;

use App\Services\Authentication;
use Josantonius\Session\Session;
use League\Plates\Engine;

class View
{
    private static $_data = array();
    /**
     * @var Engine
     */
    private static $_templates;
    private static $_controller;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    static public function createEngineOfTemplates(Request $request, $extensionTemplate = "php"): void
    {
        self::$_controller = $request->getController();
        $layoutPath = VIEWS_FOLDER . "layouts" . DS . DEFAULT_LAYOUT;
        $controllerPath = VIEWS_FOLDER . self::$_controller;

        self::$_templates = new Engine(VIEWS_FOLDER, $extensionTemplate);
        self::$_templates->addFolder("layouts", $layoutPath);
        self::$_templates->addFolder(self::$_controller, $controllerPath);

    }

    static public function renderErrorController(string $title = "error", string $errorMessage = "Ha sucedido un error", string $extensionTemplate = "php"): string
    {
        $layoutPath = VIEWS_FOLDER . "layouts" . DS . DEFAULT_LAYOUT;
        self::$_templates = new Engine(VIEWS_FOLDER, $extensionTemplate);
        self::$_templates->addFolder("layouts", $layoutPath);
        self::$_templates->addFolder("errors", VIEWS_FOLDER . "errors");
        $template = self::$_templates->make("errors::index");
        $template->data(["message" => $errorMessage, "title" => $title]);
        self::$_templates->addData(['isLogged' => Authentication::isLogged()], 'layouts::header');
        try {
            return $template->render();
        } catch (\Throwable $e) {
            return $e->getMessage();
        }
    }

    static public function loadExtension($extension): void
    {
        self::$_templates->loadExtension($extension);
    }

    static public function sendActionSessionToView(): void
    {
        if (Session::get('action')) {
            self::$_templates->addData(['action' => Session::get('action')], 'layouts::base');
            Session::set('action', false);
        }

        self::$_templates->addData(['isLogged' => Authentication::isLogged()], 'layouts::header');
        self::$_templates->addData(['userId' => Authentication::getUserId()], 'layouts::header');
        self::$_templates->addData(['userName' => Authentication::getUserName()], 'layouts::header');
        self::$_templates->addData(['email' => Authentication::getEmail()], 'layouts::header');

    }

    static public function setData(string $name, $value): void
    {
        self::$_data[$name] = $value;
    }

    static public function render(string $view): void
    {
        $renderString = self::$_controller . "::" . $view;
        ob_start();
        echo self::$_templates->render(
            $renderString,
            self::$_data
        );
    }


}
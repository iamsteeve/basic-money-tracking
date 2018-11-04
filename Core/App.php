<?php

namespace Core;

use App\Services\Authentication;
use Josantonius\Session\Session;


class App
{


    const NAMESPACE_CONTROLLERS = "\App\Controllers\\";


    const DIRECTORY_CONTROLLERS = ROOT . "App" . DS . "Controllers" . DS;

    public static function run(Request $request)
    {
        Session::init();
        $pathController = self::DIRECTORY_CONTROLLERS . ucfirst($request->getController()) . ".php";
        $method = $request->getMethod();
        $args = $request->getArgs();

        if (is_readable($pathController)) {

            $fullClass = self::NAMESPACE_CONTROLLERS . ucfirst($request->getController());
            $controller = new $fullClass;
            if (is_callable(array($controller, $method))) {
                $method = $request->getMethod();
            } else {
                $method = "index";
            }
            if (isset($args)) {
                call_user_func_array(array($controller, $method), $request->getArgs());
            } else {
                call_user_func(array($controller, $method));
            }
        } else {
            throw new \Exception("Página no encontrada");
        }

    }
}
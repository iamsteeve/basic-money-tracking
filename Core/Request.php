<?php

namespace Core;

/**
 * Objeto que se encarga de obtener la URL introducida por el cliente
 * @package Core
 */
class Request
{
    /**
     * Controlador en la url
     * @var string
     */
    private $_controller;
    /**
     * Método de la url
     * @var string
     */
    private $_method;
    /**
     * Argumentos de la url
     * @var array
     */
    private $_args;

    /**
     * Request constructor
     * Parsea la URL y luego utiliza los elementos del Array para asignarlos a las propiedades del objeto
     * finalmente verifica si una URL no tiene controladores, métodos o argumentos y asigna por default
     */
    public function __construct()
    {
        $url = $this->parseUrl();
        $url = array_filter($url);
        $this->_controller = strtolower(array_shift($url));
        $this->_method = strtolower(array_shift($url));
        $this->_args = $url;
        $this->verifyUrl();

    }

    /**
     * Verfica si hay asignado algun controlador, método o argumentos.
     */
    private function verifyUrl(): void
    {
        if (!$this->_controller) {
            $this->_controller = DEFAULT_CONTROLLER;
        }
        if (!$this->_method) {
            $this->_method = "index";
        }
        if (!$this->_args) {
            $this->_args = [];
        }
    }

    /**
     * Parsea la url en trozos en array
     * @return array
     */
    private function parseUrl(): array
    {
        if (isset($_GET['url'])) {
            $url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL);
            return $url = explode("/", $url);
        }
        return [];
    }

    /**
     * Obtiene el controlador de la URL
     * @return string
     */
    public function getController(): string
    {
        return $this->_controller;
    }

    /**
     * Obtiene el método de la URL
     * @return string
     */
    public function getMethod(): string
    {
        return $this->_method;
    }


    /**
     * Obtiene los argumentos de una URL
     * @return array
     */
    public function getArgs(): array
    {
        return $this->_args;
    }


}
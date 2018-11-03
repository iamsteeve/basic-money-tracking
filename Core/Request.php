<?php

namespace Core;


class Request
{

    private $_controller;

    private $_method;

    private $_args;

    public function __construct()
    {
        $url = $this->parseUrl();
        $url = array_filter($url);
        $this->_controller = strtolower(array_shift($url));
        $this->_method = strtolower(array_shift($url));
        $this->_args = $url;
        $this->verifyUrl();

    }


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


    private function parseUrl(): array
    {
        if (isset($_GET['url'])) {
            $url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL);
            return $url = explode("/", $url);
        }
        return [];
    }


    public function getController(): string
    {
        return $this->_controller;
    }

    public function getMethod(): string
    {
        return $this->_method;
    }

    public function getArgs(): array
    {
        return $this->_args;
    }


}
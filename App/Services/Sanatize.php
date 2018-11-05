<?php

namespace App\Services;

/**
 * Class Sanatize
 * @package App\Services
 */
class Sanatize {

    /**
     * Permite evitar la creación de un objeto
     * Sanatize constructor.
     */
    private function __construct()
    {}

    /**
     * Permite evitar la clonación
     */
    private function __clone()
    {}

    /**
     * Este método retorna el correo sanado
     * @param $email
     * @return string
     */
    public static function isEmail($email): string {
        return filter_var($email, FILTER_SANITIZE_EMAIL);

    }

    /**
     * Este método sana una cadena de texto y elimina los espacios en blanco a los lados
     * @param $string
     * @return string
     */
    public static function sanitizeText($string): string {
        return trim(filter_var($string, FILTER_SANITIZE_SPECIAL_CHARS));
    }
}
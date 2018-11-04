<?php

namespace App\Services;


class Sanatize {

    private function __construct()
    {}
    private function __clone()
    {}

    public static function isEmail($email): string {
        return filter_var($email, FILTER_SANITIZE_EMAIL);

    }
    public static function sanitizeText($string): string {
        return trim(filter_var($string, FILTER_SANITIZE_SPECIAL_CHARS));
    }
}
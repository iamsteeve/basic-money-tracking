<?php


namespace App\Services;

use Josantonius\Session\Session;
class Authentication
{
    private function __construct()
    {}
    private function __clone()
    {}

    public static function isLogged(): bool {
        return Session::get('logged') ? true : false;
    }

    public static function signIn(string $userName, int $userId , string $rol, string $email, int $lifetime = 0 ): bool {
        try {
            return Session::set("userName", $userName) && Session::set("userId", $userId) && Session::set("role", $rol) && Session::set("email", $email) && Session::set("logged", true) ? true : false;
        }catch (\Exception $exception){
            return false;
        }
    }
    public static function getEmail(){
        return Session::get('email');
    }
    public static function getUserName(){
        return Session::get('userName');
    }
    public static function getUserId(){
        return Session::get('userId');
    }

    public static function logOut(): bool {
        try {
            return Session::set("userName", null)&& Session::set("userId", null) && Session::set("role", null) && Session::set("logged", false) ? true : false;
        } catch (\Exception $exception) {
            return false;
        }
    }
    public static function checkUniqueRole(string $role){
        return Session::get("role") === $role ? true : false;
    }


}
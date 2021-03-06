<?php


namespace App\Services;

use Josantonius\Session\Session;

/**
 * Class Authentication
 * @package App\Services
 */
class Authentication
{
    /**
     * Authentication constructor.
     * Sirve para Prohibir la creación del objeto
     */
    private function __construct()
    {}

    /**
     * Sirve para prohibir la clonación del objeto
     */
    private function __clone()
    {}

    /**
     * Devuelve si el usuario está logeado
     * @return bool
     */
    public static function isLogged(): bool {
        return Session::get('logged') ? true : false;
    }

    /**
     * Permite iniciar sesión en la aplicación
     * @param string $userName
     * @param int $userId
     * @param string $rol
     * @param string $email
     * @param int $lifetime
     * @return bool
     */
    public static function signIn(string $userName, int $userId , string $rol, string $email, int $lifetime = 0 ): bool {
        try {
            return Session::set("userName", $userName) && Session::set("userId", $userId) && Session::set("role", $rol) && Session::set("email", $email) && Session::set("logged", true) ? true : false;
        }catch (\Exception $exception){
            return false;
        }
    }

    /**
     * Devuelve el Correo del usuario actual
     * @return mixed|null
     */
    public static function getEmail(){
        return Session::get('email');
    }

    /**
     * Devuelve el UserName del usuario actual
     * @return mixed|null
     */
    public static function getUserName(){
        return Session::get('userName');
    }

    /**
     * Devuelve el UserID del usuario Actual
     * @return mixed|null
     */
    public static function getUserId(){
        return Session::get('userId');
    }

    /**
     * Permite cerrar sesión y retorna si se pudo cerrar la sesión
     * @return bool
     */
    public static function logOut(): bool {
        try {
            return Session::set("userName", null)&& Session::set("userId", null) && Session::set("role", null)&& Session::set("email", null) && Session::set("logged", false) ? true : false;
        } catch (\Exception $exception) {
            return false;
        }
    }

    /**
     * Verifica si el rol del usuario actual es igual al rol permitido y devuelve verdadero si contiene el rol
     * @param string $role
     * @return bool
     */
    public static function checkUniqueRole(string $role){
        return Session::get("role") === $role ? true : false;
    }


}
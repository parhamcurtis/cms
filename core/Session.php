<?php 
namespace Core;
use Core\Request;

class Session {

    public static function exists($name) {
        return isset($_SESSION[$name]);
    }

    public static function set($name, $value) {
        $_SESSION[$name] = $value;
    }

    public static function get($name) {
        if(self::exists($name) && !empty($_SESSION[$name])) {
            return $_SESSION[$name];
        }
        return false;
    }

    public static function delete($name) {
        unset($_SESSION[$name]);
    }

    public static function createCsrfToken(){
        $token = md5('csrf'.time());
        self::set('csrfToken', $token);
        return $token;
    }

    public static function csrfCheck(){
        $request = new Request();
        $check = $request->get('csrfToken');
        if(self::exists('csrfToken') && self::get('csrfToken') == $check){
            return true;
        }
        Router::redirect('auth/badToken');
    }
}
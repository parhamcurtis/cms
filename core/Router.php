<?php 

namespace Core;

use Core\Session;
use App\Models\Users;

class Router {

    public static function route($url) {
        $urlParts = explode('/', $url);
        
        // set controller
        $controller = !empty($urlParts[0])? $urlParts[0] : Config::get('default_controller');
        $controllerName = $controller;
        $controller = '\App\Controllers\\' . ucwords($controller) . 'Controller';

        // set action 
        array_shift($urlParts);
        $action = !empty($urlParts[0])? $urlParts[0] : 'index';
        $actionName = $action;
        $action .= "Action";
        array_shift($urlParts);

        if(!class_exists($controller)) {
            throw new \Exception("The controller \"{$controller}\" does not exist.");
        }
        $controllerClass = new $controller($controllerName, $actionName);

        if(!method_exists($controllerClass, $action)) {
            throw new \Exception("The method \"{$action}\" does not exist on the \"{$controller}\" controller.");
        }
        call_user_func_array([$controllerClass, $action], $urlParts);
    }

    public static function redirect($location) {
        if(!headers_sent()) {
            header('Location: ' . ROOT . $location);
        } else {
            echo '<script type="text/javascript">';
            echo 'window.location.href = "'. ROOT . $location .'"';
            echo '</script>';
            echo '<nosript>';
            echo '<meta http-equiv="refresh" content="0;url=' . ROOT . $location . '" />';
            echo '</nosript>';
        }
        exit();
    }

    public static function permRedirect($perm, $redirect, $msg = "You do not have access to this page.") {
        $user = Users::getCurrentUser();
        $allowed = $user && $user->hasPermission($perm);
        if(!$allowed) {
            Session::msg($msg);
            self::redirect($redirect);
        } 
    }
}
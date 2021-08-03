<?php 

namespace Core;

use App\Controllers\BlogController;

class Router {

    public static function route($url) {
        $controller = new BlogController('Blog', 'indexAction');

    }
}
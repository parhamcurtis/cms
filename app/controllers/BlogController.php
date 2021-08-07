<?php 

namespace App\Controllers;

use Core\{DB, Controller, H};

class BlogController extends Controller {

    public function indexAction(){
        $db = DB::getInstance();
        $this->view->setSiteTitle('Newest Articles');
        $this->view->render();
    }
    
}

<?php 

namespace App\Controllers;

use Core\Controller;

class BlogController extends Controller {

    public function indexAction($param1, $param2){
        die("You made it to the index action! {$param1} {$param2}");
    }

    public function fooAction(){
        die("You made it to the foo action!");
    }
    
}

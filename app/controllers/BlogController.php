<?php 

namespace App\Controllers;

use Core\{DB, Controller, H};

class BlogController extends Controller {

    public function indexAction(){
        $db = DB::getInstance();
        // $sql = "INSERT INTO articles (`title`, `body`) VALUES (:title, :body)";
        // $bind = ['title' => 'new article', 'body' => 'article body'];
        // $query = $db->execute($sql, $bind);
        // $lastId = $query->lastInsertId();
        // $db->insert('articles', ['title' => 'article', 'body' => 'body of article']);
        $db->update('articles', ['user_id' => 1], ['id' => 12]);
        // $sql = "SELECT * FROM articles";
        // $query = $db->query($sql);
        // $articles = $query->results();
        // $count = $query->lastInsertId();
        // H::dnd($count);
        $this->view->setSiteTitle('Newest Articles');
        $this->view->render();
    }
    
}

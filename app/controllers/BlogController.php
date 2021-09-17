<?php 

namespace App\Controllers;

use Core\{DB, Controller, H, Router, Session};
use App\Models\{Articles, Categories, Users};

class BlogController extends Controller {

    public function indexAction(){
        $params = [
            'columns' => "articles.*, users.fname, users.lname, categories.name as category, categories.id as category_id",
            'conditions' => "articles.status = :status",
            'bind' => ['status' => 'public'], 
            'joins' => [
                ['users','articles.user_id = users.id'],
                ['categories', 'articles.category_id = categories.id', 'categories', 'LEFT']
            ],
            'order' => 'articles.id DESC'
        ];
        $params = Articles::mergeWithPagination($params);
        $this->view->articles = Articles::find($params);
        $this->view->total = Articles::findTotal($params);
        $this->view->heading = "New Articles";
        $this->view->setSiteTitle('Newest Articles');
        $this->view->render();
    }

    public function categoryAction($categoryId) {
        $params = [
            'columns' => "articles.*, users.fname, users.lname, categories.name as category, categories.id as category_id",
            'conditions' => "articles.category_id = :catId AND articles.status = :status",
            'bind' => ['status' => 'public', 'catId' => $categoryId], 
            'joins' => [
                ['users','articles.user_id = users.id'],
                ['categories', 'articles.category_id = categories.id', 'categories', 'LEFT']
            ],
            'order' => 'articles.id DESC'
        ];
        $params = Articles::mergeWithPagination($params);
        if($categoryId == 0) {
            $category = new Categories();
            $category->id = 0;
            $category->name = "Uncategorized";
        } else {
            $category = Categories::findById($categoryId);
        }
        if(!$category) {
            Session::msg('That category does not exist', 'warning');
            Router::redirect('');
        }
        $this->view->articles = Articles::find($params);
        $this->view->total = Articles::findTotal($params);
        $this->view->heading = "Category: {$category->name}";
        $this->view->setSiteTitle('Newest Articles');
        $this->view->render('blog/index');
    }

    public function authorAction($authorId) {
        $author = Users::findById($authorId);
        if(!$author) {
            Session::msg("That author does not exist.", 'warning');
            Router::redirect('');
        }
        $params = [
            'columns' => "articles.*, users.fname, users.lname, categories.name as category, categories.id as category_id",
            'conditions' => "user_id = :authorId AND articles.status = :status",
            'bind' => ['authorId' => $authorId, 'status' => 'public'], 
            'joins' => [
                ['users','articles.user_id = users.id'],
                ['categories', 'articles.category_id = categories.id', 'categories', 'LEFT']
            ],
            'order' => 'articles.id DESC'
        ];
        $params = Articles::mergeWithPagination($params);
        $this->view->articles = Articles::find($params);
        $this->view->total = Articles::findTotal($params);
        $this->view->heading = "Author: {$author->displayName()}";
        $this->view->setSiteTitle('Newest Articles');
        $this->view->render('blog/index');
    }

    public function detailsAction($id) {
        $params = [
            'columns' => "articles.*, users.fname, users.lname, category.name as category, category.id as category_id",
            'conditions' => "articles.id = :id AND articles.status = 'public'",
            'joins' => [
                ['users', 'users.id = articles.user_id'], 
                ['categories', 'category.id = articles.category_id', 'category', 'LEFT']
            ],
            'bind' => ['id' => $id]
        ];
        $article = Articles::findFirst($params);
        if(!$article) Router::redirect('blog/articleNotFound');
        if(empty($article->category_id)) {
            $article->category_id = 0;
            $article->category = "Uncategorized";
        }
        $this->view->article = $article;
        $this->view->render();
    }

    public function articleNotFoundAction(){
        $this->view->render();
    }
    
}

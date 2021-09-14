<?php 
namespace App\Controllers;
use Core\{Controller, Session, Router, H};
use App\Models\{Users, Categories, Articles};

class AdminController extends Controller {

    public function onConstruct(){
        $this->view->setLayout('admin');
        $this->currentUser = Users::getCurrentUser();
    }

    public function articlesAction() {
        Router::permRedirect(['author','admin'], 'blog/index');
        $this->view->render();
    }

    public function articleAction($id = 'new') {
        $params = [
            'conditions' => "id = :id AND user_id = :user_id",
            'bind' => ['id' => $id, 'user_id' => $this->currentUser->id]
        ];
        $article = $id == 'new'? new Articles() : Articles::findFirst($params);
        if(!$article){
            Session::msg("You do not have permission to edit this article");
            Router::redirect('admin/articles');
        }

        $categories = Categories::find(['order' => 'name']);
        $catOptions = [0 => 'Uncategorized'];
        foreach($categories as $category) {
            $catOptions[$category->id] = $category->name;
        }

        if($this->request->isPost()) {
            Session::csrfCheck();
            $article->user_id = $this->currentUser->id;
            $article->title = $this->request->get('title');
            $article->body = $this->request->get('body');
            $article->status = $this->request->get('status');
            $article->category_id = $this->request->get('category_id');
            if($article->save()) {
                Session::msg("{$article->title} saved.", 'success');
                Router::redirect('admin/articles');
            }
        }

        $this->view->article = $article;
        $this->view->statusOptions = ['private' => 'Private', 'public' => 'Public'];
        $this->view->categoryOptions = $catOptions;
        $this->view->errors = $article->getErrors();
        $this->view->heading = $id === 'new'? "Add Article" : "Edit Article";
        $this->view->render();
    }

    public function usersAction() {
        Router::permRedirect('admin', 'admin/articles');
        $params = ['order' => 'lname, fname'];
        $params = Users::mergeWithPagination($params);
        $this->view->users = Users::find($params);
        $this->view->total = Users::findTotal($params);
        $this->view->render();
    }

    public function toggleBlockUserAction($userId) {
        Router::permRedirect('admin', 'admin/articles');
        $user = Users::findById($userId);
        if($user) {
            $user->blocked = $user->blocked? 0 : 1;
            $user->save();
            $msg = $user->blocked? "User blocked." : "User unblocked.";
        }
        Session::msg($msg, 'success');
        Router::redirect('admin/users');
    }

    public function deleteUserAction($userId) {
        Router::permRedirect('admin', 'admin/articles');
        $user = Users::findById($userId);
        $msgType = 'danger';
        $msg = 'User cannot be deleted';
        if($user && $user->id !== Users::getCurrentUser()->id){
            $user->delete();
            $msgType = 'success';
            $msg = 'User deleted';
        }
        Session::msg($msg, $msgType);
        Router::redirect('admin/users');
    }

    public function categoriesAction() {
        Router::permRedirect('admin', 'admin/articles');
        $params = ['order' => 'name'];
        $params = Categories::mergeWithPagination($params);
        $this->view->categories = Categories::find($params);
        $this->view->total = Categories::findTotal($params);
        $this->view->render();
    }

    public function categoryAction($id = 'new') {
        Router::permRedirect('admin', 'admin/articles');
        $category = $id == 'new'? new Categories() : Categories::findById($id);
        if(!$category){
            Session::msg("Category does not exist.");
            Router::redirect('admin/categories');
        }

        if($this->request->isPost()) {
            Session::csrfCheck();
            $category->name = $this->request->get('name');
            if($category->save()) {
                Session::msg('Category Saved!', 'success');
                Router::redirect('admin/categories');
            }
        }

        $this->view->category = $category;
        $this->view->heading = $id == 'new'? "Add Category" : "Edit Category";
        $this->view->errors = $category->getErrors();
        $this->view->render();
    }

    public function deleteCategoryAction($id) {
        Router::permRedirect('admin', 'admin/articles');
        $category = Categories::findById($id);
        if(!$category) {
            Session::msg("That category does not exist");
            Router::redirect('admin/categories');
        } else {
            $category->delete();
            Session::msg("Category Deleted.", 'success');
            Router::redirect('admin/categories');
        }
    }

}
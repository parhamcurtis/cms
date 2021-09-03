<?php 
namespace App\Controllers;
use Core\{Controller, Session, Router};
use App\Models\{Users};

class AdminController extends Controller {

    public function onConstruct(){
        $this->view->setLayout('admin');
        $this->currentUser = Users::getCurrentUser();
    }

    public function articlesAction() {
        $this->view->render();
    }

    public function usersAction() {
        $allowed = $this->currentUser->hasPermission('admin');
        if(!$allowed) {
            Session::msg("You do not have access to this page.");
            Router::redirect('admin/articles');
        }
        $params = ['order' => 'lname, fname'];
        $this->view->users = Users::find($params);
        $this->view->total = Users::findTotal($params);
        $this->view->render();
    }
}
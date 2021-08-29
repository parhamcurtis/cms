<?php 
namespace App\Controllers;

use Core\{Controller, H, Session, Router};
use App\Models\Users;

class AuthController extends Controller {
    
    public function registerAction($id = 'new') {
        if($id == 'new') {
            $user = new Users();
        } else {
            $user = Users::findById($id);
        }

        if(!$user) {
            Session::msg("You do not have permission to edit this user");
            Router::redirect('blog/index');
        }

        // if posted
        if($this->request->isPost()){
            Session::csrfCheck();
            $fields = ['fname', 'lname', 'email', 'acl', 'password', 'confirm'];
            foreach($fields as $field) {
                $user->{$field} = $this->request->get($field);
            }
            if($id != 'new' && !empty($user->password)) {
                $user->resetPassword = true;
            }
            if($user->save()) {
                $msg = ($id == 'new')? "User Created." : "User Updated";
                Session::msg($msg, 'success');
                Router::redirect('blog/index');
            }
            
        }
        $this->view->header = $id == 'new'? 'Add User' : 'Edit User';
        $this->view->user = $user;
        $this->view->role_options = ['' => '', Users::AUTHOR_PERMISSION => 'Author', Users::ADMIN_PERMISSION => 'Admin'];
        $this->view->errors = $user->getErrors();
        $this->view->render();
    }
}
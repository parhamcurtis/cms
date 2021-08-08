<?php 
namespace App\Models;

use Core\Model;

class Users extends Model {
    protected static $table = "users";
    public $id, $created_at, $updated_at, $fname, $lname, $email, $password, $acl, $blocked = 0, $confirm, $remember = '';


    const AUTHOR_PERMISSION = 'author';
    const ADMIN_PERMISSION = 'admin';
}
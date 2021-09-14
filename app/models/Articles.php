<?php 
namespace App\Models;
use Core\Model;
use Core\Validators\RequiredValidator;

class Articles extends Model {
    protected static $table = "articles";
    public $id, $created_at, $updated_at, $user_id, $title, $body, $img, $status = 'private', $category_id = 0;

    public function beforeSave() {
        $this->timeStamps();
        $this->runValidation(new RequiredValidator($this, ['field' => 'title', 'msg' => 'Title is a required field']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'body', 'msg' => 'Body is a required field.']));
    }
}

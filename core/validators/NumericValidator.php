<?php 
namespace Core\Validators;
use Core\Validators\Validator;

class NumericValidator extends Validator {

    public function runValidation(){
        $value = $this->_obj->{$this->field};
        $pass = true;
        if(!empty($value)) {
            $pass = is_numeric($value);
        }
        return $pass;
    }
}
<?php 
namespace Core\Validators;
use Core\Validators\Validator;

class RequiredValidator extends Validator {
    public function runValidation() {
        $value = trim($this->_obj->{$this->field});
        $passes = $value != '' && isset($value);
        return $passes;
    }
}
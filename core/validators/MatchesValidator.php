<?php 
namespace Core\Validators;
use Core\Validators\Validator;

class MatchesValidator extends Validator {
    public function runValidation() {
        $value = $this->_obj->{$this->field};
        return $value == $this->rule;
    }
}
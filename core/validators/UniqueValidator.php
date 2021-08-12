<?php 
namespace Core\Validators;
use Core\Validators\Validator;

class UniqueValidator extends Validator {

    public function runValidation(){
        $value = $this->_obj->{$this->field};
        if($value == '' || !isset($value)) {
            return true;
        }

        $conditions = "{$this->field} = :{$this->field}";
        $bind = [$this->field => $value];

        //check updating record 
        if(!$this->_obj->isNew()) {
            $conditions .= " AND id != :id";
            $bind['id'] = $this->_obj->id;
        }

        //this allows you to check multiple fields for unique
        foreach($this->additionalFieldData as $adds) {
            $conditions .= " AND {$adds} = :{$adds}";
            $bind[$adds] = $this->_obj->{$adds};
        }

        $queryParams = ['conditions' => $conditions, 'bind' => $bind];

        $exists = $this->_obj::findFirst($queryParams);

        return !$exists;
    }
}
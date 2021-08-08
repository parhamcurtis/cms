<?php 
namespace Core;

class Request {

    public function isPost() {
        return $this->getRequestMethod() === 'POST';
    }

    public function isPut(){
        return $this->getRequestMethod() === 'PUT';
    }

    public function isGet(){
        return $this->getRequestMethod() === 'GET';
    }

    public function isDelete(){
        return $this->getRequestMethod() === 'DELETE';
    }

    public function isPatch(){
        return $this->getRequestMethod() === 'PATCH';
    }

    public function getRequestMethod(){
        return strtoupper($_SERVER['REQUEST_METHOD']);
    }

    public function get($input = false) {
        if(!$input) {
            $data = [];
            foreach($_REQUEST as $field => $value) {
                $data[$field] = self::sanitize($value);
            }
            return $data;
        }
        return array_key_exists($input, $_REQUEST)? self::sanitize($_REQUEST[$input]) : false;
    }

    public static function sanitize($dirty) {
        return htmlentities(trim($dirty), ENT_QUOTES, "UTF-8");
    }

}
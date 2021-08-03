<?php 
namespace Core;

class Controller {
    private $_controllerName, $_actionName;
    public $view, $request;

    public function __construct($controller, $action) {
        $this->_controllerName = $controller;
        $this->_actionName = $action;
        var_dump($controller);
    }
}
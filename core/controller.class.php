<?php
namespace Trainingskalender\core;

class Controller{
    private $controllerName;
    private $actionName;
    protected $_params = [];

    public function __construct($controller, $action)
    {
        $this->controllerName=$controller;
        $this->actionName=$action;
    }

    public function renderHTML(){

        $viewPath=$this->viewPath();

        $body='';
        if (file_exists($viewPath)){
            
            ob_start();
            include $viewPath;
            $body=ob_get_clean();
        }

        include __DIR__.'/../views/layout.php';
    }

    protected function viewPath(){

        return __DIR__ . '/../views/'. $this->controllerName.'/'.$this->actionName.'.php';
    }
}
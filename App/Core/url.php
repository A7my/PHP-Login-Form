<?php

namespace AMZ\CORE;

class url{

    private $controller;
    private $action;

    function __construct(){
        $this->url();
        $this->dispatch();
    }


    function url(){
        $url = $_SERVER['REQUEST_URI'];
        $url = explode("/" , $url);


        $controller = isset($url[5]) ? $url[5] : "main";
        $action = isset($url[6]) ? $url[6] : "dashboard" ;

        if($controller == NULL){
            $controller = "main";
        }

        $this->controller = $controller;
        $this->action = $action;
    }

    function dispatch(){
        $this->controller = "AMZ\CONTROLLER\\" . $this->controller . "Controller";

        if(!class_exists($this->controller)){
            $this->controller = "AMZ\CONTROLLER\\errorController";
            $this->action = "error";
        }
        $obj = new $this->controller;

        if(!method_exists($obj , $this->action)){
            $this->action = "error";
        }

        $controller = $this->controller;
        $action = $this->action;


        $obj->$action();

    }
}
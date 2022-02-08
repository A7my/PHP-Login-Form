<?php


namespace AMZ\CONTROLLER;

class errorController{

    function error(){
        $this->view("Error/error");
    }

    function view($x){
        require "C:\\xampp\htdocs\Programming\\03 - MVC\Project_06\App\View\\" . $x . ".php";
    }
}
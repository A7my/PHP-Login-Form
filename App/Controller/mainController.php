<?php


namespace AMZ\CONTROLLER;
use AMZ\MODEL\mainModel;
class mainController extends errorController{
    
    
    function dashboard(){
        
        session_start();
        if(empty($_SESSION['DATA'])){
            header("LOCATION:main/signup");
        }else{
            $this->view("Dashboard/dashboard");
        }
    }
    function login(){
        session_start();
        $this->view("Dashboard/login");
        if($_SESSION['DATA'] != NULL){
            header("LOCATION:dashboard");
        }
    }

    function signup(){
        $this->view("Dashboard/signup");
    }

    function signup_req(){
        
        $name  = $_POST['name'];
        $pass  = $_POST['pass'];
        $mail  = $_POST['mail'];
        $phone = $_POST['phone'];
        $new = new mainModel;
        $new->user_signup($name , $mail , $pass , $phone);
        header("LOCATION: login");
    }

    function login_req(){
        
        $mail = $_POST['mail'];
        $pass = $_POST['pass'];
        $new = new mainModel;
        $new->user_login($mail , $pass);
        if(isset($_SESSION["DATA"])){
            header("LOCATION: dashboard");
        }else{
            session_start();
            $_SESSION['error'] = "incorrect mail or password Or you've to sign up";
            header("LOCATION:login");
            
        }
    }

    function logout(){
        session_start();
        session_destroy();
        header("LOCATION:login");

    }
}
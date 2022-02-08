<?php


spl_autoload_register(function($x){
    $x = dirname(__FILE__) . "\\". $x . ".php";
    $x = str_replace("AMZ\CORE\\" , "" , $x);
    $x = str_replace("AMZ\CONTROLLER\\" , "" , $x);
    $x = str_replace("AMZ\MODEL\\" , "" , $x);

    $F1 = str_replace("Core" , "Controller" , $x);
    $F2 = str_replace("Core" , "Model" , $x);
    

    if(file_exists($x)){
        require $x;
    }else if(file_exists($F1)){
        require $F1;
    }else if(file_exists($F2)){
        require $F2;
        
    }
});
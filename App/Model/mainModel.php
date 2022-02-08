<?php

namespace AMZ\MODEL;
use PDO;

class mainModel extends dbModel{

    function user_signup($name , $mail , $pass , $phone){
        $this->insert("user" , ["Name" => $name , "Mail" => $mail , "Password" => $pass , "Phone" => $phone]);
    }

    function user_login($mail , $pass){
        $this->select("user" , $mail , $pass);
    }
}



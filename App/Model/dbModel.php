<?php

namespace AMZ\MODEL;
use PDO;

class dbModel{
    private $dns = "mysql:host=localhost;dbname=cms";
    protected $con;

    function __construct(){
        $this->con = new PDO($this->dns , "root" , "");
    }

    function insert($table , $data){
        $table = $table;
        $act = "INSERT INTO `$table` ( ";
        foreach ($data as $k => $v){
            $act .= "`$k`" . ',';
        }
        $act = rtrim($act , ",");
        $act .= ") VALUES (";
        foreach($data as $k => $v){
            $act .= ":$k,";
        }
        $act = rtrim($act , ",");
        $act .= ")";
        
        $prep = $this->con->prepare($act);
        $prep->execute($data);
    }

    function delete($table , $data){
        $table = $table;
        $act  = "DELETE FROM `$table` WHERE `Id` = :Id";
        $prep = $this->con->prepare($act);
        $prep->execute($data);
    }

    function update($table , $data){
        $table = $table;
        $act = "UPDATE `$table` SET  ";
        foreach($data as $k => $v){
            if($k != 'Id'){
                $act .= "`$k` = :$k ,"; 
            }
        }
        $act = rtrim($act , ",");
        $act .= "WHERE `Id` = :Id";
        $prep = $this->con->prepare($act);
        $prep->execute($data);
    }

    function select($table , $mail, $pass){
        $table = $table;
        $act   = "SELECT * FROM `$table` WHERE `Mail` = '$mail' AND `Password` = '$pass'";
        $fetch = $this->con->query($act);
        $arr   = $fetch->fetch(PDO::FETCH_ASSOC);

        if(!empty($arr)){
            session_start();
            session_destroy();
            session_start();
            $_SESSION['DATA'] = $arr;
        }
    }
}
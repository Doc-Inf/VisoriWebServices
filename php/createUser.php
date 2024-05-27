<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    require 'functions.php';

    if(!isset($_POST['cognome']) || !isset($_POST['nome']) || !isset($_POST['email']) || !isset($_POST['password'])){
        $result = <<<res
            {
                "result" : "error",
                "error" : "missing post data"
            }
        res;
        echo $result; 
    }else{
        if(isset($_SESSION['user'])){
            //$user = json_decode($_SESSION['user'],true);
            $cognome = $_POST['cognome'];
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $hashPassword = hash("sha256",$password);
            $sql = <<<sql
                INSERT INTO Utente(nome,cognome,email,password) VALUES (?,?,?,?)
            sql;
            $params = [$nome,$cognome,$email, $hashPassword];
            $response = "";
            $result = "";
            try{
                $result = $db->dmlCommand($sql, $params);
                if($result){
                    $response = <<<res
                    {
                        "result" : "success",
                        "error" : ""
                    }
                    res;
                }else{
                    $response = <<<res
                    {
                        "result" : "failure",
                        "error" : "no exception"
                    }
                    res;
                }
            }catch(Exception $e){
                $errorMessage = $e->getMessage();
                $response = <<<res
                {
                    "result" : "error",
                    "error" : "$errorMessage"
                }
                res;
            }
            echo $response;
        }else{
            $result = <<<res
            {
                "result" : "error",
                "error" : "effettuare prima il login"
            }
            res;
            echo $result; 
        }        
        
    }

?>
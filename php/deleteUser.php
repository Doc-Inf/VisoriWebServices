<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    require 'functions.php';

    if(!isset($_POST['cognome']) || !isset($_POST['nome']) ){
        echo jsonResult("error","missing post data"); 
    }else{
        if(isset($_SESSION['user'])){
            //$user = json_decode($_SESSION['user'],true);
            $cognome = $_POST['cognome'];
            $nome = $_POST['nome'];
            
            $sql = <<<sql
                SELECT id FROM Utente WHERE LOWER(cognome) = LOWER(?) AND LOWER(nome) = LOWER(?);
            sql;
            $params = [$cognome,$nome];
            try{

                $result = $db->query($sql, $params);

                if(isset($result[0])){
                    $row = $result[0];
                    if(isset($row['id'])){
                        $id = $row['id'];
                        $sql = <<<sql
                            DELETE FROM Utente WHERE id = ?;
                        sql;
                        $params = [$id];
                        
                        $result = "";
                    
                        $result = $db->dmlCommand($sql, $params);
                        if($result){
                            echo jsonResult("success",""); 
                        }else{
                            echo jsonResult("error","delete failed unknown reason"); 
                        }
                    }else{
                        echo jsonResult("error","missing id"); 
                    }
                }else{
                    echo jsonResult("error","user not found");
                }
               
            }catch(Exception $e){
                $errorMessage = $e->getMessage();
                echo jsonResult("error","$errorMessage"); 
            }
           
        }else{
            echo jsonResult("error","effettuare prima il login"); 
        }        
        
    }

    function jsonResult($risultato,$errore=""){
        $result = <<<json
        {
            "result" : $risultato,
            "error" : $errore
        }
        json;
        return $result;
    }
?>
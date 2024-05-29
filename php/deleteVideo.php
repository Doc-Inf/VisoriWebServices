<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    require 'functions.php';

    if( !isset($_POST['titolo']) || !isset($_POST['autore'])){
        echo jsonResult("error","missing post data"); 
    }else{
        if(isset($_SESSION['user'])){
            
            $titolo = $_POST['titolo'];
            $autore = $_POST['autore'];
            
            $sql = <<<sql
                SELECT id FROM Video WHERE LOWER(titolo) = LOWER(?) AND LOWER(autore) = LOWER(?);
            sql;
            $params = [$titolo,$autore];
            try{

                $result = $db->query($sql, $params);

                if(isset($result[0])){
                    $row = $result[0];
                    if(isset($row['id'])){
                        $id = $row['id'];
                        $sql = <<<sql
                            DELETE FROM Video WHERE id = ?;
                        sql;
                        $params = [$id];
                        
                        $result = "";
                    
                        $result = $db->dmlCommand($sql, $params);
                        if($result){
                            echo jsonResult("success",""); 
                            $sql = <<<sql
                                DELETE FROM Argomento WHERE id NOT IN (
                                    SELECT argomento
                                    FROM ArgomentoVideo
                                );
                            sql;
                            $result = $db->dmlCommand($sql);
                            $sql = <<<sql
                                DELETE FROM Materia WHERE id NOT IN (
                                    SELECT materia
                                    FROM Argomento
                                );
                            sql;
                            $result = $db->dmlCommand($sql);

                        }else{
                            echo jsonResult("error","delete failed unknown reason"); 
                        }
                    }else{
                        echo jsonResult("error","missing id"); 
                    }
                }else{
                    echo jsonResult("error","Video not found");
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
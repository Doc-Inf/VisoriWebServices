<?php
    
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    require_once 'functions.php';

    if(!isset($_POST['email']) || !isset($_POST['password'])){
        $user = <<<json
            {
                "nome" : "",
                "cognome" : "",
                "email" : "",
                "sessionID" : "",
                "access" : "denied"
            }
            json;
            echo $user;
    }else{
        $email = $_POST['email'];
        $password = $_POST['password'];
        $hashPassword = hash("sha256",$password);
        $sql = <<<SQL
                    SELECT *
                    FROM Utente u
                    WHERE u.email = ? AND u.password = ?;
                SQL;
        $params = [$email, $hashPassword];
        $result = $db->query($sql, $params);
        if(count($result) > 0){
            $datiUtente = $result[0];
            $nomeUtente = $datiUtente['nome'];
            $cognomeUtente = $datiUtente['cognome'];
            $emailUtente = $datiUtente['email'];
            $sessionID = session_id();
            $user = <<<json
            {
                "nome" : "$nomeUtente",
                "cognome" : "$cognomeUtente",
                "email" : "$emailUtente",
                "sessionID" : "$sessionID",
                "access" : "granted"
            }
            json;
            $_SESSION['user'] = $user;
            echo $user;
        }else{
            $user = <<<json
            {
                "nome" : "",
                "cognome" : "",
                "email" : "",
                "sessionID" : "",
                "access" : "denied"
            }
            json;
            echo $user;
        }
    }

?>
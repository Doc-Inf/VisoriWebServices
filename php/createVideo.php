<?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    require 'functions.php';

    /*
        Video(titolo, descrizione, autore, durata, image, link, lingua)
        Materia(nome)
        Argomento(nome,materia)
        ArgomentoVideo(video,argomento)        
    */
    if( isset($_SESSION['user'])){
        if( !ricevutiDatiPost() ){
            $result = jsonResult("error","missing post data");
            echo $result; 
        }else{
            $db->beginTransaction();
            
            $titolo = $_POST['titolo'];
            $descrizione = $_POST['descrizione']; 
            $autore = $_POST['autore'];
            $durata = $_POST['durata'];
            $image = $_POST['image'];
            $link = $_POST['link'];
            $lingua = $_POST['lingua'];
            $materia= $_POST['materia'];
            $argomento = $_POST['argomento'];
    
            $risultati = [];
    
            /* Inserimento materia se non presente */
            $materiaID = inserisciMateria($materia, $risultati);
            if($materiaID >= 0){
                /* Inserimento argomento se non presente */
                $argomentoID = inserisciArgomento($argomento, $materiaID, $risultati);
                if($argomentoID >= 0){
                    /* Inserimento del nuovo Video */
                    $videoID = inserisciVideo($titolo,$descrizione,$autore,$durata,
                                                $image,$link,$lingua,$risultati);
                    if($videoID >=0 ){
                        /* Inserimento dell'argomento al video */
                        inserisciArgomentoVideo($videoID,$argomentoID,$risultati);
                    }
                }
            }     
            
            echo json_encode($risultati);
        }
    }else{
        echo jsonResult("failure",$errore="Effettuare il login prima");
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

    function ricevutiDatiPost(){
        return isset($_POST['titolo']) && isset($_POST['descrizione']) && 
        isset($_POST['autore']) && isset($_POST['durata']) && 
        isset($_POST['image']) && isset($_POST['link']) &&
        isset($_POST['lingua']) && isset($_POST['materia']) &&
        isset($_POST['argomento']);
    }

    function inserisciMateria($materia, &$risultati){
        global $db;
        try{
            $result = $db->query("SELECT m.id, m.nome FROM Materia m WHERE m.nome=?",[$materia]);
            $materiaID = -1;
            $risultatoInserimentoMateria = "";

            if(count($result)>0){
                $materiaID = $result[0]['id'];
                $risultatoInserimentoMateria = jsonResult("error","inserimento di una nuova materia fallito, materia già presente");
            }else{
                $sql = <<<sql
                    INSERT INTO Materia(nome) VALUES (?);
                sql;
                $result = $db->dmlCommand($sql,[$materia]);            
                
                if($result){
                    $materiaID = $db->lastInsertId();
                    $risultatoInserimentoMateria = jsonResult("success");
                }else{
                    $risultatoInserimentoMateria = jsonResult("error","inserimento di una nuova materia fallito");
                    $db->rollback();
                }            
            }
        }catch(Exception $e){
            echo "Errore: " . $e->getMessage();
            $errorMessage = $e->getMessage();
            $risultatoInserimentoArgomento = jsonResult("error","inserimento di una nuova materia fallita Errore: " . $errorMessage);
            $db->rollback();
        }
        $risultati["Inserimento materia"] = $risultatoInserimentoMateria;
        return $materiaID;
    }

    function inserisciArgomento($argomento,$materiaID,&$risultati){
        global $db;
        try{
            $result = $db->query("SELECT a.id, a.nome FROM Argomento a WHERE a.nome=?",[$argomento]);
            $argomentoID = -1;
            $risultatoInserimentoArgomento = "";

            if(count($result)>0){
                $argomentoID = $result[0]['id'];
                $risultatoInserimentoArgomento = jsonResult("error","inserimento di un nuovo argomento fallito");
            }else{
                $sql = <<<sql
                    INSERT INTO Argomento(nome,materia) VALUES (?,?);
                sql;
                $result = $db->dmlCommand($sql,[$argomento,$materiaID]);            
                
                if($result){
                    $argomentoID = $db->lastInsertId();
                    $risultatoInserimentoArgomento = jsonResult("success");
                }else{
                    $risultatoInserimentoArgomento = jsonResult("error","inserimento di un nuovo argomento fallito");
                    $db->rollback();
                }            
            }
            
        }catch(Exception $e){
            echo "Errore: " . $e->getMessage();
            $errorMessage = $e->getMessage();
            $risultatoInserimentoArgomento = jsonResult("error","inserimento di un nuovo argomento fallito Errore: " . $errorMessage);
            $db->rollback();
        }
        $risultati["Inserimento argomento"] = $risultatoInserimentoArgomento;
        return $argomentoID;
    }

    function inserisciVideo($titolo,$descrizione,$autore,$durata,$image,$link,$lingua,&$risultati){
        global $db;
        try{
            $sql = <<<sql
                INSERT INTO Video(titolo, descrizione, autore, durata, image, link, lingua)
                VALUES (?,?,?,?,?,?,?)
            sql;
            $result = $db->dmlCommand($sql, [$titolo,$descrizione,$autore,$durata,$image,$link,$lingua]);
            $videoID = -1;
            if($result){
                $videoID = $db->lastInsertId();
                $risultatoInserimentoVideo = jsonResult("success");
            }else{
                $risultatoInserimentoVideo = jsonResult("error","inserimento di un nuovo video fallito");
                $db->rollback();
            }
        }catch(Exception $e){
            echo "Errore: " . $e->getMessage();
            $errorMessage = $e->getMessage();
            $risultatoInserimentoArgomento = jsonResult("error","inserimento di un nuovo video fallito Errore: " . $errorMessage);
            $db->rollback();
        }
        $risultati["Inserimento video"] = $risultatoInserimentoVideo;
        return $videoID;
    }

    function inserisciArgomentoVideo($videoID,$argomentoID,&$risultati){
        global $db;
        try{
            $risultatoInserimentoArgomentoVideo = "";
            if($videoID >= 0 && $argomentoID >= 0){
                $sql = <<<sql
                INSERT INTO ArgomentoVideo(video,argomento)
                VALUES (?,?)
                sql;
                $result = $db->dmlCommand($sql, [$videoID,$argomentoID]);
                
                if($result){                
                    $risultatoInserimentoArgomentoVideo = jsonResult("success");
                    $db->commit();
                }else{
                    $risultatoInserimentoArgomentoVideo = jsonResult("error","inserimento di un nuovo argomentoVideo fallito");
                    $db->rollback();
                }
            }else{
                $risultatoInserimentoArgomentoVideo = jsonResult("error","inserimento di un nuovo argomentoVideo fallito, mancano gli id o del video o dell'argomento");
                $db->rollback();
            }
        }catch(Exception $e){
            echo "Errore: " . $e->getMessage();
            $errorMessage = $e->getMessage();
            $risultatoInserimentoArgomento = jsonResult("error","inserimento di un nuovo argomentovideo fallito Errore: " . $errorMessage);
            $db->rollback();
        }
        $risultati["Inserimento argomento video"] = $risultatoInserimentoArgomentoVideo;
    }
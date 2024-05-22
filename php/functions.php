<?php
    require_once __DIR__ . "/DB/DB.php";
        
    $config = getConfig();
    
    if($config->database->dbLibrary === "pdo"){
        require_once __DIR__ . "/DB/PdoConnection.php";
        $db = new PdoConnection($config->database->hostname,$config->database->username,$config->database->password,$config->database->port,$config->database->dbname,$config->database->dbmsName);
    }else{
        if($config->database->dbLibrary === "mysqli"){
            require_once __DIR__ . "/DB/MySqliConnection.php";
            $db = new MySqliConnection($config->database->hostname,$config->database->username,$config->database->password,$config->database->dbname,$config->database->port);
        }else{
            die("Errore configurazione: la libreria specificata nel file di configurazione, per connettersi al DBMS non è valida");
        }
    }
      
    
    function getConfig(string $PathToConfigJson =__DIR__ . "/../config.json") {        
        for($i=0; $i<10; $i++){
            $confData = file_get_contents($PathToConfigJson);
            if(!$confData){
                $PathToConfigJson = "../" . $PathToConfigJson;
            }else{
                break;
            }
        }       
        return json_decode($confData);
    }

    function searchVideo($db, $materia = null, $argomento = null){
        $res = null;
        $sql = "";
        if($materia==null && $argomento==null){
            $sql = "SELECT * FROM Video;";            
        }else{
            if($materia!=null && $argomento==null){                
                $sql = <<<SQL
                    SELECT DISTINCT v.*
                    FROM Video v JOIN ArgomentoVideo av ON av.video=v.id 
                        JOIN Argomento a ON av.argomento=a.id JOIN Materia m 
                        ON m.id= a.materia
                    WHERE LOWER(m.nome) LIKE LOWER('%$materia%');
                SQL;
            }else{
                if($materia==null && $argomento!=null){
                    $argomentoShort = substr($argomento,0,(strlen($argomento)-1));
                    $sql = <<<SQL
                        SELECT DISTINCT v.*
                        FROM Video v JOIN ArgomentoVideo av ON av.video=v.id 
                            JOIN Argomento a ON av.argomento=a.id 
                        WHERE LOWER(a.nome) LIKE LOWER('%$argomentoShort%');
                    SQL;
                }else{
                    $sql = <<<SQL
                        SELECT DISTINCT v.*
                        FROM Video v JOIN ArgomentoVideo av ON av.video=v.id 
                            JOIN Argomento a ON av.argomento=a.id JOIN Materia m 
                            ON m.id= a.materia
                        WHERE LOWER(m.nome) LIKE LOWER('%$materia%') AND LOWER(a.nome) LIKE LOWER('%$argomento%');
                    SQL;
                }
            }
        }

        $res = $db->query($sql);
        return $res;
    }
   

    function getMaterie($db){
        $res = null;
        $sql = <<<s
            SELECT *
            FROM Materia m;
        s;
        $res = $db->query($sql);
        return $res;
    }

    function getArgomenti($db){
        $res = null;
        $sql = <<<s
            SELECT a.id,a.nome as 'nomeArgomento',m.nome as 'materia', a.materia as 'idMateria'
            FROM Argomento a JOIN Materia m ON a.materia=m.id;
        s;
        $res = $db->query($sql);
        return $res;
    }
?>
<?php
    require_once 'functions.php';

    $dati = [];

    if(isset($_GET['getMaterie']) || isset($_GET['getArgomenti'])){
        if(isset($_GET['getMaterie'])){
            $dati = getMaterie($db);
        }else{
            $dati = getArgomenti($db);
        }

    }else{
        $video = [];
        if(isset($_GET['materia'])){
            $materia = $_GET['materia'];
            if(isset($_GET['argomento'])){
                $argomento = $_GET['argomento'];
                $dati = searchVideo($db, $materia, $argomento);
            }else{
                $dati = searchVideo($db, $materia);
            }
        }else{
            if(isset($_GET['argomento'])){
                $argomento = $_GET['argomento'];
                $dati = searchVideo($db, null, $argomento);
            }else{
                $dati = searchVideo($db);
            }
        }       
    }
    
    header('Content-type: application/json');
    echo json_encode($dati, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
?>

<?php
    require_once 'functions.php';

    $video = [];
    if(isset($_GET['materia'])){
        $materia = $_GET['materia'];
        if(isset($_GET['argomento'])){
            $argomento = $_GET['argomento'];
            $video = searchVideo($db, $materia, $argomento);
        }else{
            $video = searchVideo($db, $materia);
        }
    }else{
        if(isset($_GET['argomento'])){
            $argomento = $_GET['argomento'];
            $video = searchVideo($db, null, $argomento);
        }else{
            $video = searchVideo($db);
        }
    }
    
    header('Content-type: application/json');
    //print_r($video);
    
    echo json_encode($video, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

?>

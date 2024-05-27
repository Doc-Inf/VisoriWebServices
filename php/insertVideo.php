<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="stile.css">
</head>
<body>
    <?php require './navbar.php'; ?>
    <h1>Inserisci un nuovo Video</h1>
    
    <form action="insertVideo.php" method="POST">
        <label for="titolo">Titolo: </label><input id="titolo" type="text" name="titolo" required><br>
        <label for="descrizione">Descrizione: </label><input id="descrizione" type="text" name="descrizione" required><br>
        <label for="autore">Autore: </label><input id="autore" type="text" name="autore" required><br>
        <label for="durata">Durata: </label><input id="durata" type="text" name="durata" required><br>
        <label for="image">Image: </label><input id="image" type="text" name="image" required><br>
        <label for="link">Link: </label><input id="link" type="text" name="link" required><br>
        <label for="lingua">Lingua: </label><input id="lingua" type="text" name="lingua" required><br>
        <label for="materia">Materia: </label><input id="materia" type="text" name="materia" required><br>
        <label for="argomento">Argomento: </label><input id="argomento" type="text" name="argomento" required><br>
        
        <input type="submit" value="Registra">
    </form>
    <?php
        if( isset($_POST['titolo']) && isset($_POST['descrizione']) && 
            isset($_POST['autore']) && isset($_POST['durata']) &&
            isset($_POST['image']) && isset($_POST['link']) &&
            isset($_POST['lingua']) && isset($_POST['materia']) &&
            isset($_POST['argomento']) 
            ){
            require_once './createVideo.php';
        }
    ?>
</body>
</html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="stile.css">
</head>
<body>
    <?php require './navbar.php'; ?>
    <h1>Rimuovi un Video</h1>
    <form action="removeVideo.php" method="POST">
        <label for="titolo">Titolo: </label><input id="titolo" type="text" name="titolo" required><br>
        <label for="autore">Autore: </label><input id="autore" type="text" name="autore" ><br>
        <input type="submit" value="Remove">
    </form>
    <?php
        if(isset($_POST['titolo']) && isset($_POST['autore'])){
            require_once './deleteVideo.php';
        }
    ?>
</body>
</html>
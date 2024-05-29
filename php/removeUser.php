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
    <h1>Rimuovi un utente</h1>
    <form action="removeUser.php" method="POST">
        <label for="nome">Nome: </label><input id="nome" type="text" name="nome" required><br>
        <label for="cognome">Cognome: </label><input id="cognome" type="text" name="cognome" required><br>
        <input type="submit" value="Remove">
    </form>
    <?php
        if(isset($_POST['nome']) && isset($_POST['cognome'])){
            require_once './deleteUser.php';
        }
    ?>
</body>
</html>
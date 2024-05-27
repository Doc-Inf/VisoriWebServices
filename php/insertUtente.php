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
    <h1>Crea un nuovo utente</h1>
    <form action="insertUtente.php" method="POST">
    <label for="nome">Nome: </label><input id="nome" type="text" name="nome" required><br>
    <label for="cognome">Cognome: </label><input id="cognome" type="text" name="cognome" required><br>
        <label for="email">Email: </label><input id="email" type="email" name="email" required><br>
        <label for="password">Password: </label><input id="password" type="password" name="password" min-length="8" required><br>
        <input type="submit" value="Registra">
    </form>
    <?php
        if(isset($_POST['nome']) && isset($_POST['cognome']) && isset($_POST['email']) && isset($_POST['password'])){
            require_once './createUser.php';
        }
    ?>
</body>
</html>
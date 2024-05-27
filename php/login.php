<?php session_start() ?>
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
    <h1>Login</h1>
    <form action="login.php" method="POST">
        <label for="email">Email: </label><input id="email" type="email" name="email" required><br>
        <label for="password">Password: </label><input id="password" type="password" name="password" required><br>
        <input type="submit" value="Login">
    </form>
    <?php
        if(isset($_POST['email']) && isset($_POST['password'])){
            require_once './auth.php';
        }else{
            if(isset($_SESSION['user'])){
                $user = json_decode($_SESSION['user'],true);
                echo "Benvenuto " . $user['cognome'] . " " . $user['nome'] . "<br>";
                echo "Email: " . $user['email'] .  "<br>";
                echo "Session ID: " . $user['sessionID'] .  "<br>";
            }
        }
        
    ?>
</body>
</html>
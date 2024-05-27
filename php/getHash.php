<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    
        if(isset($_GET['password'])){
            $password = $_GET['password'];
            echo "<p>" . hash("sha256",$password) . "</p>";
        }else{ 
    ?>

    <form action="./getHash.php" method="GET">
        <caption>Hash function</caption>
        <label for="password">Password: </label><input id="password" type="password" name="password" required><br>
    </form>

    <?php   }   ?>
</body>
</html>

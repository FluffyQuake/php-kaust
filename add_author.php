<?php

require_once('connection.php');

if (isset($_POST['add_author']) && $_POST['add_author'] == 'Lisa'){
    
    $stmt = $pdo->prepare('INSERT INTO authors (first_name, last_name) VALUES (:first_name, :last_name)');
    $stmt->execute(['first_name' => $_POST['first-name'], 'last_name' => $_POST['last-name']]);
}

var_dump($_POST);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lisa autor</title>
</head>
<body>
    <h2>Uue autori lisamine</h2>
    <form action="add_author.php" method="POST">
        <input type="text" name="first-name" placeholder="Eesnimi">
        <br>
        <input type="text" name="last-name" placeholder="Perenimi">
        <br>
        <input type="submit" name="add_author" value="Lisa">
        <br>
        <input type="button" value="Main page" onclick="location='index.php'" />
    </form>
</body>
</html>
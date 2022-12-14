<?php

require_once('connection.php');

$id = $_GET['id'];

$stmt = $pdo->prepare('SELECT * FROM books WHERE id = :id');
$stmt->execute(['id' => $id]);
$book = $stmt->fetch();

$stmt = $pdo->prepare('SELECT * FROM authors LEFT JOIN book_authors ON authors.id=book_authors.author_id WHERE book_authors.book_id = :id');
$stmt->execute(['id' => $id]);
// var_dump($book);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$book['title'];?></title>
</head>
<body>
    <h1><?=$book['title'];?></h1>
    <img src="<?=$book['cover_path']?>">
    <br>
    <p><span>Laos:</span> <span><?=$book['stock_saldo'];?></span></p>
    Autorid:
    <?php
    while ($author = $stmt->fetch())
    {
        echo '<li>' .$author['first_name']. '' .$author['last_name'] . '<li>';
    }
    ?>
    <div>
        <span><a href="edit_form.php?id= <?=$id;?>">Muuda</a></span>

        <form action="delete.php" method="POST">
            <input type="hidden" name="id" value="<?=$id?>">
            <input type="submit" value="kustuta" name="delete">
        </form>
    </div>
    <br>
    <input type="button" value="Main page" onclick="location='index.php'" />
</body>
</html>
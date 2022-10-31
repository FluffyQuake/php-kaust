<?php

require_once('connection.php');

$id = $_GET['id'];

if (isset($_POST['edit']) && $_POST['edit'] == 'Salvesta'){
    
    $stmt = $pdo->prepare('UPDATE books SET title = :title, stock_saldo = :stock_saldo WHERE id = :id');
    $stmt->execute(['title' => $_POST['title'], 'stock_saldo' => $_POST['stock-saldo'],'id' =>$id]);

    header('location: book.php?id=' .$id);
}

$stmt = $pdo->prepare('SELECT * FROM books WHERE id = :id');
$stmt->execute(['id' =>$id]);
$book = $stmt->fetch();

// var_dump($book);a
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="edit_form.php?id=<?$id;?>" method="POST">
        <div>
            <label for="title">Pealkiri:</label>
            <input type="text" name="title" value="<?=$book['title'];?>" style="width: 320px;">
        </div>
        <div>
            <label for="title">Laoseis:</label> <input type="text" name="stock-saldo" value="<?=$book['stock_saldo'];?>">
            <input type="submit" value="Salvesta" name="edit">
        </div>
    </form>
</body>
</html>
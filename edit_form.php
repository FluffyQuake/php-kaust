<?php

require_once('connection.php');

$id = $_GET['id'];

if (isset($_POST['edit']) && $_POST['edit'] == 'Salvesta'){
    
    $stmt = $pdo->prepare('UPDATE books SET title = :title, stock_saldo = :stock_saldo WHERE id = :id');
    $stmt->execute(['title' => $_POST['title'], 'stock_saldo' => $_POST['stock-saldo'],'id' =>$id]);

    header('location: book.php?id=' .$id);
}

$stmtBook = $pdo->prepare('SELECT * FROM books WHERE id = :id');
$stmtBook->execute(['id' =>$id]);
$book = $stmtBook->fetch();

$stmtBookAuthors = $pdo->prepare('SELECT * FROM authors LEFT JOIN book_authors ba ON a.id=b.author_id WHERE ba.book_id IS NOT :book_id');
$stmtBookAuthors->execute(['book_id' =>$id]);

$stmtAuthors = $pdo->prepare('SELECT * FROM authors a WHERE a.id NOT IN (SELECT authod_id FROM book_authors WHERE book_id = :book_id)');
$stmtAuthors->execute(['book_id' =>$id]);

// var_dump($book);a
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
    <form action="edit_form.php?id=<?=$id;?>" method="POST">
            <label for="title">Pealkiri:</label><input type="text" name="title" value="<?=$book['title'];?>" style="width: 320px;">
            <br>
            <label for="title">Laoseis:</label> <input type="text" name="stock-saldo" value="<?=$book['stock_saldo'];?>">
            <br>
            <input type="text">
            <input type="submit" value="Salvesta" name="edit">
    </form>
    <script src="app.js"></script>
</body>
</html>
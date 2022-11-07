<?php

require_once('connection.php');

$id = $_GET['id'];

if (isset($_POST['edit']) && $_POST['edit'] == 'Salvesta'){
    
    $stmt = $pdo->prepare('UPDATE books SET title = :title, stock_saldo = :stock_saldo WHERE id = :id');
    $stmt->execute(['title' => $_POST['title'], 'stock_saldo' => $_POST['stock-saldo'],'id' =>$id]);
    
    $stmt = $pdo->prepare('UPDATE book_authors SET author_id = :authord_id WHERE book_id = :book_id');
    $stmt->execute(['author_id' => $_POST['author_id'], 'book_id' =>$id]);

    header('location: book.php?id=' .$id);
}

$stmtBook = $pdo->prepare('SELECT * FROM books b LEFT JOIN book_authors ba ON b.id=ba.book_id WHERE b.id = :id');
$stmtBook->execute(['id' =>$id]);
$book = $stmtBook->fetch();

$stmtAuthors = $pdo->query('SELECT * FROM authors');
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
            <label for="title">Laoseis:</label><input type="text" name="stock-saldo" value="<?=$book['stock_saldo'];?>">
            <br>
            <div style="font-weight: bold;">Autorid</div>

            <select name="author_id">
                <?php while ($author = $stmtAuthors->fetch()) {?>
                    <option value="<?=$author['id'];?>"><?=$author['first_name'];?> <?=$author['last_name'];?>
                        <?=$author['first_name'];?> <?=$author['last_name'];?>
                    </option>
                <?php } ?>
            </select>
            <br>
            <input type="submit" value="Salvesta" name="edit">
    </form>
    <!-- <script src="app.js"></script> -->
</body>
</html>
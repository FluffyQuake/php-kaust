<?php

require_once('connection.php');

$id = $_POST['id'];

$stat = $pdo->prepare('UPDATE books SET is_deleted=1 where id = :id');
$stat->execute(['id' =>$id]);
$book = $stmt->fetch();

var_dump($book);
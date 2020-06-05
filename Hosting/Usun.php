<?php
$conn = new PDO('mysql:host=localhost;dbname=id13934076_blogwedkarskibaza', 'id13934076_blogwedkarski','RYJaq0SJ=&{#\el2');
$sql = 'DELETE FROM wpis WHERE id_wpisu = :ids';
$sth = $conn->prepare($sql);
$sth->execute(array('ids' => $_GET['ids']));
header('location: index.php');
?>
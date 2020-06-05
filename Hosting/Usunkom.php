<?php
$conn = new PDO('mysql:host=localhost;dbname=id13934076_blogwedkarskibaza', 'id13934076_blogwedkarski','RYJaq0SJ=&{#\el2');
$sql = 'DELETE FROM komentarze WHERE id_kom = :ids1';
$sth = $conn->prepare($sql);
$sth->execute(array('ids1' => $_GET['ids1']));
header('location: index.php');
?>
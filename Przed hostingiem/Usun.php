<?php
$conn = new PDO('mysql:host=localhost;dbname=blog_wedkarski', 'root');
$sql = 'DELETE FROM wpis WHERE id_wpisu = :ids';
$sth = $conn->prepare($sql);
$sth->execute(array('ids' => $_GET['ids']));
header('location: index.php');
?>
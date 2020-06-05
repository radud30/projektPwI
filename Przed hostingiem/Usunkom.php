<?php
$conn = new PDO('mysql:host=localhost;dbname=blog_wedkarski', 'root');
$sql = 'DELETE FROM komentarze WHERE id_kom = :ids1';
$sth = $conn->prepare($sql);
$sth->execute(array('ids1' => $_GET['ids1']));
header('location: index.php');
?>
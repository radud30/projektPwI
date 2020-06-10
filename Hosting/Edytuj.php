<?php
session_start();
$conn = new PDO('mysql:host=localhost;dbname=id13934076_blogwedkarskibaza', 'id13934076_blogwedkarski','RYJaq0SJ=&{#\el2');
$conn->exec("SET NAMES utf8");
$sql = "SELECT * FROM wpis WHERE id_wpisu = :ids3";
$sth = $conn->prepare($sql);
$sth->execute(array('ids3' => $_GET['ids3']));

$row = $sth->fetch();
$_SESSION['tytul'] = $row['temat'];
$_SESSION['tresc'] = $row['tresc'];
$_SESSION['zdjecie'] = $row['zdjecie'];
$_SESSION['id_wpis'] = $_GET['ids3'];


header('location: Administrator.php');
?>

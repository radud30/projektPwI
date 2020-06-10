<?php
session_start();
$conn = new PDO('mysql:host=localhost;dbname=id13934076_blogwedkarskibaza', 'id13934076_blogwedkarski','RYJaq0SJ=&{#\el2');
$conn->exec("SET NAMES utf8");

$koment = $_GET['kom'];
$idwpisu = $_GET['custId'];
$idu = $_SESSION['id_uz'];

if(isset($_SESSION['zalogowany'])){
    $query1 = $conn->prepare('INSERT INTO komentrze (id_u,id_w,komentarz) 
                    VALUES ("'.$idu .'","'.$idwpisu.'","'.$koment.'")');
    $query1->execute();
    header('location: index.php');
}
header('location: index.php');
?>
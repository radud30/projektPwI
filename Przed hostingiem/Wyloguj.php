<?php
session_start();
unset($_SESSION['zalogowany']);
$_SESSION['tupu'] = 0;
header('location: index.php');

?>
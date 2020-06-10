<?php
 session_start();
 $conn = new PDO('mysql:host=localhost;dbname=id13934076_blogwedkarskibaza', 'id13934076_blogwedkarski','RYJaq0SJ=&{#\el2');
 
  if(isset($_POST['komentarzyk'])){
        if(isset($_SESSION['zalogowany'])){
        //  $query1 = $conn->prepare('INSERT INTO komentarze (id_u,komentarz) 
        //  VALUES (5,"HOSTING")');
        //  $query1->execute();   
            
        $koment = $_POST['message'];
        $query1 = $conn->prepare('INSERT INTO komentarze (id_u,komentarz) 
        VALUES ("'.$_SESSION['id_uz'].'","'.$koment.'")');
        $query1->execute();
        header('location: index.php');
        }
       
    }
                
?>
<!doctype html>
<html>
    <head>
   	    <meta charset="UTF-8">
    	<title>Główna</title>
        <link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        
    </head>
    <body>
        <header id="naglowek">
            <img src="wedkarz.png" alt="Logo">
            <h1>BLOG WĘDKARSKI</h1>
        </header>
        <nav>
            <ul>
                <li>
                    <a href="index.php">Główna</a>
                </li>
                <li>
                    <a href="Lowiska.php">Łowiska</a>
                </li>
                <li>
                    <a href="Dodatki.php">Dodatki</a>
                </li>
                <li>
                    <a href="Kontakt.php">Kontakt</a>
                </li>
                <li>
                    <?php

                    if(!isset($_SESSION['zalogowany'])){
                       echo '<a href="Zaloguj.php">Zaloguj</a>';
                    }
                    else{
                       echo '<a href="Wyloguj.php">Wyloguj</a>';
                    
                    }
                    
                    if(isset($_SESSION['tupu']) && $_SESSION['tupu'] == 1){
                       echo '/';
                       echo '<a href="Administrator.php">Administrator</a>'; 
                     
                    }else if(isset($_SESSION['zalogowany'])){
                        echo '/';
                        echo '<a href="Profil.php"> '.$_SESSION['username'].'</a>'; 
                       
                    }
                    
                    ?>
                </li>
            </ul>
        </nav>
        
        <main>
        
        <article class="glowna">
            <?php
            
            //RYJaq0SJ=&{#\el2
           
            $conn->exec("SET NAMES utf8");
            $sql = 'SELECT * FROM wpis ORDER BY id_wpisu DESC';
            
            
            
            foreach ($conn->query($sql) as $row) {
                $idwpisu = $row['id_wpisu'];
                echo '<section>';
                echo '<img src='.$row['zdjecie'].' alt="Niepoprawnie wgrane zdjęcie">';
                echo '<h2>'.$row['temat'].'</h2>';
                echo '<p>'.$row['tresc'].'</p><br>';
                
                echo '<hr>';
                echo '<h3>KOMENTARZE DO WPISU:</h3>';
                
                $sql1 = 'SELECT uzytkownicy.login, komentrze.komentarz, komentrze.id_w FROM uzytkownicy, komentrze WHERE komentrze.id_u = uzytkownicy.id_u AND  komentrze.id_w ="'.$idwpisu.'" ';
                
                foreach ($conn->query($sql1) as $row1) {
                echo '<hr>';
                echo '<label for="kto">Kto: </label>';
                echo $row1['login'].'<br><br>';
                echo '<label for="komentarz">Treść: </label>';
                echo $row1['komentarz'].'<br><br>';
                
                }
                
                echo '<form action="Dodajkom.php" method="get">';
                echo '<h3>Napisz komentarz:</h3>';
                echo '<textarea name="kom" rows="5" cols="80">Miejsce na Twój komentarz.</textarea><br><br>';
                echo '<input type="submit" value="DODAJ">';
                echo '<input type="hidden" id="custId" name="custId" value="'.$idwpisu.'">';
                echo '</form>';
                echo '</section>';
                
                 
                
                
            }
           
            
         
            

            ?>
            
        </article>
        <aside class="prawa">
            <h3>
                ZDJECIA DNIA
            </h3>
            <img src="https://undercarp.pl/wp-content/uploads/2017/03/%C5%82owisko-drwinia.png" alt="Zdjecie dnia xd">
            
            <h3>
                MEDIA SPOŁECZNOŚCIOWE
            </h3>
            <div class="icon-bar">
              <a href="https://www.facebook.com/" class="facebook"><i class="fa fa-facebook"></i></a>
              <a href="https://twitter.com/" class="twitter"><i class="fa fa-twitter"></i></a>
              <a href="https://www.google.pl/" class="google"><i class="fa fa-google"></i></a>
              <a href="https://www.youtube.com" class="youtube"><i class="fa fa-youtube"></i></a>
            </div>
           
            
            
        </aside>  
        
        
           
        </main>
        
       
    </body>
</html>

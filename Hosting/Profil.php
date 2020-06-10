<?php
session_start();
 if($_SESSION['tupu'] == 1 ){
     header('location: index.php');
 }
$conn = new PDO('mysql:host=localhost;dbname=id13934076_blogwedkarskibaza', 'id13934076_blogwedkarski','RYJaq0SJ=&{#\el2');
$conn->exec("SET NAMES utf8");

  if(isset($_POST['zhasla'])){
                $haslo1 = hash('sha224', $_POST['haslo']);
                $haslo2 = hash('sha224', $_POST['phaslo']);
                if($haslo1 == $haslo2){
                    $queryed = $conn->prepare('UPDATE uzytkownicy 
                            SET hash = "'.$haslo1.'"
                            WHERE id_u ='.$_SESSION['id_uz']);
                    $queryed->execute();
                    header('location: index.php');
                }
                
            }
            

?>
<!doctype html>
<html>
    <head>
   	    <meta charset="UTF-8">
    	<title>Kontakt</title>
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
                    if($_SESSION['tupu'] == 1){
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
            
            <section>
               <h1>Zmiana hasła</h1>
            </section>
            <section>
                <form method="post">
                <label>Nowe hasło:</label>
                <input type="password" id="haslo" name="haslo" required><br>
                <label>Powtórz hasło:</label>
                <input type="password" id="phaslo" name="phaslo" required><br>
                <input type="submit" name = "zhasla" value="Zmien">
                </form>
                
                <?php
            
            if(isset($haslo1) && $haslo1 != $haslo2){
                    echo '<b id = "blad">Błędne powtórzenie!</b>';
                }
                
            ?>
                
            </section>
            
            
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

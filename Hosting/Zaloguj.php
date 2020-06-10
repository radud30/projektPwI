<?php
session_start();
$blad = false;

$conn = new PDO('mysql:host=localhost;dbname=id13934076_blogwedkarskibaza', 'id13934076_blogwedkarski','RYJaq0SJ=&{#\el2');

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = hash('sha224', $_POST['pwd']);
    
    $query = $conn->prepare('SELECT COUNT("id_u") FROM uzytkownicy WHERE login = "'.$username.'" AND hash = "'.$password.'"');
    $query->execute();
    
    $count = $query->fetchColumn();
    
    if($count == "1"){
        
        $_SESSION['zalogowany'] = true;
        
        $query1 = $conn->prepare('SELECT * FROM uzytkownicy WHERE login = "'.$username.'"');
        $query1->execute();
        $row = $query1->fetch();
        $_SESSION['id_uz'] = $row['id_u'];
        $_SESSION['tupu'] = $row['typ_u'];
        $_SESSION['username'] = $row['login'];

        header('location: index.php');
    }
    else{
         $blad = true;
    }
}

?>
<!doctype html>
<html>
    <head>
   	    <meta charset="UTF-8">
    	<title>Logowanie</title>
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
                     
                    }
                    
                    ?>
                </li>
            </ul>
        </nav>
        
        <main>
        
        <article class="glowna">
            <section>
                <form id = "logowanie" name = "login" method="post">
                  <label for="username">Login:</label>
                  <input type="text" id="username" name="username" required><br><br>
                  <label for="pwd">Hasło:</label>
                  <input type="password" id="pwd" name="pwd" required><br>
                    <?php
                        if($blad == true){
                            echo '<b id = "blad">Niepoprwane dane logowania!</b>';
                        }
                    ?>
                    <br>
                  <input type="submit" name = "login" value="ZALOGUJ">
                </form>
            </section>
            
            <section>
                <i>Nie masz konta? </i>
                <a href="Rejestracja.php">Rerestracja</a>
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

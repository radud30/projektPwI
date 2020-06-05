<!doctype html>
<?php
session_start();
$conn = new PDO('mysql:host=localhost;dbname=blog_wedkarski', 'root');
$_SESSION['kontrolka'] = false;

if(isset($_POST['zarejestruj'])){
    $login = $_POST['username'];
    $haslo = hash('sha224', $_POST['pwd']);
    $mail = $_POST['mail'];
    
    
    $sql1 = 'SELECT * FROM uzytkownicy';
         foreach ($conn->query($sql1) as $row) {
          if($login == $row['login']){
              $_SESSION['kontrolka'] = true;
          }
         }
    
    if($_SESSION['kontrolka'] == false){
        $query2 = $conn->prepare('INSERT INTO uzytkownicy (id_u,login,hash,mail) 
        VALUES ("'.NULL.'","'.$login.'","'. $haslo.'","'.$mail.'")');
        $query2->execute();
        header('location: Zaloguj.php');
    }
    
    
             
}



?>
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
                    
                    ?>
                </li>
            </ul>
        </nav>
        
        <main>
        
        <article class="glowna">
            <section>
                <form id = "logowanie" name = "rejestracja" method="post">
                  <label for="username">Login:</label>
                  <input type="text" id="username" name="username" required><br>
                  <?php
                     if($_SESSION['kontrolka'] == true){
                         echo '<b id = "blad">Taki login już istnieje!</b>';
                     }
                    ?>
                    <br>
                  <label for="pwd">Hasło:</label>
                  <input type="password" id="pwd" name="pwd" required><br><br>
                  <label for="mail">E-mail:</label>
                  <input type="email" id="mail" name="mail" required><br><br>
                  <input type="submit" name = "zarejestruj" value="ZAREJESTRUJ">
                </form>
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

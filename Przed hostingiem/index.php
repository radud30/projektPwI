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
                    session_start();
                    if(!isset($_SESSION['zalogowany'])){
                       echo '<a href="Zaloguj.php">Zaloguj</a>';
                    }
                    else{
                       echo '<a href="Wyloguj.php">Wyloguj</a>';
                    
                    }
                    
                    if($_SESSION['tupu'] == 1){
                       echo '/';
                       echo '<a href="Administrator.php">Administrator</a>'; 
                     
                    }
                    
                    ?>
                </li>
            </ul>
        </nav>
        
        <main>
        
        <article class="glowna">
            <?php
            
            //RYJaq0SJ=&{#\el2
            $conn = new PDO('mysql:host=localhost;dbname=blog_wedkarski', 'root');
            $conn->exec("SET NAMES utf8");
            $sql = 'SELECT * FROM wpis ORDER BY id_wpisu DESC';
            
            foreach ($conn->query($sql) as $row) {
                echo '<section>';
                echo '<img src='.$row['zdjecie'].'>';
                echo '<h2>'.$row['temat'].'</h2>';
                echo '<p>'.$row['tresc'].'</p><br>';
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
            <h3>
                OPINIE I KOMENTARZE:
            </h3>
            
             <form id = "komentarze" method="post">
                 <?php
                 
                if(isset($_POST['komentarzyk'])){
                    if(isset($_SESSION['zalogowany'])){
                    $koment = $_POST['message'];
                    $query1 = $conn->prepare('INSERT INTO komentarze (id_kom,id_u,komentarz) 
                    VALUES ("'.NULL.'","'.$_SESSION['id_uz'].'","'.$koment.'")');
                    $query1->execute();
                    header('location: index.php');
                    }
                   
                }
                 
                    $sql1 = 'SELECT uzytkownicy.login, komentarze.komentarz FROM uzytkownicy, komentarze WHERE komentarze.id_u = uzytkownicy.id_u';
                 echo '<hr>';
                 foreach ($conn->query($sql1) as $row) {
                   echo '<section>';
                   echo '<label for="kto">Kto: </label>';
                   echo $row['login'].'<br><br>';
                   echo '<label for="komentarz">Treść: </label>';
                   echo $row['komentarz'].'<br><br>';
                   echo '<hr>';
                   echo '</section>';

                }
       
                 
                 
                 ?>
                  
                  <h3>Napisz komentarz:</h3>
                  <textarea name="message" rows="5" cols="40">Miejsce na Twój komentarz.</textarea><br><br>
                  <input type="submit" name ="komentarzyk" value="DODAJ">
                </form>
            

            
            
        </aside>  
        
        
           
        </main>
        
       
    </body>
</html>

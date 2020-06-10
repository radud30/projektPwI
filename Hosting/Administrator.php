<?php
session_start();
$conn = new PDO('mysql:host=localhost;dbname=id13934076_blogwedkarskibaza', 'id13934076_blogwedkarski','RYJaq0SJ=&{#\el2');
                     $conn->exec("SET NAMES utf8");
 if($_SESSION['tupu'] != 1){
     header('location: index.php');
 }
 
 if(isset($_POST['dodajwpis'])){
                    $tytul = $_POST['tytul'];
                    $tresc = $_POST['tresc'];
                    $link = $_POST['link'];

                 
                    
                   $query1 = $conn->prepare('INSERT INTO wpis (id_u,temat,tresc,zdjecie) 
                    VALUES ("'.$_SESSION['id_uz'].'","'.$tytul.'","'.$tresc.'","'.$link.'")');
                    $query1->execute();
                    
                    header('location: index.php');          
                   
                }
if(isset($_POST['edyt'])){
                    $tytuledytuj = $_POST['tytuledytuj'];
                    $trescedytuj = $_POST['trescedytuj'];
                    $linkedytuj = $_POST['linkedytuj'];
                    // echo $_SESSION['id_wpis'];
                    
                    $queryed = $conn->prepare('UPDATE wpis 
                            SET temat = "'.$tytuledytuj.'", tresc = "'.$trescedytuj.'", zdjecie = "'.$linkedytuj.'"
                            WHERE id_wpisu ='.$_SESSION['id_wpis']);
                    $queryed->execute();
                     
                    unset($_SESSION['tytul']);
                    unset($_SESSION['tresc']);
                    unset($_SESSION['zdjecie']);
                    
                    header('location: index.php');
                 }

?>
<!doctype html>
<html>
    <head>
   	    <meta charset="UTF-8">
    	<title>Administrator</title>
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
                <H3>
                    Dodawanie wpisu na blogu:
                </H3>
         
                  <form id = "wpis" method="post">
                 <?php
                      
                     
                      
                
                
                
                 ?>
                  <label for="tytul">Tytuł:</label>
                  <input type="text" id="tytul" name="tytul" required><br>
                      
                  <textarea name="tresc" rows="7" cols="130">Treść.</textarea><br><br>
                      
                  <label for="tytul">Link do zdjęcia:</label>
                  <input type="text" id="link" name="link" required><br>
                      
                  <input type="submit" name ="dodajwpis" value="DODAJ">
                </form>
                
            </section>
            <section>
                <H3>
                    Usuwanie wpisów na blogu:
                </H3>
           
                <form action="Usun.php" method="get">
                    <select id="ids" name="ids">
                        <?php
                        
                        $sql = "SELECT * FROM wpis";
                        foreach ($conn->query($sql) as $row) {
                            echo "<option value=".$row['id_wpisu'].">".$row['temat']."</option>";
                        }
                        ?>
                    </select>
                    <input type="submit" value="USUŃ">
                    </form>
            </section>
              
            <section>
                <H3>
                    Usuwanie komentarzy na blogu:
                </H3>
            
            <form action="Usunkom.php" method="get">
                    <select id="ids1" name="ids1">
                        <?php
                        
                        $sql = "SELECT * FROM komentrze";
                        foreach ($conn->query($sql) as $row) {
                            echo "<option value=".$row['id'].">".$row['komentarz']."</option>";
                        }
                        ?>
                    </select>
                    <input type="submit" value="USUŃ">
             </form>

        </section> 
        <section>
                <H3>
                    Edycja wpisu na blogu:
                </H3>
            
             <form action="Edytuj.php" method="get">
                    <select id="ids3" name="ids3">
                        <?php
                        
                        $sql = "SELECT * FROM wpis";
                        foreach ($conn->query($sql) as $row) {
                            echo "<option value=".$row['id_wpisu'].">".$row['temat']."</option>";
                        }
                        
                        
                        
                        ?>
                    </select>
                    <input type="submit"  value="Wyświetl">
                    </form>
                    
                <?php
             
             if(isset($_SESSION['tytul'])){
                 echo '<form id = "edycja" method="post">';
                 echo '<label for="tytul">Tytuł:</label>';
                 echo '<input type="text" id="tytuledytuj" name="tytuledytuj" value ="'.$_SESSION['tytul'].'" required><br>';
                 echo '<textarea name="trescedytuj" rows="7" cols="130">'.$_SESSION['tresc'].'</textarea><br><br>';
                 echo '<label for="tytul">Link do zdjęcia:</label>';
                 echo '<input type="text" id="linkedytuj" name="linkedytuj" value ="'.$_SESSION['zdjecie'].'" required><br>';
                 echo '<input type="submit" name ="edyt" value="Edytuj">';
                 echo '</form>';
                 
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

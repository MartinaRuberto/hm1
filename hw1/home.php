<!DOCTYPE html>
<?php
session_start();
if(!isset($_SESSION['Username'])){
    header("Location: benvenuto.php");
    exit;
    }
?>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,
    initial-scale=1.0">
    <title>Series Now</title>
    <link rel="stylesheet" href="home.css">
    <script src='home.js' defer></script>
</head>

<body>
    <header>
        <nav>
            <div id="Logo">
                Series Now
              </div>

              <div id="link">
                <a  href="logout.php">Esci</a>
                <a  href="lista.php">La mia lista</a>
                <a  href="preferiti.php">Preferiti</a>
              </div>

               <div id="menu" >
                  <div></div>
                  <div></div>
                  <div></div>

              </div>  

                  <div class="links_mobile" class="hidden">
                       <a  href="logout.php">Esci</a>
                       <a  href="lista.php">La mia lista</a>
                       <a  href="preferiti.php">Preferiti</a>
                  
              </div>
        </nav>

        <div id="info">
            
            <h1>Benvenuto. <?php echo($_SESSION['Username']) ?></h1> 
            <h2>Goditi lo spettacolo<br> </h2>
            <a  class="button" href="inizia.php">Inizia</a>
        </div>
           
    </header>

    <section>

    <p>Le serie Tv piu viste </p>
    <div class="container_movie">
         
    </div>

    <p>Nuove Uscite</p>
    <div class="container_movie2">
         
        
    </div>

    </section>

    
</body>
</html>

    <footer>
       <address> Fondatore: Ruberto Martina</address>
       <p> 1000004205</p>
     
    </footer>

   </body>
   </html>
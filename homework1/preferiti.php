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
    <script src='preferiti.js' defer></script>
</head>

<body>
    <header>
        <nav>
            <div id="Logo">
                Series Now
              </div>

              <div id="link">
                <a  href="logout.php">Esci</a>
                <a  href="inizia.php">Cerca</a>
                <a  href="lista.php">La mia lista</a>
                <a  href="home.php">Home</a>

              </div>


              <div id="menu" >
                  <div></div>
                  <div></div>
                  <div></div>

              </div>  

                  <div class="links_mobile" class="hidden">
                       <a  href="logout.php">Esci</a>
                       <a  href="lista.php">La mia lista</a>
                       <a  href="inizia.php">Cerca</a>
                       <a  href="home.php">Home</a>
                  
              </div>
        </nav>

           
    </header>

    <section>

    <p>Le tue serie preferite</p>
    <div class="container_movie">
         
    </div> 

    </section>

    

    <footer>
       <address> Fondatore: Ruberto Martina</address>
       <p> 1000004205</p>
     
    </footer>

   </body>
   </html>
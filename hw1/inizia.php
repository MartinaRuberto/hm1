<!DOCTYPE html>
<?php
if(isset($_SESSION['Username'])){
    header("Location: home.php");
    exit;
}
?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,
    initial-scale=1.0">
    <script src="inizia.js" defer="true"></script>
    <link rel="stylesheet" href="cerca_css.css">

</head>
<body>

  <header>
    <nav>
            <div id="Logo">
                Series Now
              </div>

              <div id="link">
                <a  href="logout.php">Esci</a>
                <a  href="lista.php">La tua lista</a>
                <a  href="preferiti.php">Preferiti</a>
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
                       <a  href="preferiti.php">Preferiti</a>
                       <a  href="home.php">Home</a>
                  
              </div>
        </nav>

        <form class="no_result">
              <h2>Ricerca</h2>
              Inserisci la serie tv che desideri:
              <input type="text" id="series"> 
              <input type="submit"  value="Cerca" >
  
        </form>

    </header>

<div class="container_movie" >
   
</div>

<footer>
       <address> Fondatore: Ruberto Martina</address>
       <p> 1000004205</p>
     
    </footer>
</body>
</html>
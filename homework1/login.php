<!DOCTYPE html>
<?php
include 'dbconfigurazione.php';
if(!empty($_POST["Username" ]) && !empty($_POST["Password"])){
  //connessione
$connessione= mysqli_connect($dbconfigurazione['host'] ,$dbconfigurazione['user'],$dbconfigurazione['password'],$dbconfigurazione['name']);
//vedere se lo username inserito esiste sul database

$username=mysqli_real_escape_string($connessione,$_POST["Username" ]);
$password=mysqli_real_escape_string($connessione,$_POST["Password" ]);

$query="SELECT * FROM users WHERE username = '$username'";
$res= mysqli_query($connessione,$query);
if (mysqli_num_rows($res) > 0)
{
   $row=mysqli_fetch_assoc($res);
   if(password_verify($_POST['Password'],$row['password']))
    {
       session_start();
        $_SESSION['Username']=$username;
        $_SESSION['id']=$row['id'];
        header('Location: home.php');
        mysqli_free_result($res);
        mysqli_close($connessione);
        exit;
    }else{
            $error= "credenziali errate";
         }
      

}else if (isset($_POST["Username"]) || isset($_POST["Password"])) 
   {
        // Se solo uno dei due è impostato
        $error = "Inserisci username e password.";
   }
}
?>

<html>
   <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" href="login.css">
     <script src='login.js' defer></script>
     <title>Series Now - Accedi</title>
   </head>

<body>
 <article>   
 <main class="login"> 
 <h1>Accedi</h1>
 <br>
 <?php
                // Verifica la presenza di errori
                if (isset($error)) {
                    echo "<span class='error'>$error</span>";
                }
                
  ?>
  <br>
  <form id='form' nome='login_form' method='post'>

     <div class="username" >
          <input type="text" name="Username" placeholder="Username">
          <span class="errore"> </span>
       </div>
     <div class="password">
         <input type="password" name="Password" placeholder="Password">
         <span class="error"> </span>
      </div>
     <div>
         <label>&nbsp;<input type="submit" name="Accedi" value="Accedi"> </label>
      </div>
      
  </form>
  
  <div class="signup">Non hai un account? <a href="sigh.php">Iscriviti</a>

</main> 

</article>

</body>

</html>
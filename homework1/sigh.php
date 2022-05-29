<!DOCTYPE html>
<?php
if(isset($_SESSION['username'])){
    header("Location: home.php");
    exit;
}
?>
<?php 
   include 'dbconfigurazione.php';
   if(!empty($_POST["Nome" ]) && !empty($_POST["Cognome" ]) && !empty($_POST["email"])
   && !empty($_POST["Password" ]) && !empty($_POST["Username" ]) && !empty($_POST["Conferma_Password"])){
   
   $error=array();

   $connessione= mysqli_connect($dbconfigurazione['host'] ,$dbconfigurazione['user'],$dbconfigurazione['password'],$dbconfigurazione['name']);
   //vedere se lo username inserito è giusto
   if(!preg_match('/^[a-zA-Z0-9_]{1,15}$/', $_POST["Username"]))
   {
       $error[]= "Username non valido";
   }
   //vedere se gia esiste
   else {
     $username= mysqli_real_escape_string($connessione, $_POST["Username"]);
     $query= "SELECT username FROM users WHERE username= '$username'";
     $res= mysqli_query($connessione,$query);
     if(mysqli_num_rows($res)>0){
       $error[]= "Username già esistente";
     }
   
   }
   $name= mysqli_real_escape_string($connessione, $_POST["Nome"]);
   $surname= mysqli_real_escape_string($connessione, $_POST["Cognome"]);
   $password= mysqli_real_escape_string($connessione, $_POST["Password"]);
   $email= mysqli_real_escape_string($connessione, $_POST["email"]);
   $conferma_password=mysqli_real_escape_string($connessione, $_POST["Conferma_Password"]);
   
    if(strlen($password)<8)
   {
       $error[]= "Almeno 8 caratteri per la Password";
   }

   if(!preg_match('/^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,16}$/', $password))  
    { 
        $error[]= "La password inserita non è valida. Inserire maiuscole, caratteri speciali e numeri";
    } 
    
    if(strcmp($password, $conferma_password) != 0) 
    { 
       $error[] = "La password e la password di conferma non coincidono"; 
    } 

   if(!filter_var($email, FILTER_VALIDATE_EMAIL))
   {
       $error[]= "email non valida";
   }else{

    $query_email = " SELECT email FROM users WHERE email = '".$email."' "; 
    $res_email = mysqli_query($connessione, $query_email); 

     
    if (mysqli_num_rows($res_email) > 0)  
    { 
       $error[] = "L'email inserita è già utilizzata"; 
    } 
} 
   
   if(count($error)==0){

       $password=password_hash($password,PASSWORD_BCRYPT);
       $query= "INSERT INTO users(username,password,name,surname,email ) VALUE('$username','$password','$name','$surname','$email') ";
        
       if(mysqli_query($connessione,$query)){
           $_SESSION['username']=$username;
           $_SESSION['id']=mysqli_insert_id($connessione);
           header('Location: login.php');
           mysqli_close($connessione);
           exit;
       }
   
   }
   
   } else if (isset($_POST["Username"])) {
    $error = array("Riempi tutti i campi");
}
   ?>
<html>
   <head>

     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" href="sigh.css">
     <script src='sigh.js' defer></script>
     <title>Series Now</title>
   </head>

   <body>

<article>

  
 <main class="sigh"> 
    <h1> Registrati per guardare le tue serie tv preferite</h1>
     <form id="form" nome="sigh_form" method="POST">
        <div class="nome">  
         <input type="text" name="Nome" placeholder="Nome"> 
         <span class="errore"> </span>
        </div>
        <div class="cognome">
         <input type="text" name="Cognome" placeholder="Cognome"> 
         <span class="errore"> </span>
        </div>
        <div class="email">
          <input type="text" name="email" placeholder="Email">
          <span class="errore"> </span> 
        </div>
        <div class="username">
         <input type="text" name="Username" placeholder="Username"> 
         <span class="errore"> </span>
       </div>
        <div class="password">
         
         <input type="password" name="Password" placeholder="Password"> 
         <span class="errore"> </span>
        </div>

        <div class="conferma_password">
         
         <input type="password" name="Conferma_Password" placeholder="Conferma Password"> 
         <span class="errore"> </span>
        </div>

        <?php
                // Verifica la presenza di errori
                if (isset($error))
                 {
                  foreach($error as $singolo_err ) 
                  { 
                    echo "<span class='error'>$singolo_err</span>"; 
                  } 
                   
                }   
         ?>
         <div >    
         <label>&nbsp;<input type="submit" name="invio" value="Registrati" > </label>
        </div>
        </form>
        <div class="login">Hai un account? <a href="login.php">Accedi</a>
</main> 

   
</article>

</body>

</html>
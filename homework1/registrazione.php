<!DOCTYPE html>
<?php
include 'dbconfigurazione.php';
if(!empty($_POST["username" ]) && !empty($_POST["password" ]) && !empty($_POST["email" ])
&& !empty($_POST["name" ]) && !empty($_POST["surname" ]) && !empty($_POST["comfirm_password" ])){

$connessione= mysqli_connect($dbconfigurazione['host'] ,$dbconfigurazione['nome'],$dbconfigurazione['root'],$dbconfigurazione['password']);
//vedere se lo username inserito è giusto
if(!preg_match('/^[a-zA-Z0-9_]{1,15}$/', $_POST["username"]))
{
    $error[]= "Username non valido";
}
//vedere se gia esiste
else {
  $username= mysqli_real_escape_string($_POST["username"]);
  $query= "SELECT username FROM users WHERE username= '$username'";
  $res= mysqli_query($connessione,$query);
  if(mysqli_num_rows(res)>0){
    $error[]= "Username già esistente";
  }

}
$name= mysqli_real_escape_string($_POST["name"]);
$surname= mysqli_real_escape_string($_POST["surname"]);
$password= mysqli_real_escape_string($_POST["password"]);
$email= mysqli_real_escape_string($_POST["email"]);
$password= mysqli_real_escape_string($_POST["password"]);

if(strlen($password)<8)
{
    $error[]= "caratteri insufficienti";
}
if(!filter_var($password, FILTER_VALIDATE_EMAIL))
{
    $error[]= "email non valida";
}

if( count($error) == 0){

    $query= "INSERT INTO users(username,password,name,surname,email ) VALUE('$username','$password','$name','$surname','$email') ";
 
    if(mysqli_query($connessione,$query)){
        $_SESSION['Username']=$username;
        $_SESSION['id']=mysqli_insert_id($connessione);
        header('Location: home.php');
        mysqli_close($connessione);
        exit;
    }

}

}
?>
<html>
    <head>
    </head>
    <body>
        <article>
            <h2> Registrazione avvenuta con successo! </h2>
            <h2> Si prega di effettuare il <a href='login.php'> login</a> per proseguire </h2>
        </article>
    </body>
</html>
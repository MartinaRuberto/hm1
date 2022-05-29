
<?php

session_start();

if(!isset($_SESSION['Username'])){
header("Location: benvenuto.php");
exit;
}

include 'dbconfigurazione.php';
$connessione= mysqli_connect($dbconfigurazione['host'] ,$dbconfigurazione['user'],$dbconfigurazione['password'],$dbconfigurazione['name']);
$title=mysqli_real_escape_string($connessione,$_GET["title" ]);
$immagine=mysqli_real_escape_string($connessione,$_GET["immagine" ]);
$id=mysqli_real_escape_string($connessione,$_GET['id']);
$query=" DELETE FROM section(title,immagine,id) VALUES ('$title','$immagine',$id)"; 
mysqli_query($connessione,$query) or die(mysqli_error($connessione));

?>

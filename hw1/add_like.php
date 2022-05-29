<?php

session_start();

if(!isset($_SESSION['Username'])){
header("Location: benvenuto.php");
exit;
}

include 'dbconfigurazione.php';
$connessione= mysqli_connect($dbconfigurazione['host'] ,$dbconfigurazione['user'],$dbconfigurazione['password'],$dbconfigurazione['name']);
$userid=$_SESSION['id'];
echo($userid);
$sectionid=$_GET['id'];
$query=" INSERT INTO preferiti (user_id,section_id) VALUES ($userid,$sectionid) ";
echo($query);
mysqli_query($connessione,$query) or die(mysqli_error($connessione));


?>




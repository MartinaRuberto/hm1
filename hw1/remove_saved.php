<?php

session_start();

if(!isset($_SESSION['Username'])){
header("Location: benvenuto.php");
exit;
}

include 'dbconfigurazione.php';
$connessione= mysqli_connect($dbconfigurazione['host'] ,$dbconfigurazione['user'],$dbconfigurazione['password'],$dbconfigurazione['name']);
$userid=$_SESSION['id'];
$sectionid=$_GET['id'];
$query="DELETE FROM salvati  WHERE use_id=$userid AND generi_id=$sectionid";
echo($query);
mysqli_query($connessione,$query) or die(mysqli_error($connessione));
?>
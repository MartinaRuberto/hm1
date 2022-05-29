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
$query=" INSERT INTO salvati (use_id,generi_id) VALUES ($userid,$sectionid) ";
echo($query);
$res=mysqli_query($connessione,$query) or die(mysqli_error($connessione));
echo($res);

?>
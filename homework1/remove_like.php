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
$query="DELETE FROM preferiti  WHERE user_id=$userid AND section_id=$sectionid";
echo($query);
mysqli_query($connessione,$query) or die(mysqli_error($connessione));
?>

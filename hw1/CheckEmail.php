<?php 
session_start();


if (!isset($_GET["Email"])) {
    echo "Non dovresti essere qui";
    exit;
}

header('Content-Type: application/json');

include 'dbconfigurazione.php';
$connessione= mysqli_connect($dbconfigurazione['host'] ,$dbconfigurazione['user'],$dbconfigurazione['password'],$dbconfigurazione['name']);
$_email=mysqli_real_escape_string($connessione, $_GET["Email"]);
$query=" SELECT email FROM users where email='$_email'";
$res=mysqli_query($connessione,$query) or die(mysqli_error($connessione));

$json=array();
while($row=mysqli_fetch_assoc($res))
{
    array_push($json,$row);
}
    mysqli_free_result($res); 
    mysqli_close($connessione);
    echo json_encode($json);
?>
<?php 
session_start();


if (!isset($_GET["Username"])) {
    echo "Non dovresti essere qui";
    exit;
}

header('Content-Type: application/json');

include 'dbconfigurazione.php';
$connessione= mysqli_connect($dbconfigurazione['host'] ,$dbconfigurazione['user'],$dbconfigurazione['password'],$dbconfigurazione['name']);
$_username=mysqli_real_escape_string($connessione, $_GET["Username"]);
$query=" SELECT username FROM users where username='$_username'";
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

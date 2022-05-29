<?php
session_start();
if(isset($_SESSION[ "Username" ]))
{
include 'dbconfigurazione.php';
$connessione= mysqli_connect($dbconfigurazione['host'] ,$dbconfigurazione['user'],$dbconfigurazione['password'],$dbconfigurazione['name']);

$query= "SELECT * FROM section";
$res = mysqli_query($connessione, $query) or die(mysqli_error($connessione));
$json=array();
while($row=mysqli_fetch_assoc($res))
{
    array_push($json,$row);
}
    mysqli_free_result($res); 
    mysqli_close($connessione);
    echo json_encode($json);
}




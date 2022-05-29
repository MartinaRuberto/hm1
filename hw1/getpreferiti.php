
<?php
session_start();
if(!isset($_SESSION['Username'])){
    header("Location: benvenuto.php");
    exit;
    }

    include 'dbconfigurazione.php';
    $connessione= mysqli_connect($dbconfigurazione['host'] ,$dbconfigurazione['user'],$dbconfigurazione['password'],$dbconfigurazione['name']);
    $id=$_SESSION['id'];
    $query= "SELECT * FROM section JOIN preferiti ON section_id=section.id WHERE user_id='$id'";
    $res=mysqli_query($connessione, $query) or die(mysqli_error($connessione));
    $json=array();
   while($row=mysqli_fetch_assoc($res))
   {
    array_push($json,$row);
   }
    mysqli_free_result($res); 
    mysqli_close($connessione);
    echo json_encode($json);

?>
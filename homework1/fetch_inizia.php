<?php

session_start();

if(!isset($_SESSION['Username'])){
header("Location: benvenuto.php");
exit;
}

if(!isset($_GET['series']))
{
    header('Location: benvenuto.php');
    exit;
}
$_apikey='c2b1b963519f2015731940ea8ae37250';
$_series=urlencode($_GET['series']);
$_url='https://api.themoviedb.org/3/search/tv?api_key='.$_apikey.'&query='.$_series;

$curl = curl_init();
curl_setopt($curl,CURLOPT_URL,$_url);
curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
$result=curl_exec($curl);
curl_close($curl);
echo $result;

?>
<?php
session_start();
session_destroy();

header("Location: benvenuto.php");
exit;
?>
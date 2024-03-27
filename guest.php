<?php
session_start();
echo "<script> window.alert('Welcome to our website'); </script>";
$_SESSION['name']='Guest';
$_SESSION['mode']='guest';
header("Location: home.php");
?>
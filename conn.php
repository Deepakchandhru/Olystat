<?php
$servername='localhost';
$dbname='sample';
$username='postgres';
$password='5112';

$conn= pg_connect("host=$servername dbname=$dbname user=$username password=$password");
if(!$conn){
    echo "Connection error.";
}

?>
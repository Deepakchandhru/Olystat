<?php
$servername='localhost';
$dbname='olympics';
$username='postgres';
$password='5112';

$conn= pg_connect("host=$servername dbname=$dbname user=$username password=$password");
if(!$conn){
    echo "Connection error.";
}

?>
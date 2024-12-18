<?php

include "conn.php";

$user= $_POST['uname'];
$pass= $_POST['pass'];

$sq="SELECT * FROM login WHERE uname='$user' and role='user';";
$res = pg_query($conn,$sq);
$row = pg_fetch_assoc($res);
if ($row) {
    echo "<script> window.alert('User name already exists. Please enter new username'); 
    window.location.href='signin.html';</script>";     
}else{
$sql="INSERT INTO login(uname,pass,role) VALUES('$user','$pass','user') ;";
$result = pg_query($conn,$sql);
echo "<script> window.alert('Your account has been created. Please log into your account.'); 
    window.location.href='index.html';</script>";    
}
?>


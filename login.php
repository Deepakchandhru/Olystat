<?php
include "conn.php";

$uname= $_POST['uname'];
$pass= $_POST['pass'];
$role= $_POST['role'];

$sql=" SELECT * FROM login WHERE uname='$uname' and role='$role';";
$result = pg_query($conn,$sql);
if (pg_num_rows($result)) {
    session_start();
    $_SESSION['name']=$uname;
    $_SESSION['mode']=$role;
    $sq=" UPDATE login SET status='signed in' WHERE uname='$uname' and role='$role';";
    $res = pg_query($conn,$sq);
    while($row = pg_fetch_assoc($result)) {
        if($row['pass']=="$pass"){
            if($row['role']=='user'){
                echo "<script> window.alert('Welcome back');</script>";
                echo "<script> window.location.href='home.php'; </script>";  
            }else{
                echo "<script> window.alert('Welcome back admin');</script>";
                echo "<script> window.location.href='admin.php';</script>";
            }   
        }
        else{
            echo "<script> window.alert('Check your password') ; window.location.href='login.html' ;</script>";
        }
    }    
}else{
    echo "<script> window.alert('Check your username') ; window.location.href='login.html ';</script>" ; 
}

?>

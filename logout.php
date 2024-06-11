<?php
include 'conn.php';
session_start();
$uname=$_SESSION['name'];
$role=$_SESSION['mode'];
$sq=" UPDATE login SET status='signed out' WHERE uname='$uname' and role='$role';";
$res = pg_query($conn,$sq);
session_unset();
session_destroy();
header("Location: index.html");
exit();
?>

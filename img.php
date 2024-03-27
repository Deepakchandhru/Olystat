<?php
include "conn.php";

$flag=fopen("d:\\xampp\\htdocs\\olympics\\image\\Kenya.png","rb");
$ins="Update country Set flag= '$flag' where country='Kenya';";

$q1=pg_fetch_assoc(pg_query($conn,$ins));

$img="SELECT * from country where country='USA';";
$q2=pg_fetch_assoc(pg_query($conn,$img));

$r="image\\".$q2["country"].".png";
$i= base64_encode($q2['flag']);
echo $r;

echo "<div> <img src='$r' width='50px'> </div>";

echo "Inserted";
?>

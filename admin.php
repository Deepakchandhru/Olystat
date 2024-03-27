<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="Admin page" content="Application, Feedback">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <title> Olystat - Admin Panel </title>
        <link rel="stylesheet" type="text/css" href="medal.css">
        <link rel="stylesheet" type="text/css" href="home.css">
<style>
#application{
    position: absolute;
    float: left;
    left: 10%;
}

#feedback{
    position: absolute;
    float: right;
    left: 20%;
}

.logout{
    position: absolute;
    top: 100px;
    right:100px ;
    border: 2px solid beige ;
    border-radius: 2px solid beige;
    padding: 10px;
    font-size: 40px;
    text-align: center;
    font-weight: bold;
}

.logout:hover{
    background-color: rgb(12, 255, 12);
}
</style>
</head>
<?php
include 'session.php';
?>
<body>
<header>
<section class="main-content">
    <h1>Olympic Stats</h1>
    <p>Explore statistical data about Olympic medals, training programs, India's journey, and more.</p>
    <a href="logout.php"><button class="logout" id="logout" name="logout"> <?php echo 'Admin : ',$_SESSION["name"],'<br><br>','LOGOUT'; ?> </button></a>
</section>
</header>
<br><br>
<form method="post">
    <input type="submit" class="menu" id="application" name="application" value="application"> 
    <input type="submit" class="menu" id="feedback" name="feedback" value="Feedback from users">
    <br><br><br>
    <br><br><br><br>
    <hr>
    <br>
</form>

<?php 
include "conn.php";

if(array_key_exists('application',$_POST)){
    $app="SELECT * from application;";
    $res=pg_query($conn,$app);
    if(pg_num_rows($res)){
        echo "<h3> Application details </h3>";
        echo "<table> <thead>";
        echo "<th> Application number </th>";
        echo "<th> Applicant Name </th>";
        echo "<th> Email ID </th>";
        echo "<th> Mobile Number </th>";
        echo "<th> Preferred Sport </th>";
        echo "<th> Experience in sport </th>";
        echo "<th> Applicant Resident State </th>";
        echo "</thead> <tbody>";
        while($row=pg_fetch_assoc($res)){
            echo "<tr>";
            echo "<td>".$row['application_id']."</td>";
            echo "<td>".$row['name']."</td>";
            echo "<td>".$row['email']."</td>";
            echo "<td>".$row['phone']."</td>";
            echo "<td>".$row['preference']."</td>";
            echo "<td>".$row['exp']."</td>";
            echo "<td>".$row['state']."</td>";
            echo "</tr>";
        }
        echo "</tbody> </table>";
    }else{
        echo "Sorry for inconvenience. Try again";
    }
}

if(array_key_exists('feedback',$_POST)){
    $fee="SELECT * from feedback;";
    $res=pg_query($conn,$fee);
    if(pg_num_rows($res)){
        echo "<h2> Feedback details </h2>";
        echo "<table> <thead>";
        echo "<th> Feedback number </th>";
        echo "<th> User name </th>";
        echo "<th> User email </th>";
        echo "<th> Feedback </th>";
        echo "</thead> <tbody>";
        while($row=pg_fetch_assoc($res)){
            echo "<tr>";
            echo "<td>".$row['feedback_id']."</td>";
            echo "<td>".$row['username']."</td>";
            echo "<td>".$row['email']."</td>";
            echo "<td>".$row['feedback']."</td>";
            echo "</tr>";
        }
        echo "</tbody> </table>";
    }else{
        echo "Sorry for inconvenience. Try again";
    }
    
}

?>
<br><br><br><br><br><br><br><br>
<footer>
            <div class="footer-content">
                <p>&copy; 2023 Olympic Stats. All rights reserved.</p>
               
            </div>
            <ol style="list-style-type: none;"> 
                <li>olystact@inc</li>
                <li>facebook</li>
                <li>twitter</li>
            </ol>
        </footer>
</body>
</html>
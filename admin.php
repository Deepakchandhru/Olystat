<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="Admin page" content="Application, Feedback">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <title> Olystat - Admin Panel </title>
        <link rel="stylesheet" type="text/css" href="home.css">
<style>
    #application{
        position: absolute;
        float: left;
        left: 5%;
    }

    #feedback{
        position: absolute;
        float: right;
        left: 20%;
    }

    header {
        color: white;
        text-align: center;
        padding: 10px 0; 
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    header h1 {
        font-size: 40px; 
        margin: 5px 0; 
    }

    header p {
        font-size: 20px; 
        margin: 5px 0;
    }

    table {
        width: 80%;
        margin: 20px auto;
        border-collapse: collapse;
        text-align: left;
    }

    table th, table td {
        padding: 12px;
        border: 1px solid #ddd;
    }

    table th {
        background-color: #f2f2f2;
        font-weight: bold;
    }

    table tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    table tr:hover {
        background-color: #f1f1f1;
    }

    button, input[type=submit] {
        border: 2px solid #FF4500;
        border-radius: 5px;
        text-align: center;
        padding: 1%;
        margin-left: 30%;
        font-size: 30px;
        font-family: Arial, Helvetica, sans-serif;
        font-weight: bold;
        color: white;
        background-color: #FF4500;
    }

    button:hover, input[type=submit]:hover {
        background-color: #58f724;
        color: #FF4500;
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
    <input type="submit" class="menu" id="application" name="application" value="Applications"> 
    <input type="submit" class="menu" id="feedback" name="feedback" value="User feedbacks">
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
        echo "<th> Applicant Name </th>";
        echo "<th> Email ID </th>";
        echo "<th> Mobile Number </th>";
        echo "<th> Preferred Sport </th>";
        echo "<th> Applicant Resident State </th>";
        echo "</thead> <tbody>";
        while($row=pg_fetch_assoc($res)){
            echo "<tr>";
            echo "<td>".$row['name']."</td>";
            echo "<td>".$row['email']."</td>";
            echo "<td>".$row['phone']."</td>";
            echo "<td>".$row['preference']."</td>";
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
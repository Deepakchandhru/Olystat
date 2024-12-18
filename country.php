<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="compare" content="country comparison">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Country Comparison</title>
    <link rel="stylesheet" type="text/css" href="medal.css">
    <link rel="stylesheet" type="text/css" href="home.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/brython/3.9.5/brython.min.js"></script>
    <style>
        
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


    nav ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        background-color: #FF8C00;
        border-bottom: 2px solid #FF4500;
        height: 40px; 
        align-items: center; 
    }

    nav li {
        margin: 0 5px; 
    }

    nav a {
        text-decoration: none;
        color: white;
        font-size: 20px; 
        font-weight: bold;
        padding: 5px 8px; 
        transition: background-color 0.3s, color 0.3s;
    }

    nav a:hover {
        background-color: #FFD700;
        color: #FF4500;
    }
    </style>
</head>
<body>
<header>
    <section class="main-content">
        <h1>Olympic Stats</h1>
        <p>Explore statistical data about Olympic medals, training programs, India's journey, and more.</p>
        <a href="logout.php">
            <button class="logout" id="logout" name="logout">
                <?php
                include "session.php"; 
                echo 'User : ', $_SESSION["name"], '<br><br>', 'LOGOUT';
                if ($_SESSION["mode"] == "guest") {
                    echo "<script> document.getElementById('logout').innerHTML= 'EXIT' </script>";
                }
                ?>
            </button>
        </a>
    </section>
    <nav>
        <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="medals.php">Medals</a></li>
            <li><a href="country.php" style="background-color:orange;color: white;">Performance Comparison</a></li>
            <li><a href="india.php">India's Road</a></li>
            <li><a href="form.php">Training</a></li>
            <li><a href="contactus.php">Contact Us</a></li>
        </ul>
        <br>
    </nav>
</header>
<br>
<form method="post">
    <label style="margin-left: 10%;">Countries:</label>
    <select id="con1" name="con1" required>
        <option value="USA">USA</option>
        <option value="China">China</option>
        <option value="Russia">Russia</option>
        <option value="Germany">Germany</option>
        <option value="UK">England</option>
        <option value="Italy">Italy</option>
        <option value="France">France</option>
        <option value="Japan">Japan</option>
        <option value="Australia">Australia</option>
        <option value="Hungary">Hungary</option>
        <option value="Netherlands">Netherlands</option>
        <option value="India">India</option>
    </select>

    <label>vs</label>
    <select id="con2" name="con2" required>
        <option value="USA">USA</option>
        <option value="China">China</option>
        <option value="Russia">Russia</option>
        <option value="Germany">Germany</option>
        <option value="UK">England</option>
        <option value="Italy">Italy</option>
        <option value="France">France</option>
        <option value="Japan">Japan</option>
        <option value="Australia">Australia</option>
        <option value="Hungary">Hungary</option>
        <option value="Netherlands">Netherlands</option>
        <option value="India">India</option>
    </select>
    <button id="button" name="button">Compare</button>
    <br><br>
</form>
<?php
include 'conn.php';

if (array_key_exists('button', $_POST)) {
    $con1 = $_POST['con1'];
    $con2 = $_POST['con2'];
    if ($con1 == $con2) {
        echo "<p>Same country cannot be compared</p>";
    } else {
        $result1 = fetchData($conn, $con1);
        $result2 = fetchData($conn, $con2);
        if($result1 && $result2){
            $r1 = "image/".$con1.".png";
            $r2 = "image/".$con2.".png";
            echo "<h2><img src='$r1' width='40px'> $con1 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; vs &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <img src='$r2' width='40px'> $con2</h2>";
            echo "<table>";
            echo "<thead>";
            echo "<th rowspan='2' style='border-bottom: 0px hidden;'>Year</th>";
            echo "<th colspan='2'>Rank</th>";
            echo "<th colspan='2'>Gold</th>";
            echo "<th colspan='2'>Silver</th>";
            echo "<th colspan='2'>Bronze</th>";
            echo "<th colspan='2'>Total</th>";
            echo "</thead>";
            echo "<tbody>";
            echo "<tr>";
            echo "<th> </th>";
            echo "<td>$con1</td>";
            echo "<td>$con2</td>";
            echo "<td>$con1</td>";
            echo "<td>$con2</td>";
            echo "<td>$con1</td>";
            echo "<td>$con2</td>";
            echo "<td>$con1</td>"; 
            echo "<td>$con2</td>";
            echo "<td>$con1</td>";
            echo "<td>$con2</td>";
            echo "</tr>";
            
            foreach ($result1 as $key => $row1) {
                $row2 = $result2[$key];
                
                echo "<tr>";
                echo "<td>{$row1['year']}</td>";
                echo "<td>{$row1['pos']}</td>";
                echo "<td>{$row2['pos']}</td>";
                echo "<td>{$row1['gold']}</td>";
                echo "<td>{$row2['gold']}</td>";
                echo "<td>{$row1['silver']}</td>";
                echo "<td>{$row2['silver']}</td>";
                echo "<td>{$row1['bronze']}</td>"; 
                echo "<td>{$row2['bronze']}</td>";
                echo "<td>{$row1['total']}</td>";
                echo "<td>{$row2['total']}</td>";
                echo "</tr>";
            }
            
            echo "</tbody>";
            echo "<table>";
            echo "<br> <br> <br> <br>";
        }
    }
}

function fetchData($conn, $country) {
    if ($country == "India") {
        $sql = "SELECT concat(city,' , ',year) as year,pos,gold,silver,bronze,total from india
                inner join place using(year)  UNION
                SELECT 'Total' as year,round(avg(pos)),Sum(gold),Sum(silver),Sum(bronze),Sum(total) from india
                UNION
                SELECT 'Top Peformance' as year,min(pos),max(gold),max(silver),max(bronze),max(total) from india
                order by year;";
    } else {
        $sql = "SELECT 'Tokyo , 2020' as year,pos,gold,silver,bronze,total from ol20 where country='$country' UNION
                SELECT 'Rio de genero , 2016' as year,pos,gold,silver,bronze,total from ol16 where country='$country' UNION
                SELECT 'London , 2012' as year,pos,gold,silver,bronze,total from ol12 where country='$country' UNION
                SELECT 'Total' as year,pos,gold,silver,bronze,total from combined_medal where country='$country' UNION
                SELECT 'Top Peformance' as year,top,mgold,msilver,mbronze,mtotal from combined_medal where country='$country'
                order by year;";
    }
    $result = pg_query($conn, $sql);
    return pg_fetch_all($result);
}
?>

<br><br><br><br><br><br><br><br><br><br>
<footer>
    <div class="footer-content">
        <p>&copy; 2023 Olympic Stats. All rights reserved.</p>
    </div>
    <ol style="list-style-type: none;">
        <li>olystat@inc</li>
        <li>facebook</li>
        <li>twitter</li>
    </ol>
</footer>
</body>
</html>

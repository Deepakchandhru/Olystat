<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8"> 
    <meta name="medal" content="medal tally, FAQ">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title> Medal tally </title>
    <link rel="stylesheet" type="text/css" href="medal.css"> 
    <link rel="stylesheet" type="text/css" href="home.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <style>
        .filter-options {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin: 0 10%;
        }

        .filter-options label, .filter-options select, .filter-options button {
            font-size: 30px;
        }

        .filter-options button {
            background-color: #FF4500;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .filter-options button:hover {
            background-color: #FFD700;
            color: #FF4500;
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
<?php
include 'session.php';
?>
<body>
<header>
    <section class="main-content">
        <h1>Olympic Stats</h1>
        <p>Explore statistical data about Olympic medals, training programs, India's journey, and more.</p> 
        <a href="logout.php"><button class="logout" id="logout" name="logout"> 
            <?php echo 'User : ',$_SESSION["name"],'<br><br>','LOGOUT'; 
            if($_SESSION["mode"]=="guest"){
               echo"<script> document.getElementById('logout').innerHTML= 'EXIT' </script>";
            }
            ?> 
        </button></a>
    </section>
    <nav>
        <ul>
            <li><a href="home.php"> Home </a></li>
            <li><a href="medals.php" style="background-color:orange;color: white;"> Medals </a></li>
            <li><a href="country.php"> Performance Comparison </a></li>
            <li><a href="india.php"> India's Road </a></li>
            <li><a href="form.php"> Training </a></li>
            <li><a href="contactus.php"> Contact Us </a></li>
        </ul>
    </nav>
    <br>
</header>

<form method="post">
    <h2> Medal Tally </h2>
    <div class="filter-options">
        <label> Year: </label>
        <select id="year" name="year" required>
            <option id="year" name="year" value="20"> 2020 </option>
            <option id="year" name="year" value="16"> 2016 </option>
            <option id="year" name="year" value="12"> 2012 </option>
        </select>
        <label> Filter: </label>
        <select id="filter" name="filter">
            <option id="filter" name="filter" value="gold"> Gold </option>
            <option id="filter" name="filter" value="silver"> Silver </option>
            <option id="filter" name="filter" value="bronze"> Bronze </option>
            <option id="filter" name="filter" value="total"> Total </option>
        </select>
        <label> Order: </label>
        <select id="order" name="order">
            <option id="order" name="order" value="desc"> Max </option>
            <option id="order" name="order" value="asc"> Min </option>
        </select>
        <label> Max: </label>
        <select id="max" name="max">
            <option id="max" name="max" value="15"> 15 </option>
            <option id="max" name="max" value="10"> 10 </option>
            <option id="max" name="max" value="5"> 5 </option>
            <option id="max" name="max" value="3"> 3 </option>
        </select>
        <button id="button" name="button"> Show </button>
    </div>
    <br><br>
</form>

<?php

include 'conn.php';

$mg="SELECT country,gold FROM ol20 where gold=(SELECT max(gold) from ol20);";
$mt="SELECT country,total FROM ol16 where total=(SELECT max(total) from ol16);";
$ms="SELECT country,silver FROM ol12 where silver=(SELECT max(silver) from ol12);";
$mb="SELECT country,bronze FROM ol20 where bronze=(SELECT max(bronze) from ol20);";
$tg="Select country,gold from combined_medal 
where gold=(Select max(gold) from combined_medal);";

$q1=pg_fetch_assoc(pg_query($conn,$mg));
$q2=pg_fetch_assoc(pg_query($conn,$mt));
$q3=pg_fetch_assoc(pg_query($conn,$ms));
$q4=pg_fetch_assoc(pg_query($conn,$mb));
$q5=pg_fetch_assoc(pg_query($conn,$tg));

if(array_key_exists('button',$_POST)) {
$year= $_POST['year'];
$filter= $_POST['filter'];
$order= $_POST['order'];
$max= $_POST['max'];
$table= 'ol'.$year;
$sql="SELECT * from $table ORDER BY $filter $order LIMIT $max;";
$result=pg_query($conn,$sql);
if($result){
    echo "<table>";
    echo "<thead>";
    echo "<th> Rank </th>";
    echo "<th> Country </th>";
    echo "<th> Gold </th>";
    echo "<th> Silver </th>";
    echo "<th> Bronze </th>";
    echo "<th> Total </th>";
    echo "</thead>";
    echo "<tbody>";
    while($row= pg_fetch_assoc($result)){
        echo "<tr>";
        echo "<td>". $row['pos'] ."</td>";
        $r="image\\".$row["country"].".png";
        echo "<td>". "<img src='$r' width='40px'>"." ".$row['country'] ."</td>";
        echo "<td>". $row['gold'] ."</td>";
        echo "<td>". $row['silver'] ."</td>";
        echo "<td>". $row['bronze'] ."</td>";
        echo "<td>". $row['total'] ."</td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
}else{
    echo "<p> Please Select year </p>";
}
}

?>
<br><br>
<h2> FAQs </h2>
<div>
<hr>
    <h3> Which country won the most gold medals in 2020 ? <span class="material-symbols-outlined" 
        onclick="q1(this)"> stat_minus_1 </span></h3>
    <p id="g20" style="display:none"> <?php echo $q1['country'] ," : ",$q1['gold'], " Gold ";?> </p>
    <hr>
</div>
<div>
    <h3> Which country won the most medals in 2016 ? <span class="material-symbols-outlined" 
        onclick="q2(this)"> stat_minus_1 </span></h3>
    <p id="mt" style="display:none"> <?php echo $q2['country'] ," : ",$q2['total']," Medals ";?> </p>
    <hr>
</div>
<div>
    <h3> Which country won the most silver medals in 2012 ? 
    <span class="material-symbols-outlined" onclick="q3(this)"> stat_minus_1 </span>
    </h3>
    <p id="s12" style="display:none"> <?php echo $q3['country'] ," : ", $q3['silver']," Silver ";?> </p>
    <hr>
</div>
<div>
    <h3> Which country won the most bronze medals in 2020 ? <span class="material-symbols-outlined" 
        onclick="q4(this)"> stat_minus_1 </span></h3>
    <p id="mb" style="display:none"> <?php echo $q4['country'] ," : ",$q4['bronze']," Bronze ";?> </p>
    <hr>
</div>
<div>
    <h3> What is the most gold medals by a single country over last 3 olympics ? 
    <span class="material-symbols-outlined" onclick="q5(this)"> stat_minus_1 </span>
    </h3>
    <p id="lg" style="display:none"> <?php echo $q5['country'] ," : ",$q5['gold']," Golds ";?> </p>
</div>
<br>

<script>
    function q1(ele){
        if(document.getElementById('g20').style.display=='none'){
            ele.innerHTML= "stat_1";
            document.getElementById('g20').style.display='block';
        }else{
            ele.innerHTML= "stat_minus_1";
            document.getElementById('g20').style.display='none';
        }
    }

    function q2(ele){
        if(document.getElementById('mt').style.display=='none'){
            ele.innerHTML= "stat_1";
            document.getElementById('mt').style.display='block';
        }else{
            ele.innerHTML= "stat_minus_1";
            document.getElementById('mt').style.display='none';
        }
    }

    function q3(ele){
        if(document.getElementById('s12').style.display=='none'){
            ele.innerHTML= "stat_1";
            document.getElementById('s12').style.display='block';
        }else{
            ele.innerHTML= "stat_minus_1";
            document.getElementById('s12').style.display='none';
        }
    }

    function q4(ele){
        if(document.getElementById('mb').style.display=='none'){
            ele.innerHTML= "stat_1";
            document.getElementById('mb').style.display='block';
        }else{
            ele.innerHTML= "stat_minus_1";
            document.getElementById('mb').style.display='none';
        }
    }

    function q5(ele){
        if(document.getElementById('lg').style.display=='none'){
            ele.innerHTML= "stat_1";
            document.getElementById('lg').style.display='block';
        }else{
            ele.innerHTML= "stat_minus_1";
            document.getElementById('lg').style.display='none';
        }
    }

</script>

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
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="compare" content="country comparison">
        <meta name="viewport" content="width= device-width , initial-scale=1.0">
        <title> Country Comparison </title>
        <link rel="stylesheet" type="text/css" href="medal.css"> 
        <link rel="stylesheet" type="text/css" href="home.css">
        <style>
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
                <li><a href="medals.php"> Medals </a></li>
                <li><a href="country.php" style="background-color:orange;color: white;"> Performance Comparison </a></li>
                <li><a href="india.php"> India's Road </a></li>
                <li><a href="form.php"> Training </a></li>
                <li><a href="contactus.php"> Contact Us </a></li>
            </ul>
            <hr style="width: 90% ;align-items: center;background-color: orange;height:3px">
    <br>
        </nav>
    </header>
    <br><br><br><br><br><br><br><br><br><br>
    <form method="post">
        <label style="margin-left : 10%;">  Countries: </label>
        <Select id="con1" name="con1" required>
            <option id="con1" name="con1" value="USA"> USA </option>
            <option id="con1" name="con1" value="China"> China </option>
            <option id="con1" name="con1" value="Russia"> Russia </option>
            <option id="con1" name="con1" value="Germany"> Germany </option>
            <option id="con1" name="con1" value="UK"> England </option>
            <option id="con1" name="con1" value="Italy"> Italy </option>
            <option id="con1" name="con1" value="France"> France </option>
            <option id="con1" name="con1" value="Japan"> Japan </option>
            <option id="con1" name="con1" value="Australia"> Australia </option>
            <option id="con1" name="con1" value="Hungary"> Hungary </option>
            <option id="con1" name="con1" value="Netherlands"> Netherland </option>
            <option id="con1" name="con1" value="India"> India </option>
        </select>

        <label> vs </label>
        <Select id="con2" name="con2" required>
            <option id="con2" name="con2" value="USA"> USA </option>
            <option id="con2" name="con2" value="China"> China </option>
            <option id="con2" name="con2" value="Russia"> Russia </option>
            <option id="con2" name="con2" value="Germany"> Germany </option>
            <option id="con2" name="con2" value="UK"> England </option>
            <option id="con2" name="con2" value="Italy"> Italy </option>
            <option id="con2" name="con2" value="France"> France </option>
            <option id="con2" name="con2" value="Japan"> Japan </option>
            <option id="con2" name="con2" value="Australia"> Australia </option>
            <option id="con2" name="con2" value="Hungary"> Hungary </option>
            <option id="con2" name="con2" value="Netherlands"> Netherland </option>
            <option id="con2" name="con2" value="India"> India </option>
        </select>
        <button id="button" name="button"> Compare </button>
        <br><br><br><br><br><br>
    </form>
    <?php
    include 'conn.php';
    
    if(array_key_exists('button',$_POST)){
        $con1= $_POST['con1'];
        $con2= $_POST['con2'];
        if($con1==$con2){
            echo "<p> Same country cannot be compared </p>";
        }else{
            if($con1=="India"){
                $sql1="SELECT concat(city,' , ',year) as year,pos,gold,silver,bronze,total from india
                      inner join place using(year)  UNION
                      SELECT 'Total' as year,round(avg(pos)),Sum(gold),Sum(silver),Sum(bronze),Sum(total) from india
                      UNION
                      SELECT 'Top Peformance' as year,min(pos),max(gold),max(silver),max(bronze),max(total) from india
                      order by year;";
            }else{
            $sql1="SELECT 'Tokyo , 2020' as year,pos,gold,silver,bronze,total from ol20 where country='$con1' UNION
                  SELECT 'Rio de genero , 2016' as year,pos,gold,silver,bronze,total from ol16 where country='$con1' UNION
                  SELECT 'London , 2012' as year,pos,gold,silver,bronze,total from ol12 where country='$con1' UNION
                  SELECT 'Total' as year,pos,gold,silver,bronze,total from combined_medal where country='$con1' UNION
                  SELECT 'Top Peformance' as year,top,mgold,msilver,mbronze,mtotal from combined_medal where country='$con1'
                  order by year
                  ;";
            }
            $result1=pg_query($conn,$sql1);
        
            if($con2=='India'){
                $sql2="SELECT concat(city,' , ',year) as year,pos,gold,silver,bronze,total from india
                      inner join place using(year)  UNION
                      SELECT 'Total' as year,round(avg(pos)),Sum(gold),Sum(silver),Sum(bronze),Sum(total) from india
                      UNION
                      SELECT 'Top Peformance' as year,min(pos),max(gold),max(silver),max(bronze),max(total) from india
                      order by year;";
            }else{
            $sql2="SELECT 'Tokyo , 2020' as year,pos, gold,silver,bronze,total from ol20 where country='$con2' UNION
                  SELECT 'Rio de genero , 2016' as year,pos, gold,silver,bronze,total from ol16 where country='$con2' UNION
                  SELECT 'London , 2012' as year,pos, gold,silver,bronze,total from ol12 where country='$con2' UnION
                  SELECT 'Total' as year,pos,gold,silver,bronze,total from combined_medal where country='$con2' UNION
                  SELECT 'Top Peformance' as year,top,mgold,msilver,mbronze,mtotal from combined_medal where country='$con2'
                  order by year;";
            }
            $result2=pg_query($conn,$sql2);

            if($result1 && $result2){
                $r1="image\\".$con1.".png";
                $r2="image\\".$con2.".png";
                echo "<h2>". "<img src='$r1' width='40px'>"." ".$con1 .
                "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  vs &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".
                "<img src='$r2' width='40px'>"." ".$con2 ."</h2>";
                echo "<table>";
                echo "<thead>";
                echo "<th rowspan='2' style='border-bottom: 0px hidden;'> Year </th>";
                echo "<th colspan='2'> Rank </th>";
                echo "<th colspan='2'> Gold </th>";
                echo "<th colspan='2'> Silver </th>";
                echo "<th colspan='2'> Bronze </th>";
                echo "<th colspan='2'> Total </th>";
                echo "</thead>";
                echo "<tbody>";
                echo "<tr>";
                echo "<th>". " " ."</th>";
                echo "<td>". $con1 ."</td>";
                echo "<td>". $con2 ."</td>";
                echo "<td>". $con1 ."</td>";
                echo "<td>". $con2 ."</td>";
                echo "<td>". $con1 ."</td>";
                echo "<td>". $con2 ."</td>";
                echo "<td>". $con1 ."</td>"; 
                echo "<td>". $con2 ."</td>";
                echo "<td>". $con1 ."</td>";
                echo "<td>". $con2 ."</td>";
                echo "</tr>";
                while($row1= pg_fetch_assoc($result1))
                {
                    $row2= pg_fetch_assoc($result2);
                    echo "<tr>";
                    echo "<td>". $row1['year'] ."</td>";
                    echo "<td>". $row1['pos'] ."</td>";
                    echo "<td>". $row2['pos'] ."</td>";
                    echo "<td>". $row1['gold'] ."</td>";
                    echo "<td>". $row2['gold'] ."</td>";
                    echo "<td>". $row1['silver'] ."</td>";
                    echo "<td>". $row2['silver'] ."</td>";
                    echo "<td>". $row1['bronze'] ."</td>"; 
                    echo "<td>". $row2['bronze'] ."</td>";
                    echo "<td>". $row1['total'] ."</td>";
                    echo "<td>". $row2['total'] ."</td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "<table>";
                echo "<br> <br> <br> <br>";
            }
            
        }
    }
    ?>
    <br><br><br><br><br><br><br><br><br><br>
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

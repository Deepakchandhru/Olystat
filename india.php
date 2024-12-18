<!DOCTYPE html>
<html>
    <head>
        <meta charset='UTF-8'>
        <meta name="viewport" content="width=device-width , initial-scale=1.0">
        <meta name="India" content="Performance,FAQ">
        <title> India at the olympics </title>
        <link rel="stylesheet" type="text/css" href="medal.css"> 
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
        <link rel="stylesheet" type="text/css" href="home.css"> 
        <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .top{
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-weight: 700;
            text-align: center;
            display: inline;
            padding: 20px 20px;
        }

        .art{
            padding-left:20%;
            padding-right:20%;
            font-family: Georgia, 'Times New Roman', Times, serif;
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
                <li><a href="medals.php"> Medals </a></li>
                <li><a href="country.php"> Performance Comparison </a></li>
                <li><a href="india.php" style="background-color:orange;color: white;"> India's Road </a></li>
                <li><a href="form.php"> Training </a></li>
                <li><a href="contactus.php"> Contact Us </a></li>
            </ul>
        </nav>
    <br>
    </header>

    <br><br><br>
    <form method="post">
    <h2> Indian Medallists </h2>
    <br> <br>
        <label style="margin-left : 10%;"> Year : </label> 
        <select id="year" name="year" required>
            <option id="year" name="year" value="2020"> 2020 </option>
            <option id="year" name="year" value="2016"> 2016 </option>
            <option id="year" name="year" value="2012"> 2012 </option>
            <option id="year" name="year" value="2008"> 2008 </option>
            <option id="year" name="year" value="2004"> 2004 </option>
            <option id="year" name="year" value="2000"> 2000 </option>
        </select>
        <input type="submit" id="button" name="button" value="Show">
        <br><br>
    </form>

<?php
include "conn.php";

if(array_key_exists('button',$_POST)) {
$year=strval($_POST['year']);
$tab="Select * from medallist where year='$year';";
$res=pg_query($conn,$tab);
if(pg_num_rows($res)){
    echo "<table> <thead>";
    echo "<th> Medallist </th>";
    echo "<th> Medal </th>";
    echo "<th> Sport </th>";
    echo "<th> Gender </th>";
    echo "</thead> <tbody>";
    while($row=pg_fetch_assoc($res)){
        echo "<tr>";
        $r="image\\India.png";
        echo "<td>". "<img src='$r' width='40px'>"."   ".$row['player'] ."</td>";
        echo "<td>".$row['medal']."</td>";
        echo "<td>".$row['sport']."</td>";
        if($row['gender']=='M'){
            $row['gender']='Male';
        }else{
            $row['gender']='Female';
        }
        echo "<td>".$row['gender']."</td>";
        echo "</tr>";
    }
    echo "</tbody> </table>";
}else{
    echo "<p> No medals </p>";
}
}

$tm="Select Count(medal) from medallist;";
$tg="Select Count(medal) from medallist where medal='Gold';";
$fm="Select player,sport,year,medal from medallist
order by year
limit 1;";
$ffm="Select player,sport,year,medal from medallist where gender='F'
order by year
limit 1;";
$hoc ="Select Count(medal) from medallist where sport='Hockey' and medal='Gold';";
$pv="Select Count(medal) from medallist where player='PV Sindhu';";
$nc="Select city,* from medallist 
     inner join place using (year)
     where player='Neeraj Chopra' ;";

$q1=pg_fetch_assoc(pg_query($conn,$tm));
$q2=pg_fetch_assoc(pg_query($conn,$fm));
$q3=pg_fetch_assoc(pg_query($conn,$ffm));
$q4=pg_fetch_assoc(pg_query($conn,$hoc));
$q5=pg_fetch_assoc(pg_query($conn,$pv));
$q6=pg_fetch_assoc(pg_query($conn,$nc));
$q7=pg_fetch_assoc(pg_query($conn,$tg));

?>

<br><br>
<div class="top">
    <h2>India's History  at the Olympic Games</h2>
</div>
<div class="in">
    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSE2ixMT_MGpe5XNZZwPA_V8tILQAJzkn2H-A&usqp=CAU" alt="Indians with olympic" style="width:600px;height:400px;padding-left:30%;">
</div>
<div class="art"><p>As the curtains fell on the most recent Olympic Games, India stood on the global stage with a commendable display of talent, determination, and sportsmanship. 
    The past three Olympics have witnessed a transformative journey for Indian athletes, marking a paradigm shift in the nation's sporting narrative.</p>
   <h2>Rio 2016: The Turning Point</h2>
   <p>In Rio de Janeiro, India witnessed a watershed moment as PV Sindhu clinched a historic silver in badminton, 
    becoming the first Indian woman to achieve this feat. Sakshi Malik also etched her name in history, securing 
    a bronze in wrestling. These victories laid the foundation for a new era of Indian sporting prowess.</p>

   <h2> Tokyo 2020/21: </h2>
 
    <p>A Symphony of Triumphs
    Despite the delay due to the pandemic, 
    the Tokyo Olympics showcased India's growing dominance 
    across various disciplines. Neeraj Chopra's gold in javelin 
    throw marked a historic milestone, bringing home India's first-ever athletics gold. 
    Mirabai Chanu's silver in weightlifting and Ravi Kumar Dahiya's wrestling silver further solidified 
    India's position on the podium.</p>
    <h2>Emerging Talents and Team Triumphs</h2>
   
    <p>The emergence of young talents like Lovlina Borgohain in boxing and the stellar
         performance of the men's and women's hockey teams added a collective shine to India's medal haul.
 The grit displayed by these athletes showcased the depth of India's sporting prowess, hinting at a promising future.</p>
    
   <h2>Infrastructure, Support, and Systemic Changes</h2>
   <p>The improved infrastructure, targeted coaching, and robust support systems have played a pivotal role in nurturing 
    talent. Government initiatives like the Khelo India program and the increased focus on grassroots development have 
    contributed to the nation's sporting resurgence.</p>
    <p>In conclusion, India's performance over the past three Olympics reflects a nation that is not just
    participating but competing fiercely on the global stage. The medals won are not merely metal; 
    they are the embodiment of dreams, sacrifices, and a testament to the unyielding spirit of Indian athletes.
     As the world eagerly anticipates the next Olympic chapter, India stands poised to script more tales of triumph 
     and inspiration.</p></div>
    <br> <br> 

<br><br>
<h2> FAQs </h2>
<div>
    <hr>
    <h3> How many medals are won by India in the Olympics ? <span class="material-symbols-outlined" 
        onclick="q1(this)"> stat_minus_1 </span></h3>
    <p id="q1" style="display:none"> <?php echo $q1['count'], " Medals ";?> </p>
</div>

<div>
    <hr>
    <h3> How many gold medals are won by Indian hockey team in the Olympics ? <span class="material-symbols-outlined" 
        onclick="q7(this)"> stat_minus_1 </span></h3>
    <p id="q7" style="display:none"> <?php echo $q7['count'], " Golds ";?> </p>
</div>

<div>
    <hr>
    <h3> Who won the first Olympics medal for India? <span class="material-symbols-outlined" 
        onclick="q2(this)"> stat_minus_1 </span></h3>
    <p id="q2" style="display:none"> 
    <?php echo $q2['player'], " won ", $q2['medal'] , " medal in ", $q2['sport'], " in the year ", $q2['year'];?> </p>

</div>

<div>
    <hr>
    <h3> Who won the first Olympics medal for India in Women's Category? <span class="material-symbols-outlined" 
        onclick="q3(this)"> stat_minus_1 </span></h3>
    <p id="q3" style="display:none"> 
    <?php echo $q3['player'], " won ", $q3['medal'] , " medal in ", $q3['sport'] ," in the year " ,$q3['year'];?> </p>
</div>

<div>
    <hr>
    <h3> How many gold medals are won by Indian hockey team in the Olympics ? <span class="material-symbols-outlined" 
        onclick="q4(this)"> stat_minus_1 </span></h3>
    <p id="q4" style="display:none"> <?php echo $q4['count'], " Golds ";?> </p>
</div>

<div>
    <hr>
    <h3> How many medals are won by PV Sindhu in the Olympics ? <span class="material-symbols-outlined" 
        onclick="q5(this)"> stat_minus_1 </span></h3>
    <p id="q5" style="display:none"> <?php echo $q5['count'], " Medals ";?> </p>
</div>

<div>
    <hr>
    <h3> Who is Neeraj Chopra ? <span class="material-symbols-outlined" 
        onclick="q6(this)"> stat_minus_1 </span></h3>
    <p id="q6" style="display:none"> 
    <?php echo $q6['player'] , " won ", $q6['medal'] , " medal in ", $q6['sport'], " in ",$q6['city']," , " ,$q6['year'];
    echo " . He is the first Indian to won the olympics Gold medal in Athletics.";?> </p>
</div>

<br><br>

<script>
    function q1(ele){
        if(document.getElementById('q1').style.display=='none'){
            ele.innerHTML= "stat_1";
            document.getElementById('q1').style.display='block';
        }else{
            ele.innerHTML= "stat_minus_1";
            document.getElementById('q1').style.display='none';
        }
    }

    function q2(ele){
        if(document.getElementById('q2').style.display=='none'){
            ele.innerHTML= "stat_1";
            document.getElementById('q2').style.display='block';
        }else{
            ele.innerHTML= "stat_minus_1";
            document.getElementById('q2').style.display='none';
        }
    }

    function q3(ele){
        if(document.getElementById('q3').style.display=='none'){
            ele.innerHTML= "stat_1";
            document.getElementById('q3').style.display='block';
        }else{
            ele.innerHTML= "stat_minus_1";
            document.getElementById('q3').style.display='none';
        }
    }

    function q4(ele){
        if(document.getElementById('q4').style.display=='none'){
            ele.innerHTML= "stat_1";
            document.getElementById('q4').style.display='block';
        }else{
            ele.innerHTML= "stat_minus_1";
            document.getElementById('q4').style.display='none';
        }
    }

    function q5(ele){
        if(document.getElementById('q5').style.display=='none'){
            ele.innerHTML= "stat_1";
            document.getElementById('q5').style.display='block';
        }else{
            ele.innerHTML= "stat_minus_1";
            document.getElementById('q5').style.display='none';
        }
    }

    function q6(ele){
        if(document.getElementById('q6').style.display=='none'){
            ele.innerHTML= "stat_1";
            document.getElementById('q6').style.display='block';
        }else{
            ele.innerHTML= "stat_minus_1";
            document.getElementById('q6').style.display='none';
        }
    }

    function q7(ele){
        if(document.getElementById('q7').style.display=='none'){
            ele.innerHTML= "stat_1";
            document.getElementById('q7').style.display='block';
        }else{
            ele.innerHTML= "stat_minus_1";
            document.getElementById('q7').style.display='none';
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
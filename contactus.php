<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="About" content="About , Feedback">
    <title>Olystat - Unleashing Olympic Insights</title>
    <link rel="stylesheet" type="text/css" href="home.css"> 
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        .text{
            padding-left:20%;
            padding-right:20%;
        }

        .mission-statement {
            background-color: #f9f9f9;
            padding: 15px;
            margin-top: 20px;
        }

        .cta {
            padding-left:20%;
            padding-right:20%;
            margin-top: 20px;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-size: 30px;
        }

        input,
        textarea {
            width: 100%;
            left:20%;
            right:20%;
            margin-bottom: 16px;
            box-sizing: border-box;
            height: 50px;
            font-size: 30px;
        }

        textarea{
            height: 120px;
        }

        button {
            background-color: #ff6600;
            color: #fff;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            font-size: 30px;
        }

        button:hover {
            background-color: #e55e00;
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
                    <li><a href="india.php"> India's Road </a></li>
                    <li><a href="form.php"> Training </a></li>
                    <li><a href="contactus.php"  style="background-color:orange;color: white;"> Contact Us </a></li>
                </ul>
                <br>
            </nav>
        </header>
        

    <section class="text">
        <h2>About Olystat</h2>
        <p>Welcome to Olystat, your premier destination for in-depth Olympic statistical insights and athlete training programs. As a trailblazer in the sports industry, Olystat is dedicated to unraveling the stories behind the numbers, offering a comprehensive view of Olympic data that inspires athletes, enthusiasts, and professionals alike.</p>

        <p>At Olystat, we go beyond the surface to provide a dynamic platform where statistical data meets the aspirations of athletes. Our commitment to excellence is evident in the meticulous curation of Olympic statistics, creating a valuable resource for analysis, trend identification, and strategic planning.</p>

        <h2>Developed By</h2>
        <p> 1. Gokulakrishnan.E - 2022115037 , B.Tech - IT , CEG </p> 
        <p> 2. Deepak Chandhru.N - 2022115112  , B.Tech - IT , CEG </p> 

        <h2>Mission Statement</h2>
        <div class="mission-statement">
            <p>At Olystat, our mission is to be the catalyst for sporting success by providing unparalleled access to Olympic statistical data and fostering the growth of aspiring athletes through world-class training programs. We are driven by a passion for sports, a commitment to data-driven insights, and a belief in the transformative power of athletic training.</p>

            <p>Our primary goal is to democratize Olympic data, making it accessible and actionable for athletes, coaches, and sports enthusiasts. Through meticulous research and analysis, we aim to be the go-to source for Olympic statistics, empowering individuals and organizations to make informed decisions in the world of sports.</p>

            <p>In tandem with our commitment to data, Olystat is dedicated to nurturing the next generation of athletes. Our training programs blend expertise, innovation, and personalized coaching to create an environment where aspiring athletes can thrive, hone their skills, and realize their full potential.</p>
        </div>
    </section>

    <section class="cta">
        <h2>Join Olystat on the Journey to Sports Excellence</h2>
        <p>Discover the intersection of data-driven excellence and athletic prowess with Olystat - where statistics come to life, and champions are forged.</p>
      
        <form method="post">
            <label for="name">Your Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Your Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="message">Your Message:</label>
            <textarea id="message" name="message" rows="4" required></textarea>

            <button type="submit" id="submit" name="submit">Submit Feedback</button>
        </form>
    </section>
    <?php
        include "conn.php";

        if(array_key_exists('submit',$_POST)){       
            $name= $_POST['name'];
            $email= $_POST['email'];
            $feedback= $_POST['message'];
            $sql="INSERT INTO feedback(username,email,feedback) VALUES('$name','$email','$feedback') ;";
            $result = pg_query($conn,$sql);
            echo "<script> window.alert('Thank you for your valuable inputs.') ;</script>";
        }
    ?>

<br><br>
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

<?php
    include 'session.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="application" content="Training">
    <title>Training</title>
    <link rel="stylesheet" type="text/css" href="home.css">
    <style>
        body {
            background-image: url("data:image/jpeg;base64,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");
            background-repeat: no-repeat;
            background-size: cover;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .content {
            padding: 20px;
            background-color: #FFFACD;
            border: 2px solid #FF4500;
            border-radius: 10px;
            text-align: center;
            margin: 20px auto;
            max-width: 800px;
        }

        .content h1 {
            font-size: 28px;
            color: #FF4500;
            margin-bottom: 20px;
        }

        .content p {
            font-size: 18px;
            color: #333;
            margin-bottom: 20px;
        }

        .orange-button {
            background-color: #ffA500;
            color: #fff;
            padding: 10px 20px;
            border: 2px solid #fff;
            border-radius: 10px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px; 
        }

        .orange-button:hover {
            background-color: #ffD700;
        }

        form {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            font-size: 40px;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }

        input, select {
            font-size: 30px;
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button {
            font-size: 30px;
            background-color: orange;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color:orangered;
        }
            .container {
            max-width: 800px;
            margin: 20px auto;
            overflow: hidden;
            
        }
        .container {
            color: green;
            background-color: white;
            max-width: 800px;
            margin: 20px auto;
            overflow: hidden;
            
        }

        .image {
            float: right;
            max-width: 40%;
            margin-left: 20px;
            border: 5px orange solid;
        }
        .image.hover{
            size: 100%;
            transition-duration: 5s;
        }

        .text {
            float: left;
            max-width: 50%;
            font-size: 30px;
        }

        .container::after {
            display: table;
            clear: both;
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
                <li><a href="form.php" style="background-color:orange;color: white;"> Training </a></li>
                <li><a href="contactus.php"> Contact Us </a></li>
            </ul>
    <br>
        </nav>
    </header>
    
    <section class="content">
        <h1>Welcome to Khelo India Games Training Portal</h1>
        <p>Seize your athletic destiny. Enroll now and transform potential into triumph! Don't wait, start your journey to greatness today!</p>
        <br>
        <a href="#app" style=" scroll-behavior: smooth;">
        <button class="orange-button">Just Begin Your Journey By Filling out the Form Below</button></a>
    </section>
    <form method="post" id="app">
        <h2>Sport Aspirants Admission Form</h2>

        <label for="name">Full Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="phone">Phone Number:</label>
        <input type="tel" id="phone" name="phone" required>

        <label for="sport">Preferred Sport:</label>
        <input type="text"  id="sport" name="sport"  required>

        <label for="state">State:</label>
        <input type="text"  id="state" name="state"  required>
           
        <label for="experience" dafault="0">Sport Experience (years):</label>
        <input type="number" id="experience" name="experience" min="0" max="40">

        <button type="submit" id="submit" name="submit">Submit Application</button>
    </form>

    <?php

    include "conn.php";

    if(array_key_exists('submit',$_POST)){
        if($_SESSION['mode']!='guest'){
            $name= $_POST['name'];
            $email= $_POST['email'];
            $phone= $_POST['phone'];
            $preference= $_POST['sport'];
            $exp= $_POST['experience'];
            $state= $_POST['state'];
            if($exp<0){
                echo "<script> window.alert('Enter a valid experience.') ;</script>";
            }else{
                if(strlen($phone) == 10){
                    $sql="INSERT INTO application(name,email,phone,preference,exp,state) VALUES('$name','$email','$phone','$preference','$exp','$state') ;";
                    $result = pg_query($conn,$sql);  
                    echo "<script> window.alert('your form submitted successfully our team will contact soon.') ;</script>";  
                }else{
                    echo "<script> window.alert('Enter a valid mobile number.') ;</script>";
                }
            }  
        }else{
            echo "<script> window.alert('Guest users cannot submit form.Please login into your account.') ;
            window.location.href='logout.php'</script>";
        } 
    }
    ?>
        <br>
        <h2 style="color: orange;font-family:Verdana, Geneva, Tahoma, sans-serif;font-weight: 900;
        text-decoration: wavy;" > ACHIEVERS WORDS</h2>
        <hr style="width: 20% ;align-items: center;background-color: orange;height:3px">
        <br>
        <div class="container">
            
            <img src="data:image/jpeg;base64,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" alt="Your Image" class="image">
            
            <div class="text">
                <br>
            
                <br>
                <p style="font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;font-weight: 900;">
                The comprehensive training modules cater to individual strengths, making it a versatile haven for athletes. It isn't just a training ground; it's the launchpad where medals are forged.</p>
                    <br>
                    <p style="font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;font-weight: 900;">Pusarla Venkata Sindhu</p>
                    <p style="font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;font-weight: 900;">2 times Olympic Medallist-Badmitton</p>
            <br>
                
            </div>
        </div>

    <br>

    <div class="container">
        <img src="data:image/jpeg;base64,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" 
        alt="Your Image" class="image">
        <div class="text">
            <p style="font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;font-weight: 900;">
                The expert coaching, cutting-edge facilities, and a community of champions make it an unparalleled training ground. Personalized programs cater to individual strengths, ensuring a holistic development approach. Medals aren't just earned here; they are forged through dedication and world-class training. 
            </p>
            <br>
            
            <p style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;font-weight: 900;">Ravi Kumar Dahiya</p>          
            <p style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;font-weight: 900;">Olympic Bronze Medallist - Wrestler</p>          
        
        </div>
    </div>  
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

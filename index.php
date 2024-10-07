<?php
error_reporting(0);
session_start();
session_destroy();

// Displaying success message
if ($_SESSION["successMessage"]) {
    $message = $_SESSION["successMessage"];
    echo "<script type='text/javascript'>
    alert('$message');
    </script>";
}

// Database credentials
$host = "localhost";
$user = "root";
$password = "";
$db = "schoolmanagementProject";

// Database connection
$data = mysqli_connect($host, $user, $password, $db);

// Checking if connection to the database was successful
if (!$data) {
    die("Connection failed: " . mysqli_connect_error());
}

// SQL query
$sql = "SELECT * FROM Teachers";
$result = mysqli_query($data, $sql);

// Checking if the query execution was successful
if (!$result) {
    die("Query failed: " . mysqli_error($data));
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>student mangement systen</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body class="body">
    <nav>
        <label class="logo">SkillUp</label>
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">Contact</a></li>
            <li><a href="#">Admission</a></li>
            <li><a class="btn btn-success" href="login.php">Login</a></li>

        </ul>
    </nav>
    <div class="section1">
        <label class="img_text">We Teach Student With Care</label>
       
        <img class="main_img" src="images/schoolbiulding.png" alt="#">

    </div>
    <div class="container">
        <div class="row">

            <div class="col-md-4">
                <img class="welcome_img" src="images/schoolbiulding2.jpeg" alt="">
             
            </div>
            <div class="col-md-8">
            <h1>Welcome To SkillUp academy</h1>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Officia 
                    officiis reiciendis aliquam placeat expedita ad quos? Reiciendis n
                    emo ipsam, ducimus earum explicabo enim eum quam paria
                    tur excepturi vel, consequatur iste. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates nostrum voluptatem, itaque quae aliquid ipsa inventore sed id vitae dolor quod sint possimus quam odit nobis at molestias. Cumque, ducimus.</p>
            </div>
        </div>
    </div>
    <center>
        <h1>Our Teachers</h1>
    </center>
    <div class="container">
        <div class="row">
            <?php
            while($info=$result->fetch_assoc()){

            
            ?>
            <div class="col-md-4">
                <img class="teacher" src="<?php echo"{$info['image']}" ?>" alt="">
                <h3><?php echo"{$info['name']}" ?></h3>
                <p><?php echo"{$info[' teacher_desc']}" ?></p>
            </div>
           <?php 
        }; ?>

        </div>
    </div>
    <center>
        <h1>Our Courses</h1>
    </center>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <img class="teacher" src="images/graphicdesign.jpeg" alt="">
                <h3>Graphic Designing</h3>

            </div>
            <div class="col-md-4">
                <img class="teacher" src="images/webdevelopment.jpg" alt="">
                <h3>web Development</h3>

            </div>
            <div class="col-md-4">
                <img class="teacher" src="images/digitalmarketing.jpeg" alt="">
                <h3>Digital Marketing</h3>


            </div>

        </div>
    </div>
    <center class= "admission">
    
        <h1 class="adm">Admission Form</h1>
     </center>
        <div align="center" class="admission_form">
        <form action="check.php" method="POST">
        <h3>
            <?php 
            session_start();
           
            echo $_SESSION["emptyfield"];

            ?>
        </h3>
    <div class="adm_in">
        <label class="label_text" for="">Name</label>
        <input class="input_deg" type="text" name="name">
    </div>
    <div class="adm_in">
        <label class="label_text" for="">Email</label>
        <input class="input_deg" type="text" name="email">
    </div>
    <div class="adm_in">
        <label class="label_text" for="">Phone</label>
        <input class="input_deg" type="text" name="phone">
    </div>
    <div class="adm_in">
        <label class="label_text" for="">Message</label>
        <textarea class="input_text" name="message"></textarea>
    </div>
    <div class="adm_in">
        <input class="btn btn-primary" name="submit" type="submit" value="apply">
    </div>
</form>

        </div>
   <footer>
    <h3 class="footer_text">All @copyright reserved by ebuka</h3>
   </footer>
</body>
</html>
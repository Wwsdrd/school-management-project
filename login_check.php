<?php
// Error display and correction code 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

// db connection code 
$host = "localhost";
$user = "root";
$password = "";
$db = "schoolmanagementProject";

$data = mysqli_connect($host, $user, $password, $db);

if ($data == false) {
    die("Connection Error");
}

// Password Check and validation Code
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = $_POST['username'];
    $password = $_POST['password'];

    // Corrected SQL query with proper syntax
    $sql = "SELECT * FROM users WHERE username = '$name' AND password = '$password'";
    
    $result = mysqli_query($data, $sql);

    // Check if a matching user was found
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        
        // Redirect based on user type
        if ($row["usertype"] == "student") {
            $_SESSION["username"]=$name;
            $_SESSION["usertype"]="student";

            header("location:studenthome.php");
        } elseif ($row["usertype"] == "teacher") {
            header("location:teacherhome.php");
        } elseif ($row["usertype"] == "admin") {
            $_SESSION["username"]=$name;
            $_SESSION["usertype"]="admin";

            header("location:adminhome.php");
        }
    } else {
        session_start(); 
        $message = "Username or password is incorrect";
        $_SESSION['loginmessage']=$message;
        header('location:login.php');
    }
}
?>

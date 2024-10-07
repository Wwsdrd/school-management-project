<?php
// Error display and correction code 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Start session 
session_start();

// Database connection code 
$host = "localhost";
$user = "root";
$password = "";
$db = "schoolmanagementProject";

$data = mysqli_connect($host, $user, $password, $db);

if ($data == false) {
    die('Connection error');
}

// Check if form is submitted*
if (isset($_POST['submit'])) {
    // Collect form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];

    // Check if any field is empty
    if (empty($name) || empty($email) || empty($phone) || empty($message)) {
        $_SESSION["emptyfield"] = "All fields are required.";
        header("Location: index.php");
        exit(); // Ensure the script stops after redirection
    }

    // Insert query to insert user data into the database
    $sql = "INSERT INTO Admission(name, email, phone, message) VALUES ('$name', '$email', '$phone', '$message')";
    $result = mysqli_query($data, $sql);

    // Check if the query was successful
    if ($result) {
        $_SESSION['successMessage'] = "Application sent successfully.";
        header("Location: index.php");
        exit(); // Stop the script after redirection
    } else {
        // Output the error if the query fails
        echo "Apply failed: " . mysqli_error($data);
    }
}
?>

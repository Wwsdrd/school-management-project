<?php

$host = "localhost";
$user="root";
$password="";
$db= "schoolmanagementProject";
$data=mysqli_connect($host,$user,$password,$db);

if($_GET['student_id']){
    $user_id=$_GET['student_id'];
    $sql="DELETE FROM users WHERE id='$user_id'";
    $result= mysqli_query($data,$sql);
    if($result){
        $_SERVER['successMessage']="Student D";
        header("location:show_student.php");
    }
}

?>
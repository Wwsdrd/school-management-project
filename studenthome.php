
<?php
session_start();
if(!isset($_SESSION["username"])){
header("location:login.php");

}elseif($_SESSION["usertype"]=="admin"){
    header("location:login.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <?php
include"student_css.php";
?>
<body>
<?php
include"student_sidebar.php";

?>
  <div class="content">
        <h1>Student Home </h1>
    </div>
</body>
</html><samp></samp>
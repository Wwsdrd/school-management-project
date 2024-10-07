
<?php
session_start();
if(!isset($_SESSION["username"])){
header("location:login.php");

}elseif($_SESSION["usertype"]=="admin"){
    header("location:login.php");
}



$host = "localhost";
$user = "root";
$password = "";
$db = "schoolmanagementProject";

$data = mysqli_connect($host, $user, $password, $db);
$name=$_SESSION['username'];
$sql="SELECT * FROM users WHERE username='$name'";
$result=mysqli_query($data,$sql);
$info=mysqli_fetch_assoc($result);
if (isset($_POST['submit'])) {
   
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $password=$_POST['password'];
    $sql2="UPDATE users SET email='$email', phone='$phone', password='$password' WHERE username='$name'";
    $result2=mysqli_query($data,$sql2);
    if ($result2) {
        echo"<script type='text/javascript'>
        alert('Update success!');
        </script>";
       
    }
   

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
<style>
    label{
        display:inline-block;
        text-align:right;
        width: 100px;
        padding-top:10px;
        padding-bottom:10px;
    }
    .div_deg{
        background-color:skyblue;
        width: 500px;
        padding-bottom:70px;
        padding-top:70px;


    }
</style>
<body>
<?php
include"student_sidebar.php";
?>
  <div class="content">
    <center>
        <h1>Update Profile </h1>

        <div class="div_deg">
            <form action="#" method="POST">
              
                <div>
                    <label for="">Email</label>
                    <input type="email"name="Email" value="<?php echo"{$info['email']}"  ?>">
                </div>    <div>
                    <label for="">Phone</label>
                    <input type="number"name="phone" value="<?php echo"{$info['phone']}"  ?>">
                </div>    <div>
                    <label for="">Password</label>
                    <input type="password"name="password" value="<?php echo"{$info['password']}"  ?>">
                </div>    <div>
                   
                    <input class="btn btn-primary" type="submit"name="submit" name="submit" value="Update profile">
                </div>
            </form>
        </div>
        </center>
    </div>
</body>
</html><samp></samp>
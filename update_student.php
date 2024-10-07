
<?php
session_start();
if(!isset($_SESSION["username"])){
header("location:login.php");

}elseif($_SESSION["usertype"]=="student"){
    header("location:login.php");
}

$host="localhost";
$user ="root";
$password="";
$db="schoolmanagementProject";
$data =mysqli_connect($host,$user,$password,$db,);
$id=$_GET['student_id'];
$sql= "SELECT * FROM users WHERE id='$id'";
$result=mysqli_query($data,$sql);
$info=$result->fetch_assoc();

if(isset($_POST['update'])){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $password=$_POST['password'];
    $query= "UPDATE users SET username='$name', email='$email', phone='$phone',password='$password' WHERE id='$id'";

    $result2= mysqli_query($data, $query);
    if ($result2) {
     header('location:show_student.php');
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
    include"admin_css.php";
    ?>
    <style>
        label{
            display:inline-block;
            width: 100px;
            text-align:right;
            padding-top:10px;
            padding-bottom:10px;
        }
        .div_deg{
            background-color:skyblue;
            width: 400px;
            padding-bottom:70px;
            padding-top:70px;
        }
    </style>
   
</head>
<body>
 
<?php
include"admin_sidebar.php";
?>

    <div class="main-content">
        <header>
            <h1>Dashboard</h1>
            <div class="user-wrapper">
                
                <div>
                <!-- <li><a class="Btn" href="log_out.php">Logout</a></li> -->
                 
<a class="Btn"href="log_out.php">
  
  <div class="sign"><svg viewBox="0 0 512 512"><path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"  ></path></svg></div>
  
  <div class="text">Logout</div>
</a>


 
                </div>
            </div>
        </header>
        <main>
            <center>
        <h1>Update student</h1>
        <br>
        <div class="div_deg">

        <form action="#" method="POST">
        <div>
            <label for="">Username</label>
            <input type="text" name="name" value="<?php echo"{$info['username']}" ?>">
        </div>

        <div>
            <label for="">Email</label>
            <input type="email" name="email" value="<?php echo"{$info['email']}" ?>">
        </div>
        <div>
            <label for="">Phone</label>
            <input type="number" name="phone" value="<?php echo"{$info['phone']}" ?>">
        </div>
        <div>
            <label for="">Password</label>
            <input type="text" name="password" value="<?php echo"{$info['password']}" ?>">
        </div>
        <div>
        
            <input class="btn btn-success" type="submit" name="update" value="Update">
        </div>
        </form>
        </div>
        </center>

        </main>
    </div>
</body>
</html>

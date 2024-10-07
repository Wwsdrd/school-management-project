
<?php
session_start();
if(!isset($_SESSION["username"])){
header("location:login.php");

}elseif($_SESSION["usertype"]=="student"){
    header("location:login.php");
}

$host = "localhost";
$user = "root";
$password = "";
$db = "schoolmanagementProject";
$data = mysqli_connect($host, $user, $password, $db);
if ($_GET['teacher_id']) {
  $id=$_GET['teacher_id'];
  $sql="SELECT * FROM Teachers WHERE id ='$id'";
  $result=mysqli_query($data,$sql);
  $info=$result->fetch_assoc();
}

if (isset($_POST['submit'])) {
    $name= $_POST['name'];
    $desciption= $_POST['description'];
    $image_file= $_FILES['image']['name'];
    $dst = './image/' . $image_file;
    $dst_db = 'image/' . $image_file;
    
    move_uploaded_file($_FILES['image']['tmp_name'],$dst);
    if ($image_file) {
    $sql2 = "UPDATE Teachers SET name ='$name', teacher_desc='$desciption', image='$dst_db' WHERE id='" . $_GET['teacher_id'] . "'";
        
    }else{
    $sql2 = "UPDATE Teachers SET name ='$name', teacher_desc='$desciption' WHERE id='" . $_GET['teacher_id'] . "'";

    }
    $result2=mysqli_query($data,$sql2);
    if ($result2) {
        # code..
       header('location:admin_view_teacher.php');
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
            width: 150px;
            text-align:right;
            padding-top:10px;
            padding-bottom:10px;

        }
        .form_deg{
            background: #024e59;
            width: 400px;
            padding-top: 70px;
            padding-bottom: 70px;
            color: #fff;
        

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
        <h1>Update Teacher Data</h1>

            <form class="form_deg" action="#" method="POST" enctype="multypart/form-data">
                <div>
                    <label for="">Teacher name</label>
                    <input type="text" name="name" value="<?php echo"{$info['name']}"  ?>">
                </div>
                <div>
                    <label for="">About Teacher</label>
                 <textarea name="description"><?php echo"{$info['teacher_desc']}"  ?></textarea>
                </div>
                <div>
                    <label for="">Teacher old Image</label>
                    <img width="100px" hight="100px" src="<?php echo"{$info['image']}"  ?>" alt="">
                </div>
                <div>
                    <label for="">Teacher new Image</label>
                    <input type="file" name="image">
                </div>
                <div>   <input class="btn btn-success" type="submit" name="submit" value="Update Teacher">
            </div>
             

            </form>
        </center>

        </main>
    </div>
</body>
</html>

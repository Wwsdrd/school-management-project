<?php
session_start();
if(!isset($_SESSION["username"])){
header("location:login.php");

}elseif($_SESSION["usertype"]=="student"){
    header("location:login.php");
}

$host= "localhost";
$user = "root";
$password = "";
$db= "schoolmanagementProject";
$data= mysqli_connect($host, $user, $password, $db);
$sql = "SELECT * FROM Admission";
$result= mysqli_query($data, $sql);
if(isset( $_SESSION[$id])){
  $id= $_SESSION[$id];
  $sql3="DELETE FROM Admission WHERE id= '$id'";
  $result3=mysqli_query($data,$sql3);
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
    .table_th{
        padding: 20px;  
        font-size: 15px;
        background: linear-gradient(to bottom, #0f0c29, #302b63, #24243e);
        color: #fff;

    }
    .table_td{
        padding: 20px;     color: #fff; background: #024e59;
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
                                
<a class="Btn"href="log_out.php">
  
  <div class="sign"><svg viewBox="0 0 512 512"><path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"  ></path></svg></div>
  
  <div class="text">Logout</div>
</a>
                   
                </div>
            </div>
        </header>
        <main>
     
        <center>
        <h2>Applied for Admission</h2>
       
        <table border="1px">
            <tr>
                <th class="table_th">Name</th>
                <th class="table_th">Email</th>
                <th class="table_th">Phone</th>
                <th class="table_th">Message</th>
                <th class="table_th">Add Student</th>
            </tr>
            <?php
            while($info= $result->fetch_assoc()){

         

            ?>
            <tr>
                <td class="table_td">
                    <?php echo"{$info['name']}"; ?>
                </td>
                <td class="table_td">
                <?php echo"{$info['email']}"; ?>
                </td>
                <td class="table_td">
                <?php echo"{$info['phone']}"; ?>
                </td>
                <td class="table_td" >
                <?php echo"{$info['message']}"; ?>
                </td>
                <td class="table_td">
                <?php echo"<a class='btn btn-primary' href='add_student.php?student_id={$info['id']}'>Add student</a>"; ?>
                </td>
            </tr>
            <?php
               }
            ?>
        </table>
        </center>
        </main>
    </div>
</body>
</html>
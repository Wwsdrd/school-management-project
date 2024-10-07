<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("location:login.php");
} elseif ($_SESSION["usertype"] == "student") {
    header("location:login.php");
}

$host = "localhost";
$user = "root";
$password = "";
$db = "schoolmanagementProject";
$data = mysqli_connect($host, $user, $password, $db);

if (!$data) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM Teachers";
$result = mysqli_query($data, $sql);

if (isset($_GET['teacher_id'])) {
    $id = mysqli_real_escape_string($data, $_GET['teacher_id']);
    $sql2 = "DELETE FROM Teachers WHERE id='$id'";
    $result2 = mysqli_query($data, $sql2);
    if ($result2) {
        echo "Delete is successful";
        header('location:admin_view_teacher.php');
    } else {
        echo "Error deleting record: " . mysqli_error($data);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <?php include "admin_css.php"; ?>
    <style>
       .table_th {
            padding:20px;
            font-size:20px;
            background: linear-gradient(to bottom, #0f0c29, #302b63, #24243e);
            color: #fff;
        }
        .table_td {
            padding:20px;
            background: #024e59;
            color: #fff;
        }
    </style>
</head>
<body>
 
<?php include "admin_sidebar.php"; ?>

<div class="main-content">
    <header>
        <h1>Dashboard</h1>
        <div class="user-wrapper">
            <a class="Btn" href="log_out.php">
                <div class="sign">
                    <svg viewBox="0 0 512 512"><path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"></path></svg>
                </div>
                <div class="text">Logout</div>
            </a>
        </div>
    </header>
    <main>
        <center>
            <h1>View Teachers Data</h1>
            <div>
                <table border="1px">
                    <tr>
                        <th class="table_th">Teacher Name</th>
                        <th class="table_th">About Teacher</th>
                        <th class="table_th">Teacher Image</th>
                        <th class="table_th">Delete</th>
                        <th class="table_th">Update</th>
                    </tr>
                    <?php while($info = $result->fetch_assoc()) { ?>
                    <tr>
                        <td class="table_td"><?php echo $info['name']; ?></td>
                        <td class="table_td"><?php echo $info['teacher_desc']; ?></td>
                        <td class="table_td">
                            <img height="100px" width="100px" src="<?php echo $info['image']; ?>" alt="Teacher Image">
                            <td class="table_td">
                             <a onclick="return confirm('Are you sure you want to delete this person?');" class='btn btn-danger' href='admin_view_teacher.php?teacher_id=<?php echo $info['id']; ?>'>Delete</a>
                        </td>

                        <td  class="table_td">
                        <?php  echo"    
                        <a class='btn btn-primary' href='admin_update_teacher.php?teacher_id={$info['id']}'>Update</a></td>
                        "?>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </center>
    </main>
</div>
</body>
</html>

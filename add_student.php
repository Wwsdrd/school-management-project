<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
if (!isset($_SESSION["username"])) {
    header("location:login.php");
} elseif ($_SESSION["usertype"] == "student") {
    header("location:login.php");
}

// Database connection
$host = "localhost";
$user = "root";
$password = "";
$db = "schoolmanagementProject";
$data = mysqli_connect($host, $user, $password, $db);

// Fetch student data by ID
$info = null; // Default value if no ID is provided
if (isset($_GET['student_id'])) {
    $id = $_GET['student_id'];
    $sql2 = "SELECT * FROM users WHERE id='$id'";
    $result2 = mysqli_query($data, $sql2);

    if ($result2) {
        $info = $result2->fetch_assoc();
    } else {
        echo "Error fetching student data: " . mysqli_error($data);
    }
}

// Form submission for adding a student
if (isset($_POST['add_student'])) {

    $username = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $usertype = 'student';

    // Check if any field is empty
    if (empty($username) || empty($email) || empty($phone) || empty($password)) {
        echo "<script type='text/javascript'>
        alert('All fields are required');
        </script>";
    } else {
        // Check if the username already exists
        $check = "SELECT * FROM users WHERE username='$username'";
        $check_user = mysqli_query($data, $check);

        if ($check_user && mysqli_num_rows($check_user) > 0) {
            echo "<script type='text/javascript'>
            alert('Username already exists');
            </script>";
        } else {
            // Insert the new student
            $sql = "INSERT INTO users(username, phone, email, usertype, password) VALUES('$username', '$phone', '$email', '$usertype', '$password')";
            $result = mysqli_query($data, $sql);

            if ($result) {
                echo "<script type='text/javascript'>
                alert('Data uploaded successfully');
                </script>";
                header('location:show_student.php');
               
                $_SESSION[$id];
               
            } else {
                echo "Upload failed: " . mysqli_error($data);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        label {
            display: inline-block;
            text-align: right;
            width: 100px;
            padding-top: 10px;
            padding-bottom: 10px;
        }
        .div_deg {
            background: #024e59;
            width: 400px;
            padding-top: 70px;
            padding-bottom: 70px;
            color: #fff;
        }
    </style>
    <?php
    include "admin_css.php";
    ?>
</head>
<body>

<?php
include "admin_sidebar.php";
?>

<div class="main-content">
    <header>
        <h1>Dashboard</h1>
        <div class="user-wrapper">
            <div>
                <a class="Btn" href="log_out.php">
                    <div class="sign"><svg viewBox="0 0 512 512"><path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"></path></svg></div>
                    <div class="text">Logout</div>
                </a>
            </div>
        </div>
    </header>
    <main>
        <center>
        <h2><?php echo $info ? "Edit Student" : "Add Student"; ?></h2>
        <form action="#" method="POST">
            <div class="div_deg">
                <div>
                    <label for="">Username</label>
                    <input type="text" name="name" value="<?php echo isset($info['username']) ? $info['username'] : ''; ?>">
                </div>

                <div>
                    <label for="">Email</label>
                    <input type="text" name="email" value="<?php echo isset($info['email']) ? $info['email'] : ''; ?>">
                </div>

                <div>
                    <label for="">Phone</label>
                    <input type="number" name="phone" value="<?php echo isset($info['phone']) ? $info['phone'] : ''; ?>">
                </div>

                <div>
                    <label for="">Password</label>
                    <input type="text" name="password">
                </div>

                <div>
                    <input type="submit" class="btn btn-primary" name="add_student" value="Add">
                </div>
            </div>
        </form>
        </center>

    </main>
</div>
</body>
</html>

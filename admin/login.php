<?php
session_start();
include("../includes/db.php");

//Handle login form
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $password = md5($_POST['password']); //match stored MD5

    $sql = "SELECT * FROM admin WHERE username = '$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $_SESSION['admin'] = $username; //store login session
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Admin Login</title>
    </head>
<body>
    <h2>Admin Login</h2>
    <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="POST" action="">
        <label>Username:</label><br>
        <input type="text" name="username" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">Login</button>
    </form>
</body>
</html>


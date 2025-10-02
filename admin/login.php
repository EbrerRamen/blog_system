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
        <link rel="stylesheet" href="../assets/css/style.css">
    </head>
<body class="login-page">
    <div class="form-container">
    <h2>Admin Login</h2>
    <?php if(isset($error)) echo "<p class='error'>" . htmlspecialchars($error) . "</p>"; ?>
    <form method="POST" action="">
        <label>Username:</label>
        <input type="text" name="username" required>

        <label>Password:</label>
        <input type="password" name="password" required>

        <button type="submit" class="edit-btn">Login</button>
    </form>
</div>
</body>
</html>


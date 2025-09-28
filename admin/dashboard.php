<?php
session_start();
include("../includes/db.php");

//check if logged in
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Admin Dashboard</title>
    </head>
    <body>
        <h2>Welcome, <?php echo $_SESSION['admin']; ?>!</h2>
        <a href="create.php">+ Create New Post</a>
        <a href="logout.php">Logout</a>
        <hr>

        <h3>All Posts</h3>
        <?php
        $result = $conn->query("SELECT * FROM posts ORDER BY created_at DESC");
        while($row = $result->fetch_assoc()) {
            echo "<h4>" . $row['title'] . "</h4>";
            echo "<a href='edit.php?id=" . $row['id'] . "'>Edit</a> | ";
            echo "<a href='delete.php?id=" . $row['id'] . "' onclick='return confirm(\"Are you sure?\")'>Delete</a>";
            echo "<hr>";
        }
        ?>
    </body>
</html>

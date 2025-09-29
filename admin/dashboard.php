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
        <link rel="stylesheet" href="../assets/css/style.css">
    </head>
    <body class="dashboard">

    <!-- Sidebar -->
     <div class="sidebar">
        <h2>Welcome, <?php echo $_SESSION['admin']; ?>!</h2>
        <a href="create.php">+ Create New Post</a>
        <a href="logout.php">Logout</a>
</div>
<div class="main-content">
        <h2>All Posts</h2>
        <?php
        $result = $conn->query("SELECT * FROM posts ORDER BY created_at DESC");
        if ($result->num_rows >0){
            echo "<table>";
            echo "<tr><th>ID</th><th>Title</th><th>Created At</th><th>Actions</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row['id']."</td>";
            echo "<td>".$row['title']."</td>";
            echo "<td>".$row['created_at']."</td>";
            echo "<td>";
            echo "<a href='edit.php?id=" . $row['id'] . "'><button class='action-btn edit-btn'>Edit</button></a>";
            echo "<a href='delete.php?id=" . $row['id'] . "' onclick='return confirm(\"Are you sure?\")'><button class='action-btn delete-btn'>Delete</button></a>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No posts yet. </p>";
    }
        ?>
        </div>
    </body>
</html>

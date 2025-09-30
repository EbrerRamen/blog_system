<?php
session_start();
include("../includes/db.php");

// Check if admin is logged in
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $conn->real_escape_string($_POST['title']);
    $content = $conn->real_escape_string($_POST['content']);

    $sql = "INSERT INTO posts (title, content) VALUES ('$title', '$content')";
    if ($conn->query($sql) === TRUE) {
        header("Location: dashboard.php"); // Redirect after successful creation
        exit;
    } else {
        $error = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
    <html>
        <head>
            <title>Create New Post</title>
            <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="dashboard">
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <a href="dashboard.php">Dashboard</a>
        <a href="logout.php">Logout</a>
</div>
<div class="main-content">
    <div class="form-container">
    <h2>Create New Post</h2>

    <?php if(isset($error)) echo "<p  class='error'>" . htmlspecialchars($error) . "</p>"; ?>

    <form method="POST" action="">
        <label>Title:</label><br>
        <input type="text" name="title" required>

        <label>Content:</label><br>
        <textarea name="content" rows="6" required></textarea>

        <button type="submit" class="create-btn">Create Post</button>
</form>
</div>
</div>
</body>
</html>


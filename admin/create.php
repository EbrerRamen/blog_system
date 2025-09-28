<?php
session_start();
include("../incldues/db.php");

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

<DOCTYPE html>
    <html>
        <head>
            <title>Create New Post</title>
</head>
<body>
    <h2>Create New Post</h2>
    <a href="dashboard.php">Back to Dashboard</a>
    <hr>

    <?php if(isset($error)) echo "<p style='colro:red; '>$error</p>"; ?>

    <form method="POST" action="">
        <label>Title:</label><br>
        <input type="text" name="title" required><br><br>

        <label>Content:</label><br>
        <textarea name="content" rows="10" cols="50" required></textarea><br><br>

        <button type="submit">Create Post</button>
</form>
</body>
</html>


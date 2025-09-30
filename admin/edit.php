<?php
include("../includes/db.php");
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// Make sure post id is passed
if (!isset($_GET['id'])) {
    die("No post ID provided");
}

$id = (int) $_GET['id'];

//Fetch the existing post
$result = $conn->query("SELECT * FROM posts WHERE id = $id");
if ($result->num_rows === 0) {
    die("Post not found.");
}

$post = $result->fetch_assoc();

// Update post when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $conn->real_escape_string($_POST['title']);
    $content = $conn->real_escape_string($_POST['content']);

    $sql = "UPDATE posts SET title='$title', content='$content' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error updating post: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Edit Post</title>
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
    <h2>Edit Post</h2>
    <?php if(isset($error)) echo "<p class='error'>" . htmlspecialchars($error) . "</p>"; ?>

    <form method="post">
        <label>Title</label>
        <input type="text" name="title" value="<?php echo htmlspecialchars($post['title']); ?>" required>

        <label>Content</label>
        <textarea name="content" rows="6" required><?php echo htmlspecialchars($post['content']); ?></textarea>

        <button type="submit" class="edit-btn">Update Post</button>
</form>
</div>
</div>
</body>
</html>
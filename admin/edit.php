<?php
include("../db.php")
session_start()

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
if ($result->numrows === 0) {
    die("Post not found.")
}

$post = $result->fetch_assoc();

// Update post when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $conn->real_escape_string($_POST['title']);
    $content = $conn->real_escape_string($_POST['content']);

    $sql = "UDPATE posts SET title='$title', content='$content', WHERE id=$id";

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
</head>
<body>
    <h2>Edit Post</h2>
    <form method="post">
        <input type="text" name="title" value="<?php echo htmlspecialchars($post['title']); ?>" required><br><br>
        <textarea name="content" rows="10" cols="50" required><?php echo htmlspecialchars($post['content']); ?></textarea><br><br>
        <button type="submit">Update</button>
</form>
<a href="dashboard.php">Back to Dashboard</a>
</body>
</html>
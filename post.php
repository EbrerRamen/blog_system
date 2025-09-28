<?php
include("includes/db.php");
include("includes/header.php");
?>

<?php
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // make sure it's an integer
    $sql = "SELECT * FROM posts WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $post = $result->fetch_assoc();
        echo "<h1>" . $post["title"] . "</h1>";
        echo "<p>" . nl2br($post['content']) . "</p>";
        echo "<small>Posted on " . $post['created_at'] . "</small>";
    } else {
        echo "<p>Post not found!</p>";
    }
} else {
    echo "<p>No post selected.</p>";
}
?>

<?php include("includes/footer.php"); ?>
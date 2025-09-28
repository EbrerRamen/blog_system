<?php include("includes/db.php"); ?>
<?php include("includes/header.php"); ?>

<h1>My Blog</h1>

<?php
$result = $conn->query("SELECT * FROM posts ORDER BY created_at DESC")
while($row = $result->fetch_assoc()) {
    echo "<h2><a href='post.php?id=" . $row['id'] . "'>" . $row['title'] . "</a><h2>";
    echo "<p>" . substr($row['content'], 0, 200) . "...</p>";
    echo "<small>Posted on " . $row['created_at'] . "</small><hr>";
}
?>

<?php include("includes/footer.php"); ?>
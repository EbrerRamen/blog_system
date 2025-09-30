<?php include("includes/db.php"); ?>
<?php include("includes/header.php"); ?>

<div class="blog-container">
    <h1 class="blog-title">My Blog</h1>

    <?php
    $result = $conn->query("SELECT id, title, content, created_at FROM posts ORDER BY created_at DESC");
    while($row = $result->fetch_assoc()) {
        echo "<div class='post-card'>";
        echo "<h2 class='post-title'><a href='post.php?id=" . $row['id'] . "'>" . htmlspecialchars($row['title']) . "</a></h2>";
        echo "<p class='post-excerpt'>" . htmlspecialchars(substr($row['content'], 0, 200)) . "...</p>";
        echo "<small class='post-meta'>Posted on " . $row['created_at'] . "</small>";
        echo "</div>";
    }
    ?>
</div>

<?php include("includes/footer.php"); ?>

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
        ?>
        <div class="blog-container">
            <article class="post-card">
                <h1 class="post-title"><?php echo htmlspecialchars($post['title']); ?></h1>
                <p class="post-meta">Posted on <?php echo htmlspecialchars($post['created_at']); ?></p>
                <div class="post-content">
                    <?php echo nl2br(htmlspecialchars($post['content'])); ?>
                </div>
            </article>
        </div>
        <?php
    } else {
        echo "<p>Post not found!</p>";
    }
} else {
    echo "<p>No post selected.</p>";
}
?>

<?php include("includes/footer.php"); ?>
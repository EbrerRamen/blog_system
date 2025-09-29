<?php 
include("../includes/dp.php")
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    die("No post ID provided.");
}

$id = (int) $_GET['id'];

// Delete the post
$sql = "DELETE FROM POSTS WHERE id = $id";
if ($conn->query($sql) === TRUE) {
    header("Location: dashboard.php");
    exit();
} else {
    echo "Error deleting post: " . $conn->error;
}
?>
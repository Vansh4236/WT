<?php
// Connect to database
$conn = mysqli_connect("localhost", "root", "", "comment_db"); // Change credentials and DB name

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle comment submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);

    if (!empty($comment)) {
        $sql = "INSERT INTO comments (comment) VALUES ('$comment')";
        mysqli_query($conn, $sql);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Simple Comment System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Leave a Comment:</h2>
    <div class="container">
    <form method="POST">
        <textarea name="comment" rows="4" cols="50" required></textarea><br>
        <input type="submit" value="Post Comment">
    </form>
    </div>

    <h3>All Comments:</h3>
    <?php
    $result = mysqli_query($conn, "SELECT comment, created_at FROM comments ORDER BY created_at DESC");
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div style='margin-bottom: 15px; padding: 10px; border: 1px solid #ccc;'>";
        echo "<p>" . htmlspecialchars($row['comment']) . "</p>";
        echo "<small>Posted on: " . $row['created_at'] . "</small>";
        echo "</div>";
    }
    ?>
</body>
</html>

<!-- CREATE TABLE comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    comment TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
); -->
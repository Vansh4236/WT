<?php
$conn = mysqli_connect("localhost", "root", "", "wt_6");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Web Page with PHP Functionalities</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f7f7f7;
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        .container {
            max-width: 700px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }
        .comment-box {
            background-color: #e9ecef;
            padding: 10px;
            border-radius: 5px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <h3>Comment Section</h3>
    <form method="POST" action="">
        <textarea class="form-control" name="comment" placeholder="Write a comment..." required></textarea>
        <button class="btn btn-primary mt-2" type="submit" name="submit_comment">Post Comment</button>
    </form>
    <?php
    // Comment System
    if (isset($_POST['submit_comment'])) {
        $comment = mysqli_real_escape_string($conn, $_POST['comment']);
        $sql = "INSERT INTO comments (comment) VALUES ('$comment')";
        if (mysqli_query($conn, $sql)) {
            echo "<div class='alert alert-success mt-3'>Comment posted successfully!</div>";
        }
    }
    $result = mysqli_query($conn, "SELECT comment FROM comments");
    echo "<h5>All Comments:</h5>";
   while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='comment-box'>" . htmlspecialchars($row['comment']) . "</div>";
    }
    ?>
</div
<div class="container">
    <h3>Like / Dislike Section</h3>
    <form method="POST" action="">
        <button class="btn btn-success" type="submit" name="like">Like 👍</button>
        <button class="btn btn-danger" type="submit" name="dislike">Dislike 👎</button>
    </form>
    <?php
    // Initial insert if not already in the table (to avoid NULL issues)
    $check_entry = mysqli_query($conn, "SELECT * FROM items WHERE id = 1");
    if (mysqli_num_rows($check_entry) == 0) {
        mysqli_query($conn, "INSERT INTO items (id, likes, dislikes) VALUES (1, 0, 0)");
    }
    // Like/Dislike Logic
    if (isset($_POST['like'])) {
        $sql = "UPDATE items SET likes = likes + 1 WHERE id = 1";
        mysqli_query($conn, $sql);
    } elseif (isset($_POST['dislike'])) {
        $sql = "UPDATE items SET dislikes = dislikes + 1 WHERE id = 1";
        mysqli_query($conn, $sql);
    }
    // Fetch and Display Like/Dislike Count
    $result = mysqli_query($conn, "SELECT likes, dislikes FROM items WHERE id = 1");
    if ($row = mysqli_fetch_assoc($result)) {
        echo "<p>Likes: <strong>" . $row['likes'] . "</strong> | Dislikes: <strong>" . $row['dislikes'] . "</strong></p>";
    } else {
        echo "<p>Likes: <strong>0</strong> | Dislikes: <strong>0</strong></p>";
    }
    ?>
</div>
<div class="container">
    <h3>Rating System</h3>
    <form method="POST" action="">
        <input type="hidden" name="item_id" value="1">
        <select name="rating" class="form-control" required>
            <option value="">Select Rating</option>
            <option value="1">1 - Poor</option>
            <option value="2">2 - Fair</option>
            <option value="3">3 - Good</option>
            <option value="4">4 - Very Good</option>
            <option value="5">5 - Excellent</option>
        </select>
        <button class="btn btn-primary mt-2" type="submit" name="rate">Submit Rating</button>
    </form>
    <?php
    // Rating System
    if (isset($_POST['rate'])) {
        $rating = $_POST['rating'];
        $item_id = $_POST['item_id'];
        $sql = "INSERT INTO ratings (item_id, rating) VALUES ('$item_id', '$rating')";
        mysqli_query($conn, $sql);
    }
    $result = mysqli_query($conn, "SELECT AVG(rating) AS average FROM ratings WHERE item_id = 1");
    $row = mysqli_fetch_assoc($result);
    echo "<p>Average Rating: <strong>" . round($row['average'], 1) . "</strong> / 5</p>";
    ?>
</div>
<div class="container">
    <h3>CV Builder</h3>
    <form method="POST" action="">
        <input type="text" name="name" class="form-control" placeholder="Your Name" required>
        <input type="email" name="email" class="form-control mt-2" placeholder="Your Email" required>
        <textarea name="experience" class="form-control mt-2" placeholder="Your Experience" required></textarea>
        <button class="btn btn-primary mt-2" type="submit" name="generate_cv">Generate CV</button>
    </form>
    <?php
    // CV Builder System
    if (isset($_POST['generate_cv'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $experience = $_POST['experience'];
        $cv_content = "Name: $name\nEmail: $email\nExperience: $experience";
        file_put_contents("cv_$name.txt", $cv_content);
        echo "<div class='alert alert-success mt-3'>CV generated successfully! Check the file: cv_$name.txt</div>";
    }
    ?>
</div>
<div class="container">
    <h3>QR Code Generator</h3>
    <form method="POST" action="">
        <input type="text" name="url" class="form-control" placeholder="Enter URL to generate QR Code" required>
        <button class="btn btn-primary mt-2" type="submit" name="generate_qr">Generate QR Code</button>
    </form>
    <?php
    if (isset($_POST['generate_qr'])) {
        $url = $_POST['url'];
        include 'phpqrcode/qrlib.php'; // Adjusted to include the library from your phpqrcode folder
        QRcode::png($url, 'qrcode.png');
        echo "<img src='qrcode.png' class='mt-3' />";
    }
    ?>
</div>
</body>
</html>

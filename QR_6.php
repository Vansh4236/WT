<?php
$conn = mysqli_connect("localhost", "root", "", "your_db_name");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Multi Feature PHP App</title>
</head>
<body>

<h2>Comment System</h2>
<form method="POST">
    <input type="text" name="comment" required>
    <button type="submit">Post Comment</button>
</form>
<?php
if (isset($_POST['comment'])) {
    $comment = $_POST['comment'];
    $sql = "INSERT INTO comments (comment) VALUES ('$comment')";
    mysqli_query($conn, $sql);
}
$result = mysqli_query($conn, "SELECT comment FROM comments");
while ($row = mysqli_fetch_assoc($result)) {
    echo "<p>" . $row['comment'] . "</p>";
}
?>

<hr>

<h2>Rating System</h2>
<form method="POST">
    <input type="hidden" name="item_id" value="1">
    <label>Rate (1 to 5): </label>
    <input type="number" name="rating" min="1" max="5" required>
    <button type="submit" name="rate">Submit Rating</button>
</form>
<?php
if (isset($_POST['rate'])) {
    $rating = $_POST['rating'];
    $item_id = $_POST['item_id'];
    $sql = "INSERT INTO ratings (item_id, rating) VALUES ('$item_id', '$rating')";
    mysqli_query($conn, $sql);
}
$result = mysqli_query($conn, "SELECT AVG(rating) AS average FROM ratings WHERE item_id = 1");
$row = mysqli_fetch_assoc($result);
echo "Average Rating: " . round($row['average'], 1);
?>

<hr>

<h2>CV Builder</h2>
<form method="POST">
    <input type="text" name="name" placeholder="Your Name" required><br>
    <input type="email" name="email" placeholder="Email" required><br>
    <textarea name="experience" placeholder="Your Experience" required></textarea><br>
    <button type="submit" name="build_cv">Generate CV</button>
</form>
<?php
if (isset($_POST['build_cv'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $experience = $_POST['experience'];
    $cv_content = "Name: $name\nEmail: $email\nExperience: $experience";
    file_put_contents("cv_$name.txt", $cv_content);
    echo "CV generated successfully! <a href='cv_$name.txt' download>Download CV</a>";
}
?>

<hr>

<h2>QR Code Generator</h2>
<form method="POST">
    <input type="text" name="url" placeholder="Enter URL" required>
    <button type="submit" name="generate_qr">Generate QR</button>
</form>
<?php
if (isset($_POST['generate_qr'])) {
    $url = $_POST['url'];
    include "qrlib.php"; // make sure you have qrlib.php in your folder
    $file = 'qrcode.png';
    QRcode::png($url, $file);
    echo "<img src='$file' />";
}
?>

<hr>

<h2>Like / Dislike System</h2>
<form method="POST">
    <input type="hidden" name="item_id" value="1">
    <button type="submit" name="action" value="like">👍 Like</button>
    <button type="submit" name="action" value="dislike">👎 Dislike</button>
</form>
<?php
if (isset($_POST['action'])) {
    $action = $_POST['action'];
    $item_id = $_POST['item_id'];
    if ($action == 'like') {
        $sql = "UPDATE items SET likes = likes + 1 WHERE id = '$item_id'";
    } else {
        $sql = "UPDATE items SET dislikes = dislikes + 1 WHERE id = '$item_id'";
    }
    mysqli_query($conn, $sql);
}
$result = mysqli_query($conn, "SELECT likes, dislikes FROM items WHERE id = 1");
$row = mysqli_fetch_assoc($result);
echo "Likes: " . $row['likes'] . " | Dislikes: " . $row['dislikes'];
?>

</body>
</html>

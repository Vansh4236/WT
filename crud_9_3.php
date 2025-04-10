<?php
include 'db_connect.php';

if (!isset($_GET['id'])) {
    die("Error: ID not provided in the URL.");
}
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM students WHERE id=$id");

if (!$result || $result->num_rows == 0) {
    die("Error: Student not found.");
}

$data = $result->fetch_assoc();

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $sql = "UPDATE students SET name='$name', email='$email', phone='$phone' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        header("Location: read.php");
        exit;
    } else {
        $msg = "Error updating record: " . $conn->error;
    }
}
?>

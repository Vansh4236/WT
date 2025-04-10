<?php
include 'db_connect.php';

if (!isset($_GET['id'])) {
    die("Error: ID not provided.");
}

$id = $_GET['id'];

if (isset($_POST['confirm'])) {
    $conn->query("DELETE FROM students WHERE id=$id");
    header("Location: read.php");
    exit;
}
?>

<?php include 'db_connect.php'; ?>

<?php
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $sql = "INSERT INTO students (name, email, phone) VALUES ('$name', '$email', '$phone')";
    if ($conn->query($sql) === TRUE) {
        $msg = "Record added successfully.";
    } else {
        $msg = "Error: " . $conn->error;
    }
}
?>

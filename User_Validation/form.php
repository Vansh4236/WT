<?php
session_start();

$name = $mobile = $email = "";
$nameErr = $mobileErr = $emailErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $mobile = trim($_POST["mobile"]);
    $email = trim($_POST["email"]);
    $valid = true;

    if (empty($name)) {
        $nameErr = "Name is required.";
        $valid = false;
    } elseif (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        $nameErr = "Only letters and white spaces are allowed.";
        $valid = false;
    }

    if (empty($mobile)) {
        $mobileErr = "Mobile number is required.";
        $valid = false;
    } elseif (!preg_match("/^[0-9]{10}$/", $mobile)) {
        $mobileErr = "Invalid mobile number format. Must be 10 digits.";
        $valid = false;
    }

    if (empty($email)) {
        $emailErr = "Email is required.";
        $valid = false;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format.";
        $valid = false;
    }

    if ($valid) {
        header("Location: welcome.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Authentication Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>User Authentication</h2>
    <div class="container">
        <form method="POST">
            <label>Name:</label><br>
            <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>"> 
            <?php echo $nameErr; ?>
            <br>
            <br>

            <label>Mobile Number:</label><br>
            <input type="text" name="mobile" value="<?php echo htmlspecialchars($mobile); ?>"> 
            <?php echo $mobileErr; ?>
            <br>
            <br>

            <label>Email ID:</label><br>
            <input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>"> 
            <?php echo $emailErr; ?>
            <br>
            <br>

            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>

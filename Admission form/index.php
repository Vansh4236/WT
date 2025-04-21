<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Admission Form</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h2>User Admission Form</h2>
  <div class = "container">
    <form action="submit.php" method="post">
      
      <label for="name">Full Name:</label><br>
      <input type="text" id="name" name="name" required><br><br>
      
      <label for="email">Email ID:</label><br>
      <input type="email" id="email" name="email" required><br><br>
      
      <label for="gender">Gender:</label><br>
      <input type="radio" id="male" name="gender" value="Male">
      <label for="male">Male</label>
      <input type="radio" id="female" name="gender" value="Female">
      <label for="female">Female</label>

      <input type="radio" id="other" name="gender" value="Other">
      <label for="other">Other</label><br><br>
      
      <label for="dob">Date of Birth:</label><br>
      <input type="date" id="dob" name="dob" required><br><br>
      
      <label for="address">Address:</label><br>
      <textarea id="address" name="address" rows="4" cols="40" required></textarea><br><br>
      
      <label for="course">Select Course:</label><br>
      <select id="course" name="course" required>
        <option value="">--Select--</option>
        <option value="BTech">B.Tech</option>
        <option value="MTech">M.Tech</option>
        <option value="MBA">MBA</option>
        <option value="BSc">B.Sc</option>
      </select><br><br>
      
      <input type="submit" value="Submit">
      <input type="reset" value="Reset">
    </form>
  </div>
</body>
</html>

<?php
// Database configuration for XAMPP
$servername = "localhost"; // Default server name
$username = "root"; // Default username for XAMPP
$password = ""; // Default password is empty for XAMPP
$dbname = "deep_learning_tutorial"; // The name of your database

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $feedback = $_POST['feedback'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO feedback (name, feedback) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $feedback);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Thank you for your feedback, $name!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Feedback Form</title>
</head>
<body>

<h2>Feedback Form</h2>

<form method="post" action="">
    Name:<br>
    <input type="text" name="name" required><br><br>
    
    Feedback:<br>
    <textarea name="feedback" required></textarea><br><br>

    <input type="submit" value="Submit Feedback">
</form>

</body>
</html>

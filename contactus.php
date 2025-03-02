<?php
// Database configuration for XAMPP
$servername = "localhost"; // Default server name
$username = "root"; // Default username for XAMPP
$password = ""; // Default password is empty for XAMPP
$dbname = "contact"; // The name of your database

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $query = $_POST['Query']; // Corrected variable name

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO contact2 (name, email, query) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $query); // Added 's' for query

    // Execute the statement
    if ($stmt->execute()) {
        echo "Thank you for contacting us, have a good day, $name!";
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
    <title>Contact Us</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        form {
            width: 50%;
            margin: auto;
            padding: 20px;
            background-color: #f0f0f0;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
        }
        button[type="submit"] {
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
    <style>
    body {
        background-image: url("img2.jpg");
        background-size: cover;
    }
</style>
</head>

<body>

    <h2>Contact Information</h2>
    <div class="contact-item">
        <strong>Email:</strong>
        <a href="mailto:pillasrikar12@gmail.com">pillasrikar12@gmail.com</a>
    </div>
    <div class="contact-item">
        <strong>WhatsApp:</strong>
        <a href="https://wa.me/+918074654173?text=Hello!">Send a message on WhatsApp</a>
    </div>
    <div class="contact-item">
        <strong>Phone Number:</strong>
        <a href="tel:+918074654173">8074654173</a>
    </div>



    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        Name:<br>
        <input type="text" name="name" required><br><br>

        Email:<br>
        <input type="email" name="email" required><br><br>

        Query:<br>
        <textarea name="Query" required></textarea><br><br>

        <input type="submit" value="Submit ">
    </form>

</body>
</html>

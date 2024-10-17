<?php
// Database connection variables
$servername = "localhost"; // Your server name
$username = "your_username"; // Your database username
$password = "your_password"; // Your database password
$dbname = "contact_db"; // Your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input data
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $mobile = htmlspecialchars(trim($_POST['mobile']));
    $id = htmlspecialchars(trim($_POST['id']));

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO contacts (name, email, mobile, user_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $mobile, $id);

    // Execute the statement
    if ($stmt->execute()) {
        echo "<h2>Form Submitted Successfully!</h2>";
        echo "<p><strong>Name:</strong> $name</p>";
        echo "<p><strong>Email:</strong> $email</p>";
        echo "<p><strong>Mobile Number:</strong> $mobile</p>";
        echo "<p><strong>ID:</strong> $id</p>";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>

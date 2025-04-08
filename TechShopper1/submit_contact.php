<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database configuration
    $servername = "localhost"; // your server name
    $username = "root"; // your database username
    $password = ""; // your database password
    $dbname = "Techbd"; // your database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO contact_requests (name, phone, email) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $phone, $email);

    // Set parameters and execute
    $name = $_POST['name'];
    $phone = $_POST['country_code'] . $_POST['phone']; // Combine country code and phone
    $email = $_POST['email'];
    
    if ($stmt->execute()) {
        // Redirect to like.html on success
        header("Location: like.html");
        exit(); // Make sure to exit after the redirect
    } else {
        // Redirect to error page on failure
        header("Location: dizlike.html");
        exit(); // Make sure to exit after the redirect
    }

    // Close connections
    $stmt->close();
    $conn->close();
} else {
    echo "Некорректный метод запроса.";
}
?>

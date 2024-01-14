<?php
// Assuming you have already established a database connection
$hostname = "localhost";
$username = "root";
$password = "";
$database = "ac";
$conn = new mysqli($hostname, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if a user ID is provided in the form submission
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['userId'])) {
    $userId = $_POST['userId'];

    // Prepare and execute the SQL query to delete the user
    $sql = "DELETE FROM Users WHERE ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);

    if ($stmt->execute()) {
        echo "User deleted successfully.";
    } else {
        echo "Error deleting user: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "User ID not provided.";
}

$conn->close();
?>

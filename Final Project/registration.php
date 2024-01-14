<!-- registration.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Registration - Activity Club</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body class="login-page">
    <div class="background-overlay"></div>
    <header class="toolbar">
        <h1>Activity Club</h1>
    </header>
    <div class="form-container login-container">
        <h2>Event Registration</h2>

        <?php

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $eventID = $_POST['eventID']; // Assuming you pass the eventID through a hidden field
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $eventName = $_POST['eventName'];
    $eventCost = $_POST['eventCost'];

    // For example, inserting data into the Registration table
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "ac";
    $conn = new mysqli($host, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO Registration (EventID, FirstName, LastName, EventName, EventCost) 
            VALUES ('$eventID', '$firstName', '$lastName', '$eventName', '$eventCost')";

    if ($conn->query($sql) === TRUE) {
        echo '<p>Registration successful!</p>';
    } else {
        echo '<p>Error: ' . $sql . '<br>' . $conn->error . '</p>';
    }

    $conn->close();
}
?>

        <!-- Registration Form -->
        <form action="" method="post">
            <input type="hidden" name="eventID" value="<?php echo $_GET['eventID']; ?>">
            <label for="firstName">First Name:</label>
            <input type="text" id="firstName" name="firstName" required>
            <br>
            <label for="lastName">Last Name:</label>
            <input type="text" id="lastName" name="lastName" required>
            <br>
            <label for="eventName">Event Name:</label>
            <input type="text" id="eventName" name="eventName" required>
            <br>
            <label for="eventCost">Event Cost:</label>
            <input type="text" id="eventCost" name="eventCost" required>
            <br>
            <input type="submit" value="Register">
        </form>

        <button onclick="window.location.href='event_list.php'">Back to Events List</button>
    </div>
</body>
</html>





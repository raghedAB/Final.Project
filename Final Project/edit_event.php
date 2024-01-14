<!-- edit_event.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Events - Activity Club</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Edit Events - Activity Club</h1>
    </header>
    <nav>
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="server_dashboard.php">Server Dashboard</a></li>
        </ul>
    </nav>
    <main>

    <?php
    session_start();

    // Check if the user is logged in and is a server user
    if (!isset($_SESSION["user_id"]) || $_SESSION["user_type"] !== "server") {
        header("Location: login.php");
        exit;
    }

    // Establish database connection
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "ac";
    $conn = mysqli_connect($hostname, $username, $password, $database);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Loop through the submitted data and update events
        foreach ($_POST as $eventID => $eventData) {
            $name = $eventData["name"];
            $description = $eventData["description"];
            $category = $eventData["category"];
            $destination = $eventData["destination"];
            $dateFrom = $eventData["dateFrom"];
            $dateTo = $eventData["dateTo"];
            $cost = $eventData["cost"];

            // Update the event in the database
            $sql = "UPDATE event SET 
                    Name = '$name',
                    Description = '$description',
                    Category = '$category',
                    Destination = '$destination',
                    DateFrom = '$dateFrom',
                    DateTo = '$dateTo',
                    Cost = $cost
                    WHERE EventID = $eventID";

            if (!mysqli_query($conn, $sql)) {
                echo "Error updating event: " . mysqli_error($conn);
            }
        }

        echo "<p>Changes saved successfully!</p>";
    }

    // Fetch all events from the database
    $sql = "SELECT * FROM event";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        // Display the form with all events
        echo '<form action="" method="post">';
        
        while ($row = mysqli_fetch_assoc($result)) {
            $eventID = $row['EventID'];
            $name = $row['Name'];
            $description = $row['Description'];
            $category = $row['Category'];
            $destination = $row['Destination'];
            $dateFrom = $row['DateFrom'];
            $dateTo = $row['DateTo'];
            $cost = $row['Cost'];

            echo '<fieldset>';
            echo '<legend>Event ID: ' . $eventID . '</legend>';
            echo 'Name: <input type="text" name="' . $eventID . '[name]" value="' . $name . '" required><br>';
            echo 'Description: <textarea name="' . $eventID . '[description]" required>' . $description . '</textarea><br>';
            echo 'Category: <input type="text" name="' . $eventID . '[category]" value="' . $category . '" required><br>';
            echo 'Destination: <input type="text" name="' . $eventID . '[destination]" value="' . $destination . '" required><br>';
            echo 'Date From: <input type="date" name="' . $eventID . '[dateFrom]" value="' . $dateFrom . '" required><br>';
            echo 'Date To: <input type="date" name="' . $eventID . '[dateTo]" value="' . $dateTo . '" required><br>';
            echo 'Cost: <input type="text" name="' . $eventID . '[cost]" value="' . $cost . '" required><br>';
            echo '</fieldset>';
        }

        echo '<input type="submit" value="Submit Changes">';
        echo '</form>';
    } else {
        echo '<p>No events found.</p>';
    }

    mysqli_close($conn);
    ?>

    <button onclick="window.location.href='server_dashboard.php'">Back to Server Dashboard</button>
    </main>
</body>
</html>

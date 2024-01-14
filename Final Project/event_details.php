<!-- event_details.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Details - Activity Club</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Activity Club Event Details</h1>
    </header>
    <nav>
        <ul>
            <li><a href="index.html">Home</a></li>
        </ul>
    </nav>
    <main>

    <?php

    function getCategoryName($categoryId, $conn) {
        $sql = "SELECT Name FROM Lookup WHERE LookupID = $categoryId";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['Name'];
        } else {
            return 'Unknown Category';
        }
    }

    // Check if the eventID is set in the URL
    if (isset($_GET['eventID'])) {
        $eventID = $_GET['eventID'];

        // Create connection
        $host = "localhost";
        $username = "root";
        $password = "";
        $database = "ac";
        $conn = new mysqli($host, $username, $password, $database);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch event details from the database
        $sql = "SELECT * FROM event WHERE EventID = $eventID";
        $result = $conn->query($sql);

        if ($result === false) {
            die("Error in the SQL query: " . $conn->error);
        }

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<h2>' . $row['Name'] . '</h2>';
                echo '<p><strong>Description:</strong> ' . $row['Description'] . '</p>';
                echo '<p><strong>Date:</strong> ' . $row['DateFrom'] . ' to ' . $row['DateTo'] . '</p>';
                
                // Check if the 'CategoryID' key exists before accessing its value
                if (isset($row['CategoryID'])) {
                    $categoryId = $row['CategoryID'];
                    $categoryName = getCategoryName($categoryId, $conn);
                    echo '<p><strong>Category:</strong> ' . $categoryName . '</p>';
                }

                echo '<p><strong>Destination:</strong> ' . $row['Destination'] . '</p>';
                echo '<p><strong>Cost:</strong> ' . $row['Cost'] . '</p>';
            }

            // Add the "Register for Event" button
            echo '<button onclick="window.location.href=\'registration.php?eventID=' . $eventID . '\'">Register for Event</button>';
        } else {
            echo '<p>Event not found.</p>';
        }

        $conn->close();
    } else {
        echo '<p>Event ID not specified.</p>';
    }
    ?>

        <button onclick="window.location.href='event_list.php'">Back to Events List</button>
    </main>
</body>
</html>

<!-- event_list.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events List - Activity Club</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Activity Club Events</h1>
    </header>
    <nav>
        <ul>
            <li><a href="index.html">Home</a></li>
        </ul>
    </nav>
    <main>
        <h2>Upcoming Events</h2>

        <?php
        $host = "localhost";
        $username = "root";
        $password = "";
        $database = "ac";
        
        // Create connection
        $conn = new mysqli($host, $username, $password, $database);
        
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        // Fetch events from the database
        $sql = "SELECT EventID, Name FROM event";
        $result = $conn->query($sql);
        
        if ($result === false) {
            die("Error in the SQL query: " . $conn->error);
        }
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<li>';
                echo '<strong>' . $row['Name'] . '</strong>';
                echo '<button onclick="viewEventDetails(' . $row['EventID'] . ')">View Details</button>';
                echo '</li>';
            }
        } else {
            echo '<p>No upcoming events.</p>';
        }
        
        $conn->close();
        ?>

        <script>
            // Function to navigate to the event details page
            function viewEventDetails(eventID) {
                window.location.href = "event_details.php?eventID=" + eventID;
            }
        </script>
    </main>
</body>
</html>

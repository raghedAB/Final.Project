<?php
session_start();

$hostname = "localhost";
$username = "root";
$password = "";
$database = "ac";

// Establish database connection
$conn = mysqli_connect($hostname, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch all events
$sql = "SELECT * FROM event";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Error: " . mysqli_error($conn));
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Events</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header class="toolbar">
        <h1>Activity Club</h1>
    </header>
    <nav>
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="server_dashboard.php">Server Dashboard</a></li>
        </ul>
    </nav>

    <div class="form-container delete-container">
        <h2>Delete Events</h2>

        <form action="" method="post">
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<label>';
                echo '<input type="checkbox" name="eventsToDelete[]" value="' . $row['EventID'] . '"> ' . $row['Name'];
                echo '</label>';
            }
            ?>

            <br>
            <input type="submit" value="Delete Selected Events">
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["eventsToDelete"]) && is_array($_POST["eventsToDelete"])) {
                foreach ($_POST["eventsToDelete"] as $eventID) {
                    $sqlDelete = "DELETE FROM event WHERE EventID = ?";
                    $stmtDelete = mysqli_prepare($conn, $sqlDelete);
                    mysqli_stmt_bind_param($stmtDelete, "i", $eventID);

                    if (mysqli_stmt_execute($stmtDelete)) {
                        echo "<p>Event with ID $eventID deleted successfully!</p>";
                    } else {
                        echo "<p>Error deleting event with ID $eventID: " . mysqli_error($conn) . "</p>";
                    }

                    mysqli_stmt_close($stmtDelete);
                }
            }
        }
        ?>
    </div>
</body>
</html>

<?php
mysqli_close($conn);
?>

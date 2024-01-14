<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Event</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body class="login-page">
    <div class="background-overlay"></div>
    <header class="toolbar">
        <h1>Activity Club</h1>
    </header>
    <nav>
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="server_dashboard.php">Server Dashboard</a></li>
        </ul>
    </nav>

    <div class="form-container login-container">
        <h2>Add Event</h2>

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

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST["name"];
            $description = $_POST["description"];
            $category = $_POST["category"];
            $destination = $_POST["destination"];
            $dateFrom = $_POST["dateFrom"];
            $dateTo = $_POST["dateTo"];
            $cost = $_POST["cost"];

            $sql = "INSERT INTO event (Name, Description, Category, Destination, DateFrom, DateTo, Cost) 
                    VALUES ('$name', '$description', '$category', '$destination', '$dateFrom', '$dateTo', $cost)";

            if (mysqli_query($conn, $sql)) {
                echo "<p>Event added successfully!</p>";
            } else {
                echo "<p>Error: " . $sql . "<br>" . mysqli_error($conn) . "</p>";
            }
        }

        mysqli_close($conn);
        ?>

        <form action="" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            <br>
            <label for="description">Description:</label>
            <textarea id="description" name="description" required></textarea>
            <br>
            <label for="category">Category:</label>
            <input type="text" id="category" name="category" required>
            <br>
            <label for="destination">Destination:</label>
            <input type="text" id="destination" name="destination" required>
            <br>
            <label for="dateFrom">Date From:</label>
            <input type="date" id="dateFrom" name="dateFrom" required>
            <br>
            <label for="dateTo">Date To:</label>
            <input type="date" id="dateTo" name="dateTo" required>
            <br>
            <label for="cost">Cost:</label>
            <input type="text" id="cost" name="cost" required>
            <br>
            <input type="submit" value="Add Event">
        </form>
    </div>
</body>
</html>

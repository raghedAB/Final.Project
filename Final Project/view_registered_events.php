
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

// Fetch all users from the database
$sql = "SELECT * FROM registration";
$result = $conn->query($sql);

// Check if there are users
if ($result->num_rows > 0) {
    echo '<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #4285f4;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        form {
            display: inline;
        }

        input[type="submit"] {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 8px;
            cursor: pointer;
        }
    </style>
</head>
<body>';
    $rowCount = 0;

    echo '<table>';
    echo '<tr><th>EventID</th><th>FirstName</th><th>LastName</th><th>EventName</th><th>EventCost</th></tr>';

    // Output data for each row
    while ($row = $result->fetch_assoc()) {
        $rowCount++; // Increment the counter for each row
        echo '<tr>';
        echo '<td>' . $row['EventID'] . '</td>';
        echo '<td>' . $row['FirstName'] . '</td>';
        echo '<td>' . $row['LastName'] . '</td>';
        echo '<td>' . $row['EventName'] . '</td>';
        echo '<td>' . $row['EventCost'] . '</td>';
        echo '</tr>';
    }

    echo '</table>';
} else {
    echo '<p>No users found.</p>';
}
echo '<p>Total Events: ' . $rowCount . '</p>';

echo '</body></html>';


$conn->close();
?>

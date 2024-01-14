
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
$sql = "SELECT * FROM Users";
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

    echo '<table>';
    echo '<tr><th>ID</th><th>Username</th><th>Email</th><th>Action</th></tr>';

    // Output data for each row
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['ID'] . '</td>';
        echo '<td>' . $row['Username'] . '</td>';
        echo '<td>' . $row['Email'] . '</td>';
        echo '<td><form action="delete_user.php" method="post">';
        echo '<input type="hidden" name="userId" value="' . $row['ID'] . '">';
        echo '<input type="submit" value="Remove"></form></td>';
        echo '</tr>';
    }

    echo '</table>';
    echo '</body></html>';
} else {
    echo '<p>No users found.</p>';
}

$conn->close();
?>

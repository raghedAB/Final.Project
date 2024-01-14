<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body class="signup-page">
    <header class="toolbar">
        <h1>Activity Club</h1>
    </header>

    <div class="form-container signup-container">
        <h2>Sign Up</h2>

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
            $firstName = $_POST["firstName"];
            $lastName = $_POST["lastName"];
            $username = $_POST["username"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $confirmPassword = $_POST["confirmPassword"];

            // Check if the 'dob' key is set in the $_POST array
            $dob = isset($_POST["dob"]) ? $_POST["dob"] : null;

            // Check if passwords match
            if ($password != $confirmPassword) {
                echo "<p>Passwords do not match</p>";
            } else {
                // Hash the password before storing in the database
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                // Insert user data into the database
                $query = "INSERT INTO Users (FirstName, LastName, Username, Email, Password, DateOfBirth) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_prepare($conn, $query);
                mysqli_stmt_bind_param($stmt, "ssssss", $firstName, $lastName, $username, $email, $hashedPassword, $dob);

                try {
                    if (mysqli_stmt_execute($stmt)) {
                        echo "<p>Registration successful! You can now <a href='login.php'>login</a>.</p>";
                    } else {
                        echo "<p>Error during registration</p>";
                    }
                } catch (Exception $e) {
                    echo "Error: " . $e->getMessage();
                }

                mysqli_stmt_close($stmt);
            }
        }

        mysqli_close($conn);
        ?>

        <form action="" method="post">
            <label for="firstName">First Name:</label>
            <input type="text" id="firstName" name="firstName" required>
            <br>
            <label for="lastName">Last Name:</label>
            <input type="text" id="lastName" name="lastName" required>
            <br>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <br>
            <label for="confirmPassword">Confirm Password:</label>
            <input type="password" id="confirmPassword" name="confirmPassword" required>
            <br>
            <label for="dob">Date of Birth:</label>
            <input type="date" id="dob" name="dob" required>
            <br>
            <input type="submit" value="Sign Up">
        </form>

        <p>Already have an account? <a href="login.php">Log in here</a></p>
    </div>
</body>
</html>

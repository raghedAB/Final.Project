<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body class="login-page">
    <div class="background-overlay"></div>
    <header class="toolbar">
        <h1>Activity Club</h1>
    </header>

    <div class="form-container login-container">
        <h2>Login</h2>

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
            $username = $_POST["username"];
            $password = $_POST["password"];

            $query = "SELECT * FROM Users WHERE Username=?";
            
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);

            if ($result && mysqli_num_rows($result) > 0) {
                $user = mysqli_fetch_assoc($result);

                // Verify the hashed password
                if (password_verify($password, $user["Password"])) {
                    // Check if the user is a server user based on both username and password
                    if (($user["Username"] == "raghed_s" && $password == "111") || ($user["Username"] == "malak_s" && $password == "222")) {
                        // Server user
                        $_SESSION["user_id"] = $user["ID"];
                        $_SESSION["user_type"] = "server";
                        header("Location: server_dashboard.php");
                    } else {
                        // Regular user
                        $_SESSION["user_id"] = $user["ID"];
                        $_SESSION["user_type"] = "regular";
                        header("Location: index.html");
                    }
                } else {
                    // Invalid password
                    echo "<p>Invalid username or password</p>";
                }
            } else {
                // User not found
                echo "<p>Invalid username or password</p>";
            }

            mysqli_stmt_close($stmt);
        }

        mysqli_close($conn);
        ?>

        <form action="" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <br>
            <input type="submit" value="Login">
        </form>

        <p>Don't have an account? <a href="signup.php">Sign up here</a></p>
    </div>
</body>
</html>

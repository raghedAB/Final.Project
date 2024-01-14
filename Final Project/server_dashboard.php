<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Server Dashboard - Activity Club</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        
        body.server-dashboard {
            background-color: #f7f7f7;
        }

        header.server-dashboard-toolbar {
            background: rgba(0, 0, 0, 0.5);
            padding: 1em;
            text-align: center;
        }

        header.server-dashboard-toolbar h1 {
            font-size: 2em;
            margin: 0;
            color: white;
        }

        main.server-dashboard-content {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

       
        main.server-dashboard-content button {
            padding: 10px 20px;
            margin: 10px;
            font-size: 1em;
            cursor: pointer;
            background-color: #4285f4;
            color: white;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        main.server-dashboard-content button:hover {
            background-color: #3367d6;
        }
    </style>
</head>
<body class="server-dashboard">
    <header class="server-dashboard-toolbar">
        <h1>Server Dashboard - Activity Club</h1>
    </header>
    <main class="server-dashboard-content">
        <h2>Welcome, Server User!</h2>
        <p>This is your dashboard where you can manage events.</p>

        <!-- Example buttons for adding, editing, and deleting events -->
        <button onclick="window.location.href='add_event.php'">Add Event</button>
        <button onclick="window.location.href='edit_event.php'">Edit Event</button>
        <button onclick="window.location.href='delete_event.php'">Delete Event</button>

        <!-- New buttons for viewing users and registered events -->
        <button onclick="window.location.href='view_users.php'">View Users</button>
        <button onclick="window.location.href='view_registered_events.php'">View Registered Events</button>
    </main>
</body>
</html>

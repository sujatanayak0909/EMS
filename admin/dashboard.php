<?php
session_start();


if (!isset($_SESSION['admin_logged_in'])) {
    
}

include '../db.php';


$eventCount = $db->query("SELECT COUNT(*) AS count FROM events")->fetch_assoc()['count'];
$userCount = $db->query("SELECT COUNT(*) AS count FROM users")->fetch_assoc()['count'];
$ticketSales = $db->query("SELECT SUM(ticket_price) AS total FROM events")->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Management System - Admin Home</title>
   <style>
    body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.container {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
    width: 90%;
    margin: auto;
}

.navbar {
    background-color: #333;
    color: #fff;
    padding: 1em;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-radius: 8px;
    margin-bottom: 20px;
    position: sticky;
    top: 0;
}

.navbar-brand h1 {
    margin: 0;
}

.navbar-nav {
    list-style-type: none;
    display: flex;
    margin: 0;
    padding: 0;
}

.navbar-nav li {
    margin-left: 1em;
}

.navbar-nav a {
    color: #fff;
    text-decoration: none;
    font-weight: bold;
    padding: 5px 10px;
    border-radius: 5px;
}

.navbar-nav a:hover {
    background-color: #575757;
}

.main-content {
    flex: 1;
    padding: 2em;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.overview {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
    margin-bottom: 2em;
}

.card {
    background-color: #fff;
    padding: 1.5em;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    text-align: center;
    width: 30%;
    margin: 1em 0;
}

.card h2 {
    margin: 0 0 0.5em;
}

.card p {
    font-size: 1.5em;
    margin: 0;
}

.recent-activities {
    background-color: #fff;
    padding: 1.5em;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.recent-activities h2 {
    margin-top: 0;
}

.recent-activities table {
    width: 100%;
    border-collapse: collapse;
}

.recent-activities table th, .recent-activities table td {
    padding: 10px;
    border: 1px solid #ddd;
    text-align: center;
}

.recent-activities table th {
    background-color: #f4f4f4;
}

.recent-activities table tr:nth-child(even) {
    background-color: #f9f9f9;
}

.actions {
    margin: 20px 0;
    text-align: center;
}

.actions button {
    padding: 10px 20px;
    margin: 10px;
    border: none;
    background-color: #333;
    color: #fff;
    border-radius: 5px;
    cursor: pointer;
}

.actions button:hover {
    background-color: #575757;
}

@media (max-width: 768px) {
    .navbar-nav {
        flex-direction: column;
        align-items: center;
    }
    
    .navbar-nav li {
        margin-left: 0;
        margin-top: 0.5em;
    }

    .overview {
        flex-direction: column;
        align-items: center;
    }

    .card {
        width: 80%;
    }
}

   </style>
</head>
<body>
    <div class="container">
        <nav class="navbar">
            <div class="navbar-brand">
                <h1>Admin Dashboard</h1>
            </div>
            <ul class="navbar-nav">
                <li><a href="#">Home</a></li>
                <li><a href="manage_users.php">Event Settings</a></li>
                <li><a href="manage_events.php">Manage Events</a></li>
                <li><a href="admin_settings.php">Discover Events</a></li>
                <li><a href="logout.php">Send Notification</a></li>
            </ul>
        </nav>
        
        <main class="main-content">
            <div class="overview">
                <div class="card">
                    <h2>Total Events</h2>
                    <p><?php echo $eventCount; ?></p>
                </div>
                <div class="card">
                    <h2>Total Users</h2>
                    <p><?php echo $userCount; ?></p>
                </div>
                <div class="card">
                    <h2>Total Ticket Sales</h2>
                    <p>$<?php echo number_format($ticketSales, 2); ?></p>
                </div>
            </div>
            
            <div class="recent-activities">
                <h2>Recent Events</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Event ID</th>
                            <th>Title</th>
                            <th>Date</th>
                            <th>Location</th>
                            <th>Privacy</th>
                            <th>Ticket Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $events = $db->query("SELECT * FROM events ORDER BY date DESC LIMIT 10");
                        while ($event = $events->fetch_assoc()) {
                            echo "<tr>
                                <td>{$event['id']}</td>
                                <td>{$event['title']}</td>
                                <td>{$event['date']}</td>
                                <td>{$event['location']}</td>
                                <td>{$event['privacy_setting']}</td>
                                <td>\${$event['ticket_price']}</td>
                                <td>
                                    <a href='edit_event.php?id={$event['id']}'>Edit</a> | 
                                    <a href='delete_event.php?id={$event['id']}' onclick='return confirm(\"Are you sure?\");'>Delete</a>
                                </td>
                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>

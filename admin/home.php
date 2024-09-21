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
    <title>Admin Dashboard</title>
    <style>
   body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

.container {
    display: flex;
    height: 100vh;
    flex-direction: row;
}

.sidebar {
    width: 250px;
    background-color: #2c3e50;
    color: #ecf0f1;
    display: flex;
    flex-direction: column;
}

.sidebar-header {
    height: 150px;
    padding: 20px;
    text-align: center;
    background-color: #34495e;
}
.sidebar-header>img{
    height: 100px;
    margin-top: 20px;
}

.sidebar ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.sidebar ul li {
    padding: 15px 20px;
}

.sidebar ul li a {
    color: #ecf0f1;
    text-decoration: none;
    display: block;
    margin-left: 30px;
}

.sidebar ul li a:hover {
    color: blue;
}

.main-content {
    flex-grow: 1;
    padding: 20px;
}

header {
    background-color: #ecf0f1;
    padding: 20px;
    border-bottom: 1px solid #bdc3c7;
}

.content {
    margin-top: 20px;   
}
.cards {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
}

.card {
    background-color: #fff;
    padding: 20px;
    border: 1px solid #bdc3c7;
    width: 30%;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    text-align: center;
    margin-bottom: 20px;
}

@media (max-width: 768px) {
    .container {
        flex-direction: column;
    }

    .sidebar {
        width: 100%;
        height: auto;
    }

    .main-content {
        padding: 10px;
    }

    header {
        padding: 10px;
    }

    .cards {
        flex-direction: column;
        align-items: center;
    }

    .card {
        width: 80%;
    }
}

@media (max-width: 480px) {
    .sidebar ul li {
        padding: 10px;
    }

    .card {
        width: 90%;
    }
}


    </style>
</head>
<body>
    <div class="container">
        <nav class="sidebar">
            <div class="sidebar-header">
                <img src="../images/adminn.png" alt="admin">
            </div>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="manage_events.php">Manage Events</a></li>
                <li><a href="event_settings.php">Event Settings</a></li>
                <li><a href="search_events.php">Discover Events</a></li>
                <li><a href="send_notification.php">Send Notification</a></li>
            </ul>
        </nav>
        <div class="main-content">
            <header>
                <marquee><h1>Welcome To Admin Panel </h1></marquee>
            </header>
            <section class="content">
                <h2>Dashboard Overview</h2>
                <div class="cards">
                    <div class="card">
                        <h3>Total Users</h3>
                        <p><?php echo $userCount; ?></p>
                    </div>
                    <div class="card">
                        <h3>Total Sales</h3>
                        <p>$<?php echo number_format($ticketSales, 2); ?></p>
                    </div>
                    <div class="card">
                        <h3>Total Events</h3>
                        <p><?php echo $eventCount; ?></p>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <script src="scripts.js"></script>
    <script>
        document.querySelectorAll('.sidebar ul li a').forEach(link => {
    link.addEventListener('click', function() {
        document.querySelector('.sidebar ul li a.active')?.classList.remove('active');
        this.classList.add('active');
    });
});
    </script>
</body>
</html>

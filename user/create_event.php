
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Event</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url("../images/c.jpg");
            
        }

        h1 {
            text-align: center;
            color: #333;
            margin-top: 50px;
        }

        .form-container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }

        input[type="text"],
        input[type="date"],
        input[type="time"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #28a745;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #218838;
        }
        
    </style>
</head>
<body>

<div class="form-container">
    <h1>Create Event</h1>
    <form action="create_event.php" method="POST">
        <label for="title">Event Title:</label>
        <input type="text" id="title" name="title" required>

        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea>

        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required>

        <label for="time">Time:</label>
        <input type="time" id="time" name="time" required>

        <label for="location">Location:</label>
        <input type="text" id="location" name="location" required>

        <label for="ticket_price">Ticket Price:</label>
        <input type="number" step="0.01" id="ticket_price" name="ticket_price" required>

        <input type="submit" value="Create Event">
    </form>
   
</div>



</body>
</html>





<?php
session_start();
require '../db.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $location = $_POST['location'];
    $ticket_price = $_POST['ticket_price'];
    // $user_id = $_SESSION['user_id'];

    
    if (empty($title) || empty($description) || empty($date) || empty($time) || empty($location) || empty($ticket_price)) {
        die("Please fill in all fields.");
    }

 
    $sql = $db->prepare("INSERT INTO events (user_id, title, description, date, time, location, ticket_price) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $sql->bind_param("isssssd", $user_id, $title, $description, $date, $time, $location, $ticket_price);

    if ($sql->execute()) {
        echo "event created successfull !";
    } else {
        echo "Error: " . $sql->error;
    }

    $sql->close();
    $db->close();
}
?>

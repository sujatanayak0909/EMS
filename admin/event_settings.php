<?php
require("../db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    $privacy = $_POST['privacy'];
    $ticket_price = $_POST['ticket_price'];

    $privacy = $db->real_escape_string($privacy);
    $ticket_price = $db->real_escape_string($ticket_price);

    
    $sql = "UPDATE events SET privacy_settings='$privacy', ticket_price='$ticket_price' WHERE event_id=1"; // Change 'event_id=1' to the appropriate condition

    if ($db->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $db->error;
    }

    $db->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Privacy Settings and Ticket Price</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        form {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        input[type="text"], input[type="number"], select {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <h2>Update Privacy Settings and Ticket Price</h2>

    <form action="" method="post">
        <label for="privacy">Privacy Settings:</label>
        <select id="privacy" name="privacy">
            <option value="public">Public</option>
            <option value="private">Private</option>
        </select>

        <label for="ticket_price">Ticket Price:</label>
        <input type="number" id="ticket_price" name="ticket_price" min="0" step="0.01" placeholder="Enter ticket price">

        <input type="submit" value="Update">
    </form>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Send Message</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 400px;
        }
        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        input[type="text"], textarea {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #28a745;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }
        input[type="submit"]:hover {
            background-color: #218838;
        }
        .message {
            margin-top: 20px;
            padding: 10px;
            border-radius: 4px;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        @media (max-width: 600px) {
            .container {
                width: 100%;
                padding: 10px;
                box-shadow: none;
            }
            input[type="text"], textarea {
                width: calc(100% - 20px);
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Send Message to Attendees</h1>
        <form action="send_notification.php" method="post">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>
            <label for="message">Message:</label>
            <textarea id="message" name="message" rows="10" required></textarea>
            <input type="submit" value="Send Message">
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $title = $_POST['title'];
            $message = $_POST['message'];

           require("../db.php");

            $sql = "INSERT INTO messages (title, message) VALUES ('$title', '$message')";

            if ($db->query($sql) === TRUE) {
                echo "<div class='message success'>Message sent successfully</div>";
            } else {
                echo "<div class='message error'>Error: " . $sql . "<br>" . $db->error . "</div>";
            }

            $db->close();
        }
        ?>
    </div>
</body>
</html>

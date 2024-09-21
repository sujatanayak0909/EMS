<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/bootstrap.bundle.min.js"></script>
    <title>Document</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 500px;
            
        }

        .container {
            max-width: 400px;
            margin-top: 300px;
        }

        .msg {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .notification-item {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 10px;
            background-color: #f9f9f9;
        }

        .notification {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 40%;
            height: 20%;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            font-size: 16px;
            z-index: 1000;
            color: #fff;
            display: none;
            overflow: auto;
        }

        .notification.success {
            background-color: #28a745;
        }

        .notification.error {
            background-color: #dc3545;
        }

        @media (max-width: 600px) {
            .notification {
                width: calc(100% - 40px);
                bottom: 10px;
                right: 10px;
                left: 10px;
            }
        }
    </style>
</head>
<body>

    <div class="container mt-5">
        <div class="msg">
            <h1>Event Notifications</h1>
            <?php
            require("../db.php");

            $sql = "SELECT title, message, created_at FROM messages ORDER BY created_at DESC";
            $result = $db->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<div class='notification-item'>";
                    echo "<h2>" . $row["title"] . "</h2>";
                    echo "<p>" . $row["message"] . "</p>";
                    echo "<small>Posted on: " . $row["created_at"] . "</small>";
                    echo "</div><hr>";
                }
            } else {
                echo "<div class='alert alert-info'>No messages found.</div>";
            }

            $db->close();
            ?>
        </div>
    </div>

    <?php
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      
        echo "<div class='notification success'>Message sent successfully</div>";
    }
    ?>
    
    <script>
        
        document.addEventListener('DOMContentLoaded', (event) => {
            const notification = document.querySelector('.notification');

            if (notification) {
                notification.style.display = 'block';
                setTimeout(() => {
                    notification.style.display = 'none';
                }, 3000); 
            }
        });
    </script>
    
</body>
</html>
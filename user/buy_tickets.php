<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Events</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 90%;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
        }
        form {
            display: flex;
            flex-direction: column;
            margin-bottom: 20px;
        }
        label {
            margin: 10px 0 5px;
        }
        input, select {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        button {
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #575757;
        }
        .results {
            margin-top: 20px;
        }
        .event-card {
            background-color: #fff;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- <h1>Search Events</h1> -->
        

        <div class="results">
            <?php
            include '../db.php';

            $conditions = [];
            $params = [];

            

            $sql = "SELECT * FROM events";

            if (count($conditions) > 0) {
                $sql .= " WHERE " . implode(" AND ", $conditions);
            }

            $sort = "date ASC";
            if (isset($_GET['sort'])) {
                switch ($_GET['sort']) {
                    case 'date_asc':
                        $sort = "date ASC";
                        break;
                    case 'date_desc':
                        $sort = "date DESC";
                        break;
                    case 'price_asc':
                        $sort = "ticket_price ASC";
                        break;
                    case 'price_desc':
                        $sort = "ticket_price DESC";
                        break;
                }
            }

            $sql .= " ORDER BY " . $sort;

            $stmt = $db->prepare($sql);
            if (count($params) > 0) {
                $types = str_repeat('s', count($params));
                $stmt->bind_param($types, ...$params);
            }

            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while ($event = $result->fetch_assoc()) {
                    echo '<div class="event-card">';
                    echo '<h2>' . htmlspecialchars($event['title']) . '</h2>';
                    echo '<p><strong>Date:</strong> ' . htmlspecialchars($event['date']) . '</p>';
                    echo '<p><strong>Location:</strong> ' . htmlspecialchars($event['location']) . '</p>';
                    echo '<p><strong>Category:</strong> ' . htmlspecialchars($event['category']) . '</p>';
                    echo '<p><strong>Price:</strong> $' . htmlspecialchars($event['ticket_price']) . '</p>';
                    echo '<p>' . htmlspecialchars($event['description']) . '</p>';
                    echo '<a href="bt.php" class="btn btn-primary">Buy Ticket</a>';
                    echo '</div>';
                }
            } else {
                echo '<p>No events found.</p>';
            }
            ?>
        </div>
    </div>
</body>
</html>

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
        <h1>Search Events</h1>
        <form method="GET" action="search_events.php">
            <label for="keyword">Keyword</label>
            <input type="text" id="keyword" name="keyword" placeholder="Enter keyword">

            <label for="location">Location</label>
            <input type="text" id="location" name="location" placeholder="Enter location">

            <label for="date">Date</label>
            <input type="date" id="date" name="date">

            <label for="category">Category</label>
            <input type="text" id="category" name="category" placeholder="Enter category">

            <label for="sort">Sort By</label>
            <select id="sort" name="sort">
                <option value="date_asc">Date Ascending</option>
                <option value="date_desc">Date Descending</option>
                <option value="price_asc">Price Ascending</option>
                <option value="price_desc">Price Descending</option>
            </select>

            <button type="submit">Search</button>
        </form>

        <div class="results">
            <?php
            include '../db.php';

            $conditions = [];
            $params = [];

            if (isset($_GET['keyword']) && $_GET['keyword'] !== '') {
                $conditions[] = "title LIKE ?";
                $params[] = "%" . $_GET['keyword'] . "%";
            }

            if (isset($_GET['location']) && $_GET['location'] !== '') {
                $conditions[] = "location LIKE ?";
                $params[] = "%" . $_GET['location'] . "%";
            }

            if (isset($_GET['date']) && $_GET['date'] !== '') {
                $conditions[] = "date = ?";
                $params[] = $_GET['date'];
            }

            if (isset($_GET['category']) && $_GET['category'] !== '') {
                $conditions[] = "category LIKE ?";
                $params[] = "%" . $_GET['category'] . "%";
            }

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

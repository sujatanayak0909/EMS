<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="icon" href="images/logo.png" type="image/png">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            color: #333;
        }
        .parent {
            display: flex;
            flex-wrap: wrap;
        }
        .side {
            width: 100%;
            background-color: #2c3e50;
            padding: 20px;
            text-align: center;
        }
        .side img {
            width: 50%;
            padding: 10px;
            display: block;
            margin: 0 auto 20px;
            border-radius: 50%;
            border: 2px solid #fff;
        }
        .side_text ul {
            list-style: none;
            padding: 0;
        }
        .side_text li {
            background-color: #34495e;
            margin: 10px 0;
            padding: 15px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .side_text li a {
            text-decoration: none;
            color: #ecf0f1;
            font-size: 16px;
        }
        .side_text li:hover {
            background-color: #1abc9c;
        }
        .main {
            width: 100%;
            background-color: #ecf0f1;
            padding: 20px;
        }
        @media (min-width: 768px) {
            .side {
                width: 20%;
                height: 100vh;
                padding: 30px;
            }
            .side img {
                width: 80%;
                padding: 30px;
                margin: 0 auto 30px;
            }
            .main {
                width: 80%;
                height: 100vh;
                padding: 30px;
            }
        }
    </style>
</head>
<body>
    <?php include("../nav/nav1.php"); ?>
    <div class="parent">
        <div class="side">
            <img src="../images/user.png" alt="User Image">
            <div class="side_text">
                <ul class="text">
                    <li class="ul_text1"><a href="create_event.php">Create Event</a></li>
                    <li class="ul_text2"><a href="discover_event.php">Discover Events</a></li>
                    <li class="ul_text3"><a href="buy_tickets.php">Purchase Ticket</a></li>
                    <li class="ul_text3"><a href="#">Register for Event</a></li>
                </ul>
            </div>
        </div>
        <div class="main">
            <!-- Main content goes here -->
        </div>
    </div>
</body>
</html>

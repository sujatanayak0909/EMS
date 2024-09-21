<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.bundle.min.js"></script>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .nav{
            display: flex;
            list-style: none;
            background-color: rgb(15, 15,15);
            width: 100%;
            height:70px;
            justify-content: space-evenly;
            padding: 25px;
            box-shadow: 0px 0px 5px 5px rgb(25,28,47);
            position: sticky;
            top: 0;
        
        }
        .nav-item>a{
            text-decoration: none;
            color: white;
            margin-left: 200px;
        }
        .nav-item>a:hover{
            color: blue;
            
          
        
        }
        /* #logout{
            background-color: white;

            width: 50px;
            height: 30px;
            border-radius: 200px;
            margin-left: 200px;
        } */
       
    </style>
    

</head>
<body>
<ul class="nav justify-content-end">
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="#">Home</a>
  </li>
  
  
  <li class="nav-item"id="logout">
  <a class="nav-link" href="../user/logout.php">Logout</a>
  </li>
</ul>

</body>
</html>
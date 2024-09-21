<?php
session_start();
require("../db.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['email'];
    $password = md5($_POST['pass']);

    $check_sql = "SELECT email FROM users WHERE email=?";
    $sql_exe = $db->prepare($check_sql);
    $sql_exe->bind_param("s", $email);
    $sql_exe->execute();
    $sql_exe->store_result();

    if ($sql_exe->num_rows != 0) {
       
        $user_check = "SELECT * FROM users WHERE email=? AND password=?";
        $sql_exe = $db->prepare($user_check);
        $sql_exe->bind_param("ss", $email, $password);
        $sql_exe->execute();
        $res = $sql_exe->get_result();

        if ($res->num_rows != 0) {
           
            echo " <html>
           <head>
           <style>
            h1{
            color: #4AF90D;
            text-align: center;
               }
              </style>
               <script type='text/javascript'>
                   setTimeout(function(){
                       window.location.href = 'user_profile.php';
                   }, 1000);
               </script>
           </head>
           <body>
               <h1>Login Successfull</h1>
               
           </body>
         </html>";     
        } else {
            echo " <html>
           <head>
        
               <script type='text/javascript'>
                   setTimeout(function(){
                       window.location.href = 'login.php';
                   }, 3000);
               </script>
           </head>
           <body>
               <h1>You Entered Wrong Password !</h1>
               <p>You will be redirected to the Login page in 3 seconds...</p>
           </body>
         </html>";

        }
    } else {
        echo "User not found";
    }
} else {
    echo "Unauthorized request";
}
?>

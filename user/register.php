<?php
require("../db.php");
if($_SERVER['REQUEST_METHOD']=="POST")
{

    $user_name=$_POST['username'];
    $email=$_POST['email'];
    $password=md5($_POST['password']);

    
    $check="SELECT email FROM users WHERE email='$email'";
    $result=$db->query($check);

    if($result->num_rows !=0)
    {
        echo " <html>
           <head>
               <script type='text/javascript'>
                   setTimeout(function(){
                       window.location.href = 'index.php';
                   }, 3000);
               </script>
           </head>
           <body>
               <h1>User Is Already Registed !</h1>
               <p>You will be redirected to the Home  page in 3 seconds...</p>
           </body>
         </html>";

    }
    else
    {
       
        
        $sql="INSERT INTO users(user_name,email,password)
        VALUES('$user_name','$email','$password')";
       if($db->query($sql))
       {
           echo " <html>
           <head>
               <script type='text/javascript'>
                   setTimeout(function(){
                       window.location.href = 'login.php';
                   }, 3000);
               </script>
           </head>
           <body>
               <h1>Registration Successful!</h1>
               <p>You will be redirected to the login page in 3 seconds...</p>
           </body>
         </html>";
       }
       else
       {
          echo " <html>
           <head>
               <script type='text/javascript'>
                   setTimeout(function(){
                       window.location.href = 'index.php';
                   }, 3000);
               </script>
           </head>
           <body>
               <h1>Registration Failed!</h1>
               <p>You will be redirected to the Home page in 3 seconds...</p>
           </body>
         </html>";
       }

       
    }

    
     
    

}
else
{
    echo "Unauthorised request";
}



?>
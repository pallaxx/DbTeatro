<?php
    session_start();
    include_once 'CreateDb.php';
    // $cookie_name = "User";
    // // setcookie($cookie_name, "", time());
    // if(isset($_COOKIE[$cookie_name])){include 'login.php';die();}
    session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>


    <script src="js/main.js"></script>
</body>
</html>
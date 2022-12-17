<?php
//connect this page to the end of cv.php to give users the option of logging out
    session_start();
    session_destroy();
?>
<DOCTYPE html>
    <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script scr="portfolio3JS.js"></script>
    <link rel="stylesheet" type="text/css" href="porftolio3.css" >
    <title>Log out Page</title>
    
    <link rel="stylesheet" type="text/css" href="porftolio3.css" >
    </head>
    <div class="logout" id="logout">
    <h3>You have successfully logged out!</h3>
    <p>Do you want to log in again?<a href="login.php">Log in!</a> </p>
</div>
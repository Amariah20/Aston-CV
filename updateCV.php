<?php
 if(isset($_POST['submitted'])){

     
        require_once('connectingToDB.php');

    try{

        $var= $db->prepare('SELECT password FROM cvs WHERE username = ?');  
        $var -> execute(array($_POST['username']));

        if ($var->rowCount()>0){  // matching username
           
           $row=$var->fetch();

          if (password_verify(($_POST['password']),$row['password'])){ //matching password
                   
               //recording the session variable 
               session_start();

               $userName= $db->quote($_POST['username']);   
               $email= filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
               $lang= htmlentities($_POST['proglang']);
               $edu= htmlentities($_POST['education']);
               $profile= htmlentities($_POST['profile']);
               $URL = htmlentities($_POST['URL']); 
               $password= isset($_POST['password'])?password_hash($_POST['password'],PASSWORD_DEFAULT):false;
             


               
              
               $val= $db->prepare("UPDATE `cvs`  SET email=?, keyprogramming=?, profile=?,education=?, URLlinks=? WHERE username=$userName" );
              
               $val-> execute(array( $email, $lang,$profile, $edu,$URL));
               echo "<script>alert('CV has been successfully updated!');</script>";
               

           }else {
               //wrong password
               echo "<script>alert('Failed to update details, password does not match!');</script>";

            }
        } else{
            echo "<script>alert('user does not exist!');</script>";
        }
    } catch(PDOException $e){
        echo ("<p style='color:red>A database error occured./p><br><br>");
        echo ("Error details: <em><b>". $e->getMessage()."</em></b>");

 }
}


?>

<!DOCTYPE html>
 <head>
 <meta charset="utf-8" />

 <meta name="csrf-token" content="{{ csrf_token() }}">

 <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
<link rel="stylesheet" type="text/css" href="porftolio3.css" >

<script scr="portfolio3JS.js"></script>

 <title>Update CV</title>
 </head>
 <nav id="nav">
     <h1>Welcome to AstonCV</h1>
    |<a id="nav1" href="registrationForm.php">Register<i class="bi bi-pen-fill"></i></a> |
    <a id="nav1" href="login.php">Log in <i class="bi bi-box-arrow-right"></i></a> |
    <a id="nav1" href="cv.php">All CVs <i class="bi bi-person-lines-fill"></i></a> |
</nav>

 <h2>Update CV Details</h2>
 <body>


    <form action="updateCV.php" method="post">
    <label for="username">Username: </label><input type="text" name="username" size="25" minlength="3" maxlength="20" placeholder="username"  id="username"  required /><br>
        <label for="email">Email: </label><input type="email" name="email" size="40" minlength="5" maxlength="40"  placeholder="email " required /><br><br>
        <label for="proglang">Key Programming Language: </label><input type="text" name="proglang" size="40" maxlength="40"  placeholder="programming language " required /><br>
        <label for="education">Education: </label><input type="text" name="education" size="40" minlength="2" maxlength="40"  placeholder="education" required /><br><br>
        <label for="profile">profile: </label><input type="text" name="profile" size="40" minlength="3" maxlength="40"  placeholder="profile" required /><br>
        <label for="URL">URL: </label><input type="text" name="URL" size="40"   placeholder="URL Link" required /><br><br>

        <label for="password">Password: </label> <input type="text" name="password" size="40" maxlength="40"  placeholder="current password" required /><br><br>
        
        <input type="submit" value="Update" />
	    <input type="reset" value="clear"/>
        <input type="hidden" name="submitted" value="true" />

    </form>
 </body>
</DOCTYPE>
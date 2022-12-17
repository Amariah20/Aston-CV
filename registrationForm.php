<?php

//has the form been submitted?
if(isset($_POST['submitted'])){
    
    //connecting to DB
    require_once('connectingToDB.php');

    $userName= htmlentities(isset($_POST['username'])?$_POST['username']:false); //preventing html injection with htmlentities()
    $password= htmlentities(isset($_POST['password'])?password_hash($_POST['password'],PASSWORD_DEFAULT):false); 


    //why is this if statement here?
    // if (!($userName)){
    //     echo "Username wrong!";
    //     exit;
    //     }
    //   if (!($password)){
    //     exit("password wrong!");
    // }

    try{
    

        //registering user
        $var = $db->prepare("insert into `cvs` (username, password) values (?,?)");  
        $var-> execute(array($userName,$password));
        
        //getting user id
        $id=$db-> lastInsertId();
        echo ("<script>alert('Registration successful! Your ID is: $id .');</script>");
       
        

    } catch(PDOException $e){
        echo ("<p style='color:red'>A database error occured./p><br><br>");
        echo ("Error details: <em><b>". $e->getMessage()."</em></b>");

    }
}

?>

<!DOCTYPE html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
<link rel="stylesheet" type="text/css" href="porftolio3.css" >

<meta name="csrf-token" content="{{ csrf_token() }}">
<script scr="portfolio3JS.js"></script>
<title>Register</title>
</head>
<nav id="nav">
    <h1>Welcome to AstonCV</h1>
    |<a id="nav1" href="updateCV.php">Update CV<i class="bi bi-pen-fill"></i></a> |
    <a id="nav1" href="login.php">Log in <i class="bi bi-box-arrow-right"></i></a> |
    <a id="nav1" href="cv.php">All CVs <i class="bi bi-person-lines-fill"></i></a> |
</nav>
<body>
<form id="register" method = "post" action="registrationForm.php">
    <h2>Registration Form</h2>
    
	<label for="username">Username: </label><input type="text" name="username" size="20" minlength="3" maxlength="30"  id="username" required/><br> <!--the pattern prevents html/javascript injections-->
	<label for="password">Password: </label><input type="password" name="password" size="20" maxlength="30"  required/><br><br><br> <!--pattern="[ ^< ^>]" change to vowels. pa check for injections here-->

	<input type="submit" value="Register" /> 
	<input type="reset" value="clear"/>
	<input type="hidden" name="submitted" value="true"/>
   <!-- <meta http-equiv="refresh" content="5; URL=login.php " /> -->
  </form>  
  <p>Already have an account? <a href="login.php">Log in!</a>  </p>
  
</body>
</html>


<?php

if(isset($_POST['submitted'])){

    if(!isset($_POST['username'] ,$_POST['password'])){
        exit("Please enter both username and password!");
    }  
    
    require_once('connectingToDB.php');

    try{
		
		
        //finding matching username & password in database
        $var= $db->prepare('SELECT password FROM cvs WHERE username = ?');  
        $var -> execute(array($_POST['username']));
		

        
			if ($var->rowCount()>0){  // matching username
			
				$row=$var->fetch();
                

				
				if (password_verify(($_POST['password']),$row['password'])){ //matching password
					
					//recording the session variable and going to login page
				  session_start();
					$_SESSION["username"]=htmlentities($_POST['username']); //HTML ENTITIES
					
					header("Location:cv.php"); 
					
					exit();
				
				} else {
                    //wrong password
				 echo "<script>alert('Failed to login, password does not match!');</script>";
 			    }
		    } else {
			 //wrong user name
			  echo "<script>alert('Failed to login, Username does not exist!');</script>";
		    }

    } catch(PDOException $e ){

        echo "<p style='color:red>Could not connect to database.</p><br>";
			echo $e->getMessage();
			exit;
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

<title>Login Page</title>
</head>
<nav id="nav">
   <h1>Welcome to AstonCV</h1>
    |<a id="nav1" href="updateCV.php">Update CV<i class="bi bi-pen-fill"></i></a> |
    <a id="nav1" href="registrationForm.php">Register<i class="bi bi-box-arrow-right"></i></a> |
    <a id="nav1" href="cv.php">All CVs <i class="bi bi-person-lines-fill"></i></a> |
</nav>
<body>
    <h2>Login Page</h2>

    <form action="login.php" method="post">

	<label for="username">Username: </label><input type="text" name="username" size="20" minlength="3" maxlength="30"  required/> 
    <label for="password">Password:</label><input type="password" name="password" size="20" maxlength="30"  required /> 
	
	
	<input type="submit" value="Login"  />
	<input type="reset" value="clear"/>
    <input type="hidden" name="submitted" value="true" />
	<p>Not a registered user yet? <a href="registrationForm.php">Register!</a></p> 

</form>
</body>
<br><br><br><br>
<footer>

     <p>Would you like to log out? <a href="logout.php">Log out!</a></p>
     <p>© All rights reserved 2022-2025<p>
 </footer>
</html>
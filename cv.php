
<?php

  
    session_start();
    if(!isset($_SESSION['username'])){
        header("Location:login.php");
        exit();
    }

    $username=$_SESSION['username'];
	

    require_once('connectingToDB.php');

    try{
        
        $var= "SELECT * FROM cvs";
        $tuples =  $db->query($var); //rows

        if ( $tuples && $tuples->rowCount()> 0) {

 ?>
        <!DOCTYPE html>
        <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link rel="stylesheet" type="text/css" href="porftolio3.css" >
        <title>CV Page</title>

        <!--icon library -->
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
       
       <meta name="csrf-token" content="{{ csrf_token() }}">
       <script scr="portfolio3JS.js"></script>
        </head>

        <nav id="nav">
        <h1>Welcome to AstonCV</h1>
      |<a id="nav1" href="updateCV.php">Update CV<i class="bi bi-pen-fill"></i></a> |
      <a id="nav1" href="login.php">Log in <i class="bi bi-box-arrow-right"></i></a> |
      <a id="nav1" href="registrationForm.php">Register<i class="bi bi-box-arrow-right"></i></a> |
     </nav>

    <?php
      echo ("<h2 style='color:red', style='font-size:300px'> Hello ".$_SESSION['username']."! </h2>");
    ?>
     
        <h2>List of CVs</h2><br><br>
    <form action="allCVdetails.php" method="POST">
        <p>Please select a radio box before typing into the search button</p>
        <label><input  type = "radio" name = "rdo" value = "Search By Name"/>Search By Name</label>
        <label><input type = "radio" name = "rdo" value = "Search By Language"/>Search By Programming Language</label><br>
        <input type="text" placeholder="Search.." name="search">
        <button type="submit"><i id="search" class="fa fa-search" name="submitted"></i></button>  <!--customize button-->
        
        <br>
        <p>Click on a name to get more details regarding a particular candidate!</P>
        <table cellspacing="5"  cellpadding="10" id="CVtable" >
        <tr><th align="left"><b>Name</b></th>   <th align="left"><b>Email</b></th> <th align="left"><b>Key Programming Language</b></th > </tr>
        
        <?php
        
		//printing all  the records.
			while  ($row =  $tuples->fetch())	{   
				echo  "<tr><td align='left'><a href='allCVdetails.php?name=". $row['username'] ."'> ". $row['username'] ."</td>"; 
                echo "<td align='left'>" . $row['email']  ."</td>";   
				echo  "<td align='left'>" . $row['keyprogramming'] . "</td><tr>\n";   
	           
			}

        echo "</table>";

        "</form>";
        }
        else {
			echo  "<script>alert('There's currently no cv stored in the database.');</script>"; //no match found
		
    
        }
    }catch (PDOexception $e){
		echo "<p style='color:red>Unfortunately, a database error occurred!</p> <br>";
		echo "Error details: <em>". $e->getMessage()."</em>";
	}
	?>	
  <br><br>
   <footer>
     <p>Would you like to log out? <a href="logout.php">Log out!</a></p>
     <p>© All rights reserved 2022-2025<p>
 </footer>
</html>

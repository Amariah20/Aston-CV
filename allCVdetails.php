<!DOCTYPE html>
<head>
<link rel="stylesheet" type="text/css" href="porftolio3.css" >
</head>

<?php
 require_once('connectingToDB.php');
 try{
   

  if(isset($_POST['search'])) {
      

    if(isset($_POST['rdo'])){
    

     //if user wants to search by name
       if($_POST['rdo']=='Search By Name'){
          

           $searchValue=$_POST['search']; //getting what user typed in search box
        
           $val= $db-> query("SELECT * FROM cvs WHERE username='$searchValue' "); 
           
           //$val-> execute(array($searchValue));

          
           echo "<p>please click on a name to view the candidate's CV</p>";
      
           while($row=$val->fetch()){
            echo  "<p align='left'><a href='allCVdetails.php?name=". $row['username'] ."'> ". $row['username'] ."</p>";
          }
        

         //if user wants to search by programming language
       } elseif($_POST['rdo']=='Search By Language'){ 
          $searchValue= $_POST['search'];
          $val= $db-> query("SELECT * FROM cvs WHERE keyprogramming='$searchValue' ");
          //$val-> execute(array($searchValue));

          echo "<p>please click on a name to view the candidate's CV</p>";
          while($row=$val->fetch()){
 
            echo  "<p align='left'><a href='allCVdetails.php?name=". $row['username'] ."'> ". $row['username'] ."</p>";

           }
       }
     
   } 
} elseif(isset($_GET['name'])){ //otherwise, display all cv details if a name is selected
   
    
    $userName=$_GET['name']; //notes from advanced php lecture to display details. slide 8
   
    $var= $db -> query("SELECT * FROM cvs WHERE username='$userName'");
    
 "<div id='displayCV'>";

    foreach ($var as $row){
      echo  "<li> Name: ". $row['username']. "</li>";
      echo  "<li> Email: ". $row['email']. "</li>";
      echo "<li>  Programming Language: " . $row['keyprogramming']. "</li>"; 
      echo  "<li> Profile: ". $row['profile']. "</li>";
      echo  "<li> Education: ". $row['education']. "</li>";
      echo  "<li> URL Links: ". $row['URLlinks']. "</li>";
      
      
    }
    "</div>";
}
 

}catch(PDOException $e){
    echo "<b><p style='color:red'>Unfortunately there has been an error.</p></b>";
    echo ("Error details: <em><b>". $e->getMessage()."</em></b>");
}
 
 

?>
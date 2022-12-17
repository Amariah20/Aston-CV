<?php
$dbHost= 'localhost';
$dbName= 'u_210069828_portfolio3';
$userName= 'root'; //root is the default username for mysql
$password='';

try{
    $db= new PDO("mysql:dbname=$dbName;host=$dbHost", $userName, $password);

} catch (PDOException $e){
    echo("<p style='color:red>Could not connect to database.</p><br>");
    echo($e->getMessage());
	exit;
}

?>
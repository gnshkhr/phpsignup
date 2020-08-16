<?php

// Autor ganesh Khaire 
// Using PDO connection
// Database ::Mysql
// File Name : Database Connection File

//  connection done using PDO -> has 12 drivers..

// $db = new PDO('mysql:host = localhost; dbname = signup', 'root',''); // simple way to connect
// echo "Connected To register database";//simple way to connect

/* Below is showing Better way to connect to Pdo And database connection..*/

  $dsn = "mysql:host=localhost; dbname=signup"; //dsn -> data source Network..
  $username = 'root';                               // root ->mysql -> user
  $password = '';  // Password is blank here..
 
//   PDO exception TRy and catch Block...
 
   try{

     // variables are just palced inside the PDO object... 
     $db = new PDO ($dsn , $username, $password);
    //set pdo error mode to exception
     $db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
    // echo '<h4><p style ="color:green;"> Connection is Successful &#10004;</p></h4>';
     
   }catch(PDOException $ex){
    
     echo '<h4><p style ="color:red;"> &#10008; Connection Failed:</p></h4>'. $ex->getMessage();
 
   }

  // $db = mysqli_connect('localhost','root','','signup');
?>
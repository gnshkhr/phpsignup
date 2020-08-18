<?php
include_once 'utility1.php';
include_once 'database.php';
 session_start();
if(!isset($_SESSION['Username'])){
  header('Location : login.php');
}
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentication system</title>
</head>
<body>
<h1>User Authentication System</h1>
 <hr style="height:5px;background-color:black;">
<?php 


 
   if(isset($_SESSION['Username'])|| isCookieValid($db)){
   $id = $_SESSION['id'];
   $username = $_SESSION['Username'];
   echo "<p> you are signned in as Username : $username  ID: $id </p>";
   echo '<p> <a href="logout.php"> Logout </a> </p>';
   }else{
   
    echo '<p>Not yet member Register Here  <a href="Signup.php">SignUp</a> You are not logged in as a member <a href="login.php">Login</a></p>';

   }



?>
   </body>
   </html>
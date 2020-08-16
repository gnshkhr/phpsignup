<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp</title>
</head>
<body>
<h1>User Authentication System</h1>
<hr style="height:5px;background-color:black;">
<?php
include_once 'database.php';
include_once 'utility1.php';

?>
<?php
 if(isset($_POST['submit'])){

    $formErrors = array();
    $requiredField = array('username', 'password');
    $fieldlength = array('username'=>4,'password'=>8);
    $formErrors = array_merge($formErrors, checkEmptyField($requiredField));
    $formErrors = array_merge($formErrors, checkLength($fieldlength));
   // $formErrors = array_merge($formErrors,checkEmail($_POST));

     if(empty($formErrors)) {

       $username = $_POST['username'];
       $password = $_POST['password'];


       $query = "SELECT * FROM users WHERE username = :username";
       $statement    =  $db->prepare($query);
       $statement->execute(array(':username'=> $username));

       while( $row = $statement->fetch()){

        $id = $row['id'];
        $hashed_password = $row['Password'];
        $username = $row['Username'];
       
        if(password_verify($password,$hashed_password)){    
          
          echo  $_SESSION['id'] = $id;
          echo  $_SESSION['Username'] = $username;
          header('Location: index.php');

        }else{

            echo '<p style = "color:red;">Login Failed !! Password is wrong</p>';
        }

    }

    if(count($formErrors)==1){

        $result = "<p style ='color:red;border:1px solid gray;'>There was One Eror </p>";

    }elseif(count($formErrors)>1){
    
        $result = "<p style ='color:red;border:1px solid gray;'>There were ".count($formErrors)." Erors. </p>";
    }
    }
}
?>


<form action="" method="POST">
<fieldset style ='width:30%'>
<legend>SignIn</legend>
 <?php 
    if(isset($result)) echo $result;
    if(!empty($formErrors)) echo showError($formErrors);
 ?>
<br>
<label for="username">USERNAME</label>
<input type="text" name="username"> <br><br>
<label for="password">PASSWORD</label>
<input type="text" name="password" ><br> <br>
<label for="">&nbsp;    &nbsp;   &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
<input type="submit" name="submit" Value="login">
</fieldset>
</form>

<p><a href="signup.php">Back</a></p>
</body>
</html>
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
include_once 'utility.php';


//var_dump($_POST); // to check method is det or not
    $message ="";
    $result="";
    $formErrors = array();
    if(isset($_POST['submit'])){

       $requriedFields = array('Email','Username','Password');
       $fieldsLength   = array('Email'=>10,'Username'=>4,'Password'=>8);

       //To check empty Fields
       $formErrors = array_merge($formErrors, checkEmptyFields($requriedFields));
       //To Check Length of Fields
       $formErrors = array_merge($formErrors, checkLength($fieldsLength));
       //To Check Email verify
       $formErrors = array_merge($formErrors, checkEmail($_POST));

 if(empty($formErrors)) {
     
        $email = $_POST['Email'];
        $username = $_POST['Username'];
        $password = $_POST['Password'];

        $hashed_password = password_hash($password,PASSWORD_DEFAULT);
          
    $sqlinsert = "INSERT INTO  users (username, password ,email,jointdate) VALUES (:username,:password, :email, now())";
    $statement = $db->prepare($sqlinsert);
    $statement->execute(array(':username'=>$username , ':password'=>  $hashed_password , ':email'=>$email));
 
    if($statement->rowcount()==1){

        $message = "<p style='color:green; text:align:center'>Registration successfull &#10004;</p>";
    }else{
        $message = "<p style='color:red; text:align:center'>Error is ocuured plz try again</p>";
    }
  
  } 
  
  if(count($formErrors)==1){

    $result = "<p style='color: red;'> There was 1 error in the form<br>";
  }elseif(count($formErrors)>1){
     
    $result = "<p style='color: red;'> There were ". count($formErrors) ." error in the form<br>";
  
  }
  
} 
?>
 

<?php if(isset($result)) echo $result; ?>
<?php if(!empty($formErrors)) echo showError($formErrors); ?>
 
<form action="" method="POST">
<fieldset style="width:30%;">
<?= $message ?>

<legend>SignUp</legend>
<br>
<label for="email">EMAIL&nbsp;&nbsp;   &nbsp;   &nbsp;      &nbsp; &nbsp;</label> 
<input type="text" name="Email" > <br><br>
<label for="username">USERNAME </label>
<input type="text" name="Username"> <br><br>
<label for="password">PASSWORD</label>
<input type="text" name="Password" ><br> <br>
<label for="">&nbsp;     &nbsp;   &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
<input type="submit" name="submit" Value="SignUp">

</fieldset>
</form>

<p>  <a href="LOGIN.php">LOGIN </a></BUtton>  </p>
</body>
</html>


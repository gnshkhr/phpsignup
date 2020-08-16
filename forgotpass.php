<?php include_once 'database.php';

include_once 'utility4.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
    <?php

        if(isset($_POST['submit'])){
         
            $formErros = array();
            $requiredFields = array('Email', 'Newpassword','Confirmpassword');
            $fieldlength = array('Newpassword'=>8,'Confirmpassword'=>8);
            $formErros = array_merge($formErros,checkEmptyField($requiredFields));
            $formErros = array_merge($formErros,checkEmail($_POST));
            $formErros = array_merge($formErros,checkMinLength($fieldlength));
            $errCount = count($formErros);
            
            if(empty($formErros)){

                $email = $_POST['Email'];
                $newpassword = $_POST['Newpassword'];
                $confirmpassword = $_POST['Confirmpassword'];

                if($newpassword != $confirmpassword ){

                    $result1 = "<p style ='color:red;'> New password and confirm Password Doesn't Match!!!</p>";
                }else{

                    $query = "SELECT email FROM users WHERE email = :email";
                    $statement = $db->prepare($query);
                    $statement->execute(array(':email'=>$email));

                    if($statement->rowCount()==1){
                        $hashedPassword = password_hash($newpassword ,  PASSWORD_DEFAULT);

                        $queryUpdate = "UPDATE users SET Password = :password WHERE email = :email";
                        $statement = $db->prepare($queryUpdate);
                        $statement->execute(array(':password'=> $hashedPassword, ':email'=>$email));
                        $result1 = "<p style='padding:20px; border: 1px solid gray; color: green;'> &#10004;Password Reset Successful</p>";

                    }
  
                }
            
            }

            
            if($errCount == 1){
                 
                $result = '<p style="color:red;"> There is one Error</p>';

                }elseif($errCount > 1){

                $result =   "<p style = 'color:red;'> There were $errCount Error</p>";

                }else{

                $result = "";
            }



        }

        
        

       
    ?>


<body>
    <form action="" method = "POST">
    <fieldset style="width:30%;">
    <legend>Reset Password</legend>
    <?php if(isset($result1)) echo $result1; ?>
    <?php if(isset($result)) echo $result; ?>
    <?php if(!empty($formErros)) echo showError($formErros); ?>

    <label for="email">Email &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
    <input type="text" name="Email"><br><br>
    <label for="newpassword">New Password&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;</label>
    <input type="text" name="Newpassword"><br><br>
    <label for="confirmpassword">Confirm Password</label>
    <input type="text" name="Confirmpassword"><br><br>
    &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
    <input type="submit" name="submit" value="Confirm">
    </fieldset>
    </form>
</body>
</html>
<?php
//1. validation of empty textboxes//

function checkEmptyFields($requriedFields){

    $formErrors = array();

    foreach( $requriedFields as $nameofField){
          
        if (!isset($_POST[$nameofField]) || $_POST[$nameofField] == NULL){
           
           $formErrors[] = $nameofField . " is a required field." ;

        }

      }

      return $formErrors;

}

//2. length of username email & password //
// array(username=>4, password=>8,email=>10)
  
function checkLength($fieldsLength){
    
    $formErrors = array();

    foreach($fieldsLength as $nameOfField=>$minLength){
         if(strlen(trim($_POST[$nameOfField])) < $minLength ){

            $formErrors[] = $nameOfField. " is a too short. Minimum ". $minLength ." Length Required.";
         }
    }
  
    return  $formErrors;
}

    // check Email functionality

function checkEmail($data){
    //initialize an array to store error messages
    $formErrors = array();
    $key = 'Email';
    //check if the key email exist in data array
    if(array_key_exists($key, $data)){

        //check if the email field has a value
        if($_POST[$key] != null){

            // Remove all illegal characters from email
           $key = filter_var($key, FILTER_SANITIZE_EMAIL);

            //check if input is a valid email address
            if(filter_var($_POST[$key], FILTER_VALIDATE_EMAIL) === false){
                $formErrors[] = $key. " is not a valid email address";
            }
        }
    }
    return $formErrors;
}



// all the errors are collected here

function showError($formErrorArray){
    $error = "<p><ul style='color:red;'>" ;

    foreach($formErrorArray as $theError){

        $error .= "<li>". $theError  ."</li>";

    }
    $error .= "</ul></p>" ;  

   return $error;

}
?>


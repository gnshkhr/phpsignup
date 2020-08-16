<?php

function checkEmptyField($requiredFields){

    $formErrors = array();
  
   foreach($requiredFields as $nameofField){
  
       if(!isset($_POST[$nameofField]) || $_POST[$nameofField] == NULL )

       {
        $formErrors[] = $nameofField. "  a required Field";
       }

   }
       return $formErrors;
}

function checkEmail($data){

    $formErrors = array();
    $key = 'Email';

    if(array_key_exists($key,$data)){

        if($key !=  NULL){

            $key = filter_var($_POST[$key],FILTER_SANITIZE_EMAIL);

            if(filter_var($key,FILTER_VALIDATE_EMAIL)===FALSE){

                $formErrors[] = $key." Not a Valid Email Address";

            }
            
        }

    }
    return $formErrors;
}

function checkMinLength($fieldslength){
   $formErrors = array();


    foreach($fieldslength as $nameField  => $length){

        if(strlen(trim($_POST[$nameField]))< $length){

            $formErrors[] = $nameField ." minimum $length Length is required ";
        }
    }

  return $formErrors;
}



function showError($formErrorsarray){
    $error = '<ul style ="color:red;">';
   foreach($formErrorsarray as $theError){
   
       $error .= "<li>$theError </li>"; 

   }
     $error .= '</ul>';

     return $error;

}

?>
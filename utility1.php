<?php
  // to check Empty Fields
    function checkEmptyField($requiredField){

        $formErrors = array();

        foreach($requiredField as $nameofField){

            if (!isset($_POST[$nameofField]) || $_POST[$nameofField] == NULL){
           
                $formErrors[] = $nameofField . " is a required field." ;
            
            }
        }
        return $formErrors;
    }

    // to check Length of Fields

    function checkLength($fieldlength){

       $formErrors = array();
        foreach($fieldlength as $nameofField => $valueofField){

        if(strlen(trim($_POST[$nameofField])) < $valueofField){
        
            $formErrors[] = $nameofField. " is not in Valid Format Try again";

        }

        }
        return $formErrors; 

    }

    // to check the valid email
        function checkEmail($data){

        $formErrors = array();
        $key = 'Email';

        if(array_key_exists($key, $data)){

                if($_POST[$key] != null){

            $key = filter_var($key,FILTER_SANITIZE_EMAIL);
            
                if(filter_var($_POST[$key],FILTER_VALIDATE_EMAIL) === false){
                   
                    $formErrors[] = $_POST[$key]. " not a valid email address";
                
                }

            }
        }

        return $formErrors;

    }

    




    function showError($formErrorsArray){

        $error = "<ul>";

       foreach($formErrorsArray as $theError){
        
        $error .= "<li style='color:red;'> $theError </li>";

       }
        $error .= "</ul>";
      
        return $error;
    }

?>

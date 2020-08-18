<?php
// remember me functionality

function rememberMe($userId){

    $encryptCookieData = base64_encode("ABCDEFGHIJKabcdefghijk{$userId}");
    // set cookie for  month to expire time
    setcookie("rememberUserCookie",$encryptCookieData ,time()+30*24*60*60 ,"/");
}

function isCookieValid(){
    $isValid = false;
    if(isset($_COOKIE['rememberUserCookie'])){
        $decyptCookieData =  base64_decode($_COOKIE['rememberUserCookie']);
        $userId = explode('ABCDEFGHIJKabcdefghijk' ,$decyptCookieData );
        $userID = $userId[1];

        // check id retrived is exists in the database

        $sql = "SELECT * FROM users WHERE id = :id";
        $statement = $db->prpare($sql);
        $statement->execute(array(':id'=> $userID));

        if($row = $statement->fetch()){
            $id = $row['id'];
            $username = $row['username'];

            // session variables are created//
            $_SESSION['id'] = $id;
            $_SESSION['username']= $username;
            $isValid = true;
        }else{
            $isValid = false;
            signout();
        }

   
    }
    return $isValid;
}

function signout(){

    unset($_SESSION['username']);
    unset($_SESSION['id']);

    if(isset($_COOKIE['rememberUserCookie'])){
        unset($_COOKIE['rememberUserCookie']);
        setcookie('rememberUserCookie', null, -1, '/');
    }
    session_destroy();
    session_regenerate_id(true);
    header('Location : index.php');
}


function rememberMee(){

    setcookie('username' ,$_POST['username'], time()+60*60*24*30);
    setcookie('password' ,$_POST['password'], time()+60*60*24*30);
}

function withoutRememberMe(){

    setcookie("username","");
    setcookie("password","");
}
?>
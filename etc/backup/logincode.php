<?php
session_start();
include("dbcon.php");

if(isset($_POST['login_btn'])){
    $email = $_POST['email'];
    $clearTextPassword = $_POST['password'];

    try {
        $user = $auth->getUserByEmail("$email");
        try{
            $signInResult = $auth->signInWithEmailAndPassword($email, $clearTextPassword);
            $idtoken = $signInResult->idToken(); // string|null

            $idTokenString = $signInResult->idToken();

            try {
                $verifiedIdToken = $auth->verifyIdToken($idTokenString);
                $uid = $verifiedIdToken->claims()->get('sub');
                $_SESSION['idTokenString'] = $idTokenString;
                $_SESSION['verified_user_id'] = $uid;

                $_SESSION['status'] = "Logged in!";
                header('Location: home.php');
                exit();


            } catch (FailedToVerifyToken $e) {
                echo 'The token is invalid: '.$e->getMessage();
            }

        } catch(Exception $e){
            $_SESSION['status'] = "Wrong password!";
            header('Location: login.php');
            exit();
        }
        
    } catch (\Kreait\Firebase\Exception\Auth\UserNotFound $e) {
        //echo $e->getMessage();
        $_SESSION['status'] = "Invalid email address!";
        header('Location: login.php');
        exit();
    }


} else {
    $_SESSION['status'] = "Not allowed";
    header('Location: login.php');
    exit();
}


?>
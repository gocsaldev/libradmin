<?php 
session_start();
include("dbcon.php");

if(isset($_SESSION['verified_user_id'])){
    $uid = $_SESSION['verified_user_id'];
    $idTokenString = $_SESSION['idTokenString'];

    try {
        $verifiedIdToken = $auth->verifyIdToken($idTokenString);
        //echo "Working";
    } catch (FailedToVerifyToken $e) {
        //echo 'The token is invalid: '.$e->getMessage();
        $_SESSION['expiry_status'] = "Token expired on invalid! Login again";
        header("Location: logout.php");
        exit();
    }
}
else {
    $_SESSION['status'] = "Login to access this page!";
    header("Location: login.php");
    exit();
}

?>
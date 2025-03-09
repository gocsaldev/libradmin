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
        $_SESSION['expiry_status'] = "Érvénytelen vagy lejárt token! Jelentkezz be újra!";
        header("Location: logout.php");
        exit();
    }
}
else {
    $_SESSION['status'] = "Jelentkezz be, hogy elérd az oldalt!";
    header("Location: login.php");
    exit();
}

?>
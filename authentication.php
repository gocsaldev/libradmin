<?php 
session_start();
include("dbcon.php");

if(isset($_SESSION['verified_user_id'])){
    $uid = $_SESSION['verified_user_id'];
    $idTokenString = $_SESSION['idTokenString'];

    try {
        $verifiedIdToken = $auth->verifyIdToken($idTokenString);
        // Token is valid, proceed with your logic
    } catch (Firebase\Auth\Token\Exception\ExpiredToken $e) {
        // Token is expired, log the user out and redirect to login
        $_SESSION['expiry_status'] = "Érvénytelen vagy lejárt token! Jelentkezz be újra!";
        header("Location: logout.php");
        exit();
    } catch (Firebase\Auth\Token\Exception\InvalidToken $e) {
        // Token is invalid
        $_SESSION['expiry_status'] = "Érvénytelen vagy lejárt token! Jelentkezz be újra!";
        header("Location: logout.php");
        exit();
    }
} else {
    $_SESSION['status'] = "Jelentkezz be, hogy elérd az oldalt!";
    header("Location: login.php");
    exit();
}
?>
<?php
session_start();

unset($_SESSION['verified_user_id']);
unset($_SESSION['idTokenString']);


if(isset($_SESSION['expiry_status'])){
    $_SESSION['status'] = "Lejárt token! Jelentkezz be újra!";
} else {
    $_SESSION['status'] = "Sikeres kijelentkezés!";
    header("Location: login.php");
    exit();
}


?>
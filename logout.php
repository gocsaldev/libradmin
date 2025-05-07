<?php
session_start();

// Check if the token has expired
if (isset($_SESSION['expiry_status']) && $_SESSION['expiry_status'] === true) {
    // Token has expired
    $_SESSION['status'] = "Lejárt token! Jelentkezz be újra!";
} else {
    // Normal logout
    $_SESSION['status'] = "Sikeres kijelentkezés!";
}

// Unset all session variables related to the user
unset($_SESSION['verified_user_id']);
unset($_SESSION['idTokenString']);
unset($_SESSION['expiry_status']); // Clear expiry status to avoid confusion

// Redirect to login page
header("Location: login.php");
exit();
?>
<?php 
session_start();
include("dbcon.php");

// Könyv felvétele
if(isset($_POST["new-entry"])){
    $postData = [
        "title" => $_POST["title"],
        "sec_title" => $_POST["sec_title"],
        "writer" => $_POST["writer"],
        "category" => $_POST["category"],
        "whouse_id" => $_POST["whouse_id"],
        "rel_year" => $_POST["rel_year"],
        "spot" => $_POST["spot"],
        "condition" => $_POST["condition"],
        "worth" => $_POST["worth"],
        "rentable" => $_POST["rentable"]
    ];

    $ref_table = "books";
    $postRef = $database->getReference($ref_table)->push($postData);

    if($postRef->getKey()){
        $_SESSION["status"] = "Könyv sikeresen felvéve!";
    } else {
        $_SESSION["status"] = "A könyvet nem sikerült felvenni!";
    }
    
    header("Location: allomany.php");
    exit(); // Terminate script after redirect
}

// Könyv szerkesztése
if(isset($_POST["update-book"])){
    $key = $_POST["key"];
    $updateData = [
        "title" => $_POST["title"],
        "sec_title" => $_POST["sec_title"],
        "writer" => $_POST["writer"],
        "category" => $_POST["category"],
        "whouse_id" => $_POST["whouse_id"],
        "rel_year" => $_POST["rel_year"],
        "spot" => $_POST["spot"],
        "condition" => $_POST["condition"],
        "worth" => $_POST["worth"],
        "rentable" => $_POST["rentable"]
    ];

    // Update the SPECIFIC book entry
    $updateRef = $database->getReference("books/{$key}");
    $updateResult = $updateRef->update($updateData);

    if($updateResult->getKey()){
        $_SESSION["status"] = "Könyv sikeresen frissítve!";
    } else {
        $_SESSION["status"] = "A könyvet nem sikerült frissíteni!";
    }
    
    header("Location: allomany.php");
    exit(); // Terminate script after redirect
}
?>
<?php 
session_start();
include("dbcon.php");

// Könyv keresése
if(isset($_POST["search-book"])){
    $searchParams = [
        "category" => $_POST["search_category"] ?? '',
        "condition" => $_POST["search_condition"] ?? '',
        "rel_year" => $_POST["search_rel_year"] ?? '',
        "rentable" => $_POST["search_rentable"] ?? '',
        "sec_title" => $_POST["search_title"] ?? '',
        "spot" => $_POST["search_spot"] ?? '',
        "title" => $_POST["search_title"] ?? '',
        "whouse_id" => $_POST["search_whouse_id"] ?? '',
        "worth" => $_POST["search_worth"] ?? '',
        "writer" => $_POST["search_writer"] ?? '',
    ];

    // Store search parameters in session to use in kolcsozok_kereses.php
    $_SESSION['search_params'] = $searchParams;

    header("Location: allomany_kereses.php");
    exit();
}

// Kölcsönző keresése
if(isset($_POST["search-loaner"])){
    $searchParams = [
        "name" => $_POST["search_name"] ?? '',
        "add" => $_POST["search_add"] ?? '',
        "email" => $_POST["search_email"] ?? '',
        "phone" => $_POST["search_phone"] ?? ''
    ];

    // Store search parameters in session to use in kolcsozok_kereses.php
    $_SESSION['search_params'] = $searchParams;

    header("Location: kolcsonzok_kereses.php");
    exit();
}

// Kölcsönző törlése
if(isset($_POST["delete-loaner"])){
    $del_id = $_POST["delete-loaner"];

    $ref_table = "loaners/".$del_id;
    $deletequery_result = $database->getReference($ref_table)->remove();

    if($deletequery_result){
        $_SESSION["status"] = "Sikeres törlés!";
        header("Location: kolcsonzok.php");
    } else {
        $_SESSION["status"] = "Sikertelen törlés!";
        header("Location: kolcsonzok.php");
    }
}

// Kölcsönző szerkesztése
if(isset($_POST["update-loaner"])){
    $key = $_POST["key"];
    $updateData = [
        "name"=> $_POST["name"],
        "add" => $_POST["add"],
        "email" => $_POST["email"],
        "phone"=> $_POST["phone"],
    ];

    // Update the SPECIFIC book entry
    $updateRef = $database->getReference("loaners/{$key}");
    $updateResult = $updateRef->update($updateData);

    if($updateResult->getKey()){
        $_SESSION["status"] = "Kölcsönző sikeresen frissítve!";
    } else {
        $_SESSION["status"] = "A kölcsönzőt nem sikerült frissíteni!";
    }
    
    header("Location: kolcsonzok.php");
    exit(); // Terminate script after redirect
}

// Kölcsönző felvétele
if(isset($_POST["new-loaner"])){
    // Fetch the last UID from the database
    $ref_table = "loaners";
    $fetchdata = $database->getReference($ref_table)->getValue();
    $lastUid = 0;

    if (!empty($fetchdata) && is_array($fetchdata)) {
        foreach ($fetchdata as $row) {
            if (isset($row['uid']) && $row['uid'] > $lastUid) {
                $lastUid = $row['uid'];
            }
        }
    }

    // Increment the UID
    $newUid = $lastUid + 1;

    // Prepare the data for the new loaner
    $postData = [
        "uid" => $newUid,
        "name" => $_POST["name"],
        "add" => $_POST["add"],
        "email" => $_POST["email"],
        "phone" => $_POST["phone"],
        "date" => $currentDateTime = date('Y-m-d H:i:s'),
    ];

    $postRef = $database->getReference($ref_table)->push($postData);

    if($postRef->getKey()){
        $_SESSION["status"] = "Kölcsönző sikeresen felvéve!";
    } else {
        $_SESSION["status"] = "A kölcsönzőt nem sikerült felvenni!";
    }
    
    header("Location: kolcsonzok.php");
    exit(); // Terminate script after redirect
}

// Könyv törlése
if(isset($_POST["delete-entry"])){
    $del_id = $_POST["delete-entry"];

    $ref_table = "books/".$del_id;
    $deletequery_result = $database->getReference($ref_table)->remove();

    if($deletequery_result){
        $_SESSION["status"] = "Sikeres törlés!";
        header("Location: allomany.php");
    } else {
        $_SESSION["status"] = "Sikertelen törlés!";
        header("Location: allomany.php");
    }
}

// Könyv felvétele
if (isset($_POST['new-entry'])) {
    // Book data
    $title = $_POST['title'];
    $sec_title = $_POST['sec_title'];
    $writer = $_POST['writer'];
    $category = $_POST['category'];
    $whouse_id = $_POST['whouse_id'];
    $rel_year = $_POST['rel_year'];
    $spot = $_POST['spot'];
    $condition = $_POST['condition'];
    $worth = $_POST['worth'];
    $rent_name = $_POST['rent_name'];
    $rent_date1 = $_POST['rent_date1'];
    $rent_date2 = $_POST['rent_date2'];

    // Prepare basic book data
    $postData = [
        'title' => $title,
        'sec_title' => $sec_title,
        'writer' => $writer,
        'category' => $category,
        'whouse_id' => $whouse_id,
        'rel_year' => $rel_year,
        'spot' => $spot,
        'condition' => $condition,
        'worth' => $worth,
        'rentable' => $rentable,
        'rent_name' => $rent_name,
        'rent_date1' => $rent_date1,
        'rent_date2' => $rent_date2,
    ];

    // Push book data to Firebase
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

// Könyv kölcsönzésének visszavonása
if(isset($_POST["del-rent"])){
    $key = $_POST["key"];
    $updateData = [
        "rent_name" => "",
        "rent_date1" => "",
        "rent_date2" => "",
    ];

    // Update the SPECIFIC book entry
    $updateRef = $database->getReference("books/{$key}");
    $updateResult = $updateRef->update($updateData);

    if($updateResult->getKey()){
        $_SESSION["status"] = "Kölcsönzés sikeresen visszavonva!";
    } else {
        $_SESSION["status"] = "A kölcsönzést nem sikerült visszavonni!";
    }
    
    header("Location: allomany.php");
    exit(); // Terminate script after redirect
}


// Könyv szerkesztése
if (isset($_POST["update-book"])) {

    $key = $_POST["key"];

    // Validate key
    if (empty($key)) {
        $_SESSION["status"] = "Érvénytelen könyv kulcs!";
        header("Location: allomany.php");
        exit();
    }

    // Build update data
    $updateData = [];

    // Existing fields
    if (!empty($_POST["title"])) $updateData["title"] = $_POST["title"];
    if (!empty($_POST["sec_title"])) $updateData["sec_title"] = $_POST["sec_title"];
    if (!empty($_POST["writer"])) $updateData["writer"] = $_POST["writer"];
    if (!empty($_POST["category"])) $updateData["category"] = $_POST["category"];
    if (!empty($_POST["whouse_id"])) $updateData["whouse_id"] = $_POST["whouse_id"];
    if (!empty($_POST["rel_year"])) $updateData["rel_year"] = $_POST["rel_year"];
    if (!empty($_POST["spot"])) $updateData["spot"] = $_POST["spot"];
    if (!empty($_POST["condition"])) $updateData["condition"] = $_POST["condition"];
    if (!empty($_POST["worth"])) $updateData["worth"] = $_POST["worth"];
    if (!empty($_POST["rent_name"])) $updateData["rent_name"] = $_POST["rent_name"];
    
    // Add loaner_uid and rent dates
    if (!empty($_POST["loaner_uid"])) $updateData["loaner"] = $_POST["loaner_uid"]; // Map to 'loaner' field
    if (!empty($_POST["rent_date1"])) $updateData["rent_date1"] = $_POST["rent_date1"];
    if (!empty($_POST["rent_date2"])) $updateData["rent_date2"] = $_POST["rent_date2"];

    // Update Firebase
    try {
        $updateRef = $database->getReference("books/{$key}");
        $updateResult = $updateRef->update($updateData);

        if ($updateResult->getKey()) {
            $_SESSION["status"] = "Könyv sikeresen frissítve!";
        } else {
            $_SESSION["status"] = "A könyvet nem sikerült frissíteni!";
        }
    } catch (Exception $e) {
        $_SESSION["status"] = "Hiba történt a frissítés során: " . $e->getMessage();
    }

    header("Location: allomany.php");
    exit();
}
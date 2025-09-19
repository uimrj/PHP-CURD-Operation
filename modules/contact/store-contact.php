<?php
require_once "../../config/connection.php";

// Check required fields
if (!empty($_POST['full_name']) && !empty($_POST['phone'])) {
    try {
        $insert = $db->prepare(
            'INSERT INTO `contacts` 
            (full_name, nickname, email, phone, address, contact_type_id) 
            VALUES (:fname, :nname, :email, :phone, :address, :type_id)'
        );

        $insert->execute([
            "fname" => $_POST['full_name'],
            "nname" => $_POST['nickname'] ?? null,
            "email" => $_POST['email'] ?? null,
            "phone" => $_POST['phone'],
            "address" => $_POST['address'] ?? null,
            'type_id' => $_POST['type_id'] ?? null
        ]);

        // Redirect with success message
        header("Location:create-contact.php?code=1");
        exit;
    } catch (PDOException $e) {
        // Log error or show friendly message
        error_log("Insert contact error: " . $e->getMessage());
        header("Location:create-contact.php?code=3"); // 3 = database error
        exit;
    }
} else {
    // Redirect if required fields are missing
    header("Location:create-contact.php?code=2"); // 2 = missing required fields
    exit;
}

<?php
require_once "../../config/connection.php";

$id = $_POST['id'] ?? null;

if (!$id) {
    // Redirect if no ID provided
    header("Location:list-contact.php?code=4"); // 4 = missing ID
    exit;
}

if (!empty($_POST['full_name']) && !empty($_POST['phone'])) {
    try {
        $update = $db->prepare(
            'UPDATE `contacts` SET 
                full_name = :fname,
                nickname = :nname,
                email = :email,
                phone = :phone,
                address = :address,
                contact_type_id = :type_id
            WHERE id = :id'
        );

        $update->execute([
            "id" => $id,
            "fname" => $_POST['full_name'],
            "nname" => $_POST['nickname'] ?? null,
            "email" => $_POST['email'] ?? null,
            "phone" => $_POST['phone'],
            "address" => $_POST['address'] ?? null,
            "type_id" => $_POST['type_id'] ?? null
        ]);

        header("Location:edit-contact.php?id=$id&code=1"); // success
        exit;
    } catch (PDOException $e) {
        error_log("Update contact error: " . $e->getMessage());
        header("Location:edit-contact.php?id=$id&code=3"); // database error
        exit;
    }
} else {
    // Missing required fields
    header("Location:edit-contact.php?id=$id&code=2"); // validation error
    exit;
}

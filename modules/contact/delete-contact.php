<?php
require_once "../../config/connection.php";

// Check if ID is provided
if (!empty($_GET['id'])) {
    $id = $_GET['id'];

    try {
        // Prepare and execute delete query
        $delete = $db->prepare("DELETE FROM contacts WHERE id = :id");
        $delete->execute(['id' => $id]);

        if ($delete->rowCount() > 0) {
            // Successfully deleted
            header("Location:list-contact.php?code=1");
        } else {
            // ID not found
            header("Location:list-contact.php?code=2");
        }
        exit;
    } catch (PDOException $e) {
        // Log error and redirect
        error_log("Delete contact error: " . $e->getMessage());
        header("Location:list-contact.php?code=2");
        exit;
    }
} else {
    // No ID provided
    header("Location:list-contact.php?code=2");
    exit;
}

<?php

// Create a connection
include "../db_connection.php";
// Check if delete action is triggered
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['user_id'])) {
    // Get the id of the row to be deleted
    $deleteId = $_GET['user_id'];

    // Prepare the delete statement
    $stmt = $connection->prepare("DELETE FROM cashier WHERE user_id = ?");
    $stmt->bind_param("i", $deleteId);

    // Execute the delete statement
    if ($stmt->execute()) {
        echo "Row deleted successfully.";
        header("Location: cashier.php");
    } else {
        echo "Error deleting row: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}
if (isset($_GET['action']) && $_GET['action'] === 'dt' && isset($_GET['trans_id'])) {
    // Get the id of the row to be deleted
    $deleteId = $_GET['trans_id'];

    // Prepare the delete statement
    $stmt = $connection->prepare("DELETE FROM money WHERE trans_id = ?");
    $stmt->bind_param("i", $deleteId);

    // Execute the delete statement
    if ($stmt->execute()) {
        echo "Row deleted successfully.";
        header("Location: transactions.php");
    } else {
        echo "Error deleting row: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}
?>
<?php
session_start(); // Start the session

// Retrieve order information from request or session
$reservation_id = isset($_POST['reservation_id']) ? $_POST['reservation_id'] : ''; // Assuming the order number is submitted via POST
$customerName = isset($_SESSION['customer_name']) ? $_SESSION['customer_name'] : ''; // Assuming customer name is stored in the session

include_once "connection.php"; // Make sure to include the correct file name for your database connection

// Update the order status
if (!empty($reservation_id) && !empty($customerName)) {
    $sql = "UPDATE reservation SET order_status = 'A' WHERE reservation_id = ' '";
    if ($connection && $connection->query($sql) === TRUE) {
        echo "Order status updated successfully.";
    } else {
        echo "Error updating order status: " . $connection->error;
    }
} else {
    echo "Invalid order information.";
}
?>

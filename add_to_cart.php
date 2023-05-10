<?php
//Include the database connection
include_once 'connection.php';

//start the session
session_start();

$item_id = $_POST['item_id'];
$item_name = $_POST['item_name'];
$item_price = $_POST['item_price'];
$item_size = $_POST['item_size'];
$item_qty = $_POST['item_qty'];

$item = [
    'id' => $item_id,
    'name' => $item_name,
    'price' => $item_price,
    'size' => $item_size,
    'qty' => $item_qty,
];

if (isset($_SESSION['cart'])) {
    // If the cart session variable already exists, add the new item to it
    $_SESSION['cart'][] = $item;
} else {
    // If the cart session variable doesn't exist yet, create it and add the new item to it
    $_SESSION['cart'] = [$item];
}

header('Location: cart.php');

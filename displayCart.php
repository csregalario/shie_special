<?php

include_once "connection.php";

if(isset($_POST['price_id'])) {
    $user = $_SESSION['user_id'];
    $price_id = $_POST['price_id'];
    $item_id = $_POST['item_id'];
    $cat_id = $_POST['cat_id'];
    $size_id = $_POST['size_id'];
    $cart_qty = $_POST['item_qty'];

    $sql = "SELECT reservation_id, price_id, item_id, cat_id, size_id, item_quantity, order_status
            FROM reservation r
            WHERE `user_id` = ? 
              AND `price_id` = ?
              AND `item_id` = ?
              AND `cat_id` = ?
              AND `size_id` = ?
              AND `order_status` = 'C'";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "iiiii", $user, $price_id, $item_id, $cat_id, $size_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    if(mysqli_num_rows($result) == 0) {
        $order_qty = 0;
        $order_qty += $cart_qty;

        $table = "reservation";
        $fields = array( 'user_id' => $user
                        ,'price_id' => $price_id
                        ,'item_id' => $item_id
                        ,'cat_id' => $cat_id
                        ,'size_id' => $size_id
                        ,'item_quantity' => $order_qty
                        ,'order_status' => 'C'
                       );

        if(insert($conn, $table, $fields)) {
            header("location: menuPage.php?add_to_cart=success");
            exit();
        } else {
            header("location: menuPage.php?add_to_cart=failed");
            exit();
        } 
    } else {
        $reservation_id = $row['reservation_id'];
        $order_qty = $row['item_quantity'];
        $order_qty += $cart_qty;

        $table = "reservation";
        $fields = array('item_quantity' => $order_qty);
        $filter = array('reservation_id' => $reservation_id);

        if(update($conn, $table, $fields, $filter)) {
            header("location: menuPage.php?add_to_cart=success");
            exit();
        } else {
            header("location: menuPage.php?add_to_cart=failed");
            exit();
        }  
    }  
    mysqli_free_result($result);
    
    }
      
         
            // // If the user wants to remove an item from the cart
            // if (isset($_GET['remove'])) {
            //     // Get the reservation ID to remove
            //     $reservation_id = $_GET['remove'];
    
            //     // Remove the item from the cart
            //     if(isset($_SESSION['cart'][$reservation_id])) {
            //     unset($_SESSION['cart'][$reservation_id]);
    
            //     // Redirect the user back to the cart page
            //     header('Location: myCart.php');
            //     exit;
            // } else {
            //     header('Location: error.php');
            //     exit;
            // }
            // }

    
    /*   elseif (isset($_GET['remove'])) {
            $reservation_id = $_GET['remove'];
        
            $table = "reservation";
            $filter = array('reservation_id' => $reservation_id);
        
            if (delete($conn, $table, $filter)) {
                header("location: myCart.php?remove_item=success");
                exit();
            } else {
                header("location: myCart.php?remove_item=failed");
                exit();
            }
        } */
// If the user submitted a form to add an item to the cart
// if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cat_id']) && isset($_POST['item_qty'])) {
//     // Get the item ID and quantity from the form
//     $cat_id = $_POST['cat_id'];
//     $item_qty = $_POST['item_qty'];

//     // If the item is already in the cart, update its quantity
//     if (isset($_SESSION['cart'][$cat_id])) {
//         $_SESSION['cart'][$cat_id] += $item_qty;
//     } else {
//         // Otherwise, add the item to the cart with the specified quantity
//         $_SESSION['cart'][$cat_id] = $item_qty;
//     }

//     // Redirect the user back to the order display page
//     header('Location: menuPage.php');
//     exit;
// }



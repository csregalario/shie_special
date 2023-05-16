<?php
include('connection.php');

    $user_id = $_SESSION['user_id'];

    $sql = "SELECT * FROM user WHERE user_id = $user_id";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);

    if (!$user) {
        echo "Error: User not found.";
        exit();
    }

    //Check if the form was submitted
    // if(isset($_POST['submit'], $_POST['reservation_id'])) {
    //     $reservation_id = $_POST['reservation_id'];

    //     $new_order_status = 'P';
    //     $sql = "UPDATE reservation SET order_status = '$new_order_status' WHERE reservation_id = $reservation_id";
    //     mysqli_query($conn, $sql);

    //     header('Location: checkout.php');
    //     exit();
    // } else {
    //     header('Location: checkout.php');
    //     exit();
    // }

// For checkout

if(isset($_POST['pickup_date'])) {
    date_default_timezone_set("Asia/Manila");
    $pickup_date = $_POST['pickup_date'];
    
    $sql = "SELECT order_ref_number, date_ordered, pickup_date, order_status
            FROM reservation
            WHERE user_id = $user_id";
    $result = query($conn, $sql);
    
    if(!empty($result)) {
        $ref_number = gen_order_ref_number(12);
        
        foreach($result as $key => $row) {
            
            $table = "reservation";
            $fields = array( 'order_ref_number' => $ref_number
                           , 'date_ordered' => date("Y-m-d H:i:s")
                           , 'pickup_date' => $pickup_date
                           , 'order_status' => 'P'
                           );
            $filter = array( 'order_status' => 'C' );
            
            update($conn, $table, $fields, $filter);
        }
        
        if(update($conn, $table, $fields, $filter)) {
            header("location: order_list.php?checkout=success");
            exit;
        } else {
            header("location: order_list.php?checkout=failed");
            exit;
        }
    }
}

//
//    $reservation_ids = array_keys($_SESSION['cart']);
//    $reservation_ids_str = implode(",", $reservation_ids);
//    foreach ($reservations as $reservation) {
//    $reservation_id = $reservation['reservation_id'];
//
//    $query = "SELECT * FROM `reservation` WHERE reservation_id = $reservation_id";
//    $result = mysqli_query($conn, $query);
//    $reservations = mysqli_fetch_all($result, MYSQLI_ASSOC);
//    }
//
//    $date_ordered = date('Y-m-d H:i:s');
//    $order_status = 'P';
//
//    $ref_number = gen_order_ref_number(12);
//    $table = "reservation";
//    $field = "order_ref_number";
//    while (is_existing($conn, $ref_number, $field, $table)) {
//        $ref_number = gen_order_ref_number(12);
//    }
//
//    foreach ($reservations as $reservation) {
//        $reservation_id = $reservation['reservation_id'];
//        $reservation_id = $reservation['reservation_id'];
//        $item_quantity = $reservation['item_quantity'];
//
//        $sql = "UPDATE reservation 
//                SET date_ordered = '$date_ordered', order_status = '$order_status', pickup_date = $pickup_date order_ref_number = '$ref_number' 
//                WHERE reservation_id = $reservation_id IN ($reservation_ids_str) 
//                AND order_status = 'P'";
//
//        mysqli_query($conn, $sql);
//    }  
//
//    header('Location: order_list.php');
//    exit;
?>

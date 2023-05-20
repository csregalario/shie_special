<?php
include_once "connection.php";

$loc = $_SESSION['location'];

if(isset($_GET['order_ref_num'])) {
    
    $ref_num = $_GET['order_ref_num'];
    $type = $_GET['user_type'];
    $status = $_GET['order_status'];
    $btn = $_GET['btn'];
    $subloc = $_GET['subloc'];

    $sql = "SELECT order_id, order_status
            FROM orders	
            WHERE order_ref_num = '$ref_num'
              AND order_status = '$status'
            GROUP BY order_id";
    $result = query($conn, $sql);
    
    $update = 0;
    switch ($status) {
        case 'C':
            switch ($btn) {
                case 'Cancel':
                    $status = 'C';
                    break;
                case 'Confirm':
                    $status = 'P';
                    break;
            }
            break;
        case 'P':
            switch ($btn) {
                case 'Cancel':
                    $status = 'X';
                    break;
                case 'Reject':
                    $status = 'X';
                    break;
                case 'Accept':
                    $status = 'B';
                    break;
            }
        case 'B':
            if($btn == 'Ship'){
                $status = 'S';
            }
            break;
        case 'S':
            if($btn == 'Delivered') {
                $status = 'D';
            }
            break;
    }
        
    
//    if(isset($_POST['Reject'])) {
//        $btn = $_POST['Reject'];
//        $order_status = 'X';
//    } else if(isset($_POST['Accept'])) {
//        $btn = $_POST['Accept'];
//        $order_status = 'B';
//    } else if(isset($_POST['Cancel'])) {
//        $btn = $_POST['Cancel'];
//        $order_status = 'X';
//    } else if(isset($_POST['Shipped'])) {
//        $btn = $_POST['Shipped'];
//        $order_status = 'S';
//    }
    
    if(!empty($result)) {
        $update = 0;
        foreach($result as $key => $row) {
            $table = "reservation";
            $fields = array( 'order_status' => $status
                           , 'last_update_ts' => date("Y-m-d H:i:s")
                           );
            $filter = array( 'reservation_id' => $row['reservation_id'] );

            if(update($conn, $table, $fields, $filter)) {
                $update++;
            }
        }
    }
    
    if($update != 0) { {
        header("location: " . $loc . "?order_" . $btn . "=success&" . $subloc);
        exit();
        }
    } else {
        header("location: " . $loc . "?order_" . $btn . "=failed&" . $subloc);
        exit();
    }
} else {
    header("location: " . $loc);
    exit;
}

?>

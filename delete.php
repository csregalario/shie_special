<?php 
include_once 'connection.php';

if(isset($_GET['reservation_id'])) {
    $reservation_id = $_GET['reservation_id'];
    $params = array($reservation_id);

    if (query($conn, "DELETE FROM reservation WHERE reservation_id = ?", $params) ){
        header("location: myCart.php?item_delete=success");
        exit();
    }
    else {
        header("location: myCart.php?item_delete=failed");
        exit();
    }
}
?>
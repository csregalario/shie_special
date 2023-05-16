<?php

include_once("connection.php");
if(isset($_GET['conf_ord'])){
    $ord_ref = mysqli_real_escape_string($conn, htmlentities($_GET['conf_ord']));

    $table="reservation";
    $fields=array("order_status" => 'C');
    $filter=array("order_ref_number" => $ord_ref);

    if(update($conn, $table, $fields , $filter )){
        header("location: index.php?confirm_pending_orders&status=confirmed");
    }
}

if(isset($_GET['pickup'])){
    $ord_ref = mysqli_real_escape_string($conn, htmlentities($_GET['pickup']));

    $table="reservation";
    $fields=array("order_status" => 'O');
    $filter=array("order_ref_number" => $ord_ref);

    if(update($conn, $table, $fields , $filter )){
        header("location: index.php?pickup&status=received");
    }
}

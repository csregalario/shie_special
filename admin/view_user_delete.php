<?php
include_once "connection.php";

if(isset($_GET['user_id'])){
    
//    if(query($conn, "DELETE FROM user WHERE user_id = ?", $params) ){
//        header("location: u_user_display.php?user_delete=done");
//        exit();
//    }
//    else{
//        header("location: u_user_display.php?user_delete=failed");
//        exit();
//    } 
    
    $table = "user";
    $d_user_id = $_GET['user_id'];
    $fields = array( 'user_status' => 'I' );
    $filter = array( 'user_id' => $d_user_id );
    
   if( update($conn, $table, $fields, $filter )){
       header("location: index.php?viewuser&update_status=deleted");
       exit();
   }
    else{
        header("location: index.php?viewuser&update_status=failed");
        exit();
    }
}
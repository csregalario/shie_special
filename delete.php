<?php
include_once "db_conn.php";

if(isset($_GET['user_id'])){
    
//    if(query($conn, "DELETE FROM users WHERE user_id = ?", $params) ){
//        header("location: index.php?user_delete=done");
//        exit();
//    }
//    else{
//        header("location: index.php?user_delete=failed");
//        exit();
//    } 
    
    $table = "users";
    $d_user_id = $_GET['user_id'];
    $fields = array( 'user_stats' => 'I' );
    $filter = array( 'user_id' => $d_user_id );
    
   if( update($conn, $table, $fields, $filter )){
       header("location: index.php?update_status=deleted");
       exit();
   }
    else{
        header("location: index.php?update_status=failed");
        exit();
    }
}
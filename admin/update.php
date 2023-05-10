<?php
include_once "../db.php";
if(isset($_POST['item_id'])){
// Get the form data
$item_id = mysqli_real_escape_string($conn, $_POST['item_id']);
$item_name = mysqli_real_escape_string($conn, $_POST['item_name']);
$item_cat = mysqli_real_escape_string($conn, $_POST['item_cat']);
$item_desc = mysqli_real_escape_string($conn, $_POST['item_desc']);
$item_price = mysqli_real_escape_string($conn, $_POST['item_price']);
    
    $start_eff_dt = $_POST['start_eff_dt'];
    $end_eff_dt = $_POST['end_eff_dt'];
$stock_qty = (int)$_POST['stock_qty'];
//$cur_stock_qty = htmlentities($_POST['cur_stock_qty']);

$isPriceAdjusted = false;
 
//   
// Upload the image file
//initialize variable
$upload_msg ="";
$item_filename="";
$target_file ="";
$target_dir = "../img/";
$uploadOk = 1;
$err_msg="";
$reason ="";
$mode=0;
    

       
if($start_eff_dt == "" || $end_eff_dt == ""){
    $isPriceAdjusted = false;
}
else{
    $isPriceAdjusted = true;    
}
//check if there is file to upload
if(isset($_FILES['item_image']) && $_FILES['item_image']['error'] != UPLOAD_ERR_NO_FILE ){
    $mode=1;  
    $item_filename = basename($_FILES["item_image"]["name"]);
    $target_file = $target_dir . $item_filename;
    $new_file_ind = 1;
    $uploadOk = 1;
    
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
    // Check if image file is a actual image or fake image

    $check = getimagesize($_FILES["item_image"]["tmp_name"]);
    if($check !== false) {
        //$upload_msg .= "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    }else {
        $upload_msg .= "File is not an image.<br>";
        $uploadOk = 0;
    }
    
        // Check file size
    if ($_FILES["item_image"]["size"] > 5000000) {
        $upload_msg .= "Sorry, your file is too large.<br>";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "webp" ) {
        $upload_msg .= "Sorry, only JPG, JPEG, PNG, webp & GIF files are allowed.<br>";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $upload_msg .= "Sorry, your file cannot be uploaded.<br>";
    } 
    else {
        //initialize variables
        $newbasename=$item_name . "." .$imageFileType;
        $newfilename=$target_dir . $newbasename;
         
        
        //check if upload is done.
            if (move_uploaded_file($_FILES["item_image"]["tmp_name"], $newfilename)) {
                $upload_msg .= "The Item Image has been updated.<br>";
                
                //initiate update parameters
                $table = "products";
                $fields =array("item_desc" => $item_desc,
                               "cat_id" => $item_cat,
                               "item_file" => $newbasename
                              );
                $filter =array("item_id" => $item_id);
                
                update($conn, $table, $fields, $filter);
                
                //pricing
                //initiate sql that checks for overlapping price effectivity.
                if($isPriceAdjusted){
                    $sql_check_overlap = "SELECT price_id 
                                        from pricing 
                                       WHERE item_id = $item_id 
                                         and (? between eff_start_dt and eff_end_dt
                                          or  ? between eff_start_dt and eff_end_dt)";
                     $price_overlap = query($conn,$sql_check_overlap, array($start_eff_dt, $end_eff_dt));
                //if there is a record.     
                     if(count($price_overlap) > 0){
                         $update_pricing = "UPDATE pricing
                                               SET item_price = ?
                                                 , eff_start_dt = ?
                                                 , eff_end_dt = ?
                                                 , last_update_ts = CURRENT_TIMESTAMP
                                             WHERE item_id = ? 
                                               AND (? between eff_start_dt and eff_end_dt
                                                OR  ? between eff_start_dt and eff_end_dt)";
                         query($conn, $update_pricing, array($item_price,$start_eff_dt,$end_eff_dt, $item_id, $start_eff_dt, $end_eff_dt));
                     }
                //if there is none.
                    else{
                         $table = "pricing";
                         $fields = array("item_id" => $item_id
                                        ,"item_price"=>$item_price
                                        ,"eff_start_dt"=>$start_eff_dt
                                        ,"eff_end_dt"=>$end_eff_dt);
                         insert($conn, $table, $fields);
                     }
                $err_msg .= "Pricing Adjusted for {$item_name} effective {$start_eff_dt} to {$end_eff_dt}.";
                }
                  
              /*Stock Qty*/
               if($stock_qty != 0){
                   if($stock_qty < 0){
                       $reason = "Admin made a stock reversal.";
                   }
                   else{
                       $reason = "Admin added a stock.";
                   }
                   $table = "stock";
                   $fields = array("item_id"=> $item_id ,
                                  "stock_qty" => $stock_qty ,
                                  "stock_reason" => $reason
                                 );
                   insert($conn, $table, $fields);
               }
            
         }
         else{
                 $upload_msg .= "The file ". htmlspecialchars( $item_filename). " was not uploaded. <br>";
            }   
    }
}
else {
$mode = 2;
    
                $table = "products";
                $fields =array("item_desc" => $item_desc,
                               "cat_id" => $item_cat
                              );
                $filter =array("item_id" => $item_id);
                
                update($conn, $table, $fields, $filter);
    
                if($isPriceAdjusted){
                    $sql_check_overlap = "SELECT price_id 
                                        from pricing 
                                       where item_id = $item_id 
                                         and (? between eff_start_dt and eff_end_dt
                                          or ? between eff_start_dt and eff_end_dt)
                                          LIMIT 1";
                    
                     $price_overlap = query($conn,$sql_check_overlap, array($start_eff_dt, $end_eff_dt));
                     if(count($price_overlap) > 0){
                         
                         $update_pricing = "UPDATE pricing 
                                               SET item_price = ?
                                                 , eff_start_dt = ?
                                                 , eff_end_dt = ?
                                                 , last_update_ts = CURRENT_TIMESTAMP
                                             WHERE item_id = ? 
                                               and (? between eff_start_dt and eff_end_dt 
                                               or ? between eff_start_dt and eff_end_dt) ";
                         query($conn, $update_pricing, array($item_price,$start_eff_dt,$end_eff_dt, $item_id, $start_eff_dt, $end_eff_dt));
                     }
                    else{
                         $table = "pricing";
                         $fields = array("item_id" => $item_id
                                        ,"item_price"=>$item_price
                                        ,"eff_start_dt"=>$start_eff_dt
                                        ,"eff_end_dt"=>$end_eff_dt);
                         insert($conn, $table, $fields);
                     }
                $err_msg .= "Pricing Adjusted for {$item_name} effective {$start_eff_dt} to {$end_eff_dt}. <br>";
                }
                    
                /*Stock Qty*/
               if($stock_qty != 0){
                   if($stock_qty < 0){
                       $reason = "Admin made a stock reversal.";
                   }
                   else{
                       $reason = "Admin added a stock.";
                   }
                   $table = "stock";
                   $fields = array("item_id" => $item_id
                                 , "stock_qty" => $stock_qty
                                 , "stock_reason" => $reason
                                );
                   insert($conn, $table, $fields);
                   $err_msg .= $reason;
               }
}
if( $err_msg != "" || $upload_msg != ""){
     $err_msg = $err_msg . "</br>" . $upload_msg;
}else{
    $err_msg = "No Updates Made for $item_name";
}

header("location: index.php?updateitem=$item_id&status=$err_msg&mode=$mode");
exit();
}


<?php
//check if there is file to upload
if(isset($_FILES['item_image']) && $_FILES['item_image']['error'] != UPLOAD_ERR_NO_FILE ){
    
    $item_filename = basename($_FILES["item_image"]["name"]);
    $target_file = $target_dir . $item_filename;
    $new_file_ind = 1;
    $uploadOk = 1;
    
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
    // Check if image file is a actual image or fake image

    $check = getimagesize($_FILES["item_image"]["tmp_name"]);
    if($check !== false) {
        $upload_msg .= "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    }else {
        $upload_msg .= "File is not an image.";
        $uploadOk = 0;
    }
    
        // Check file size
    if ($_FILES["item_image"]["size"] > 5000000) {
        $upload_msg .= "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        $upload_msg .= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $upload_msg .= "Sorry, your file cannot be uploaded.";
    } 
    else {
        //initialize variables
        $newbasename=$item_name . "." .$imageFileType;
        $newfilename=$target_dir . $newbasename;
         
        
        //check if upload is done.
            if (move_uploaded_file($_FILES["item_image"]["tmp_name"], $newfilename)) {
                $upload_msg .= "The file ". htmlspecialchars( $item_filename). " has been uploaded.";
                
                //initiate update parameters
                $table = "products";
                $fields =array("item_desc" => $item_desc,
                               "item_cat" => $item_cat,
                               "item_file" => $newbasename
                              );
                $filter =array("item_id" => $item_id);
                
                update($conn, $table, $fields, $filter);
                
                //pricing
                
                    $sql_check_overlap = "SELECT price_id 
                                        from pricing 
                                       WHERE item_id = $item_id 
                                         and ('$start_eff_dt' between eff_start_dt and eff_end_dt
                                          or  '$end_eff_dt' between eff_start_dt and eff_end_dt)";
                     $price_overlap = query($conn,$sql_check_overlap);
                     
                     if(count($price_overlap) > 0){
                         $update_pricing = "UPDATE pricing
                                               SET item_price = ?
                                                 , eff_start_dt = ?
                                                 , eff_end_dt = ?
                                             WHERE item_id = ? 
                                               and ('$start_eff_dt' between eff_start_dt and eff_end_dt
                                               or  '$end_eff_dt' between eff_start_dt and eff_end_dt)";
                         query($conn, $update_pricing, array($item_price,$start_eff_dt,$end_eff_dt, $item_id));
                     }
                    else{
                         $table = "pricing";
                         $fields = array("item_id" => $item_id
                                        ,"item_price"=>$item_price
                                        ,"eff_start_dt"=>$start_eff_dt
                                        ,"eff_end_dt"=>$end_eff_dt);
                         insert($conn, $table, $fields);
                     }
                //stock
                if($stock_qty > 0 || $stock_qty < 0){
                    
                    $table = "stock";
                    $fields = array("item_id"=> $item_id ,
                                   "stock_qty" => $stock_qty);
                    insert($conn, $table, $fields);
                }
            
        }
         else{
                 $upload_msg .= "The file ". htmlspecialchars( $item_filename). " was not uploaded.";
            }   
    }
}
else {
                $table = "products";
                $fields =array("item_desc" => $item_desc,
                               "item_cat" => $item_cat
                              );
                $filter =array("item_id" => $item_id);
                
                update($conn, $table, $fields, $filter);
                    $sql_check_overlap = "SELECT price_id 
                                        from pricing 
                                       where item_id = $item_id 
                                         and ('$start_eff_dt' between eff_start_dt and eff_end_dt
                                          or '$end_eff_dt' between eff_start_dt and eff_end_dt)";
                     $price_overlap = query($conn,$sql_check_overlap);
                     
                     if(count($price_overlap) > 0){
                         $update_pricing = "UPDATE pricing 
                                               SET item_price = ?
                                                 , eff_start_dt = ?
                                                 , eff_end_dt = ?
                                             WHERE item_id = ? 
                                               and ('$start_eff_dt' between eff_start_dt and eff_end_dt 
                                               or '$end_eff_dt' between eff_start_dt and eff_end_dt)";
                         query($conn, $update_pricing, array($item_price,$start_eff_dt,$end_eff_dt, $item_id));
                     }
                    else{
                         $table = "pricing";
                         $fields = array("item_id" => $item_id
                                        ,"item_price"=>$item_price
                                        ,"eff_start_dt"=>$start_eff_dt
                                        ,"eff_end_dt"=>$end_eff_dt );
                         insert($conn, $table, $fields);
                     }
                
                
                if($stock_qty > 0 || $stock_qty < 0){
                    
                    $table = "stock";
                    fields = array("item_id"=> $item_id ,
                                   "stock_qty" => $stock_qty);
                    insert($conn, $table, $fields);
                }
}

exit();
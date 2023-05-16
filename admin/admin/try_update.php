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
                $table = "item";
                $fields =array("item_desc" => $item_desc,
                               "item_file" => $newbasename
                              );
                $filter =array("item_id" => $item_id);
                
                update($conn, $table, $fields, $filter);
                
                //price
                
                    $sql_check_overlap = "SELECT price_id 
                                        from price 
                                       WHERE item_id = $item_id 
                                         and ('$start_date' between start_date and end_date
                                          or  '$end_date' between start_date and end_date)";
                     $price_overlap = query($conn,$sql_check_overlap);
                     
                     if(count($price_overlap) > 0){
                         $update_price = "UPDATE price
                                               SET item_price = ?
                                                 , start_date= ?
                                                 , end_date= ?
                                             WHERE item_id = ? 
                                               and ('$start_date' between start_date and end_date
                                          or  '$end_date' between start_date and end_date)";
                         query($conn, $update_price, array($item_price,$start_date,$end_date, $item_id));
                     }
                    else{
                         $table = "price";
                         $fields = array("item_id" => $item_id
                                        ,"item_price"=>$item_price
                                        ,"start_date"=>$start_date
                                        ,"end_date"=>$end_date);
                         insert($conn, $table, $fields);
                     }
               
        }
<?php
include_once "connection.php";
    if(isset($_POST['item_id'])){
        // Get the form data
        $item_name = mysqli_real_escape_string($conn, $_POST['item_name']);
        $item_price = mysqli_real_escape_string($conn, $_POST['item_price']);
            
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];

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
    
    if($start_date == "" || $end_date == ""){
        $isPriceAdjusted = false;
    }
    else{
        $isPriceAdjusted = true;    
    }
    //check if there is file to upload
    if(isset($_FILES['item_file']) && $_FILES['item_file']['error'] != UPLOAD_ERR_NO_FILE ){
        $mode=1;  
        $item_filename = basename($_FILES["item_file"]["name"]);
        $target_file = $target_dir . $item_filename;
        $new_file_ind = 1;
        $uploadOk = 1;
        
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    }
    
    // Check if image file is a actual image or fake image

    $check = getimagesize($_FILES["item_file"]["tmp_name"]);
    if($check !== false) {
        //$upload_msg .= "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    }else {
        $upload_msg .= "File is not an image.<br>";
        $uploadOk = 0;
    }
    
        // Check file size
    if ($_FILES["item_file"]["size"] > 5000000) {
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
    }    
        
        //check if upload is done.
            if (move_uploaded_file($_FILES["item_file"]["tmp_name"], $newfilename)) {
                $upload_msg .= "The Item Image has been updated.<br>";
                
                //initiate update parameters
                $table = "item";
                $fields =array("item_name" => $item_name,
                               "item_file" => $newbasename
                              );
                $filter =array("item_id" => $item_id);
                
                update($conn, $table, $fields, $filter);
                
                //pricing
                //initiate sql that checks for overlapping price effectivity.
                if($isPriceAdjusted){
                    $sql_check_overlap = "SELECT price_id 
                                        from price
                                       WHERE item_id = $item_id 
                                         and (? between start_date and end_date
                                          or  ? between start_date and end_date)";
                     $price_overlap = query($conn,$sql_check_overlap, array($start_date, $end_date));
                //if there is a record.     
                     if(count($price_overlap) > 0){
                         $update_price = "UPDATE price SET 
                                            ,   item_price = ?
                                            ,   start_date = ?
                                            ,   end_date = ?
                                            ,  last_update_ts = CURRENT_TIMESTAMP
                         WHERE item_id = ? AND (CURRENT_DATE between start_date and end_date OR CURRENT_DATE between start_date and end_date);";
                         
                         query($conn, $update_price, array($item_price,$start_date,$eff_date, $item_id, $start_date, $end_date));
                     }
                //if there is none.
                    else{
                         $table = "price";
                         $fields = array("item_id" => $item_id
                                        ,"item_price"=>$item_price
                                        ,"start_date"=>$start_date
                                        ,"end_date"=>$eff_date);
                         insert($conn, $table, $fields);
                     }
                    $err_msg .= "Price Adjusted for {$item_name} effective {$start_date} to {$eff_date}.";
                }
            }
            else{

            $mode = 2;
    
                $table = "item";
                $fields =array("item_desc" => $item_desc,
                               "cat_id" => $item_cat
                              );
                $filter =array("item_id" => $item_id);
                
                update($conn, $table, $fields, $filter);
    
                if($isPriceAdjusted){
                    $sql_check_overlap = "SELECT price_id 
                                        from price
                                       where item_id = $item_id 
                                         and (? between start_date and end_date
                                          or ? between start_date and end_date)
                                          LIMIT 1";
                    
                     $price_overlap = query($conn,$sql_check_overlap, array($start_date, $end_date));
                     if(count($price_overlap) > 0){
                         
                         $update_pricing = "UPDATE price SET 
                                                ,   item_price = ?
                                                ,   start_date = ?
                                                ,   end_date = ?
                                                ,  last_update_ts = CURRENT_TIMESTAMP
                            WHERE item_id = ? AND (CURRENT_DATE between start_date and end_date OR CURRENT_DATE between start_date and end_date);";
                            
                         query($conn, $update_price, array($item_price,$start_date,$end_date, $item_id, $start_date, $end_date));
                     }
                    else{
                         $table = "pricing";
                         $fields = array("item_id" => $item_id
                                        ,"item_price"=>$item_price
                                        ,"start_date"=>$start_date
                                        ,"end_date"=>$end_date);
                         insert($conn, $table, $fields);
                     }
                        $err_msg .= "Pricing Adjusted for {$item_name} effective {$start_date} to {$end_date}. <br>";
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

<?php
include_once "../db.php";

// Get the form data

$item_name = mysqli_real_escape_string($conn, $_POST['item_name']);
$item_cat = mysqli_real_escape_string($conn, $_POST['item_cat']);
$item_desc = mysqli_real_escape_string($conn, $_POST['item_desc']);
$item_price = mysqli_real_escape_string($conn, $_POST['item_price']);
$start_eff_dt = mysqli_real_escape_string($conn, $_POST['start_eff_dt']);
$end_eff_dt = mysqli_real_escape_string($conn, $_POST['end_eff_dt']);
$stock_qty = mysqli_real_escape_string($conn, $_POST['stock_qty']);

// Upload the image file
$upload_msg ="";
$item_filename="";
$target_file ="";
$target_dir = "../img/";
$uploadOk = 1;
$err_msg="";

//check first the file if there is to upload.
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
        $upload_msg .= "Sorry, your file was not uploaded.";
    } 
    else {
        
        $newbasename=$item_name . "." .$imageFileType;
        $newfilename=$target_dir . $newbasename;
         
        
        // Check if the item already exists in the product table
        if (is_existing($conn, htmlspecialchars($item_name), 'item_name', 'products')) { 
              $err_msg .= "Item already existing.";
        }
        else{
        
            if (move_uploaded_file($_FILES["item_image"]["tmp_name"], $newfilename)) {
                $upload_msg .= "The file ". htmlspecialchars( $item_filename). " has been uploaded.";
                    
                $prod_query = "INSERT INTO products (item_name, item_desc, cat_id, item_file) VALUES ('$item_name', '$item_desc', '$item_cat', '$newbasename')";
                if(mysqli_query($conn, $prod_query)){
                 
                    $item_id = mysqli_insert_id($conn);
                    //check pricing overlap
//                    $sql_check_overlap = "SELECT price_id 
//                                from pricing 
//                               where item_id = $item_id 
//                                 and ('$start_eff_dt' between eff_start_dt and eff_end_dt) 
//                                  or ('$end_eff_dt' between eff_start_dt and eff_end_dt)";
             
                    // Insert the new item's pricing information in the pricing table
                    $pricing_query = "INSERT INTO pricing (item_id, item_price, eff_start_dt, eff_end_dt) VALUES ('$item_id', '$item_price', '$start_eff_dt', '$end_eff_dt')";
                    if( !mysqli_query($conn, $pricing_query) ) {
                        query($conn,"delete from products where item_id = $item_id");
                        $err_msg = "Error inserting into Pricing table." . mysqli_error($conn);
                    }
                    
                    else {
                         $stock_query = "INSERT INTO stock (item_id, stock_qty) VALUES ('$item_id', '$stock_qty')";
                         if(!mysqli_query($conn, $stock_query)){
                              $del = query($conn,"delete from pricing where item_id = $item_id");
                              $del2 = query($conn,"delete from products where item_id = $item_id");
                         }else{
                             query($conn, "update pricing set item_price_status = NULL where item_id = $item_id ");
                             query($conn, "update pricing set item_price_status = 'A' where item_id = $item_id and CURRENT_DATE between eff_start_dt and eff_end_dt");
                         }
                    }
   
                }
                else{
                    $err_msg .= "Unable to add this to the database.";
                }
            }
            else{
                 $upload_msg .= "The file ". htmlspecialchars( $item_filename). " was not uploaded.";
            }

            
        }
        
    }
    
    
}
else {
    $err_msg .= "Please provide an image for this new item.";
}

$err_msg = $err_msg . ". " . $upload_msg;

header("location: index.php?additem&status=$err_msg");
exit();

//
//// Check if the item already exists in the product table
//if (is_existing($conn, $item_id, 'item_id', 'products')) {
//        
//    
////    if (move_uploaded_file($_FILES["item_image"]["tmp_name"], $newfilename)) {
////        $upload_msg .= "The file ". htmlspecialchars( $item_filename). " has been uploaded.";
////        
////        // Update the existing item's information in the products table
////        $query = "UPDATE products SET item_name = '$item_name', item_desc = '$item_desc', cat_id = '$item_cat', item_file = '$newbasename' WHERE item_id = '$item_id'";
////        mysqli_query($conn, $query);
////
////        // Update the existing item's price in the pricing table
////        $query = "UPDATE pricing
////                    SET item_price = '$item_price', start_eff_dt = '$start_eff_dt', end_eff_dt = '$end_eff_dt', stock_qty = '$stock_qty'
////                    WHERE item_id = '$item_id'";
////        mysqli_query($conn, $query);
////            header("location: ../index.php?status=success&msg=Item updated successfully.");
////    exit();
////    
////} else {
////    $upload_msg .= "Sorry, there was an error uploading your file.";
////}
//} else {
//    // Insert the new item's information in the products table
//$query = "INSERT INTO products (item_name, item_desc, cat_id, item_file) VALUES ('$item_name', '$item_desc', '$item_cat', '$newbasename')";
//mysqli_query($conn, $query);
//
//$item_id = mysqli_insert_id($conn);
//
//// Insert the new item's pricing information in the pricing table
//$query = "INSERT INTO pricing (item_id, item_price, start_eff_dt, end_eff_dt, stock_qty) VALUES ('$item_id', '$item_price', '$start_eff_dt', '$end_eff_dt', '$stock_qty')";
//mysqli_query($conn, $query);
//
//if ($new_file_ind == 1 && move_uploaded_file($_FILES["item_image"]["tmp_name"], $newfilename)) {
//    $upload_msg .= "The file ". htmlspecialchars( $item_filename). " has been uploaded.";
//} 
//
//header("location: ../index.php?status=success&msg=Item added successfully.");
//exit();
//}
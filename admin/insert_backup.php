<?php
include_once "../db.php";

// Get the form data
if(isset($_POST['item_id'])){
   $item_id = mysqli_real_escape_string($conn, $_POST['item_id']);   
}
else {
    $item_id = 0;
}

$item_name = mysqli_real_escape_string($conn, $_POST['item_name']);
$item_cat = mysqli_real_escape_string($conn, $_POST['item_cat']);
$item_desc = mysqli_real_escape_string($conn, $_POST['item_desc']);
$item_price = mysqli_real_escape_string($conn, $_POST['item_price']);
$stock_qty = mysqli_real_escape_string($conn, $_POST['stock_qty']);

    // Upload the image file
$upload_msg ="";
$item_filename="";
$target_file ="";
$target_dir = "../img/";

if(isset($_FILES['item_image'])){
    
    $item_filename = basename($_FILES["item_image"]["name"]);
    $target_file = $target_dir . $item_filename;
    $new_file_ind = 1;
    
}
else {
    $new_file_ind = 0;
}
 $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["item_image"]["tmp_name"]);
        if($check !== false) {
            $upload_msg .= "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
            echo 1;
        } else {
            $upload_msg .= "File is not an image.";
            $uploadOk = 0;
            echo 2;
        }
        
    }
    // Check if file already exists
    // if (file_exists($target_file)) {
    // echo "Sorry, file already exists.";
    // $uploadOk = 0;
    // }
    
    // Check file size
    if ($_FILES["item_image"]["size"] > 5000000) {
    $upload_msg .= "Sorry, your file is too large.";
    $uploadOk = 0;
        echo 3;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        $upload_msg .= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
        echo 4;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $upload_msg .= "Sorry, your file was not uploaded.";
        echo 5;
        // if everything is ok, try to upload file
    } 


        $newbasename=$item_name . $item_id . "." .$imageFileType;
        $newfilename=$target_dir . $newbasename;



// Check if the item already exists in the product table
if (is_existing($conn, $item_name, 'item_name', 'products')) {
    
    // Get the item_id of the existing item
    $query = "SELECT item_id FROM products WHERE item_name = '$item_name' or item_id = '$item_id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $item_id = $row['item_id'];
    
    if (move_uploaded_file($_FILES["item_image"]["tmp_name"], $newfilename)) {
        echo 'x';
        // Update the existing item's information in the products table
        $query = "UPDATE products SET item_desc = '$item_desc', cat_id = '$item_cat', item_file = '$newbasename' WHERE item_id = '$item_id'";
        mysqli_query($conn, $query);

        // Update the existing item's price in the pricing table
        $query = "UPDATE pricing SET item_price = '$item_price' WHERE item_id = '$item_id'";
        mysqli_query($conn, $query);

        // Update the existing item's stock quantity in the stock table
        $query = "INSERT INTO stock (`item_id`,`stock_qty`) VALUES ('$item_id','$stock_qty')";
        mysqli_query($conn, $query);
        
        header("Location: index.php?viewitem=2&msg=$upload_msg");
                exit();
    }
} 
else 
{
   
//        if (move_uploaded_file($_FILES["item_image"]["tmp_name"], $target_file)) {
        if (move_uploaded_file($_FILES["item_image"]["tmp_name"], $newfilename)) {
            $upload_msg .= "The file ". htmlspecialchars( $item_filename). " has been uploaded.";
            //insert into database:
               // After uploading the image, insert the new item and related tables data into the database:
                if (!empty($item_name) && !empty($item_desc) && !empty($item_price) && !empty($stock_qty)) {
                    // Insert the new item's information into the products table
                    $query = "INSERT INTO products (item_name, item_desc,cat_id, item_file) VALUES ('$item_name', '$item_desc','$item_cat', '$newbasename')";
                    mysqli_query($conn, $query);

                // Get the item_id of the newly inserted item
                $item_id = mysqli_insert_id($conn);

                // Insert the new item's price into the pricing table
                $query = "INSERT INTO pricing (item_id, item_price) VALUES ('$item_id', '$item_price')";
                mysqli_query($conn, $query);

                // Insert the new item's stock quantity into the stock table
                $query = "INSERT INTO stock (item_id, stock_qty) VALUES ('$item_id', '$stock_qty')";
                mysqli_query($conn, $query);

                // Redirect the user to the product list page
                header("Location: index.php?viewitem&msg=$upload_msg");
                exit();
                } else {
                    // Display an error message if any required field is empty
                    echo "Error: Please fill all the required fields.";
                }
        } 
        else {
            $upload_msg .= "Sorry, there was an error uploading your file.";
        }
    

}

 
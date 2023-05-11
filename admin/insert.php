<?php

include "connection.php";

// Get form data
$item_name = mysqli_real_escape_string($conn, $_POST['item_name']);
$cat_id = mysqli_real_escape_string($conn, $_POST['cat_id']);
$item_desc = mysqli_real_escape_string($conn, $_POST['item_desc']);
$item_image = $_FILES['item_image']['name'];
$item_price = '';

// Check if item image is uploaded
if(isset($_FILES['item_image']) && $_FILES['item_image']['error'] === 0) {
  $item_image = mysqli_real_escape_string($conn, $item_image);

  // Upload item image to server
  move_uploaded_file($_FILES['item_image']['tmp_name'], "uploads/$item_image");
}

// Insert item data into item table
$sql = "INSERT INTO item (item_name, cat_id, item_desc, item_image, item_price) VALUES ('$item_name', '$cat_id', '$item_desc', '$item_image', '$item_price')";

if(mysqli_query($conn, $sql)) {
  $status = "Item added successfully!";
} else {
  $status = "Error adding item: " . mysqli_error($conn);
}

mysqli_close($conn);

header("Location: add_item.php?status=$status");
exit();

?>
// Check if image file is a actual image or fake image
if(isset($_FILES["item_file"])) {
    $check = getimagesize($_FILES["item_file"]["tmp_name"]);
    if($check !== false) {
        $upload_msg .= "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        $upload_msg .= "File is not an image.";
        $uploadOk = 0;
    }
} else {
    $upload_msg .= "Please provide an image for this new item.";
    $uploadOk = 0;
}
    
// Check file size
if ($_FILES["item_file"]["size"] > 5000000) {
    $upload_msg .= "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats
$imageFileType = strtolower(pathinfo($_FILES["item_file"]["name"], PATHINFO_EXTENSION));
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
    $upload_msg .= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $upload_msg .= "Sorry, your file was not uploaded.";
} else {
    $newbasename = $item_name . "." . $imageFileType;
    $newfilename = $target_dir . $newbasename;
         
    // Check if the item already exists in the item table
    if (is_existing($conn, htmlspecialchars($item_name), 'item_name', 'item')) { 
        $err_msg .= "Item already exists.";
    } else {
        if (move_uploaded_file($_FILES["item_file"]["tmp_name"], $newfilename)) {
            $upload_msg .= "The file " . htmlspecialchars($item_filename) . " has been uploaded.";
                    
            $item_query = "INSERT INTO item (item_name, item_desc, cat_id, item_file) VALUES ('$item_name', '$item_desc', '$cat_id', '$newbasename')";
            if(mysqli_query($conn, $item_query)) {
                $item_id = mysqli_insert_id($conn);
                
                // Insert the new item's pricing information in the pricing table
                $pricing_query = "INSERT INTO price (item_id, item_price) VALUES ('$item_id', '$item_price')";
                if(!mysqli_query($conn, $pricing_query)) {
                    query($conn, "delete from item where item_id = $item_id");
                    $err_msg = "Error inserting into Price table." . mysqli_error($conn);
                } else {
                    $upload_msg .= " Item added successfully.";
                }
            } else {
                $err_msg .= "Unable to add this to the database.";
            }
        } else {
             $upload_msg .= "The file " . htmlspecialchars($item_filename) . " was not uploaded.";
        }
    }
}
$err_msg = $err_msg . ". " . $upload_msg;
header("location: index.php?additem&status=$err_msg");
exit();

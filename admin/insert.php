<?php

include_once "connection.php";

// Get the form data
    $item_name = mysqli_real_escape_string($conn, $_POST['item_name']);
    $item_price = mysqli_real_escape_string($conn, $_POST['item_price']);

// Check if the item already exists in the item table
if (is_existing($conn, $item_name, 'item_name', 'item')) {
    
    // Get the item_id of the existing item
    $query = "SELECT item_id FROM item WHERE item_name='$item_name'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $item_id = $row['item_id'];

    // Update the existing item's information in the item table
        $query = "UPDATE item
                    JOIN price ON item.item_id = price.item_id
                    SET item.item_name = 'item_name', price.item_price = 'item_price'
                    WHERE item.item_id = 'item_id'";
        mysqli_query($conn, $query);

} else {
    // Check if the item_file key exists in the $_FILES array
    if (isset($_FILES["item_file"])) {
        // Upload the image file
        $target_dir = "../img/";
        $target_file = $target_dir . basename($_FILES["item_file"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["item_file"]["tmp_name"]);
            if($check !== false) {
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }
        // Check if file already exists
        // if (is_existing($target_file)) {
        //     echo "Sorry, file already exists.";
        //     $uploadOk = 0;
        // }

        // Check file size
        if ($_FILES["item_file"]["size"] > 50000000) { // 50mb image size
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["item_file"]["tmp_name"], $target_file)) {
                $upload_msg .= "";
                // Insert the new item and related tables data into the database
            if (!empty($item_name) && !empty($item_price)) {
                // Insert the new item's information into the item table
                $query = "INSERT INTO item (item_name, item_file) VALUES ('$item_name', '$target_file')";
                mysqli_query($conn, $query);
                
                // Get the item_id of the newly inserted item
                $item_id = mysqli_insert_id($conn);

                // Insert the item price into the price table
                $query = "INSERT INTO price (item_id, item_price)
                        SELECT $item_id, '$item_price'
                        FROM item
                        WHERE item_id = $item_id";
                mysqli_query($conn, $query);

                // Redirect the user to the product list page
                header("Location: index.php");
                exit();
            } else {
                    // Display an error message if any required field is empty
                    $upload_msg .= "Please fill in all required fields.";
                }
            } 
            else {
                // Display an error message if the file was not moved successfully
                $upload_msg .= "Sorry, there was an error uploading your file.";
            }
            }
        }
        }

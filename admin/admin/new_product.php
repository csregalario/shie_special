<?php
include_once "db_conn.php";

//checks if value of name="new_item_name" is set and if file is uploaded successfully
if(isset($_POST['new_item_name']) && $_FILES['new_item_image']['error'] == '0') {

    //transfers value of name="" from form to variable
    $n_itemname = $_POST['new_item_name']; //itemname
    $n_itemcat = $_POST['new_item_cat'];
    $n_itemprice = $_POST['new_item_price'];

    $file = $_FILES['new_item_image']['name']; //basename.ext
    $fileext = pathinfo($file, PATHINFO_EXTENSION); //ext

    $temp = $_FILES['new_item_image']['tmp_name']; //temporary location
    $n_itemimgdir = "products/" . $n_itemname . "." . $fileext; ///target location

    //preparing arguments for insert()
    $table = "items";
    $fields = array ('item_name' => $n_itemname
                    ,'category_id' => $n_itemcat
                    ,'item_price' => $n_itemprice
                    ,'item_imgdir' => $n_itemimgdir
                    );

    //retrieves info from db
    $sql = "SELECT `item_name`, `category_id`, `item_price`, `item_imgdir` FROM `items` WHERE `item_name` = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $n_itemname);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    //if file is successfully moved to target loc:
    if(move_uploaded_file($temp, $n_itemimgdir)) {
        //if $result is empty, the param $n_itemname does not exist in db
        if(mysqli_num_rows($result) > 0) {
            header("location: product_index.php?new_product=failed");
            exit();
        }
        //inserts arguments to db
        else {
            if(insert($conn, $table, $fields)) {
                header("location: product_index.php?new_product=success");
                exit();
            } else {
                header("location: landing_page.php?new_product=failed");
                exit();
            }
        }
    }
    mysqli_free_result($result);        
}
?>

<?php
include_once "connection.php";

// Function to update the user information in the database
function update($conn, $table, $fields, $filter) {
    // Construct the update query based on the provided table, fields, and filter
    $updateQuery = "UPDATE $table SET ";
    $updateFields = array();
    foreach ($fields as $field => $value) {
        $updateFields[] = "$field = '$value'";
    }
    $updateQuery .= implode(", ", $updateFields);
    $updateQuery .= " WHERE ";
    $updateFilters = array();
    foreach ($filter as $filterField => $filterValue) {
        $updateFilters[] = "$filterField = '$filterValue'";
    }
    $updateQuery .= implode(" AND ", $updateFilters);

    // Execute the update query
    $result = mysqli_query($conn, $updateQuery);

    // Return true if the update was successful, false otherwise
    return $result;
}

if (isset($_POST['user_id'])) {
    $table = "user";

    $p_user_id = $_POST['user_id'];
    $p_fname = $_POST['fname'];
    $p_lname = $_POST['lname'];
    $p_password = $_POST['password'];
    $p_address = $_POST['address'];
    $p_contact = $_POST['contact_num'];

    $fields = array(
        'fname' => $p_fname,
        'lname' => $p_lname,
        'password' => $p_password,
        'address' => $p_address,
        'contact_number' => $p_contact
    );
    $filter = array('user_id' => $p_user_id);

    if (update($conn, $table, $fields, $filter)) {
        header("location: index.php?viewuser&update_status=success");
        exit();
    } else {
        header("location: index.php?viewuser&update_status=failed");
        exit();
    }
}
?>

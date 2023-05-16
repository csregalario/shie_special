<?php
include_once "connection.php";

session_start();

//checks if value of name="email_add" is set
if(isset($_POST['email_add'])) {

    //transfers value of name="" from form to variable
    //$r_username = $_POST['reg_username'];
    $email_add = $_POST['email_add'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $password = $_POST['password'];
    $contact_num = $_POST['contact_num'];
    $address = $_POST['address'];

    //hashes value of name="password" from form then transfered to variable
    //$r_pwdhash = password_hash($_POST['password'], PASSWORD_ARGON2ID);

    $_SESSION["email_add"] = $email_add;
    $_SESSION["password"] = $_POST['password'];
    
    //preparing arguments for insert()
    // check if the user already exists
    $sql = "SELECT * FROM user WHERE email_add = '$email_add'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // the user already exists, so do not insert a new record
        $msg="User already exists.";
    } else {
        // insert the new user record into the users table
        $sql = "INSERT INTO user (email_add, password, fname, lname, contact_num, address) VALUES ('$email_add', '$password' ,'$fname', '$lname', '$contact_num', '$address')";
        if (mysqli_query($conn, $sql)) {
            $msg="New user record inserted successfully.";
        } else {
            $msg="Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    header("location:home2.php?register&msg=$msg");
}

// close the database connection
mysqli_close($conn);

//$privateKey 	= 'AA74CDCC2BBRT935136HH7B63C27'; // user define key
//$secretKey 	= '5fgf5HJ5g27'; // user define secret key
//$encryptMethod  = "AES-256-CBC";
//$stringEncrypt  = '3423432423'; // user encrypt value
//$key    = hash('sha256', $privateKey);
//$ivalue = substr(hash('sha256', $secretKey), 0, 16); // sha256 is hash_hmac_algo
//echo $output = openssl_decrypt(base64_decode($stringEncrypt), $encryptMethod, $key, 0, $ivalue);
//// output is a decrypted value
?>

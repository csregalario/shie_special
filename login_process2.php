<?php
include_once "connection.php";

// Create database connection
// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  
  // Get the POST variables
  $email = $_POST['email'];
  $pass = $_POST['pass'];
    
  // Prepare SQL statement to retrieve user information from the database
  $sql = "SELECT *
            FROM user WHERE email_add ='$email'
           AND user_stats = 'A'
           GROUP BY email_add";
  $chk_user = query($conn, $sql);

  if(count($chk_user) < 1) {
    header("location:home1.php?email_add_invalid");
  } else {
  if(count($chk_user) == 1) {
    //fetch user information from the result set
    $row = $chk_user[0];

    $_SESSION['user_id'] = $row['user_id'];
    if($row['user_type'] == 'A') {
        //Admin user
        if($row ['password'] === $pass) {
            //Store user ID and user type in session variables
            $_SESSION['user'] = array(
                //"username" => $row['username'],
                "user_id" => $row['user_id'],
                "fname" => $row['fname'],
                "lname" => $row['lname'],
                "user_type" => $row['user_type'],
                "address" => $row['address'],
                "email_add" => $row['email_add'],
                "contact_num" => $row['contact_num'],
                "user_stats" => $row['user_stats']
            );
            header("Location: admin/index.php?Welcome_Admin_{$_SESSION['user']['lname']}");
            exit();
    } else {
        header("location: index.php?wrong_password");
        exit();
    }
  } else { // if($row['user_type'] == 'C') {
    //Client user
    if($row ['password'] === $pass) {
      $user_id = $row['user_id'];
      $user_type = $row['user_type'];
        //Store user ID and user type in session variables
        $_SESSION['user'] = array(
            //"username" => $row['username'],
            "user_id" => $row['user_id'],
            "fname" => $row['fname'],
            "lname" => $row['lname'],
            "user_type" => $row['user_type'],
            "address" => $row['address'],
            "email_add" => $row['email_add'],
            "contact_num" => $row['contact_num'],
            "user_stats" => $row['user_stats']
        );
        //Redirect to appropriate page depending on user type

        if ($_SESSION['user']['user_type'] == 'C') {
        header("location: home2.php");
      }
    } 
    else {
        header("location: home1.php?wrong_password");
      }
    }
  }
   else if($chk_user > 1){
    header("location: home1.php?duplicate_user_found");
   }
else {
    header("location: home1.php?no_user_found");
    }
  }
}
mysqli_close($conn);

?>

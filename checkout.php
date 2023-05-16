<?php

//Interface for the checkout
include_once 'connection.php';

//If the user is logged in, store their user id in the session

$user_id = $_SESSION['user_id'];
$_SESSION['location'] = "checkout.php";
$loc = $_SESSION['location'];

if (isset($_SESSION['user_id'])) {
//retrieve  user information from the database
$user_id = $_SESSION['user_id'];
$query = "SELECT fname, lname, address, contact_num FROM user WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
    //If the user found, fill the form fields with user data
    $row = mysqli_fetch_assoc($result);
    $fname = $row['fname'];
    $lname = $row['lname'];
    $address = $row['address'];
    $contact_num = $row['contact_num'];

} else {
    //User not found
    echo "User not found.";
}
}


// //If the user submitted a form to add an item to the cart
// if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cat_id']) && isset($_POST['item_qty'])) {
//     //get the item id and quantity from the form
//     $cat_id = filter_input(INPUT_POST, 'cat_id', FILTER_SANITIZE_NUMBER_INT);
//     $item_qty = filter_input(INPUT_POST, 'item_qty', FILTER_SANITIZE_NUMBER_INT);

//     //Validate the item id and quantity
//     if (!is_numeric($cat_id) || !is_numeric($item_qty)) {
//         //redirect the user bact to the order display page with an error message
//         header('Location: menuPage.php?error=invalid_input');
//         exit;
//     }
//     //if the item is already in the cart, update its quantity
//     if (isset($_SESSION['cart'][$user_id][$cat_id])) {
//         $_SESSION['cart'][$user_id][$cat_id] += $item_qty;
//     } else {
//         //otherwise, add the item to the cart with the specified quantity
//         $_SESSION['cart'][$user_id][$cat_id] = $item_qty;
//     }
//     //redirect the user back to the order display page
//     header('Location: menuPage.php');
//     exit;
// }
// //if the user wants to remove an item from the cart
// if (isset($_GET['remove'])) {
//     //get the item id to remove
//     $cat_id = filter_input(INPUT_GET, 'remove', FILTER_SANITIZE_NUMBER_INT);

//     //validate the item id  
//     if (!is_numeric($cat_id)) {
//         //redirect the user back to the cart page with an error message
//         header('Location: menuPage.php?error=invalid_input');
//         exit;
//     }

//     //remove the item from the cart
//     unset($_SESSION['cart'][$user_id][$cat_id]);

//     //redirect the user back to the cart page
//     header('Location: checkout.php');
//     exit;
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>Checkout</title>
<style>
  *{
        padding: 0;
        margin: 0;
        font-family: 'helvetica', sans-serif;
      }
    body{
    overflow: auto;
    }
    .bg-image{
    background-repeat: no-repeat;
    background-size: cover;
    position: relative;
    min-height: 100vh;
    width: 100%;
    }
    .navbar-toggler {
    border: 0;
    }
    .navbar-toggler:focus,
    .navbar-toggler:active,
    .navbar-toggler-icon:focus{
    outline: none;
    box-shadow: none;
    border: 0;
    }
    .toggler-icon{
    width: 30px;
    height: 3px;
    background-color: white!important;
    display: block;
    transition: all 0.4s;
    }
    .middle-bar{
    margin: 5px auto;
    }
    .navbar-toggler .top-bar{
    transform: rotate(45deg);
    transform-origin: 10% 10%;
    }
    .navbar-toggler .middle-bar{
    opacity: 0;
    filter: alpha(opacity=0);
    }
    .navbar-toggler .bottom-bar{
    transform: rotate(-45deg);
    transform-origin: 10% 10%;
    }
    .navbar-toggler.collapsed .top-bar{
    transform: rotate(0);
    }
    .navbar-toggler.collapsed .middle-bar{
    opacity: 1;
    filter: alpha(opacity=100);
    }
    .navbar-toggler.collapsed .bottom-bar{
    transform: rotate(0);
    }
    .navbar-toggler.collapsed .toggler-icon{
    background-color: black!important;
    }
    .navbar .navbar-nav .nav-item{
    padding: 10px 20px;
    }
    .navbar .navbar-nav .nav-item .nav-link{
    color: white!important;
    font-size: 20px;
    letter-spacing: 5px;
    font-weight: 400;
    }
    .navbar .navbar-nav .nav-item .nav-link:hover{
    color: black!important;
    font-weight: bolder;
    transition: .4s;
    }
  </style>

</head>
<body>
  <div class="bg-image"
  style="background-image: url('dk.jpg');">
  <nav class="navbar navbar-expand-lg bg-warning bg-opacity-75">
    <div class="container-fluid">
      <img src="logo.png" alt="Logo"class="navbar-brand" height="90" width="90">
      <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="toggler-icon top-bar" ></span>
        <span class="toggler-icon middle-bar" ></span>
        <span class="toggler-icon bottom-bar" ></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-center position-relative">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="home2.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="menuPage.php">Menu</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.php">About Us</a>
          </li>
        </ul>
        <ul class="nav navbar-nav navbar-right text-center">
          <li class="nav-item">
            <a class="nav-link" href="myCart.php">My cart</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="modal" data-bs-target="#logoutModal">Logout</a>
          </li>
        </ul>
      </div>
    </div>
   <!-- Modal -->
   <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="logout">
                    Are you sure you want to log out?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <a href="logout_process.php" class="btn btn-warning">Log out</a>
                </div>
            </div>
        </div>
    </div>
  </nav>
<div class="container">
    <div class="row mt-3">
        <div class="col-12  mt-5" style="color:white;">
    <h1 class="mb-3 mt-3">Checkout</h1>
    <?php
    
    //Contents of the cart
    echo "<table class='table table-bordered text-white'>";
    echo '<thead><tr>';
    echo '<th>Item name</th>';
    echo "<th>Category Name</th>";
    echo "<th>Size</th>";
    echo "<th>Price</th>";
    echo '<th>Item Quantity</th>';
    echo '<th>Subtotal</th>';
    echo '</tr></thead>';

        $total = 0; // initialize total variable       
            // Get the details of the item from the database
            $user = $_SESSION['user_id'];
            $sql = "SELECT i.item_id, i.item_name, c.category_name, s.size, p.item_price, r.item_quantity
                      FROM reservation r
                      JOIN item i ON i.item_id = r.item_id
                      JOIN category c ON c.cat_id = r.cat_id
                      JOIN sizes s ON s.size_id = r.size_id
                      JOIN price p ON p.price_id = r.price_id
                      WHERE r.user_id = $user
                        AND r.order_status = 'C'
                        AND i.item_stats = 'A'";

            $result = query($conn, $sql);

            if (!empty($result)) { // check if the cart is not empty
              foreach($result as $key => $row) {
                // Calculate the subtotal for the item
                $subtotal = $row['item_quantity'] * $row['item_price'];
                // Add the subtotal to the total amount
                $total += $subtotal;
                // Display a row for the item in the cart
                echo '<tr>';
                echo '<td>' . $row['item_name'] . '</td>';
                echo '<td>' . $row['category_name'] . '</td>';
                echo '<td>' . $row['size'] . '</td>';
                echo '<td>' . $row['item_price'] . '</td>';
                echo '<td>' . $row['item_quantity'] . '</td>';
                echo '<td>' . $subtotal . '</td>'; 
                echo '</tr>';
              } 
            }
                else {
          //if the query was not successful, display an error message
          echo '<tr><td colspan="5">Error retrieving item details</td></tr>';
          }


          //Display the total amount
          echo '<tr>';
          echo '<td colspan="5"></td>';
          echo '<td><b>Total Amount: Php</b> ' . $total . '</td>';
          echo '</tr>';
          echo '</table>';

          //Display a link to the checkout page if the cart is not empty
          if (!empty($result)) {
              echo '<a class="btn btn-warning me-5" href="myCart.php">back</a>';
          } else {

          // If the cart is empty, display a message
              echo 'Your cart is empty.' . "<br>";
              echo '<a class="btn btn-warning mt-3 me-5" href="myCart.php">back</a>';
          }
          ?>
        </div>
  </div>
</div>
<div class="container">
  <div class="row">
    <div class="col-3">
    </div>

<div class="col-6 border border-white mt-5" style="color:white">
    <h2 class="mb-3 mt-3">User Information</h2>
    <form action="checkout_process.php" method="POST">
        <div class="mb-3">
            <label for="fname" class="form-label">First Name</label>
            <input type="text" id="fname" required name="fname" class="form-control" value="<?php echo isset($fname) ? $fname : ''; ?>">
        </div>
        <div class="mb-3">
            <label for="lname" class="form-label">Last Name</label>
            <input type="text" id="lname" required name="lname" class="form-control" value="<?php echo isset($lname) ? $lname : ''; ?>">
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" required id="new_address" name="address" class="form-control" value="<?php echo isset($address) ? $address : ''; ?>">
        </div>
        <div class="mb-3">
            <label for="contact_num" class="form-label">Contact Number</label>
            <input type="number" required id="contact_num" name="contact_num" class="form-control" value="<?php echo isset($contact_num) ? $contact_num : ''; ?>">
        </div>
        <div class="mb-3">
            <label for="pickup_date" class="form-label">Pickup Date</label>
            <input type="datetime-local" required id="pickup_date" name="pickup_date" class="form-control" value="<?php echo isset($pickup_date) ? $pickup_date : ''; ?>">
        </div>
        <input type="hidden" name="reservation_id" value="<?php echo $reservation_id; ?>">
        <input type="submit" name="submit" class="btn btn-warning float-end mb-2" value="Checkout">
    </form>
          </div>
        </div>
      </div>
    </div>
<script src="js/bootstrap.js"></script>
</body>
</html>

<?php

include_once "connection.php";

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>Cart</title>
    <style>
        *{
        padding: 0;
        margin: 0;
        font-family: 'helvetica', serif;
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
    .header{
        text-align: center;
        margin: auto;
        color: white!important;
    }
    .menu{
        color: white!important;
        text-align: center;
        margin: auto;
    }
    .pancit{
        color: white!important;
        text-align: left;
    }
    .list{
        text-align: left;
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
    <div class="bg-image" style="background-image: url('dk.jpg');">
      <nav class="navbar navbar-expand-lg bg-warning bg-opacity-75">
        <div class="container-fluid">
          <img src="logo.png" alt="Logo"class="navbar-brand" height="90" width="90">
          <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="toggler-icon top-bar" ></span>
            <span class="toggler-icon middle-bar" ></span>
            <span class="toggler-icon bottom-bar" ></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-center postion-relative">
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
          <div class="row">
            <div class="col-12 p-3 bg-transparent text-center" style="color: white">
              <h2 style="background: white; text-align: center; font-family:'Helvetica', serif; color: black;">Cart</h2>
              <div class="container-fluid">
                <?php
                if (isset($_GET['search'])) {
                  //sanitize and store the search query
                  $searchkey = htmlentities($_GET['search']);
                  $stmt = $db->prepare("SELECT c.cat_id, c.category_name, c.category_description, c.cat_file, p.item_price, i.item_name, s.size
                                        FROM category c
                                        INNER JOIN price p ON p.cat_id = c.cat_id
                                        INNER JOIN item i ON i.item_id = p.item_id
                                        INNER JOIN sizes s ON s.size_id = p.size_id
                                        WHERE c.cat_stats = 'A' AND (c.category_name LIKE '%{$searchkey}%' OR i.item_name LIKE '%{$searchkey}%')
                ");
                } else {
                $stmt = $db->prepare("SELECT c.cat_id, c.category_name, c.category_description, c.cat_file, p.item_price, i.item_name, s.size
                FROM category c
                INNER JOIN price p ON p.cat_id = c.cat_id
                INNER JOIN item i ON i.item_id = p.item_id
                INNER JOIN sizes s ON s.size_id = p.size_id
                WHERE c.cat_stats = 'A' ");
                }

                //it is not working
                //$stmt = $db->prepare($sql);
                $stmt->execute();
                $category = $stmt->fetchALL(PDO::FETCH_ASSOC);
                //Display the contents of the cart
                echo "<table class='table table-bordered text-white'>";
                echo "<thead>";
                echo "<th>Item Name</th>";
                echo "<th>Category Name</th>";
                echo "<th>Size</th>";
                echo "<th>Price</th>";
                echo "<th>Item Quantity</th>";
                echo "<th>Subtotal</th>";
                echo "<th>Action</th>";
                echo "</thead>";

                $total = 0; // initialize total variable       
                // Get the details of the item from the database
                $user = $_SESSION['user_id'];
                $sql = "SELECT i.item_id, i.item_name, c.category_name, s.size, p.item_price, r.item_quantity, r.reservation_id
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
                    echo '<td><a class="btn btn-danger" href="delete.php?reservation_id=' . $row['reservation_id'] . '">Remove</a></td>';
                    echo '</tr>'; 
                  }

                  // Add a button to the bottom of the cart

                  echo "<tr>";
                  echo "<td colspan='6'><strong>Total Amount: </strong>Php " . $total . "</td>";           
                  echo '<td><a class="btn btn-success me-5" href="checkout.php">Checkout</a></td>';                 
                  echo "</tr>";
                  // echo "</tbody>";
                  echo "</table>";
                } else {
                  echo "<p>Your cart is currently empty, Place an order.</p>";
                }
                  ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    <script src="js/bootstrap.js"></script>
  </body>
</html>
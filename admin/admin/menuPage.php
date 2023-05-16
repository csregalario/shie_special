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
    <title>Menu</title>
</head>
<body>
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
    .product {
      background-color:#333; 
      color: white; 
      border-color: #333;
      width: 80px;
    }
  </style>

</head>
<body>
  <!-- navigation bar -->
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
      <div class="row">
        <div class="col-3"></div>
          <div class="col-6 mt-5">
            <form class="d-flex" role="search" action="?search" method="GET">
              <div class="input-group">
                <input type="search" class="form-control" name="search" placeholder="Search..." aria-label="Search">
                <button class="btn btn-warning" type="submit">Search</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <?php
            //  check if the search query is submitted
            // if (isset($_GET['search'])) {
            //     //sanitize and store the search query
            //     $searchkey = htmlentities($_GET['search']);
            //     //prepare the sql statement
            //     $sql = "SELECT i.item_id, i.item_name, i.item_file, p.item_price, s.size, c.category_description, c.cat_file, c.category_name
            //     FROM item i
            //     JOIN sizes s ON s.item_id = i.item_id
            //     JOIN price p ON p.price_id = s.price_id
            //     JOIN category c ON s.cat_id = c.cat_id
            //     WHERE i.item_stats = 'A'    
            //     AND (c.category_name LIKE '%{$searchkey}%' OR i.item_name LIKE '%{$searchkey}%')";
            // } else {
            //     $sql = "SELECT i.item_id, i.item_name, i.item_file, p.item_price, s.size, c.category_description, c.cat_file, c.category_name
            //     FROM item i
            //     JOIN sizes s ON s.item_id = i.item_id
            //     JOIN price p ON p.price_id = s.price_id
            //     JOIN category c ON s.cat_id = c.cat_id
            //     WHERE i.item_stats = 'A'";
            // }

            // $stmt = $db->prepare($sql);
            // $stmt->execute();
            // $category = $stmt->fetchALL(PDO::FETCH_ASSOC);
            if (isset($_GET['search'])) {
              //sanitize and store the search query
              $searchkey = htmlentities($_GET['search']);
              $filter = "AND (c.category_name LIKE '%{$searchkey}%' OR i.item_name LIKE '%{$searchkey}%')";
            } else {
              $filter='';
            }
            $stmt = $db->prepare(
              "SELECT i.item_id, p.price_id, c.cat_id, s.size_id, i.item_name, c.category_name, c.category_description, s.size, p.item_price, c.category_name, c.cat_file
              FROM price p
              INNER JOIN category c ON p.cat_id = c.cat_id
              INNER JOIN item i ON i.item_id = p.item_id
              INNER JOIN sizes s ON s.size_id = p.size_id
              WHERE c.cat_stats = 'A' $filter"
            );
            // Prepare the SQL statement
            // Execute the statement and fetch the results into the $category array
            $stmt->execute();
            $category = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
          
<!-- PRODUCT DISPLAY -->
    <div class="container">
      <div class="row">
        <div class="col-md-3 border border-white ms-5" style="background: white; margin: 10px;">
          <div class="item mt-3">
            <div class="container-fluid">
            <form action="displayCart.php" method="post">
                    <input type="hidden" name="item_id" value="<?php echo $row['item_id']; ?>"/>
                    <input type="hidden" name="cat_id" value="<?php echo $row['cat_id']; ?>"/>
              <?php 
                echo "<hr>";

                // Query the database to get the categories
                $sql_cat = "SELECT * FROM category";
                $stmt_cat = $db->prepare($sql_cat);
                $stmt_cat->execute();
                $categories = $stmt_cat->fetchAll(PDO::FETCH_ASSOC);

                // Loop through the categories
                foreach ($categories as $cat) {
                    // Query the database to get the products of the current category
                    
                    // query for the search bar
                    if(isset($_GET['search'])){
                        $searchkey=htmlentities($_GET['search']);
                        $sql_item = "SELECT item_id, item_name, item_file, date_added
                                    FROM item
                                    WHERE item_stats = 'A' AND item_name LIKE '%{$searchkey}%'";
                    }
                    // query for the CATEGORY NAVIGATION bar
                    else if (isset($_GET['cat_id'])){
                        $sql_item = "SELECT item_id, item_name, item_desc, item_file, item_price
                                    FROM item
                                    WHERE item_stats = 'A' AND cat_id = $_GET[cat_id] AND cat_id = '{$cat['cat_id']}'" ;
                    } else {
                        // query for all the items by category
                        $sql_item = "SELECT item_id, item_name, item_file
                                    FROM item
                                    WHERE item_stats = 'A' ";
                    }

                    $stmt_item = $db->prepare($sql_item);
                    $stmt_item->execute();
                    $item = $stmt_item->fetchAll(PDO::FETCH_ASSOC);

                    // Only display the category if there are products in it
                    if (count($item) > 0) {
                        echo '<div class="container-fluid"><hr>';
                        echo '<h3 class="text-center text-light border border-info p-3" style="color: white; background: linear-gradient(to bottom right, #FF4E50, #FC913A, #ED1C24, #911E4B); ">' . '</h3>';
                        echo '<div class="row">';
                    }

                    // Loop through the products of the current category
                    foreach ($item as $row) {
                        echo '<div class="col-md-3 border border-white ms-5" style="background: white; margin: 10px;">';
                        echo '<div class=" mt-3">';
                        echo '<img style="border: solid blue 2px; max-width: 100%;" src="img/' . $row['item_file'] . '" alt="' . $row['item_name'] . '">';

                        echo '<div class="overlay mt-3">';
                        echo '<div class="caption">';
                        echo '<h3>' . $row['item_name'] . '</h3>';
                        echo '<b><p>Price: ' . $row['item_price'] . '</p></b>'; 

                        echo "<form action='displaycart.php' method='POST'>";
                        echo '<input type="hidden" name="item_id" value="' . $row['item_id'] . '" />';
                        echo '<label style="display: inline-block; width: 100px;"><b>Quantity:</b></label>';
                        echo '<input type="number" name="item_qty" value="1" min="1" max="99" style="display: inline-block; width: 50px;">';
                        echo '<button type="submit" class="btn btn-primary mt-2 mb-2 ms-2">Add to Cart</button>';
                        echo '</form>';

                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }

                    echo '</div>';
                    echo '</div>';
                }
                ?>
            </div>
          </div>
      </div>
    </div>
                
                  
    <script src="js/bootstrap.js"></script>
</body>
</html>
                        
                        
      
  
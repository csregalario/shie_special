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
  <div class="container">
    <div class="row">
      <div class="col-12" style="color: black;">
        <h2 class="mt-3" style="background: white; text-align: center; font-family: 'helvetica', serif;">Shie's Special Menu</h2>
        <div class="container-fluid">
          <?php

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
          <div class="row">
            <?php foreach ($category as $row): ?>
              <div class="col-md-3 border border-white ms-5" style="background: white; margin: 10px;">
                <div class="item mt-3">
                  <img src="<?php echo "img/" . $row['cat_file']; ?>" alt="<?php echo $row['category_name']; ?>" style="border: solid blue 2px; max-width: 100%;">

                  <div class="overlay">
                    <div class="caption">
                      <h3 class="mt-3"><strong><?php echo $row['item_name']; ?></strong></h3>
                      <h5><?php echo $row['category_name']; ?></h5>
                      <p><?php echo $row['category_description']; ?></p>
                      <!-- Form to display the item -->
                      <form action="displayCart.php" method="post">
                        <input type="hidden" name="item_id" value="<?php echo $row['item_id']; ?>"/>
                        <input type="hidden" name="cat_id" value="<?php echo $row['cat_id']; ?>"/>
                        <div class="input-group mb-3">
                          <span class="input-group-text product">Size</span>
                          <input type="hidden" name="size_id" value="<?php echo $row['size_id']; ?>"/>
                          <input type="text" readonly="readonly" style="border-color: #333;" class="form-control" value="<?php echo $row['size']; ?>"/>
                        </div>
                        <div class="input-group mb-3">
                          <span class="input-group-text product">Price</span>
                          <input type="hidden" name="price_id" value="<?php echo $row['price_id']; ?>"/>
                          <input type="text" readonly="readonly" style="border-color: #333;" class="form-control" value="<?php echo $row['item_price']; ?>"/>
                        </div>
                        <!-- <b><p>Size: <?php echo $row['size']; ?></p></b>  -->
                        <!-- <b><p>Price:<?php echo $row['item_price']; ?></p></b> -->
                        <!--connection -->
                        <div class="input-group mb-3">
                          <span class="input-group-text product">Quantity</span>
                          <input type="number" style="border-color: #333;" class="form-control" name="item_qty" value="1" min="1"/>
                        </div>
                        <button type="submit" class="btn btn-warning mt-2 mb-2">Add to cart</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            <?php endforeach;?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="js/bootstrap.js"></script>
</body>
</html>

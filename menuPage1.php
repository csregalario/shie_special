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
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-center postion-relative">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="home2.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="menuPage1.php">Menu</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About Us</a>
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
      <div class="col-3">

      </div>
      <div class="col-6 mt-5">
        <form class="d-flex" role="search" action="?search" method="GET">
          <div class="input-group">
            <input type="search" class="form-control" name="search" placeholder="Search..." aria-label="Search"><button class="btn btn-warning" type="submit">Search</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
        <div class="col-12 bg-transparent border-info" style="color: black;">
        <h2 class="mt-3" style="background: white; text-align: center; font-family: 'helvetica', serif;">Shie's Special Menu</h2>
        <div class="container-fluid">
            <?php
if (isset($_GET['search'])) {
    $searchkey = htmlentities($_GET['search']);
    $sql = "SELECT i.item_id, i.item_name, i.item_file, i.item_size, p.price_amount, c.category_description, c.cat_file, c.category_name
    FROM item i
    JOIN price p
    ON p.price_id = i.price_id
    JOIN category c
    ON i.cat_id = c.cat_id
    WHERE i.item_stats = 'A'
    AND (c.category_name LIKE '%{$searchkey}%' OR i.item_name LIKE '%{$searchkey}%')";
} else {
    $sql = "SELECT i.item_id, i.item_name, i.item_file, i.item_size, p.price_amount, c.category_description, c.cat_file, c.category_name FROM item i JOIN price p ON p.price_id = i.price_id JOIN category c ON i.cat_id = c.cat_id WHERE i.item_stats = 'A';";
}

$stmt = $db->prepare($sql);
$stmt->execute();
$category = $stmt->fetchALL(PDO::FETCH_ASSOC);
?>
<div class="row">
  <?php foreach ($category as $row):
?>
  <div class="col-md-3 border border-white ms-5" style="background: white; margin: 10px;">
  <div class="item mt-3">
    <img src="<?php echo "img/" . $row['cat_file']; ?>" alt="<?php echo $row['category_name']; ?>" style="border: solid black 2px; max-width: 100%;">
    <div class="overlay">
      <div class="caption">
        <h3><?php echo $row['category_name']; ?></h3>
        <p><?php echo $row['category_description']; ?></p>
        <p><?php echo "Serving size option" ?></p>
        <select name="size" id="size" onchange="displayPrice()">
        <option value="option">Choose an option</option>
        <option value="small">Small</option>
        <option value="medium">Medium</option>
        <option value="large">Large</option>
      </select>
      <p id="small" style="display:none;">Good for sharing between 2-4 people. <br>Price: &#x20B1;200.00</p>
     <p id="medium" style="display:none;">Good for sharing between 6-9 people. <br>Price: &#x20B1;400.00</p>
     <p id="large" style="display:none;">Good for sharing between 6-9 people. <br>Price: &#x20B1;800.00</p>

     <!--Function to get the price of an item size from the database-->
     <?php function getPrice($size) {
      global $conn;
      $stmt = $conn->prepare("SELECT p.price_amount, i.item_size FROM item i JOIN price p ON p.price_id = i.price_id WHERE item_size =?");
      $stmt->bind_param("s", $size);
      $stmt->execute();
      $result = $stmt->get_result();
      $row = $result->fetch_assoc();
      return $row['price_amount'];
     } ?>
      <!--connection --> 
        <form action="displayCart.php" method="post">
          <input type="hidden" name="item_id" value="<?php echo $row['item_id']; ?>"/>
          <span><b>Quantity:</b></span>
          <input type="number" name="item_qty" value="1" min="1" />
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
  <script>
    function displayPrice() {
      var size = document.getElementById("size").value;
      if (size == "small") {
        document.getElementById("small").style.display = "block";
      } else {
        document.getElementById("small").style.display = "none";
      }v
      if (size == "medium") {
        document.getElementById("medium").style.display = "block";
      } else {
        document.getElementById("medium").style.display = "none";
      }
      if (size == "large") {
        document.getElementById("large").style.display = "block";
      } else {
        document.getElementById("large").style.display = "none";
      }
    }
    </script>
    <script src="js/bootstrap.js"></script>
</body>
</html>

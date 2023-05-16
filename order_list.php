
<?php
    include_once 'connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>Order List</title>
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
    #login{
    border-style: solid;
    border-color: white!important;
    border-width: 2px;
    border-radius: 30px;
    }
    #login:hover{
    border-color: black!important;
    }
    @media (max-width: 987px) {
    #login{
        border-style: none;
    }
    }
    .crop{
    max-width: 100vh;
    height: auto;
    position: relative;
    margin-bottom: 0px;
    float: left;
    }
    .orderNow{
    padding: 10px 25px;
    font-size: 25px;
    font-family: 'helvetica', sans-serif;
    color: white;
    }
    .mt-5{
    margin-top: 5rem!important;
    }
    @media (max-width: 987px) {
    .crop{
        display: none;
    }
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
      </form>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-center postion-relative">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="#">Home</a>
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
  <div class="container-fluid">
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10 p-3 mb-2 bg-light opacity-75 border border-white mt-5" style=" color: black;">
            
            <!-- Displaying the ordered record list -->
            <div class="row ">
                    <div class="col-10">
                        <h2>PENDING PURCHASE</h2>
                    </div>
            </div>
            <?php
                    // Retrieve user ID to use on the query
                    if (isset($_SESSION['user_id'])) {
                        // User is logged in, retrieve user ID from session 
                        $user_id = $_SESSION['user_id'];
                    } else {
                        // User is not logged in, redirect to login page
                        header("Location: home1.php");
                        exit;
                    }
                    $order_status = 'P';
                    $table = "reservation";
                    $field = "order_ref_number";
                    // Perform the join query
                    $query = "SELECT i.item_id,
                              i.item_name,
                              c.category_name, 
                              s.size, 
                              p.item_price, 
                              r.item_quantity, 
                              r.user_id, 
                              r.order_status, 
                              r.order_ref_number, 
                              r.date_ordered, 
                              r.pickup_date
                    FROM reservation r
                    JOIN item i ON i.item_id = r.item_id
                    JOIN category c ON c.cat_id = r.cat_id
                    JOIN sizes s ON s.size_id = r.size_id
                    JOIN price p ON p.price_id = r.price_id
                    WHERE r.user_id = $user_id
                        AND r.order_status = 'P'
                        ORDER BY r.reservation_id DESC";

                    $result = mysqli_query($conn, $query);

                    // Check if the query was successful
                    if ($result && mysqli_num_rows($result) > 0) {
                        // Display the order list
                        echo "<table class='table table-bordered'>";
                        echo "<thead>";   
                        echo "<tr>";  
                        echo "<th class='white-text'>Reference Number</th>"; 
                        echo "<th class='white-text'>Item Name</th>";   
                        echo "<th class='white-text'>Category Name</th>";  
                        echo "<th class='white-text'>Size</th>"; 
                        echo "<th class='white-text'>Quantity</th>";     
                        echo "<th class='white-text'>Price</th>";    
                        echo "<th class='white-text'>Date Ordered</th>";    
                        echo "<th class='white-text'>Pickup Date</th>"; 
                        echo "<th class='white-text'>Order Status</th>";   
                        echo "</tr>";   
                        echo "</thead>";    
                        echo "<tbody>";
                        while ($row = mysqli_fetch_assoc($result)) { 
                            echo "<tr>";    
                            echo "<td class='white-text'>" . $row['order_ref_number'] . "</td>";
                            echo "<td class='white-text'>" . $row['item_name'] . "</td>";  
                            echo "<td class='white-text'>" . $row['category_name'] . "</td>"; 
                            echo "<td class='white-text'>" . $row['size'] . "</td>"; 
                            echo "<td class='white-text'>" . $row['item_quantity'] . "</td>"; 
                            echo "<td class='white-text'>" . $row['item_price'] . "</td>"; 
                            echo "<td class='white-text'>" . $row['date_ordered'] . "</td>";
                            echo "<td class='white-text'>" . $row['pickup_date'] . "</td>";
                            echo "<td class='white-text'>" . $row['order_status'] . "</td>";
                            echo "</tr>";
                        }  
                        echo "</tbody>";
                        echo "</table>";
                    } 
                    //  else {
                    //     // If the query was empty, display a message
                    //     echo "<br>" . "PURCHASE HISTORY IS EMPTY" . "<br>" . "<br>";
                    // }
                ?>
                <a class="btn btn-primary me-5" href="menuPage.php">back</a> 
            </div>
            <div class="col-1"></div>
        </div>
    </div>
                
</body>
<script src="bootstrap/js/bootstrap.js"></script>
</html>

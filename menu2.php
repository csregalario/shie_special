<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="menu.css">
  <title>Menu</title>
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
            <a class="nav-link " href="menu2.php">Menu</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About Us</a>
          </li>
        </ul>
        <ul class="nav navbar-nav navbar-right text-center">
          <li class="nav-item">
            <a class="nav-link" href="#">My cart</a>
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
                <div class="modal-body">
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
  <form action="add_to_cart.php" method="post">
    <div class="container">
      <div class="row">
        <div class="col-6 menu">
          <h1>Pancit Malabon<br>Classic Regular</h1>
    <p>noodles mixed with the traditional shirmp sauce and & tinapa flakes <br> Default toppings: sliced hardboiled eggs, marinated ground pork, pork rinds, chinese cabbage & scallions</p>
    <ul class= "list" style="list-style-type:square;">
      <li>Small - Good for 2-4 people</li>
      <li>Medium - Good for 6-9 people </li>
      <li>Large - Good for 12-15 people</li>
    </ul>
    <input type="hidden" name="item_id" value="1">
    <input type="hidden" name="item_name" value="Pancit Malabon Classic Regular">
    <input type="hidden" name="item_price" value="200.00">
    <h3>Serving size option</h3>
    <select name="size" id="size" onchange="displayPrice()">
      <option value="option">Choose an option</option>
      <option value="small">Small</option>
      <option value="medium">Medium</option>
      <option value="large">Large</option>
    </select>
    <p id="small" style="display:none;">Good for sharing between 2-4 people. <br>Price: &#x20B1;200.00</p>
     <p id="medium" style="display:none;">Good for sharing between 6-9 people. <br>Price: &#x20B1;400.00</p>
     <p id="large" style="display:none;">Good for sharing between 6-9 people. <br>Price: &#x20B1;800.00</p>
    <input type="number" name="item_qty" value="1" id="" min="1" max="200">
    <button class="buy-btn">Add to cart</button>
  </div>
</form>

        <div class="col-6">
          <img src="p.png" alt="" height="500" width="500">
        </div>
      </div>
    </div>

    <div class="container">
      <div class="row">
        <div class="col-6">
          <img src="p.png" alt="" height="500" width="500">
        </div>
        <div class="col-6 menu">
          <h1>Overload Special</h1>
    <p>Loaded with greater/extra default toppings & a variety of seafoods (shirmp & squid adobo)</p>

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
      }
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

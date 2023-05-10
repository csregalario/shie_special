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
    .btn{
        padding: 10px 25px;
        font-size: 25px;
        font-family: 'helvetica', sans-serif;
        color: white;
      }
    .mt-5{
        margin-top: 5rem!important;
      }
    .btn:hover{
        color: black!important;
        font-weight: bold;
        border-color: black!important;
      }
    @media (max-width: 987px) {
    .crop{
        display: none;
      }
    }
    .modal-content {
        width: 100%;
        margin: 0 auto;
        background-color: white;
      }
    .modal-body {
        padding: 0px;
        border-radius: 50px;
      }
    .btn-close {
        position: absolute;
        right: 0;
        padding: 1em;
      }
      .myform {
        padding: 2em;
        max-width: 100%;
        color: #fff;
        box-shadow: 0 4px 6px 0 rgba(22, 22, 26, 0.18);
      }
    @media (max-width: 576px) {
    .myform {
        max-width: 90%;
        margin: 0 auto;
      }
    }
    .form-control:focus {
        box-shadow: 5px 10px 18px #F1C40F ;
    }
    .form-control {
   /* background-color: inherit; */
        font-size: 20px;
        color: black!important;
        padding: 15px;
        border: 0;
        border-radius: 20px;
      }
    .myform .btn {
        width: 70%;
        font-weight: 800;
        border-style: none;
        color: white;
        font-size: 30px;
        background-color: #F1C40F  !important;
      }
    .myform .btn:hover {
        background-color: #D4AC0D !important;
        color: #fff!important;
        border-style: none;
      }
      .signUp {
        text-align: center;
        padding-top: 2em;
        color: black;
        font-size: 20px;
      }
    .signUp .sU {
        color: black;
        text-decoration: none;
        font-size: 20px;
      }
    .signUp .sU:hover {
        color:   #D4AC0D !important;
        font-weight: 100;
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
            <a class="nav-link" aria-current="page" href="home1.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="menu1.php">Menu</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About Us</a>
          </li>
        </ul>
        <ul class="nav navbar-nav navbar-right text-center">
          <li class="nav-item">
            <a class="nav-link" href="register.php">Sign Up</a>
          </li>
        </ul>

<!-- Login button -->
<button type="button" class="btn" id="login" data-bs-toggle="modal" data-bs-target="#ModalForm">Login</button>
<form action="login_process1.php" method="post">
<div class="modal fade" id="ModalForm" tabindex="-1" aria-labelledby="ModalFormLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content bg-light bg-opacity-75">
      <div class="modal-body">
          <button type="button" class="btn-close btn-close-warning" data-bs-dismiss="modal" aria-label="Close"></button>
          <div class="myform">
                  <div class="mb-3 mt-4">
                      <label for="InputEmail1" class="form-label" ></label>
                      <input type="email" class="form-control" id="InputEmail1" name="email_add" placeholder="Email or phone number" aria-describedby="emailHelp" required>
                  </div>
                  <div class="mb-3" >
                      <label for="InputPassword1" class="form-label"></label>
                      <input type="password" class="form-control" id="InputPassword1" name="password" placeholder="Password" required>
                      <input type="checkbox" onclick="myFunction()"> Show Password
                  </div>
                  <button type="submit" class="btn mt-3">Log In</button>
                  <p class="signUp">Need an account? <a class="sU" href="register.php">Sign up now</a></p>
          </div>
      </div>
    </div>
  </div>
</div>
</form>
  </div>
    </div>
      </nav>
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
    <input type="number" name="" id="" min="1" max="200">
    <button class="btn btn-warning mt-4" type="button" style="font-size: 15px; color: white;" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Add to cart</button>
    <div class="collapse mt-2" id="collapseExample">
      <div class="card card-body" style="border-radius: 5px; width: 30rem; color:black;">Please log in or create an account to proceed with your order.</div>
    </div>
  </div>


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

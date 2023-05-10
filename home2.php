<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>Home</title>
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
<form action="login_process.php" method="post">
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
  </nav>

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


    <div class="container-fluid-mt-0">
      <div class="row">
        <div class="col-lg-7 col-sm-12 position-relative mb-0 mt-3 ">
          <img src="crop.png" alt="Pancit Malabon" class="crop">
        </div>
        <div class="col-lg-5 col-xs-12 mb-2 mt-0">
            <img src="brand.png" alt="">
            <div class="text-center">
        <a href="#" class="btn btn-warning mt-4 orderNow" style="font-size: 20px; color: white;">ORDER NOW</a>
        </div>
        </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="js/bootstrap.js"></script>
</body>
</html>

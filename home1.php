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
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-center position-relative">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <!--<li class="nav-item">
            <a class="nav-link " href="#">Menu</a>
          </li> -->
          <li class="nav-item">
            <a class="nav-link" href="about1.php">About Us</a>
          </li>
        </ul>
        <ul class="nav navbar-nav navbar-right text-center">
          <li class="nav-item">
            <a class="nav-link" href="register.php">Sign Up</a>
          </li>
        </ul>

<!-- Modal Login button -->
<button type="button" class="btn" id="login" data-bs-toggle="modal" data-bs-target="#ModalForm">Login</button>
<form action="login_process2.php" method="post">
<div class="modal fade" id="ModalForm" tabindex="-1" aria-labelledby="ModalFormLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content bg-light bg-opacity-75">
      <div class="modal-body">
          <button type="button" class="btn-close btn-close-warning" data-bs-dismiss="modal" aria-label="Close"></button>
          <div class="myform">
                  <div class="mb-3 mt-4">
                      <label for="InputEmail1" class="form-label" ></label>
                      <input type="text" class="form-control" id="InputEmail1" name="email" placeholder="Email address" aria-describedby="emailHelp" required>
                  </div>
                  <div class="mb-3">
                      <label for="InputPassword1" class="form-label"></label>
                      <input type="password" class="form-control" id="InputPassword1" name="pass" placeholder="Password" required>
                      <input type="checkbox" onclick="myFunction()" class="mt-2"> Show Password
                  </div>
                  <div class="d-flex justify-content-center">
                  <button type="submit" class="btn mt-3">Log In</button></div>
                  <p class="signUp">Need an account? <a class="sU" href="register.php">Sign up now</a></p>
          </div>
      </div>
    </div>
  </div>
</div>
</form>
</form>
  </div>
    </div>
      </nav>
        <div class="container-fluid-mt-0">
          <div class="row">
           <div class="col-lg-7 col-sm-12 position-relative mb-0 mt-3 ">
           <img src="crop.png" alt="Pancit Malabon" class="crop">
           </div>
           <div class="col-lg-5 col-xs-12 mb-2 mt-0 text-center">
            <img src="brand.png" alt="">
            <button id="myButton" class="btn btn-warning mt-4" type= "button" style="font-size: 20px; color: white;" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">ORDER NOW</button>
            <div class="collapse" id="collapseExample">
                <div id="alert" class="card card-body" style="border-radius: 5px; width: 30rem;">Oops! It looks like you're not logged in yet. Please log in or create an account to proceed with your order.
                  </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
var button = document.getElementById('myButton');
  button.addEventListener('click', function() {
    var alertElement = document.getElementById('alert');
    if (alertElement) {
      alertElement.style.display = 'block';
      setTimeout(function() {
        alertElement.style.display = 'none';
      }, 5000);
    }
  });
</script>

<script>
  function myFunction() {
      var x = document.getElementById("InputPassword1");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    }
    </script>

<script src="js/bootstrap.js"></script>
</body>
</html>

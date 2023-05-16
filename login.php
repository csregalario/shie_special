<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>login</title>
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

    .myform {
        padding: 2em;
        max-width: 100%;
        color: #fff;
        box-shadow: 0 4px 6px 0 rgba(22, 22, 26, 0.18);
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
   /* background-color: #4CD279; */
        color: white;
        font-size: 30px;
        background-color: #F1C40F  !important;
   /* background-color: #fff;
    border-radius: 0;
    padding: 0.5em 0; */
    }
    .myform .btn:hover {
        background-color: #D4AC0D !important;
        color: #fff!important;
    /*border-style: none; */
        border-style: none;
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
            <a class="nav-link active" aria-current="page" href="home1.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="#">Menu</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About Us</a>
          </li>
        </ul>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
            <img src="brand.png" alt="">
            </div>
            <!--Login -->
        <div class="col-lg-7 bg-light bg-opacity-75 mt-3">
          <div class="myform" id="login">
              <form action="login_process2.php" method="post">
                  <div class="mb-3 mt-4">
                      <label for="InputEmail1" class="form-label" ></label>
                      <input type="email" class="form-control" id="InputEmail1" name="f_user" placeholder="Username" aria-describedby="emailHelp" required>
                  </div>
                  <div class="mb-3">
                      <label for="InputPassword1" class="form-label"></label>
                      <input type="password" class="form-control" id="InputPassword1" name="f_pass" placeholder="Password" required>
                      <input type="checkbox" onclick="myFunction()">Show Password
                  </div>
                  <div class="text-center">
                  <button type="submit" class="btn mt-3 text-center">Log In</button>
                  <hr>
                  <button type="submit" class="btn mt-3">Create new account</button>
                  </div>
              </form>
            </div>
        </div>
    </div>
    </div>
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

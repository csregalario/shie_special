<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/bootstrap.css">
  <title>Sign up</title>
  <style>
   #daform{
    margin-top: 50px;
    color: rgb(0, 0, 0);
    font-family: Arial, sans-serif;
    background-color: rgb(243, 243, 243);
    padding-top: 50px;
    padding-bottom: 50px;
    border-radius: 1%;
    width: 1000px;
    opacity: 0.8;
     }
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
      #cAccount {
        width: 200px;
        font-size: 20px;
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
          <!-- <li class="nav-item">
            <a class="nav-link " href="#">Menu</a>
          </li> -->
          <li class="nav-item">
            <a class="nav-link" href="about1.php">About Us</a>
          </li>
        </ul>
    </nav>
  <div class="container" id="daform" >
    <!--form -->
    <form action="register_pros.php" method="post">
      <div class="container-fluid" id="heaad">
        <h2> Register your Account</h2>
        <?php if(isset($_GET['msg'])){ ?>
 <div class="alert-warning alert"><?php echo $_GET['msg'];?></div>
     <?php }?>
      </div> 
  <div>
    <div class="row">
      <div class="col mb-4">
        <label class="form-label">First name</label>
        <input type="text" id="fname" name="fname" class="form-control" required/>
      </div>
      <div class="col mb-4">
        <label class="form-label" >Last name</label>
        <input type="text" id="lname" name="lname" class="form-control" required/>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col mb-4">
      <label class="form-label" >Address</label>
      <input type="text" id="address" name="address" class="form-control" placeholder="Street/ Baranggay/ Municipality" required/>
    </div>
    <div class="col-4">
      <label class="form-label">Phone</label>
      <input type="text" id="contact_num" name="contact_num" class="form-control" required/>
    </div>
  </div>
  <div class="form-outline mb-4">
    <label class="form-label" >Email</label>
    <input type="email" id="email_add" name="email_add" class="form-control" required/>
  </div>
  <div class="form-outline mb-4">
    <label class="form-label">Password</label>
    <input type="password" id="password" name="password" class="form-control" required/>
    <input type="checkbox" onclick="myFunction()">Show Password
  </div>
  <button type="submit" class="btn btn-warning" id="cAccount">Create Account</button>
</form>

  </div>
</div>

  <script src="js/bootstrap.js"></script>
  <script>
  function myFunction() {
      var x = document.getElementById("password");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    }
    </script>
</body>
</html>

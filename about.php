<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

  <style>
    *{ 
      padding: 0;
      margin: 0;
      font-family: 'helvetica', sans-serif;
  }
  body{
      overflow: scroll;
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
  }
  .btn{
      padding: 10px 25px;
      font-size: 25px; 
  
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
    .glyphicon {
       font-size: 20px;
       color:white;
       border: none;
       text-decoration: none;
     }
     .par{
      font-size: 20px;
     }
     #content{
      background-color:white; 
      border-radius:10px; 
      color: black; 
      text-align: center;
      opacity: 65%;
     }
     * {
  box-sizing: border-box;
  border-radius: 10px;
}

.column {
  float: left;
  width: 33.33%;
  padding: 5px;
  
}

/* Clearfix (clear floats) */
.row::after {
  content: "";
  clear: both;
  display: table;
}
 
  </style>
  
  </head>
    <link rel="stylesheet" href="styles.css">
    <title>Shie's Special</title>
    <link rel="icon" type="png" href="logo.png"/>
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
              <a class="nav-link" aria-current="page" href="home2.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="menuPage.php">Menu</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">About Us</a>
            </li>
          </ul>
          

          </div>
          </div>
          </nav>

        <div class="container" id="picss" style="padding-top: 20px;">
          <div class="row">
            <div class="column">
              <img src="4.jpg" alt="Snow" style="width:100%">
            </div>
            <div class="column">
              <img src="2.jpg" alt="Forest" style="width:100%">
            </div>
            <div class="column">
              <img src="3.jpg" alt="Mountains" style="width:100%">
            </div>
          </div>
          </div>
          
   <div class="container"style="padding-top: 50px; bg-light">
            <div class="row">
                <div class="col-5"></div>
                <div class="col-12" id="content">
                    <h1 class="mb-4">About Us</h1>
                    <p class="par"> Pancit Palabok is a shrimp-flavored noodle dish topped with cooked shrimp, 
                      boiled pork, crushed chicharon, tinapa flakes, fried tofu, scallions, and fried garlic. A wonderfully tasty delicacy that will satisfy your hunger.
                      Shie's special offers the traditional noodledish-pancit malabon/palabok 
                      -aiming to connect people, honor and retain our cultural identity as Filipinos.
                      Tangkilikin ang pagkaing Tatak Pinoy!</p>
                      <br>
                      <p class="par">"Why Shie's Special instead of Shie's specialty?" Wag nang ma-confuse dahil Shie's Special talaga
                        yan - where the contraction entirely means "Shie is Special."
                        This is to acknowledge how extra special my mom is! For it's not mainly about the pancit malabon,
                        but about the wonderful one who serves it with sincere love & passion.
                      </p>
                      
                </div> 
                <div class="col-2"></div>
            </div>
        </div>

   </div>        

          
</body>
</html>
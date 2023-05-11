<?php 
session_start();
include_once "connection.php"; 

if(isset($_GET['signout'])){
    session_destroy();
    header("Location:../index.php");
    exit();
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Welcome Admin</title>
    
   
    <!-- Link to Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">


<style>
body{
      background-image: url("dk.jpg");
      overflow: auto;
    }
    .container {
			max-width: 1900px;
      max-height: fit-content;
		}
    #pix{
      float: left;
      width: 600px;
      position: relative;
    }
   
  * {
    padding: 0;
    margin: 0;
    font-family: 'helvetica', sans-serif;
  }
  body {
    overflow: auto;
  }
  
  .accordion-content {
    height: 50%;
    overflow-y: auto;
  }
  
  /* add the following CSS rules */
  .sidebar {
    position: fixed;
    top: 0;
    left: 0;
    height: 100%;
    width: 250px;
    background-color: #f8f9fa;
  }
  
  .content {
    margin-left: 250px;
  }
  
  @media (max-width: 768px) {
    .sidebar {
      display: none;
    }
    .content {
      margin-left: 0;
    }
  }
  .btn {
  display: inline-block;
  padding: 5px;
  font-size: 15px;
  cursor: pointer;
  text-align: center;
  text-decoration: none;
  outline: none;
  color: #000;
  background-color: #ddd;
  border: none;
  border-radius: 15px;
  box-shadow: 0 9px #999;
}

.btn:hover {
  background-color: #ddd;
}

.btn.pressed {
  background-color: #ccc;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}


</style>

<body>
  <div class="container-fluid">
     <div class="row">
           <div class="px-0 bg-transparent text-dark col-md-4col-lg-3 d-none d-md-block sidebar h-100">
              <div class="card pt-10">
                 <div class="text-center">
                    <img src="icon.jpg" style="border-radius: 50%; width: 100px;" alt="" class="img-responsive d-block mx-auto mt-1 rounded-circle">   
                       <h5 style="margin-top:10px;">Admin</h5>
                          <div class="card-body">
                             <div class="mx-auto d-block text-center">
                                <?php if(isset($_SESSION['user'])): ?>
                                <h6 class="display-6">@<?php echo $_SESSION['user']['username'];?></h6>
                                <?php endif; ?>  
                                <a href="profile" class="btn btn">Profile</a> ◉
                                <a href="signout" class="btn btn">Sign out</a> 
                             </div>
                          </div>
                 </div>
                 <hr>
                   <div id="accordion">
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    <button class="btn btn" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" onclick="this.classList.toggle('active')">
                                        Manage Orders
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="card-body accordion-content">
                                    <!-- Manage Orders -->
                                    <ul style="list-style: none;">
                                        <li><a href="?vieworders">View All Orders</a></li>
                                        <li><a href="?confirm_pending_orders">Confirm Pending Orders</a></li>
                                        <li><a href="?delivered">Delivered Orders</a></li>
                                        <li><a href="?cancelled">Cancelled Orders</a></li>
                                    </ul>

                                </div>
                            </div>
                        </div>

                        <div class="card bg-transparent">
                            <div class="card-header" id="headingTwo">
                                <h5 class="mb-0">
                                    <button class="btn btn collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Manage Items
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseTwo" class="bg-transparent collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                <div class="card-body accordion-content">
                                    <!-- Manage Items -->
                                    <ul style="list-style: none;">
                                        <li><a href="?viewitem">View Items</a></li>
                                        <li><a href="?additem">Add Items</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="card bg-transparent">
                            <div class="card-header" id="headingThree">
                                <h5 class="mb-0">
                                    <button class="btn btn collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Show Reports
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                <div class="card-body accordion-content">
                                    <!-- Show Reports -->
                                    <ul style="list-style: none;">
                                        <li><a href="?sales">Sales Report</a></li>
                                        <li><a href="?inven">Inventory Report</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="card bg-transparent">
                            <div class="card-header" id="headingFour">
                                <h5 class="mb-0">
                                    <button class="btn btn collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                        Show Users
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                                <div class="card-body accordion-content">
                                    <!-- Show Users -->
                                    <ul style="list-style: none;">
                                        <li><a href="#">View Users</a></li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                 </div>
        </div>
    </div>



            <!-- contents-->
          
                <?php 
                  
                if(isset($_GET['msg'])){ ?>
                     <div class="alert alert-success"><?php echo $_GET['msg']; ?></div>
                <?php }
                /*Reports*/
                if(isset($_GET['sales'])){
                    
                    include_once "sales_report.php";
                }
                if(isset($_GET['inven'])){
                    include_once "inventory_report.php";
                }
                /*orders*/
                if(isset($_GET['orders'])){ 
                    include_once "view_orders.php";
                }
                if(isset($_GET['confirm_pending_orders'])){  ?>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12">
                                  
                                      <h3 class="display-6">Confirm Pending Orders</h3> 
                                    <?php admin_retrieve_orders($conn, $order_sql,$sql_itemize, 'P' , 'E'); ?>
                                </div>
                            </div>
                        </div>
            
                <?php }
                
                
                if(isset($_GET['delivered'])){ ?>
                     <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-12">
                                  
                                      <h3 class="display-6">Delivered by Couriers</h3> 
                                    <?php admin_retrieve_orders($conn, $order_sql,$sql_itemize, 'D' , 'E'); ?>
                                </div>
                            </div>
                        </div>
                <?php }
                
                if(isset($_GET['cancelled'])){ ?>
                     <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-12">
                                  
                                      <h3 class="display-6">Cancelled</h3> 
                                    <?php admin_retrieve_orders($conn, $order_sql,$sql_itemize, 'N' , 'E'); ?>
                                </div>
                            </div>
                        </div>
                <?php }
                /*items*/
                if(isset($_GET['additem'])){
                    include_once "add_item.php";
                }
                if(isset($_GET['viewitem'])){
                    if(isset($_GET['deacitem'])){
                    
                    $item=htmlentities($_GET['deacitem']);
                    $fields = array("item_status" => 'D');
                    $filter = array("item_id" => $item);
                        if(update($conn, "products", $fields, $filter)){ ?>
                          <div class="alert alert-danger mb-0">Item Deactivated</div>
                        <?php } 
                    }
                    if(isset($_GET['reacitem'])){
                    
                    $item=htmlentities($_GET['reacitem']);
                    $fields = array("item_status" => 'A');
                    $filter = array("item_id" => $item);
                        if(update($conn, "products", $fields, $filter)){ ?>
                          <div class="alert alert-success mb-0">Item Reactivated</div>
                        <?php } 
                    }
                    if($_GET['viewitem'] == '2'){
                    include_once "view_item_tiled.php";
                    }
                    else{
                    include_once "view_item.php";
                    }
                }
                
                if(isset($_GET['updateitem'])){
                    $item_id=htmlentities($_GET['updateitem']);
                    include_once "update_item.php";
                }
                ?>
         
<!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- Link to jQuery -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <!-- Link to Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/bootstrap.bundle.min.js"></script>
</body>
</html>

<script>
   $(document).ready(function() {
    $('#minus_qty').click(function() {
        var currentVal = parseInt($('#stock_qty').val());
     //   if (!isNaN(currentVal) && currentVal > 1) {
            $('#stock_qty').val(currentVal - 1);
       // }
    });

    $('#plus_qty').click(function() {
        var currentVal = parseInt($('#stock_qty').val());
        //if (!isNaN(currentVal) && currentVal < 1000) {
            $('#stock_qty').val(currentVal + 1);
    //    }
    });
});
</script>
</body>

</html>
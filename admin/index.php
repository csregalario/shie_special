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
      *{
        padding: 0;
        margin: 0;
        font-family: 'helvetica', sans-serif;
      }
    body{
        overflow: auto;
      }
      
        .accordion-content {
            height: 50%;
            overflow-y: auto;
        }

    </style>
</head>
<!-- Sidebar navigation -->
    <div class="container-fluid">
       <div class="row">
          <div class="px-0 bg-transparent text-dark col-md-3 col-lg-3 d-none d-md-block sidebar h-100">
             <div class="card pt-3">
             <div class="text-center">
             <img src="icon.jpg" style="border-radius: 50%; width: 100px;" alt="" class="img-responsive d-block mx-auto mt-1 rounded-circle">   
                <h5 style="margin-top:10px;">Admin</h5>
                   <div class="card-body">
                      <div class="mx-auto d-block text-center">
                         <?php if(isset($_SESSION['user'])): ?>
                            <h6 class="display-6">@<?php echo $_SESSION['user']['username'];?></h6>
                         <?php endif; ?>  
                                <a href="profile" class="btn btn-link">Profile</a> ◉
                                <a href="signout" class="btn btn-link">Sign out</a> 
                      </div>
                   </div>

                   <hr>
                   <div id="accordion">
                      <div class="card">
                         <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                               <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Manage Orders
                               </button>
                            </h5>
                         </div>
                         <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body accordion-content">
                                <!-- content for Manage Orders -->
                                <ul>
                                    <li><a href="?orders">View All Orders</a></li>
                                    <li><a href="?confirm_pending_orders">Confirm Pending Orders</a></li>
                                    <li><a href="?delivered">Delivered Orders</a></li>
                                    <li><a href="?cancelled">Cancelled Orders</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="card ">
                       <div class="card-header bg-transparent" id="headingTwo">
                          <h5 class="mb-0">
                             <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                 Manage Items
                             </button>
                          </h5>
                       </div>
                          <div id="collapseTwo" class="bg-transparent collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                             <div class="card-body accordion-content">
                                <!-- content for Manage Items -->
                                <ul>
                                    <li><a href="?viewitem">View Items</a></li>
                                    <li><a href="?additem">Add Items</a></li>
                                </ul>
                             </div>
                          </div>
                    </div>

                    <div class="card bg-transparent">
                       <div class="card-header" id="headingThree">
                          <h5 class="mb-0">
                             <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Show Reports
                             </button>
                          </h5>
                       </div>
                       <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                          <div class="card-body accordion-content">
                             <!-- content for Show Reports -->
                                <ul>
                                    <li><a href="?sales">Sales Report</a></li>
                                    <li><a href="?inven">Inventory Report</a></li>
                                    <li><a href="?useract">User Activity Report</a></li>
                                </ul>
                          </div>
                       </div>
                    </div>

                    <div class="card bg-transparent">
                       <div class="card-header" id="headingFour">
                          <h5 class="mb-0">
                             <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                Show Users
                             </button>
                          </h5>
                       </div>
                       <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                          <div class="card-body accordion-content">
                             <!-- content for Show Users -->
                             <ul>
                                 <li><a href="#">View Users</a></li>
                                 <li><a href="#">New Admin Users</a></li>
                             </ul>
                          </div>
                       </div>
                    </div>
                </div>
             </div>
            <!--                contents-->
                <?php
                if(isset($_POST['search'])){
                    $k = htmlentities($_POST['search']);
                    $order_sql = "select o.order_ref_number order_ref_number
                                           , u.fullname         fullname
                                           , u.shipping_address shipping_address
                                           , u.contact contact
                                           , cast(o.date_ordered as date) date_ordered
                                           , count(*) order_count
                                        from orders o
                                    inner join users u
                                            on (o.user_id = u.user_id)
                                       where ( o.order_ref_number = '$k'
                                                OR 
                                                u.fullname LIKE '%$k%'
                                                )
                                         AND o.order_status = ?
                                       group by o.order_ref_number
                                           , u.fullname
                                           , u.shipping_address
                                           , u.contact
                                           , cast(o.date_ordered as date)
                                       order by o.date_ordered DESC ";
                }
                else{
                       $order_sql = "select o.order_ref_number order_ref_number
                                           , u.fullname         fullname
                                           , u.shipping_address shipping_address
                                           , u.contact contact
                                           , cast(o.date_ordered as date) date_ordered
                                           , count(*) order_count
                                        from orders o
                                    inner join users u
                                            on (o.user_id = u.user_id)
                                       where o.order_status = ?
                                       group by o.order_ref_number
                                           , u.fullname
                                           , u.shipping_address
                                           , u.contact
                                           , cast(o.date_ordered as date)
                                       order by o.date_ordered DESC
                                       LIMIT 50;";
                                      
                       
                   }
                 $sql_itemize = "select p.item_id
                                  , p.item_name
                                  , p.item_file
                                  , o.order_id
                                  , COALESCE(pr.item_price,0) as item_price
                                  , o.item_qty as item_qty
                                  , curr_stock_qty
                               from orders o
                            inner join products p
                              on (o.item_id = p.item_id)
                            LEFT JOIN (
                                SELECT item_id, MAX(price_id) AS price_id
                                FROM pricing
                                WHERE (CURRENT_DATE between eff_start_dt and eff_end_dt)
                                or (eff_start_dt is null)
                                GROUP BY item_id
                            ) AS prmax 
                              ON i.item_id = prmax.item_id
                            JOIN price pr 
                              ON prmax.item_id = pr.item_id
                             AND prmax.price_id = pr.price_id
                            LEFT JOIN (
                                    SELECT item_id, SUM(stock_qty) AS curr_stock_qty
                                    FROM stock
                                    GROUP BY item_id
                                ) AS sk 
                              ON i.item_id = sk.item_id
                           where order_status = ?
                           and o.order_ref_number = ?";
                
                  
                ?>
                    <form action="" method="POST">
                        <div class="input-group mb-3 w-50">
                            <input type="search" required name="search" value="<?php if(isset($_POST['search'])){ echo $_POST['search']; }else{ echo ""; }?>" placeholder="ORDER REFERENCE NUMBER or Full Name" class="form-control">
                            <input type="hidden" name="orders" class="form-control">
                            <button class="btn btn-primary">Search</button>
                        </div>
                        
                    </form>
                
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
                    include_once "orders.php";
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
            <?php    
                }
                
                if(isset($_GET['ship_order'])){ ?>
                     <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-12">
                                  
                                      <h3 class="display-6">Ship Orders</h3> 
                                    <?php admin_retrieve_orders($conn, $order_sql,$sql_itemize, 'C' , 'E'); ?>
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
            </div>
        </div>
    </div>
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
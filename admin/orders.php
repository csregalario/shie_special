<?php if(isset($_GET['orders'])) { 
//      $order_sql = " select o.order_ref_number order_ref_number
//                                           , u.fullname         fullname
//                                           , u.shipping_address shipping_address
//                                           , u.contact contact
//                                           , cast(o.date_ordered as date) date_ordered
//                                           , count(*) order_count
//                                        from orders o
//                                    inner join users u
//                                            on (o.user_id = u.user_id)
//                                       where o.order_status = ?
//                                       group by o.order_ref_number
//                                           , u.fullname
//                                           , u.shipping_address
//                                           , u.contact
//                                           , cast(o.date_ordered as date)
//                                       order by o.date_ordered DESC;";
//                                      
//       $sql_itemize = "select p.item_id
//                  , p.item_name
//                  , p.item_file
//                  , o.order_id
//                  , COALESCE(pr.item_price,0) as item_price
//                  , o.item_qty as item_qty
//                  , curr_stock_qty
//               from orders o
//            inner join products p
//              on (o.item_id = p.item_id)
//            LEFT JOIN (
//                SELECT item_id, MAX(price_id) AS price_id
//                FROM pricing
//                WHERE (CURRENT_DATE between eff_start_dt and eff_end_dt)
//                or (eff_start_dt is null)
//                GROUP BY item_id
//            ) AS prmax 
//              ON p.item_id = prmax.item_id
//            JOIN pricing pr 
//              ON prmax.item_id = pr.item_id
//             AND prmax.price_id = pr.price_id
//            LEFT JOIN (
//                    SELECT item_id, SUM(stock_qty) AS curr_stock_qty
//                    FROM stock
//                    GROUP BY item_id
//                ) AS sk 
//              ON p.item_id = sk.item_id
//           where order_status = ?
//           and o.order_ref_number = ?";
                                      
?>
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active position-relative" id="pendingOrders-tab" data-bs-toggle="tab" data-bs-target="#pendingOrders" type="button" role="tab" aria-controls="pendingOrders" aria-selected="true">
         <span class="position-absolute translate-middle start-100 top-25 badge rounded-pill bg-danger">
                           <?php echo admin_retrieve_orders($conn, $order_sql,$sql_itemize, 'P' , 'C');?>
                       </span>
                               <span class="">Pending</span>
    </button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link position-relative" id="ofd-tab" data-bs-toggle="tab" data-bs-target="#ofd" type="button" role="tab" aria-controls="ofd" aria-selected="false">
             <span class="position-absolute translate-middle start-100 top-25 badge rounded-pill bg-danger">
                           <?php echo admin_retrieve_orders($conn, $order_sql,$sql_itemize, 'O' , 'C');?>
                       </span>
        <span class="">Picked Up </span>
    </button>
  </li>
  
  <li class="nav-item" role="presentation">
    <button class="nav-link position-relative" id="delivered-tab" data-bs-toggle="tab" data-bs-target="#delivered" type="button" role="tab" aria-controls="delivered" aria-selected="false">
             <span class="position-absolute translate-middle start-100 top-25 badge rounded-pill bg-danger">
                           <?php echo admin_retrieve_orders($conn, $order_sql,$sql_itemize, 'D' , 'C');?>
                       </span>
        <span class="">Delivered</span>
    </button>
  </li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane active" id="pendingOrders" role="tabpanel" aria-labelledby="pendingOrders-tab" tabindex="0">
     <?php
       admin_retrieve_orders($conn, $order_sql,$sql_itemize, 'P' , 'V');
      ?>
      
  </div>

  <div class="tab-pane" id="delivered" role="tabpanel" aria-labelledby="delivered-tab" tabindex="0">
       <?php
       admin_retrieve_orders($conn, $order_sql,$sql_itemize, 'D', 'V');
      ?>
      
  </div>
  <div class="tab-pane" id="ofd" role="tabpanel" aria-labelledby="ofd-tab" tabindex="0">
       <?php
       admin_retrieve_orders($conn, $order_sql,$sql_itemize, 'O' , 'V');
      ?>
      
  </div>
</div>
<?php } ?>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
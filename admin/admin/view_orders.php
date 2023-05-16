<?php if(isset($_GET['reservation'])) {
//      $reservation_sql = " select r.order_ref_number order_ref_number,
//                                           , u.fname       
//                                           , u.lname         
//                                           , u.contact_num   
//                                           , cast(r.date_ordered as date) date_ordered
//                                           , count(*) order_count
//                                        from reservation r
//                                    inner join user u
//                                            on (r.user_id = u.user_id)
//                                       where r.order_status = 'Received'
//                                       group by r.order_ref_number,
//                                           , u.fname         
//                                           , u.lname        
//                                           , u.contact_num   
//                                           , cast(r.date_ordered as date)
//                                       order by r.date_ordered DESC;";
//                                      
//       $sql_itemize = "select r.reservation_id
//                  , r.order_ref_number
//                  , r.date_ordered
//                  , r.reservation_id
//                  , COALESCE(pr.item_price,0) as item_price
//                  , r.item_quantity as item_quantity
//               from reservation r
//            inner join item i
//              on (r.item_id = i.item_id)
//            left join (
//                select item_id, max(price_id) as price_id
//                from price
//                group by item_id
//             ) as prmax
//                 on i.item_id = prmax.item_id
//            join price pr 
//                 on prmax.item_id = pr.item_id
//                 and prmax.price_id = pr.price_id
//            order by r.date_ordered DESC
//            limit 50;
                                     

?>
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active position-relative" id="pendingOrders-tab" data-bs-toggle="tab" data-bs-target="#pendingOrders" type="button" role="tab" aria-controls="pendingOrders" aria-selected="true">
         <span class="position-absolute translate-middle start-100 top-25 badge rounded-pill bg-danger">
                           <?php echo admin_retrieve_orders($conn, $reservation_sql,$sql_itemize, 'P' , 'C');?>
                       </span>
                               <span class="">Pending</span>
    </button>
  </li> 
  <li class="nav-item" role="presentation">
    <button class="nav-link position-relative" id="delivered-tab" data-bs-toggle="tab" data-bs-target="#delivered" type="button" role="tab" aria-controls="delivered" aria-selected="false">
             <span class="position-absolute translate-middle start-100 top-25 badge rounded-pill bg-danger">
                           <?php echo admin_retrieve_orders($conn, $reservation_sql,$sql_itemize, 'D' , 'C');?>
                       </span>
        <span class="">Received</span>
    </button>
  </li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane active" id="pendingOrders" role="tabpanel" aria-labelledby="pendingOrders-tab" tabindex="0">
     <?php
       admin_retrieve_orders($conn, $sql_1, $sql_2, 'P', 'V');
      ?>
      
  </div>
  <div class="tab-pane" id="toShip" role="tabpanel" aria-labelledby="toShip-tab" tabindex="0">
    <?php
       admin_retrieve_orders($conn, $reservation_sql,$sql_itemize, 'C' , 'V');
      ?>
      
  </div>
  <div class="tab-pane" id="received" role="tabpanel" aria-labelledby="delivered-tab" tabindex="0">
       <?php
       admin_retrieve_orders($conn, $reservation_sql,$sql_itemize, 'D', 'V');
      ?>
      
  </div>
  <div class="tab-pane" id="ofd" role="tabpanel" aria-labelledby="ofd-tab" tabindex="0">
       <?php
       admin_retrieve_orders($conn, $reservation_sql,$sql_itemize, 'O' , 'V');
      ?>
      
  </div>
      
  </div>
</div>
<?php } ?>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
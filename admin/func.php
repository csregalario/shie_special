<?php
/**
 * Check if a value exists in a column of a table
 *
 * @param mysqli $conn The database connection object
 * @param string $value The value to check
 * @param string $column The column name to check
 * @param string $table The table name to check
 * @return bool Returns true if the value exists in the column, false otherwise
 */

function is_existing(mysqli $conn, string $value, string $column, string $table): bool
{
    $value = mysqli_real_escape_string($conn, $value);
    $column = mysqli_real_escape_string($conn, $column);
    $table = mysqli_real_escape_string($conn, $table);

    $query = "SELECT COUNT(*) AS count FROM $table WHERE $column = '$value'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return ($row['count'] > 0);
    }

    return false;
}

function count_cart_items($conn, $user) {
    $sql = "SELECT COUNT(ORDER_ID) as cart FROM orders WHERE order_status='X' and user_id = ? ";
    $res = query($conn, $sql, array($user));
    foreach($res as $r){
        return $r['cart'];
    }
}

function get_items_from_order($conn, $order_id){
    return query($conn, "SELECT i.item_name, i.item_id, i.item_qty, pr.item_price
                           FROM orders o
                        inner join item i
                              on o.item_id = i.item_id
                     LEFT JOIN (
                        SELECT item_id, MAX(price_id) AS price_id
                        FROM price
                        WHERE (CURRENT_DATE between eff_start_dt and eff_end_dt)
                        or (eff_start_dt is null)
                        GROUP BY item_id
                    ) AS prmax 
                      ON i.item_id = prmax.item_id
                    JOIN price pr 
                      ON prmax.item_id = pr.item_id
                     AND prmax.price_id = pr.price_id
                          WHERE order_id = ?
                            AND order_status = 'X' ", array($order_id));
}

function admin_retrieve_orders($conn, $sql_1,$sql_2, $status ='P', $mode = 'V'){
    //mode = V = view or E = edit or C = count_order_reference
       if($mode == 'C'){
           return count(query($conn,$sql_1,array($status)));
       }
    else if($mode == 'V'){
     echo "<table class='table table-responsive table-striped table-borderless'>";               
      $f_orders=query($conn, $sql_1, array($status));
        if(count($f_orders) > 0){
            foreach($f_orders as $ord){ ?>
              <tr class='border border-1' data-bs-toggle="collapse" href="#<?php echo $ord['order_ref_number']; ?>" role="button" aria-expanded="false" aria-controls="<?php echo $ord['order_ref_number'];?>">
              <?php 
                                       echo "<td><b>" . $ord['order_ref_number'] . "<b></td>" ;
                                       echo "<td>" . $ord['date_ordered'] . "</td>" ;
                                       echo "<td>" . $ord['order_count'] . "</td>" ; 
                                       $total_amt=0;
                                      $order_ref_number =  $ord['order_ref_number'];
                                      $show_order_item = query($conn, $sql_2, array($status, $order_ref_number));
                                       foreach($show_order_item as $idet){
                                            $total_amt += $idet['item_price'] * $idet['item_qty'];
                                       }
                                       echo "<td>" . CURRENCY . number_format($total_amt,2) . "</td>" ;  ?>
                                       <td><?php echo strtoupper($ord['fullname']) . ", " . ucwords($ord['shipping_address']) . ", (". $ord['contact'] .")"; ?></td>
              </tr>
              <?php 
            
            //echo "<div id=". $ord['order_ref_number'] . " class='collapse'>";
              foreach($show_order_item as $idet){
                  $total_amt += $idet['price_amount'] * $idet['item_qty']; ?>
              <tr class="collapse" id="<?php echo $ord['order_ref_number'];?>">
              <?php
                 echo "<td class='float-end'>" . $idet['item_name'] ."</td>";
                 echo "<td class='float-end'>" . $idet['price_amount'] . " x " . $idet['item_qty'] ."</td>";
                 echo "<td>" . number_format($idet['price_amount'] * $idet['item_qty'],2) ."</td>"; ?>
              </tr>
              <?php }
             // echo "<tr><td colspan='2'>Total Amount</td><td><i class='text-danger'>Php" . number_format($total_amt,2) . "</i></td></tr>";

            //echo "</div>";          
                }
       }
      else{
            echo "<tr><td>No Orders.</td></tr>";
      }
     echo "</table>";
    }
    else if($mode == 'E'){
        echo "<table class='table table-responsive table-striped table-borderless'>";               
      $f_orders=query($conn, $sql_1, array($status));
        if(count($f_orders) > 0){
            echo "<tr>";
                echo "<td></td>";
                echo "<td>Reference No.</td>";
                echo "<td>Total Amount</td>";
                echo "<td>Date Ordered</>
            echo "</tr>";
            foreach($f_orders as $ord){ ?>
              <tr>
                 <td>
                   <?php 
                     switch($status){ 
                         case 'P':
                           ?>
                             <a href="process_orders.php?conf_ord=<?php echo $ord['order_ref_number']; ?>" class="btn btn-primary z-1"> Confirm Order</a>
                            <?php break; ?>
                  <?php  case 'C': ?>
                              <a href="process_orders.php?ship_ord=<?php echo $ord['order_ref_number']; ?>" class="btn btn-primary z-1"> Ship Order</a>
                            <?php break; ?>
                  <?php  case 'O': ?>
                              <a href="process_orders.php?update_delivery=<?php echo $ord['order_ref_number']; ?>&del_status=D" class="btn btn-primary z-1"> Delivered</a>
                              <a href="process_orders.php?update_delivery=<?php echo $ord['order_ref_number']; ?>&del_status=R" class="btn btn-danger z-1"> Rejected</a>
                            <?php break; ?>
                     <?php }
                     ?>
                    
                 </td>
                 <td><a data-bs-toggle="collapse" href="#<?php echo $ord['order_ref_number']; ?>" role="button" aria-expanded="false" aria-controls="<?php echo $ord['order_ref_number'];?>" ><?php echo $ord['order_ref_number']; ?></a></td>
                 <td style='text-align:right'>
                     <?php 
                        $order_ref_number=$ord['order_ref_number'];
                        $show_order_item = query($conn, $sql_2, array($status, $order_ref_number));
                        $total_amt=0;
                        foreach($show_order_item as $i){
                           $total_amt += $i['price_amount'] * $i['item_qty'];
                        }
                     echo CURRENCY . number_format($total_amt,2);
                     ?>
                 </td>
                  <td><?php echo $ord['date_ordered']; ?></td>
                  <td><?php echo strtoupper($ord['fullname']) . ", " . ucwords($ord['shipping_address']) . ", (". $ord['contact'] .")"; ?></td>
              </tr>
              <?php 
             
            //echo "<div id=". $ord['order_ref_number'] . " class='collapse'>";
              foreach($show_order_item as $idet){
                 ?>
              <tr class="collapse fade align-items-center" id="<?php echo $ord['order_ref_number'];?>">
                  <td><img style="width:100px" src="../img/<?php echo $idet['item_file'];?>" alt="" class="img-thumbnail"></td>
              <?php
                 echo "<td style='text-align:right'>" . $idet['item_name'] ."</td>";
                 echo "<td>" . $idet['price_amount'] . " x " . $idet['item_qty'] ."</td>";
                 echo "<td style='text-align:right'>" . CURRENCY . number_format($idet['item_price'] * $idet['item_qty'],2) ."</td>"; ?>
              </tr>
              <?php }
             // echo "<tr><td colspan='2'>Total Amount</td><td><i class='text-danger'>Php" . number_format($total_amt,2) . "</i></td></tr>";

            //echo "</div>";          
                }
       }
      else{
            echo "<tr><td>No Orders.</td></tr>";
      }
     echo "</table>";
    }
}

//this is to check if the user is logged. if not, it will be redirected to specific $location.
//@param $usertype = array('A','D')
function session_check($usertype, $loc){
    if(isset($_SESSION['user']['user_type'] )){
        if(!in_array($_SESSION['user']['user_type'], $usertype) ){
           header("location: $loc ");
        //   exit();
        }
    }
    else{
          header("location: $loc");
          // exit();
    }
}



function encrypt_password($password, $salt ) {
    $hash = hash('sha256', $password . $salt);
    return $hash;
}
function verify_password($password, $hash, $salt) {
 
    $hash_to_verify = hash('sha256', $password . $salt);
    return $hash_to_verify === $hash;
}
//This function takes in a password and a hash (which would be retrieved from a database or other storage), adds the same salt string as the encryption function, and generates a hash using the SHA256 algorithm. It then compares this hash to the original hash, and returns true if they match, indicating that the password is correct.

function gen_private_key($len){
    $alpha_num=array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','0','1','2','3','4','5','6','7','8','9','0');
    $key="";
    for ($i = 0; $i <= $len; $i++){
        if($i%2 == 0 && $i > 0){
           $key .= $alpha_num[rand(0,52)];
        }
        else{
             $key .= $alpha_num[rand(53,62)];
        }
     }
    return $key;
}
function gen_order_ref_number($len){
    $alpha_num=array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','0','1','2','3','4','5','6','7','8','9','0');
    $key="";
    for ($i = 0; $i <= $len; $i++){
        if($i%2 == 0 && $i > 0){
           $key .= $alpha_num[rand(0,25)];
        }
        else{
             $key .= $alpha_num[rand(26,sizeof($alpha_num)-1)];
        }
     }
    return $key;
}
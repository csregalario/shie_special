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

        $query = "SELECT COUNT(*) AS count FROM `$table` WHERE `$column` = '$value'";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            return ($row['count'] > 0);
        }

        return false;
    }

    function count_cart_items($conn, $user) {
        $sql = "SELECT COUNT(*) AS cart FROM cart WHERE user = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 's', $user);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $count);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
        return $count;
    }

//    function get_items_from_order($conn, $reservation_id){
//        $sql = "SELECT i.item_name, i.item_id, r.item_qusntity, pr.item_price
//                FROM reservation r
//                INNER JOIN item i ON r.item_id = i.item_id
//                LEFT JOIN (
//                    SELECT item_id, MAX(price_id) AS price_id
//                    FROM price
//                    WHERE (CURRENT_DATE BETWEEN start_date AND end_date)
//                    OR (start_date IS NULL)
//                   GROUP BY item_id
//                ) AS prmax ON i.item_id = prmax.item_id
//                JOIN pricing pr ON prmax.item_id = pr.item_id AND prmax.price_id = pr.price_id
//                WHERE reservation_id = ? AND order_status = 'X'";


    function admin_retrieve_orders($conn, $sql_1, $sql_2, $status , $mode = 'V') {
    // mode = V = view or E = edit or C = count_order_reference
    if ($mode == 'C') {
         return count(query($conn,$sql_1,array($status)));
       }
     else if ($mode == 'V') {
        echo "<table class='table table-responsive table-striped table-borderless'>";  
        
        echo "<thead>";   
        echo "<tr>";  
        echo "<th>Order Reference Number</th>"; 
        echo "<th>Date Ordered</th>";  
        echo "<th>Quantity</th>";
        echo "<th>Amount</th>";
        echo "<th>User Information</th>";   
        echo "</tr>";   
        echo "</thead>";    
        echo "<tbody>";
        $f_reservation = query($conn, $sql_1, array($status));
        if (count($f_reservation) > 0) {
            foreach ($f_reservation as $res) {
?>
                <tr class='border border-1' data-bs-toggle="collapse" href="#<?php echo $res['order_ref_number']; ?>" role="button" aria-expanded="false" aria-controls="<?php echo $res['order_ref_number'];?>">
                    <?php 
                        echo "<td><b>" . $res['order_ref_number'] . "</b></td>";
                        echo "<td>" . $res['date_ordered'] . "</td>";
                        echo "<td>" . $res['order_count'] . "</td>"; 
                        $total_amt = 0;
                        $order_ref_number =  $res['order_ref_number'];
                        $show_order_item = query($conn, $sql_2, array($status, $order_ref_number));
                        foreach ($show_order_item as $idet) {
                            $total_amt += $idet['item_price'] * $idet['item_qty'];
                        }
                        echo "<td>" . CURRENCY . number_format($total_amt,2) . "</td>";
                        echo "<td>" . strtoupper($res['fname']) . ", " . $res['lname'] . " (" . $res['contact_number'] . ")</td>";
                    ?>
                </tr>
                <tr class="collapse" id="<?php echo $res['order_ref_number'];?>">
                    <td colspan="5">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th>Item Name</th>
                                    <th>Price x Quantity</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($show_order_item as $idet) { ?>
                                    <tr>
                                        <td><?php echo $idet['item_name']; ?></td>
                                        <td><?php echo $idet['item_price'] . " x " . $idet['item_qty']; ?></td>
                                        <td><?php echo CURRENCY . number_format($idet['item_price'] * $idet['item_qty'],2); ?></td>
                                    </tr>
                                <?php } ?>
                                <tr>
                                    <td colspan="2"><b>Total Amount</b></td>
                                    <td><i class='text-danger'><?php echo CURRENCY . number_format($total_amt,2); ?></>

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
      $f_reservation=query($conn, $sql_1, array($status));
if(count($f_reservation) > 0){
    echo "<tr>";
    echo "<td></td>";
    echo "<td>Reference No.</td>";
    echo "<td>Total Amount</td>";
    echo "<td>Date Ordered</td>";
    echo "</tr>";
    foreach($f_reservation as $res){ ?>
        <tr>
            <td>
                <?php 
                switch($status){ 
                    case 'P':
                        ?>
                        <a href="orders.php?id=<?php echo $res['reservation_id'];?>&type=P">View</a> | 
                        <a href="#" onclick="cancelOrder('<?php echo $res['reservation_id'];?>','<?php echo $res['user_id'];?>')">Cancel</a>
                        <?php 
                        break;
                    case 'C':
                        ?>
                        <a href="orders.php?id=<?php echo $res['reservation_id'];?>&type=C">View</a> | 
                        <a href="#" onclick="pickupDate('<?php echo $res['reservation_id'];?>','<?php echo $res['user_id'];?>')">Pickup Date</a>
                        <?php 
                        break;
                    case 'D':
                        ?>
                        <a href="orders.php?id=<?php echo $res['order_id'];?>&type=D">View</a> 
                        <?php 
                        break;
                    default:
                        ?>
                        <a href="orders.php?id=<?php echo $res['order_id'];?>&type=V">View</a>
                        <?php 
                        break;
                } ?>
            </td>
            <td><?php echo $ord['order_refno'];?></td>
            <td><?php echo $ord['order_total'];?></td>
            <td><?php echo $ord['date_ordered'];?></td>
        </tr>
    <?php 
    } 
} else {
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
function getSalesReportByDay($conn, $date) {
    
    // Perform the SQL query to retrieve items sold on the given day
    $query = "SELECT i.item_name, SUM(r.item_quantity) as total_quantity_sold, SUM(r.item_quantity * pr.item_price) as total_sales
                FROM reservation r
                JOIN item i ON r.item_id = i.item_id
                JOIN price pr ON r.price_id = pr.price_id
                WHERE r.order_status = 'D' AND DATE(r.pickup_date) = '$date'
                GROUP BY i.item_name";
    $result = mysqli_query($conn, $query);

    // Perform the SQL query to retrieve the overall total sales for the given day
    $query2 = "SELECT SUM(r.item_quantity * pr.item_price) as overall_total_sales
                FROM reservation r
                JOIN item i ON r.item_id = i.item_id
                JOIN price pr ON r.price_id = pr.price_id
                WHERE r.order_status = 'D' AND DATE(r.pickup_date) = '$date'
                LIMIT 0, 25";
               
    $result2 = mysqli_query($conn, $query2);
    $row2 = mysqli_fetch_assoc($result2);
    $overall_total_sales = $row2['overall_total_sales'];

    // Display the result in a table format
    if ($result && mysqli_num_rows($result) > 0) {
        echo "<table class='table table-bordered bg-transparent blur'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Item Name</th>";
        echo "<th>Pickup Date</th>";
        echo "<th>Total Quantity Sold</th>";
        echo "<th>Total Sales</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['item_name'] . "</td>";
            echo "<td>" . $row['pickup_date'] . "</td>";
            echo "<td>" . $row['total_qty'] . "</td>";
            echo "<td>" . $row['total_sales'] . "</td>";
            echo "</tr>";
        }
        echo "<tr>";
        echo "<td colspan='2'>Overall Total Sales:</td>";
        echo "<td>" . $overall_total_sales . "</td>";
        echo "</tr>";
        echo "</tbody>";
        echo "</table>";
    } else {
        // If there is no data, display a message
        echo "No sales data found for this day.";
    }
}


function getSalesReportByRange($conn, $start_date, $end_date) {
    // Perform the SQL query to retrieve items sold within the given date range
    $query = "SELECT i.item_name, r.pickup_date, SUM(r.item_quantity) as total_quantity, SUM(pr.item_price*r.item_quantity) as total_sales
                FROM reservation r
                INNER JOIN item i ON r.item_id = i.item_id
                INNER JOIN price pr ON r.price_id = pr.price_id
                WHERE r.order_status = 'D' AND r.pickup_date >= '$start_date' AND r.pickup_date <= '$end_date'
                GROUP BY i.item_name";
    $result = mysqli_query($conn, $query);

    // Perform the SQL query to retrieve the overall total sales for the given date range
    $query2 = "SELECT SUM(r.item_quantity * pr.item_price) as overall_total_sales
                FROM reservation r
                JOIN item i ON r.item_id = i.item_id
                JOIN price pr ON r.price_id = pr.price_id
                WHERE r.order_status = 'D' AND r.pickup_date >= '$start_date' AND r.pickup_date <= '$end_date'";
    $result2 = mysqli_query($conn, $query2);
    $row2 = mysqli_fetch_assoc($result2);
    $overall_total_sales = $row2['overall_total_sales'];

    // Display the result in a table format
    if ($result && mysqli_num_rows($result) > 0) {
        echo "<table class='table table-bordered bg-transparent blur'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Item Name</th>";
        echo "<th>Pickup Date</th>";
        echo "<th>Total Quantity Sold</th>";
        echo "<th>Total Sales</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['item_name'] . "</td>";
            echo "<td>" . $row['pickup_date'] . "</td>";
            echo "<td>" . $row['total_quantity'] . "</td>";
            echo "<td>" . $row['total_sales'] . "</td>";
            echo "</tr>";
        }
        echo "<tr>";
        echo "<td colspan='2'>Overall Total Sales:</td>";
        echo "<td>" . $overall_total_sales . "</td>";
        echo "</tr>";
        echo "</tbody>";
        echo "</table>";
   } else {
    // If there is no data, display a message
    echo "<p style='text-align:center; color:white;'>No sales data found for this date range.</p>";
}
}

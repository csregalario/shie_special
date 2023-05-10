<div class="container-fluid">
    <div class="row">
       <div class="col-lg-12">
        <h3 class="display-6">Sales</h3>
           <button class="btn btn-primary btn-sm mb-3" type="button" data-bs-toggle="collapse" data-bs-target=".multicollapse" aria-expanded="false" aria-controls="<?php echo $d['date_ordered'];?>">
          toggle itemize
          </button>
          
          <form action="" method="POST">
              <div class="input-group mb-3">
                  <span class="input-group-text">Between </span>
                  <input type="date" name="start_date" class="form-control">
                  <span class="input-group-text"> and </span>
                  <input type="date" name="end_date" class="form-control">
                  <input type="submit" name="filter_range" value="filter" class="btn btn-primary">
              </div>
          </form>
          <form action="" method="POST">
              <div class="input-group mb-3">
                  <span class="input-group-text">For This Date </span>
                  <input type="date" name="this_date" class="form-control">
                  <input type="submit" name="filter_date" value="filter" class="btn btn-primary">
              </div>
          </form>
       </div>
       <?php
        if(isset($_POST['filter_date'])){
            $report_sql="SQL TO SHOW TOTAL SALES, TOTAL ORDER COUNT, PER ORDERDATE FOR SPECIFIC DATE";
              $reports = query($conn ,$report_sql, array($_POST['this_date']));
        }
        else if(isset($_POST['filter_range'])){
            $report_sql="/*SQL TO SHOW TOTAL SALES, TOTAL ORDER COUNT, PER ORDER DATE IN BETWEEN 2 DATES*/";
            $reports = query($conn ,$report_sql, array($_POST['start_date'], $_POST['end_date']));
        }
        else{
            $report_sql="/*SQL TO SHOW DATE ORDERED, TOTAL SALES AMT, TOTAL ORDER COUNT*/";
            $reports = query($conn ,$report_sql);
        }
        
        
        
        /*will use sales_report_detail view*/
      
        foreach($reports as $d){ 
        $order_perc = ($d['count_orders'] / TARGET_ORDERS) * 100;
        ?>
        <div class="col-lg-4 col-md-3">
            <div class="card border border-1 mb-3">
                <b class="ms-2"><?php echo $d['date_ordered'];?></b>
                <table class="table table-responsive table-hover">
                    <tr>
                        <td>Total Order % base on Target <?php echo "(". TARGET_ORDERS . ")";?></td>
                        <td>
                        <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
  <div class="progress-bar <?php if($order_perc < 25){ echo "text-bg-danger"; } else if($order_perc < 65){ echo "text-bg-warning";  } else if($order_perc < 95){ echo "text-bg-info"; }else{echo "text-bg-success"; } ?> " style="width: <?php echo $order_perc; ?>%"> <?php echo $order_perc; ?>% </div>
</div>
                        </td>
                    </tr>
                    <tr>
                        <td>Total Sales</td>
                       <td><?php echo CURRENCY . number_format($d['sales_amt'],2);?></td>
                    </tr>
                </table>
                <?php $rep_detail = query($conn,"/*REMOVED*/",array($d['date_ordered']));
                ?>
               <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $d['date_ordered'];?>" aria-expanded="false" aria-controls="<?php echo $d['date_ordered'];?>">
    Item Sold
  </button>
                <div class="collapse multicollapse" id="<?php echo $d['date_ordered'];?>">
                   <table class="table table-responsive table-striped">
                           <tr>
                               <th></th>
                               <th>Orders</th>
                               <th>Sales Amt</th>
                           </tr>
                    <?php foreach($rep_detail as $id){ ?>
                        <tr>
                            <td><?php echo $id['item_name'];?></td>
                            <td><?php echo $id['order_qty'];?></td>
                            <td><?php echo $id['item_sls_amt'];?></td>
                        </tr>
                    <?php }?>
                    </table>
                </div>
            </div>
        </div>
        <?php } ?>
        
        
    </div>
</div>
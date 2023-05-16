<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Sales Report</title>


    <style>
      body{
        background-image: url("dk.jpg");
        overflow: auto;
        text:center;
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
   
    </style>
  </head>
    <body>
        <?php include_once "navbar.php"; ?>
        
        <div class="container pt-5">
            <div class="sidenav">
                <h4 class="header mb-4">Sales</h4>
                <a href="reports.php?today">Day</a>
                <hr>
                <a href="reports.php?week">Week</a>
                <hr>
                <a href="reports.php?month">Month</a>
                <hr>
                <a href="reports.php?year">Year</a>
            </div>
            <div class="main">
                <?php
                if(isset($_GET['today'])) {
                ?>
                <h4 class="header">Sales Today</h4>
                <form action="reports.php?today"
                      method="post">
                    <div class="input-group mb-3">
                        <span class="input-group-text">Specific Date</span>
                        <input type="date"
                               name="date"
                               class="form-control"/>
                        <input type="submit"
                               name="filter_date"
                               value="Filter"
                               class="btn btn-secondary"/>
                    </div>
                </form>
                <?php
                    $date = "CURRENT_DATE";
                    if(isset($_POST['date'])) {
                        $date = "'" . $_POST['date'] . "'";
                    }
                    $duration = "= $date";
                    echo gen_sales($conn, $duration);
                }
                
                if(isset($_GET['week'])) {
                ?>
                <h4 class="header">Sales This Week</h4>
                <?php
                    $duration = "BETWEEN DATE_ADD(CURRENT_DATE, INTERVAL -7 DAY) AND CURRENT_DATE";
                    echo gen_sales($conn, $duration);
                }
                
                if(isset($_GET['month'])) {
                ?>
                <h4 class="header">Sales This Month</h4>
                <?php
                    $duration = "BETWEEN DATE_ADD(CURRENT_DATE, INTERVAL -1 MONTH) AND CURRENT_DATE";
                    echo gen_sales($conn, $duration);
                }
                
                if(isset($_GET['year'])) {
                ?>
                <h4 class="header">Sales This Year</h4>
                <?php
                    $duration = "BETWEEN DATE_ADD(CURRENT_DATE, INTERVAL -1 YEAR) AND CURRENT_DATE";
                    echo gen_sales($conn, $duration);
                }
                ?>
            </div>
        </div>
    </body>
</html>
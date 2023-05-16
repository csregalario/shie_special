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
<div class="container-fluid">
  <div class="row">
    <div class="col-md-3">
      <!-- sidebar -->
    </div>
	
    <div class="container-fluid">
    <div class="row">
        <div class="col-md-9">
            <h3 class="display-6 text-center text-white">SALES</h3>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3 bg-image">
                    </div>
                    <div class="col-md-7 ml-3 my-3">
                        <div class="row justify-content-right">
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
                </div>
            </div>
        </div>
        <?php
    if (isset($_POST['filter_date'])) {
            // Retrieve sales report for a specific date
            $date = $_POST['this_date'];
            getSalesReportByDay($conn, $date);
        } else if (isset($_POST['filter_range'])) {
            // Retrieve sales report for a range of dates
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];
            getSalesReportByRange($conn, $start_date, $end_date);
        } else {
            // Retrieve sales report for all orders
            $date = date('Y-m-d');
            getSalesReportByDay($conn, $date);
        }

    ?>
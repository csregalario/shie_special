
    <!DOCTYPE html>
<html>

<head>
    <title>Update Item</title>
    <!-- Link to Bootstrap CSS -->
<!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">-->

</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <div class="col-7 mx-auto my-3 text-light">

                <h1>Update Item</h1>
                    <?php 
                    if(isset($_GET['status'])){?>
                        
                        <div class="alert alert-secondary"><?php echo $_GET['status'];?></div>
                    <?php }
                    ?>

                    <form action="update.php" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="item_name">Item Name</label>
                            <input type="text" class="form-control" id="item_name" name="item_name" required>
                        </div>

                        <div class="mb-3 w-25">
                            <img src="../img/<?php echo  $item['item_file'];?>" alt="" class="img-fluid object-fit-lg-contain border rounded">
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label fw-semibold"  for="item_file">Item Image</label>
                            <input type="file" id="item_file" name="item_file">
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label fw-semibold"  for="item_price">Item Price <br> <i class="text-secondary">Note: If you are adjusting a price, make sure to put effectivity date or it will not take effect.</i> </label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="item_price" name="item_price" value="<?php echo ucwords($item['item_price']);?>" required placeholder="Price">                            
                                    <span class="input-group-text">Effective Start</span>
                                    <input type="date" class="form-control" name="start_date">
                                    <span class="input-group-text">Effective End</span>
                                    <input type="date" class="form-control" name="end_date">

                                </div>  
                         </div>
                            <button type="submit" name="submit" value="Done" class="btn btn-lg btn-primary">Submit</button>

                    </form>
            </div>
        </div>
    </div>

 
</body>

</html>
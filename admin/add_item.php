
<!DOCTYPE html>
<html>

<head>
    <title>Add Item</title>
    <!-- Link to Bootstrap CSS -->
<!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
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
   
  </style>


</head>

<body>

    <div class="container-fluid">
    <div class="row">
        <div class="col-5 mx-auto my-4 text-light">
            <div class="text-left">
                <h1 style="font-size: 30px;">Add Item</h1>
                <?php if(isset($_GET['status'])){?>
                    <div class="alert alert-secondary"><?php echo htmlentities($_GET['status']);?></div>
                <?php }?>
            </div>
             <form action="insert.php" method="post" enctype="multipart/form-data">
           
                <div class="form-group">
                    <label for="item_name">Item Name</label>
                    <input type="text" class="form-control" id="item_name" name="item_name" required>
                </div>

                <div class="form-group">
                    <label for="item_price">Item Price</label>
                    <input type="number" class="form-control" id="item_price" name="item_price" required>
                </div>

                <div class="form-group">
                    <label for="item_file">Item File</label>
                    <input type="file" id="item_file" name="item_file" required>
                </div>

                <button type="submit" name="submit" value="Done" class="btn btn-primary">Submit</button>            </form>
        </div>
    </div>
</div>





    

    <!-- Link to jQuery -->
<!--    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>-->
    <!-- Link to Bootstrap JS -->
<!--    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->

</body>

</html>
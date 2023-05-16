<?php

if(isset($_GET['user_id'])){
    $user_id  = $_GET['user_id'];
    $fname=$_GET['fname'];
    $lname=$_GET['lname'];
    $password = $_GET['password'];
    $address = $_GET['address'];
    $contact_num = $_GET['contact_num'];
    }
?>

<!DOCTYPE html>
<html>

<head>
    <title>Users</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
    <!-- Link to Bootstrap CSS -->
<!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
</head>

<body class="bg-transparent text-light">
    <div class="container-fluid bg-light text-light">  
    <div class="row">
            <div class="col-7 text-center bg-transparent border border-dark">
                <h1>ADMIN DASHBOARD</h1>
            </div>
        </div> 
        <div class="row">
            <div class="col-7">
                <h3 class="display text-center mt-3 mb-3">
                    Users
                </h3>
    <div class="container">
        <div class="row">
        <div class="col-3"></div>
        <div class="col-6 blur bg-transparent border border-light mb-2" style="color: light;">
                <h3 class="mt-2 text-center">Update Record</h3>
                <form action="view_user_update.php" method="POST">
                    <div class="mt-4 mb-3">
                       <label for="">Firstname</label>
                        <input type="text" name="fname" placeholder="Enter Firstname" value="<?php echo $fname; ?>" class="form-control">
                    </div>
                    <div class="mb-3">
                       <label for="">Lastname</label>
                        <input type="text" name="lname" placeholder="Enter Lastname" value="<?php echo $lname; ?>" class="form-control">
                    </div>
                    <div class="mb-3">
                       <label for="">Password</label>
                        <input type="password" name="password" placeholder="" value="<?php echo $password; ?>" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" name="address" placeholder="Enter Address" value="<?php echo $address; ?>" class="form-control">
                    </div>
                    <div class="mb-4">
                        <label for="contact_number" class="form-label">Contact Number</label>
                        <input type="text" name="contact_num" placeholder="Enter Contact Number" value="<?php echo $contact_num; ?>" class="form-control">
                    </div>
                    <a class="btn btn-primary mb-5" href="index.php?viewuser">back</a>
                    <input type="submit" class="btn btn-success float-end">
                </form>
            </div>
            <div class="col-3"></div>
            
        </div>
    </div>

    <!-- Link to jQuery -->
<!--    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>-->
    <!-- Link to Bootstrap JS -->
<!--    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->

</body>


</html>
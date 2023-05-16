<!DOCTYPE html>
<html>

<head>
    <title>Users</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
    <!-- Link to Bootstrap CSS -->
<!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
</head>

<body class="bg-warning text-light">
    <div class="container-fluid bg-transparent text-light">   
        <div class="row">
            <div class="col-7 mx-auto my-3">
                <h3 class="display">
                    USERS
                </h3>
    <div class="container">
        <div class="row">
            <form action="" method="POST">
                <div class="input-group mb-3 w-50">
                    <input type="search" placeholder="Search for an Item" name="searchkey" class="form-control" />
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </div>
            </form>

            <div class="col-12 p-3 mb-2 bg-transparent" style="color: light;">
               <h3>Records</h3>
                <?php

                    if (isset($_POST['searchkey'])) {
                    $searchkey = $_POST['searchkey'];
                    $userlist = query($conn, "select user_id
                                        , fname
                                        , lname
                                        , password
                                        , address
                                        , contact_num
                                        , user_type
                                        , user_stats
                                        FROM user
                                        WHERE fname LIKE '%{$searchkey}%' OR lastname LIKE '%{$searchkey}%'
                                        ORDER BY user_stats, user_type DESC");
                    }else{
                        $userlist = query($conn, "SELECT user_id
                                        , fname
                                        , lname
                                        , password
                                        , address
                                        , contact_num
                                        , user_type
                                        , user_stats
                                        FROM user 
                                        ORDER BY user_stats, user_type DESC");
                    }

                       echo "<table class='table table-bordered' text-white >";
                        echo "<thead class ='text-white'>";
                            echo "<th>Firstname</th>";
                            echo "<th>Lastname</th>";
                            echo "<th>Password</th>";
                            echo "<th>Address</th>";
                            echo "<th>Contact Number</th>";
                            echo "<th>User Type</th>";
                            echo "<th>User Status</th>";
                            echo "<th>Date Added</th>";
                            echo "<th>Update</th>";
                            echo "<th>Remove</th>";
                            

                        echo "</thead>";
                    foreach($userlist as $key => $row){
                        echo "<tr class='text-white'>";
                        echo "<td>" . $row['fname'] . "</td>";
                        echo "<td>" . $row['lname'] . "</td>";
                        echo "<td>" . $row['password'] . "</td>";
                        echo "<td>" . $row['address'] . "</td>";
                        echo "<td>" . $row['contact_num'] . "</td>";
                        echo "<td>" . $row['user_type'] . "</td>";
                        echo "<td>" . $row['user_stats'] . "</td>";
                        echo "<td>" . (isset($row['date_added']) ? $row['date_added'] : '') . "</td>";
                        

                            echo "<td> <a class='btn btn-success' href='view_user_submit.php?password=" . $row['password'] . "&fname=" .$row['fname'] . "&lname=" .$row['lname'] .  "&user_id=". $row['user_id'] . "&address=". $row['address'] . "&contact_num=" . $row['contact_num'] . "&user_type=" . $row['user_type'] . "' > 🔘 </a> </td>";
                            echo "<td> <a class='btn btn-danger' href='view_user_delete.php?user_id=". $row['user_id'] ." ' > 🔘 </a> </td>";
                            
                        echo "</tr>";
                    }
                    echo "</table>";
                
                ?>
                
            </div>
            <div class="col-1"></div>
        </div>
    </div>

    <!-- Link to jQuery -->
<!--    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>-->
    <!-- Link to Bootstrap JS -->
<!--    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->

</body>

</html>
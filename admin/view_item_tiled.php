<!DOCTYPE html>
<html>

<head>
    <title>Items</title>
    <!-- Link to Bootstrap CSS -->
<!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
    <style>
        .product {
            position: relative;
        }

        .product img {
            width: 100%;
            height: auto;
        }

        .overlay {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: rgba(0, 0, 0, 0.5);
            color: #fff;
            opacity: 0;
            transition: opacity 0.5s;
        }

        .product:hover .overlay {
            opacity: 1;
        }

        .caption {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }
    </style>
</head>


<body class="bg-dark text-light">

    <div class="container-fluid bg-light text-dark">

        <div class="row z-1">
            <div class="col-12">

                <h3 class="display-3">
                    <a href="?viewitem=1" class="btn btn-primary-outline">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-table" viewBox="0 0 16 16">
                            <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm15 2h-4v3h4V4zm0 4h-4v3h4V8zm0 4h-4v3h3a1 1 0 0 0 1-1v-2zm-5 3v-3H6v3h4zm-5 0v-3H1v2a1 1 0 0 0 1 1h3zm-4-4h4V8H1v3zm0-4h4V4H1v3zm5-3v3h4V4H6zm4 4H6v3h4V8z" />
                        </svg>
                    </a>
                    Items
                </h3>
                <form action="?view_item" method="get">
                    <input type="search" placeholder="Search for an Item" name="searchkey" class="form-control mb-3" />
                </form>

                <?php
                
//                $ITEM_STOCK_DETAIL_SQL = "SELECT p.item_id, 
//                                               p.item_name, 
//                                               p.item_desc, 
//                                               p.item_file, 
//                                               p.date_added, 
//                                               COALESCE(pr.item_price,0) as item_price, 
//                                               c.cat_desc, 
//                                               c.cat_id,
//                                               p.item_status, 
//                                               COALESCE(sk.total_stock_qty, 0) total_stock_qty,
//                                               COALESCE(o.total_item_qty, 0) total_order_qty,
//                                               COALESCE(sk.total_stock_qty, 0) - COALESCE(o.total_item_qty, 0) AS current_stock_qty
//                                        FROM products p
//                                        JOIN category c ON p.cat_id = c.cat_id
//                                        LEFT JOIN (
//                                            SELECT item_id, MAX(price_id) AS price_id
//                                            FROM pricing
//                                            WHERE (CURRENT_DATE between eff_start_dt and eff_end_dt)
//                                            or (eff_start_dt is null)
//                                            GROUP BY item_id
//                                        ) AS prmax 
                //                          ON p.item_id = prmax.item_id
//                                        JOIN pricing pr 
                //                          ON prmax.item_id = pr.item_id AND prmax.price_id = pr.price_id
//                                        LEFT JOIN (
//                                            SELECT item_id, SUM(stock_qty) AS total_stock_qty
//                                            FROM stock
//                                            GROUP BY item_id
//                                        ) AS sk ON p.item_id = sk.item_id
//                                        LEFT JOIN (
//                                            SELECT item_id, SUM(item_qty) AS total_item_qty
//                                            FROM orders
//                                            WHERE order_status not in ('C','X')
//                                            GROUP BY item_id
//                                        ) AS o ON p.item_id = o.item_id
//                                        GROUP BY p.item_id, 
//                                                 p.item_name, 
//                                                 p.item_desc, 
//                                                 p.item_file, 
//                                                 p.date_added, 
//                                                 pr.item_price, 
//                                                 c.cat_desc, 
//                                                 p.item_status";
                $ITEM_STOCK_DETAIL="SELECT * FROM item_stock_detail;"; //VIEW
                $items = query($conn, $ITEM_STOCK_DETAIL);?>

                <div class="row">
                    <?php foreach($items as $item){ ?>
                    <div class="col-3 p-0">
                        <div class="card mb-0 border-0">
                            <div class="product">
                                <div class="d-flex justify-content-center align-items-center" style="width: 300px; height: 300px;">
                                      <img class="img-fluid" style="object-fit: cover" src="../img/<?php echo $item['item_file'];?>" alt="">
                                </div>
                           
<!--                                <img src="../img/<?php echo $item['item_file'];?>" alt="" class="card-img-top object-fit-contain" style="height:300px;width:auto;position:center">-->
                                <div class="overlay  overflow-y-auto" height="300px">
                                    <div class="caption">
                                        <p>Total Stock: <?php echo $item['total_stock_qty']; ?>
                                        <br>Total Orders: <?php echo $item['total_order_qty']; ?>
                                        <br>Current Available: <?php echo $item['current_stock_qty']; ?></p>
                                        <h3 class="card-title"> <?php  echo ucwords($item['item_name']); ?></h3>
                                <small class="card-text text-truncate overflow-y-visible"> <?php echo $item['item_desc']; ?> </small>
                                <blockquote class="blockquote"><?php echo CURRENCY . number_format($item['item_price'],2) ;?></blockquote>
                                    </div>
                                </div>
                            </div>
                            <ul class="list-group list-group-flush mb-0 pb-0">
                                <li class="list-group-item mb-0 pb-0">
                                    <div class="btn-group mb-0">
                                        <a href="?updateitem=<?php echo $item['item_id'];?>" class="btn btn-sm mb-0 btn-outline-success"> <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                            </svg> </a>
                                        <?php if($item['item_status'] == 'A') { ?>
                                        <a title="Deactivate Item" href="?viewitem=2&deacitem=<?php echo $item['item_id'];?>" class="btn btn-outline-danger">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-toggle-off" viewBox="0 0 16 16">
                                                <path d="M11 4a4 4 0 0 1 0 8H8a4.992 4.992 0 0 0 2-4 4.992 4.992 0 0 0-2-4h3zm-6 8a4 4 0 1 1 0-8 4 4 0 0 1 0 8zM0 8a5 5 0 0 0 5 5h6a5 5 0 0 0 0-10H5a5 5 0 0 0-5 5z" />
                                            </svg></a>
                                        <?php }
                                                            if($item['item_status'] == 'D'){ ?>
                                        <td> <a title="Reactivate item" href="?viewitem=2&reacitem=<?php echo $item['item_id'];?>" class="btn btn-outline-success ">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-toggle-on" viewBox="0 0 16 16">
                                                    <path d="M5 3a5 5 0 0 0 0 10h6a5 5 0 0 0 0-10H5zm6 9a4 4 0 1 1 0-8 4 4 0 0 1 0 8z" />
                                                </svg>
                                            </a>
                                            <?php } ?>
                                    </div>
                                    <div class="float-right">
                                            <?php  echo "<span title='". ($item['item_status']=='A'? 'Active' : 'Discontinued')  ."'>" . ($item['item_status']=='A'? $active :$inactive) . "</span>"; ?>
                                        
                                    </div>
                                </li>

                            </ul>
                        </div>

                    </div>
                    <?php } ?>
                </div>

            </div>
        </div>


    </div>

    <!-- Link to jQuery -->
<!--    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>-->
    <!-- Link to Bootstrap JS -->
<!--    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->

</body>

</html>
<?php
session_start();
require 'db.php';

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == 0) {
    $_SESSION['message'] = "You need to first login to access this page!";
    header("Location: Login/error.php");
    exit();
}

$fid = $_SESSION['id'];

// Retrieve farmer information
$farmer_query = mysqli_query($conn, "SELECT * FROM farmer WHERE fid = '$fid'");
$farmer_row = mysqli_fetch_assoc($farmer_query);
$farmer_name = $farmer_row['fname'];
$farmer_email = $farmer_row['femail'];

// Retrieve orders for the farmer
$sql = "SELECT * FROM orders WHERE fid = '$fid'";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Farmers Stock Trading: Farmer Orders</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!--[if lte IE 8]><script src="css/ie/html5shiv.js"></script><![endif]-->
    <link rel="stylesheet" href="login.css" />
    <script src="js/jquery.min.js"></script>
    <script src="js/skel.min.js"></script>
    <script src="js/skel-layers.min.js"></script>
    <script src="js/init.js"></script>
    <noscript>
        <link rel="stylesheet" href="css/skel.css" />
        <link rel="stylesheet" href="css/style.css" />
        <link rel="stylesheet" href="css/style-xlarge.css" />
    </noscript>
    <!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
</head>

<body>

    <?php require 'menu.php'; ?>

    <section id="main" class="wrapper style1 align-center">
        <div class="container">
            <h2>Orders for <?php echo $farmer_name; ?></h2>

            <section id="two" class="wrapper style2 align-center">
                <div class="container">
                    <div class="row">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Buyer</th>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                                    <?php
                                    $order_id = $row['oid'];
                                    $bid = $row['bid'];
                                    $pid = $row['pid'];
                                    $quantity = $row['quantity'];
                                    $status = $row['status'];

                                    // Retrieve buyer information
                                    $buyer_query = mysqli_query($conn, "SELECT * FROM buyer WHERE bid = '$bid'");
                                    $buyer_row = mysqli_fetch_assoc($buyer_query);
                                    $buyer_name = $buyer_row['bname'];

                                    // Retrieve product information
                                    $product_query = mysqli_query($conn, "SELECT * FROM fproduct WHERE pid = '$pid'");
                                    $product_row = mysqli_fetch_assoc($product_query);
                                    $product_name = $product_row['product'];
                                    ?>

                                    <tr>
                                        <td><?php echo $order_id; ?></td>
                                        <td><?php echo $buyer_name; ?></td>
                                        <td><?php echo $product_name; ?></td>
                                        <td><?php echo $quantity; ?></td>
                                        <td><?php echo $status; ?></td>


                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </section>

</body>

</html>

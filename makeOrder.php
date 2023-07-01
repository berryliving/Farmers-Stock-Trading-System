<?php
session_start();
require 'db.php';

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == 0) {
    $_SESSION['message'] = "You need to first login to access this page!";
    header("Location: Login/error.php");
    exit();
}

$bid = $_SESSION['id'];

if (isset($_GET['flag'])) {
    $pid = $_GET['pid'];

    $sql = "INSERT INTO mycart (bid, pid) VALUES ('$bid', '$pid')";
    $result = mysqli_query($conn, $sql);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Farmers Stock Trading: Make Order</title>
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

    <?php
    require 'menu.php';

    function dataFilter($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Make order
    if (isset($_POST['make_order'])) {
        // Get the selected product ID and quantity from the form
        $fid = $_POST['fid'];
        $bid = $_POST['bid'];
        $pid = $_POST['pid'];
        $quantity = $_POST['quantity'];

        // Insert the order into the database
        $sql = "INSERT INTO orders (fid, bid, pid, quantity) VALUES ('$fid','$bid', '$pid', '$quantity')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            // Retrieve buyer information
            $buyer_query = mysqli_query($conn, "SELECT * FROM buyer WHERE bid = '$bid'");
            $buyer_row = mysqli_fetch_assoc($buyer_query);
            $buyer_name = $buyer_row['bname'];
            $buyer_email = $buyer_row['bemail'];

            // Retrieve product information
            $product_query = mysqli_query($conn, "SELECT * FROM fproduct WHERE pid = '$pid'");
            $product_row = mysqli_fetch_assoc($product_query);
            $product_name = $product_row['product'];

            // Retrieve farmer information
            $farmer_query = mysqli_query($conn, "SELECT * FROM farmer WHERE fid = '$fid'");
            $farmer_row = mysqli_fetch_assoc($farmer_query);
            $farmer_name = $farmer_row['name'];
            $farmer_email = $farmer_row['email'];

            // Display success message with order details
            $_SESSION['message'] = "Order placed successfully!";
            $_SESSION['order_details'] = "Buyer: $buyer_name ($buyer_email)<br>";
            $_SESSION['order_details'] .= "Product: $product_name<br>";
            $_SESSION['order_details'] .= "Quantity: $quantity<br>";
            $_SESSION['order_details'] .= "Farmer: $farmer_name ($farmer_email)";

            header("Location: Login/success.php");
            exit();
        } else {
            $_SESSION['message'] = "Failed to place the order. Please try again.";
            header("Location: Login/error.php");
            exit();
        }
    }
    ?>

    <!-- One -->
    <section id="main" class="wrapper style1 align-center">
        <div class="container">
            <h2>Make Order</h2>

            <section id="two" class="wrapper style2 align-center">
                <div class="container">
                    <div class="row">
                        <?php
                        $sql = "SELECT * FROM fproduct";
                        $result = mysqli_query($conn, $sql);

                        while ($row = $result->fetch_assoc()) {
                            $fid = $row['fid'];
                            // $bid = $row['bid'];
                            $pid = $row['pid'];
                            $product = $row['product'];
                            $pcat = $row['pcat'];
                            $price = $row['price'];
                            $picDestination = "images/productImages/".$row['pimage'];

                            echo "<div class='col-md-4'>";
                            echo "<section>";
                            echo "<strong><h2 class='title' style='color: black;'>$product</h2></strong>";
                            echo "<img class='image fit' src='$picDestination' alt='' />";
                            echo "<div style='text-align: left'>";
                            echo "<blockquote>Type: $pcat<br>Price: $price /-</blockquote>";
                            echo "</div>";
                            echo "<div style='text-align: left'>";
                            echo "<form method='POST' action=''>";
                            echo "<input type='hidden' name='bid' value='$bid'>";
                            echo "<input type='hidden' name='pid' value='$pid'>";
                            echo "<label for='quantity'>Quantity:</label>";
                            echo "<input type='number' name='quantity' id='quantity' value='1' min='1'>";
                            echo "<button type='submit' name='make_order'>Order</button>";
                            echo "</form>";
                            echo "</div>";
                            echo "</section>";
                            echo "</div>";

                        }
                        ?>

                    </div>
                </div>
            </section>
        </div>
    </section>

</body>

</html>

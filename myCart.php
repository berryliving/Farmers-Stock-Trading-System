<?php
    session_start();
    require 'db.php';
    
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == 0) {
        $_SESSION['message'] = "You need to first login to access this page !!!";
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
    <title>Farmers stock trading: My Cart</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!--[if lte IE 8]><script src="css/ie/html5shiv.js"></script><![endif]-->
    <link rel="stylesheet" href="login.css"/>
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

	// Remove item from cart
if (isset($_GET['remove'])) {
    $pid = $_GET['remove'];

    $sql = "DELETE FROM mycart WHERE bid = '$bid' AND pid = '$pid'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $_SESSION['message'] = "Item removed from cart successfully!";
        header("Location: myCart.php");
        exit();
    }
}

if (isset($_GET['flag'])) {
    $pid = $_GET['pid'];

    $sql = "INSERT INTO mycart (bid, pid) VALUES ('$bid', '$pid')";
    $result = mysqli_query($conn, $sql);
}

// Make order
if (isset($_POST['make_order'])) {
    // Perform the necessary actions to make the order
    // ...

    // Once the order is successfully made, you can redirect to a success page
    $_SESSION['message'] = "Order placed successfully!";
    header("Location: orderSuccess.php");
    exit();
}
?>

<!-- One -->
<section id="main" class="wrapper style1 align-center">
    <div class="container">
        <h2>My Cart</h2>

        <section id="two" class="wrapper style2 align-center">
            <div class="container">
                <div class="row">
                    <?php
                        $sql = "SELECT * FROM mycart WHERE bid = '$bid'";
                        $result = mysqli_query($conn, $sql);

                        while ($row = $result->fetch_array()) {
                            $pid = $row['pid'];
                            $sql = "SELECT * FROM fproduct WHERE pid = '$pid'";
                            $result1 = mysqli_query($conn, $sql);
                            
                            if ($result1 && $result1->num_rows > 0) {
                                $row1 = $result1->fetch_assoc();
                                $picDestination = isset($row1['pimage']) ? "images/productImages/" . $row1['pimage'] : "images/default-image.jpg";
                                $product = isset($row1['product']) ? $row1['product'] : "N/A";
                                $pcat = isset($row1['pcat']) ? $row1['pcat'] : "N/A";
                                $price = isset($row1['price']) ? $row1['price'] : "N/A";
                            } else {
                                $picDestination = "images/default-image.jpg";
                                $product = "N/A";
                                $pcat = "N/A";
                                $price = "N/A";
                            }
                    ?>
                        <div class="col-md-4">
                            <section>
                                <strong><h2 class="title" style="color: black;"><?php echo $product; ?></h2></strong>
                                <a href="review.php?pid=<?php echo $pid; ?>">
                                    <img class="image fit" src="<?php echo $picDestination; ?>" alt="" />
                                </a>
                                <div style="text-align: left">
                                    <blockquote><?php echo "Type: " . $pcat; ?><br><?php echo "Price: " . $price . ' /-'; ?><br></blockquote>
                                </div>
                            </section>
                        </div>
                    <?php } ?>

                    <!-- <div class="col-12">
                        <br />
                        <a href="makeOrder.php" class="button special">Make Order</a>
                    </div> -->
                </div>
            </div>
        </section>
    </div>
</section>

</body>
</html>

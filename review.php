<?php
session_start();
require 'db.php';

if (isset($_GET['pid'])) {
    $pid = $_GET['pid'];
} else {
    // Handle the case when 'pid' is not found
}

if (isset($_GET['fid'])) {
    $fid = $_GET['fid'];
} else {
    // Handle the case when 'fid' is not found
}

$picDestination = ""; // Define the variable

if (isset($pid)) {
    // Fetch product information
    $productSql = "SELECT * FROM fproduct WHERE pid = $pid";
    $productResult = mysqli_query($conn, $productSql);
    if ($productResult && mysqli_num_rows($productResult) > 0) {
        $row = mysqli_fetch_assoc($productResult);
        $picDestination = "images/productImages/" . $row['pimage']; // Assign the image path

        // Fetch farmer information
        if (isset($fid)) {
            $farmerSql = "SELECT * FROM farmer WHERE fid = '$fid'";
            $farmerResult = mysqli_query($conn, $farmerSql);
            if ($farmerResult && mysqli_num_rows($farmerResult) > 0) {
                $farmer_row = mysqli_fetch_assoc($farmerResult);
                $farmerName = $farmer_row['fname'];
            } else {
                // Handle the case when farmer information is not found
            }
        } else {
            // Handle the case when 'fid' is not found
        }
    } else {
        // Handle the case when product information is not found
    }
}


if (isset($_POST['add_to_cart'])) {
    $pid = $_POST['pid'];
    $quantity = $_POST['quantity'];

    // Fetch the farmer's stock
    $stockSql = "SELECT * FROM fproduct WHERE pid = '$pid'";
    $stockResult = mysqli_query($conn, $stockSql);
    if ($stockResult && mysqli_num_rows($stockResult) > 0) {
        $row = mysqli_fetch_assoc($stockResult);
        $availableQuantity = $row['quantity'];

        if ($quantity <= $availableQuantity) {
            // Add the product to the cart
            $cartSql = "INSERT INTO mycart (bid, pid, quantity) VALUES ('$bid', '$pid', '$quantity')";
            $cartResult = mysqli_query($conn, $cartSql);

            if ($cartResult) {
                // Reduce the quantity from the farmer's stock
                $newQuantity = $availableQuantity - $quantity;
                $updateStockSql = "UPDATE fproduct SET quantity = '$newQuantity' WHERE pid = '$pid'";
                $updateStockResult = mysqli_query($conn, $updateStockSql);

                if ($updateStockResult) {
                    $_SESSION['message'] = "Item added to cart successfully!";
                    header("Location: myCart.php");
                    exit();
                } else {
                    $_SESSION['message'] = "Error: Failed to update the quantity in the farmer's stock.";
                }
            } else {
                $_SESSION['message'] = "Error: Failed to add item to cart.";
            }
        } else {
            $_SESSION['message'] = "Error: The entered quantity exceeds the available stock.";
        }
    } else {
        $_SESSION['message'] = "Error: Failed to fetch the stock quantity.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Farmers stock trading</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <link href="bootstrap\css\bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="bootstrap\js\bootstrap.min.js"></script>
    <!--[if lte IE 8]><script src="css/ie/html5shiv.js"></script><![endif]-->
    <script src="js/jquery.min.js"></script>
    <script src="js/skel.min.js"></script>
    <script src="js/skel-layers.min.js"></script>
    <script src="js/init.js"></script>
    <link rel="stylesheet" href="Blog/commentBox.css" />
    <noscript>
        <link rel="stylesheet" href="css/skel.css" />
        <link rel="stylesheet" href="css/style.css" />
        <link rel="stylesheet" href="css/style-xlarge.css" />
    </noscript>
</head>
<body>
    <?php require 'menu.php'; ?>

    <section id="main" class="wrapper style1 -center">
        <div class="12u$">
            <center>
                <div class="row uniform">
                    <div class="6u 12u$(large)">
                        <form method="POST" action="">
                            <input type="hidden" name="pid" value="<?= $pid ?? ''; ?>">
                            <!-- <input type="number" name="quantity" value="1" min="1" max="<?= $row['quantity'] ?? ''; ?>" required> -->
                            <input type="submit" name="add_to_cart" value="Add to Cart">
                        </form>
                    </div>
                    <div class="6u 12u$(large)">
                        <a href="buyNow.php?pid=<?= $pid ?? ''; ?>" class="btn btn-primary" style="text-decoration: none;">Buy Now</a>
                    </div>
                </div>
            </center>
        </div><br>
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <img class="image fit" src="<?php echo $picDestination ?? ''; ?>" alt="" />
                </div><!-- Image of farmer-->

                <div style="text-align: left">
                    <blockquote>
                        <?php echo "Type: ".$row['pcat']; ?><br>
                        <?php echo "Quantity: ".$row['quantity']; ?><br>
                        <input type="number" name="quantity" value="1" min="1" max="<?= $row['quantity'] ?? ''; ?>" required>
                        <?php echo "Price: ".$row['price']." /-Tsh"; ?><br>
                        <?php echo "Farmer: ".$fname; ?><br>
                    </blockquote>
                </div>
            </div><br />
            <div class="row">
                <div class="col-12 col-sm-12" style="font: 25px Times New Roman;">
                    <?= $row['pinfo'] ?? ''; ?>
                </div>
            </div>
        </div>

        <!-- <div class="container">
            <center>
            <h1>Product Reviews</h1>
            <div class="row">
                <?php
                // $sql = "SELECT * FROM review WHERE pid=0";
                // $result = mysqli_query($conn, $sql);
                // if ($result) {
                //     while ($row1 = $result->fetch_array()) {
                        ?>
                        <div class="con">
                            <div class="row">
                                <div class="col-sm-4">
                                    <em style="color: black;"><?= $row1['comment'] ?? ''; ?></em>
                                </div>
                                <div class="col-sm-4">
                                    <em style="color: black;"><?php echo "Rating: " . $row1['rating'] . ' out of 10'; ?></em>
                                </div>
                            </div>
                            <span class="time-right" style="color: black;"><?php echo "From: " . $row1['name']; ?></span>
                            <br /><br />
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
            </center>
        </div>

        <div class="container">
            <center>
            <p style="font: 20px Times New Roman;">Rate this product</p><br>
            <form method="POST" action="reviewInput.php?pid=<?= $pid ?? ''; ?>">
                <div class="row">
                    <div class="col-sm-7">
                        <textarea style="background-color:white;color: black;" cols="5" name="comment" placeholder="Write a review"></textarea>
                    </div>
                    <div class="col-sm-5">
                        <br />
                        Rating: <input type="number" min="0" max="10" name="rating" value="0"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <br />
                        <input type="submit" />
                    </div>
                </div>
            </form>
            </center>
        </div> -->
    </section>
</body>
</html>

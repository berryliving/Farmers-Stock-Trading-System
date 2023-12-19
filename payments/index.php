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

    // Fetch farmer information
    $farmerSql = "SELECT * FROM farmer WHERE fid = $fid";
    $farmerResult = mysqli_query($conn, $farmerSql);
    if ($farmerResult && mysqli_num_rows($farmerResult) > 0) {
        $farmer_row = mysqli_fetch_assoc($farmerResult);
        $farmer_phone = $farmer_row['phone']; // Get the farmer's phone number
    } else {
        // Handle the case when farmer information is not found
    }
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
    } else {
        // Handle the case when product information is not found
    }
}

if (isset($_POST['make_payment'])) {
    $pid = $_POST['pid'];
    $quantity = $_POST['quantity'];

    // Fetch the product's price
    $priceSql = "SELECT price FROM fproduct WHERE pid = '$pid'";
    $priceResult = mysqli_query($conn, $priceSql);
    if ($priceResult && mysqli_num_rows($priceResult) > 0) {
        $priceRow = mysqli_fetch_assoc($priceResult);
        $productPrice = $priceRow['price'];

        // Calculate the total price
        $totalPrice = $quantity * $productPrice;

        // Generate payment reference number
        $paymentRef = generatePaymentReference();

        // Save the payment details in the database
        $paymentSql = "INSERT INTO payments (pid, quantity, payment_ref) VALUES ('$pid', '$quantity', '$paymentRef')";
        $paymentResult = mysqli_query($conn, $paymentSql);

        if ($paymentResult) {
            $_SESSION['message'] = "Payment details saved successfully! Please make the payment using the provided M-Pesa number.";
            $_SESSION['payment_ref'] = $paymentRef;
            header("Location: payment.php");
            exit();
        } else {
            $_SESSION['message'] = "Error: Failed to save payment details.";
        }
    }
}

// Function to generate a payment reference number
function generatePaymentReference() {
    // Generate a random alphanumeric string
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $reference = '';
    $length = 10;

    for ($i = 0; $i < $length; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $reference .= $characters[$index];
    }

    return $reference;
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
                        <form method="POST" action="index.php?fid=<?= $fid ?? ''; ?>">
                            <input type="hidden" name="pid" value="<?= $pid ?? ''; ?>">
                            <input style="color: black;" type="number" name="quantity" value="1" min="1" max="<?= $row['quantity'] ?? ''; ?>" required>
                            <input type="submit" name="make_payment" value="Make Payment">
                        </form>
                    </div>
                </div>
            </center>
        </div><br>
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <img class="image fit" src="<?php echo $picDestination ?? ''; ?>" alt="" />
                </div><!-- Image of farmer-->

                <div class="col-12 col-sm-6">
                    <p style="font: 50px Times New Roman;"><?= $row['product'] ?? 'Not Available'; ?></p>
                    <?php if (isset($farmer_phone)): ?>
                        <p style="font: 30px Times New Roman;">Product Owner: <?= $farmer_row['name']; ?></p>
                        <p style="font: 30px Times New Roman;">Price: <?= $row['price'] ?? 'Not Available'.' /-Tsh'; ?></p>
                        <p style="font: 30px Times New Roman;">Payment Phone Number: <?= $farmer_phone; ?></p>
                    <?php else: ?>
                        <p style="font: 30px Times New Roman;">Product Owner: Not Available</p>
                    <?php endif; ?>
                </div>
            </div><br />
            <div class="row">
                <div class="col-12 col-sm-12" style="font: 25px Times New Roman;">
                    <?= $row['pinfo'] ?? ''; ?>
                </div>
            </div>
        </div>

        <div class="container">
            <center>
                <h1>Payment Details</h1>
                <p><?= $_SESSION['message'] ?? ''; ?></p>
                <p><?= $_SESSION['payment_ref'] ?? ''; ?></p>
            </center>
        </div>
    </section>
</body>
</html>

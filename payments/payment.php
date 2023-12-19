<?php
session_start();
require 'db.php';

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

// Continue with the rest of the payment processing code

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Payment</title>
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
        <div class="container">
            <center>
                <h1>Payment Details</h1>
                <p><?= $_SESSION['message'] ?? ''; ?></p>
                <p><?= $_SESSION['payment_ref'] ?? ''; ?></p>
                <?php if (isset($farmer_phone)): ?>
                    <p style="font: 30px Times New Roman;">Payment Phone Number: <?= $farmer_phone; ?></p>
                <?php else: ?>
                    <p style="font: 30px Times New Roman;">Payment Phone Number: Not Available</p>
                <?php endif; ?>
            </center>
        </div>
    </section>
</body>
</html>

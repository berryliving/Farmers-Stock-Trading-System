
<?php
    session_start();
    require 'db.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $orderId = $_POST['orderId'];
        $amount = $_POST['amount'];
        $paymentStatus = $_POST['paymentStatus'];

        // Update the payment status in the database
        $sql = "UPDATE orders SET payment_status='$paymentStatus' WHERE oid='$orderId';";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $_SESSION['message'] = "Payment received successfully!";
            header("Location: success.php");
            exit();
        } else {
            $_SESSION['message'] = "Failed to update payment status. Please try again.";
            header("Location: error.php");
            exit();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Receive Payment</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <link href="bootstrap\css\bootstrap.min.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="bootstrap\js\bootstrap.min.js"></script>
        <!--[if lte IE 8]><script src="css/ie/html5shiv.js"></script><![endif]-->
        <link rel="stylesheet" href="login.css"/>
        <link rel="stylesheet" type="text/css" href="indexFooter.css">
        <script src="js/jquery.min.js"></script>
        <script src="js/skel.min.js"></script>
        <script src="js/skel-layers.min.js"></script>
        <script src="js/init.js"></script>
        <!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
    </head>
    <body>
        <?php require 'menu.php'; ?>

        <!-- One -->
        <section id="one" class="wrapper style1 align-center">
            <div class="container">
                <form method="POST" action="receivePayment.php">
                    <h2>Receive Payment</h2>
                    <br>
                    <div class="row">
                        <div class="col-sm-6">
                            <input type="text" name="orderId" id="orderId" value="" placeholder="Order ID" style="background-color: white; color:black" required />
                        </div>
                        <div class="col-sm-6">
                            <input type="text" name="amount" id="amount" value="" placeholder="Amount" style="background-color: white; color:black" required />
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-12">
                            <input type="text" name="paymentStatus" id="paymentStatus" value="" placeholder="Payment Status" style="background-color: white; color:black" required />
                        </div>
                    </div>
                    <br>
                    <div class="row uniform">
						<div class="6u 12u$(xsmall)">
							<button class="button fit" onclick="document.getElementById('id01').style.display='block'" style="width:auto; background-color:darkgray">Recive Payment</button>
						</div>
                    </div>
                </form>
            </div>
        </section>
    </body>
</html>

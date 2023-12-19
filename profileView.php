<?php
    session_start();

	if(!isset($_SESSION['logged_in']) OR $_SESSION['logged_in'] != 1)
	{
		$_SESSION['message'] = "You have to Login to view this page!";
		header("Location: Login/error.php");
	}
?>

<!DOCTYPE HTML>

<html lang="en">
    <head>
        <title>Profile: <?php echo $_SESSION['Username']; ?></title>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link href="bootstrap\css\bootstrap.min.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="bootstrap\js\bootstrap.min.js"></script>
        <meta name="description" content="" />
		<meta name="keywords" content="" />
		<!--[if lte IE 8]><script src="css/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="login.css"/>
		<script src="js/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-layers.min.js"></script>
		<script src="js/init.js"></script>
		<link rel="stylesheet" href="css/skel.css" />
		<link rel="stylesheet" href="css/style.css" />
		<link rel="stylesheet" href="css/style-xlarge.css" />

        <style>
        /* Styling for the side navigation bar */
        .sidenav {
            width: 200px;
            background-color: #f1f1f1;
            padding: 20px;
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            overflow-y: auto;
        }

        /* Styling for the side navigation bar buttons */
        .sidenav a {
            display: block;
            margin-bottom: 30px;
            margin-top: 10px;
            text-decoration: none;
            color: #000;
            background-color: #ddd;
            padding: 10px;
        }

        /* Styling for the active button */
        .sidenav a.active {
            background-color: #555;
            color: #fff;
        }

        /* Styling for the content section */
        .content-section {
            margin-left: 220px; /* Adjust the margin to provide space for the side navigation bar */
            padding: 20px; /* Add padding to the content section to avoid overlapping with the sidebar */
        }
    </style>

    </head>


    <body>

        <div class="sidenav">
            <a class="btn btn-danger" href="profileView.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                Dashboard</a>
            <a href="uploadProduct.php" class="btn btn-danger">Post Crops</a>
            <a href="myProducts.php" class="btn btn-danger">My Products</a>
            <a href="viewOrder.php" class="btn btn-danger">View Order</a>
            <!-- <a href="receivePayment.php" class="btn btn-danger">Receive Payment</a> -->
            <a href="Login/logout.php" class="btn btn-danger">Logout</a>
        </div>j8

        <section id="one" class="wrapper style1 align">
            <div class="inner">
                <div class="box">
                
                <header>
                    <center>
                    <img src="images/profileImages/profile0.png" alt="">
                    <h2><?php echo $_SESSION['Name'];?></h2>
                    <h4 style="color: black;"><?php echo $_SESSION['Username'];?></h4>
                    <br>
                </center>
                </header>
                    <div class="row">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-3">
                            <b><font size="+1" color="black">RATINGS : </font></b>
                            <font size="+1"><?php echo $_SESSION['Rating'];?></font>
                        </div>
                        <div class="col-sm-3">
                            <b><font size="+1" color="black">Email ID : </font></b>
                            <a href="https://mail.google.com" style="color: #f1f1f1;"><?php echo $_SESSION['Email']; ?></a>
                        </div>
                        <div class="col-sm-3"></div>
                    </div>
                    <br />
                    <div class="row">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-3">
                            <b><font size="+1" color="black">Mobile No : </font></b>
                            <font size="+1"><?php echo $_SESSION['Mobile'];?></font>
                        </div>
                        <div class="col-sm-3">
                            <b><font size="+1" color="black">ADDRESS : </font></b>
                            <font size="+1"><?php echo $_SESSION['Addr'];?></font>
                        </div>
                        <div class="col-sm-3"></div>
                    </div>

                    </div>
                </div>
            </div>
        </section>

        <!-- Scripts -->
            <script src="assets/js/jquery.min.js"></script>
            <script src="assets/js/jquery.scrolly.min.js"></script>
            <script src="assets/js/jquery.scrollex.min.js"></script>
            <script src="assets/js/skel.min.js"></script>
            <script src="assets/js/util.js"></script>
            <script src="assets/js/main.js"></script>



    </body>
</html>

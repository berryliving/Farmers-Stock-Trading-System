<?php
session_start();
require 'db.php';

// Retrieve crop details from the database
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['product'])) {
    $productName = dataFilter($_GET['product']);
    $fid = $_SESSION['id'];

    $sql = "SELECT * FROM fproduct WHERE product = '$productName' AND fid = '$fid'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $crop = mysqli_fetch_assoc($result);
        $productType = $crop['pcat'];
        $productInfo = $crop['pinfo'];
        $productPrice = $crop['price'];
    } else {
        $_SESSION['message'] = "Crop not found!";
        header("Location: Login/error.php");
        exit();
    }
}

// Update crop details in the database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productType = $_POST['type'];
    $productName = dataFilter($_POST['pname']);
    $productInfo = $_POST['pinfo'];
    $productPrice = dataFilter($_POST['price']);
    $fid = $_SESSION['id'];

    $sql = "UPDATE fproduct SET pcat = '$productType', pinfo = '$productInfo', price = '$productPrice' WHERE product = '$productName' AND fid = '$fid'";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        $_SESSION['message'] = "Unable to update Crop!";
        header("Location: Login/error.php");
        exit();
    } else {
        $_SESSION['message'] = "Crop updated successfully!";
        header("Location: Login/success.php");
        exit();
    }
}

function dataFilter($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!DOCTYPE html>
<html lang="en">
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
    <link rel="stylesheet" href="login.css"/>
    <link rel="stylesheet" type="text/css" href="indexFooter.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/skel.min.js"></script>
    <script src="js/skel-layers.min.js"></script>
    <script src="js/init.js"></script>
    <noscript>
        <link rel="stylesheet" href="css/skel.css" />
        <link rel="stylesheet" href="css/style.css" />
        <link rel="stylesheet" href="css/style-xlarge.css" />
    </noscript>
    <script src="https://cdn.ckeditor.com/4.8.0/full/ckeditor.js"></script>
    <!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
</head>
<body>
<?php require 'menu.php'; ?>

<!-- One -->
<section id="one" class="wrapper style1 align-center">
    <div class="container">
        <form method="POST" action="updateCrop.php" enctype="multipart/form-data">
            <h2>Update Crop Information</h2>
            <br>
            <div class="row">
                <div class="col-sm-6">
                    <div class="select-wrapper" style="width: auto">
                        <select name="type" id="type" required style="background-color:white;color: black;">
                            <option value="" style="color: black;">- Category -</option>
                            <option value="Fruit" style="color: black;" <?php if ($productType === 'Fruit') echo 'selected'; ?>>Fruit</option>
                            <option value="Vegetable" style="color: black;" <?php if ($productType === 'Vegetable') echo 'selected'; ?>>Vegetable</option>
                            <option value="Grains" style="color: black;" <?php if ($productType === 'Grains') echo 'selected'; ?>>Grains</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                <input type="text" name="pname" id="pname" value="<?php echo isset($productName) ? $productName : ''; ?>" placeholder="Product Name" style="background-color:white;color: black;" readonly/>

                </div>
            </div>
            <br>
            <div>
            <textarea name="pinfo" id="pinfo" rows="12" style="background-color: white;"><?php echo isset($productInfo) ? $productInfo : ''; ?></textarea>

            </div>
            <br>
            <div class="row">
                <div class="col-sm-6">
                    <input type="text" name="price" id="price" value="<?php echo $productPrice; ?>" placeholder="Price" style="background-color:white;color: black;" />
                </div>
                <div class="col-sm-6">
                    <button class="button fit" style="width:auto; color:black;">Update</button>
                </div>
            </div>
        </form>
    </div>
</section>

<script>
    CKEDITOR.replace('pinfo');
</script>
</body>
</html>

<?php
session_start();
require 'db.php';

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == 0) {
    $_SESSION['message'] = "You need to first login to access this page !!!";
    header("Location: Login/error.php");
    exit();
}

$fid = $_SESSION['id'];

// Handle product update form submission
if (isset($_POST['update_product'])) {
    $pid = $_POST['pid'];
    $productType = $_POST['type'];
    $productName = dataFilter($_POST['pname']);
    $productInfo = $_POST['pinfo'];
    $productPrice = dataFilter($_POST['price']);
    $productQuantity = dataFilter($_POST['quantity']);

    $sql = "UPDATE fproduct SET pcat='$productType', product='$productName', pinfo='$productInfo', price='$productPrice', quantity='$productQuantity' WHERE pid='$pid'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $_SESSION['message'] = "Product updated successfully!";
        header("Location: myProducts.php");
        exit();
    } else {
        $_SESSION['message'] = "Failed to update product!";
        header("Location: myProducts.php");
        exit();
    }
}

$sql = "SELECT * FROM fproduct WHERE fid = '$fid'";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Farmers stock trading: My Products</title>
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

<?php require 'menu.php'; ?>

<!-- One -->
<section id="main" class="wrapper style1 align-center">
    <div class="container">
        <h2>My Products</h2>

        <section id="two" class="wrapper style2 align-center">
            <div class="container">
                <div class="row">
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <div class="col-md-4">
                            <section>
                                <strong><h2 class="title" style="color: black;"><?php echo $row['product']; ?></h2></strong>
                                <?php if ($row['picStatus'] == 1) { ?>
                                    <img class="image fit" src="images/productImages/<?php echo $row['pimage']; ?>" alt="" />
                                <?php } else { ?>
                                    <img class="image fit" src="images/default-image.jpg" alt="" />
                                <?php } ?>
                                <div style="text-align: left">
                                    <blockquote><?php echo "Type: " . $row['pcat']; ?><br><?php echo "Price: " . $row['price'] . ' /-'; ?><br></blockquote>
                                    <form action="myProducts.php" method="post">
                                        <input type="hidden" name="pid" value="<?php echo $row['pid']; ?>">
                                        <label for="type">Type:</label>
                                        <select name="type" id="type">
                                            <option value="Fruit" <?php if ($row['pcat'] == 'Fruit') echo 'selected'; ?>>Fruit</option>
                                            <option value="Vegetable" <?php if ($row['pcat'] == 'Vegetable') echo 'selected'; ?>>Vegetable</option>
                                            <option value="Grains" <?php if ($row['pcat'] == 'Grains') echo 'selected'; ?>>Grains</option>
                                        </select><br>
                                        <label for="pname">Product Name:</label>
                                        <input style="background-color: white; color:black" type="text" id="pname" name="pname" value="<?php echo $row['product']; ?>"><br>
                                        <label for="pinfo">Product Info:</label>
                                        <textarea style="background-color: white; color:black" name="pinfo" id="pinfo"><?php echo $row['pinfo']; ?></textarea><br>
                                        <label for="price">Price:</label>
                                        <input type="text" id="price" name="price" value="<?php echo $row['price']; ?>"><br>
                                        <label for="quantity">Quantity:</label>
                                        <input type="number" id="quantity" name="quantity" style="background-color: white;" value="<?php echo $row['quantity']; ?>"><br>
                                        <br>
                                        <input type="submit" name="update_product" value="Update" style="background-color: black; color:black">
                                    </form>
                                </div>
                            </section>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </section>
    </div>
</section>

<script>
    CKEDITOR.replace('pinfo');
</script>
</body>
</html>

<?php
function dataFilter($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

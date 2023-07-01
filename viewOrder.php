<?php
session_start();
require 'db.php';

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == 0) {
    $_SESSION['message'] = "You need to first login to access this page!";
    header("Location: Login/error.php");
    exit();
}

$fid = $_SESSION['id'];

// Fetch orders associated with the farmer
$sql = "SELECT * FROM orders WHERE fid = '$fid'";
$result = mysqli_query($conn, $sql);

// Check if any orders are found
if ($result && mysqli_num_rows($result) > 0) {
    // Loop through the orders and display relevant information
    while ($row = mysqli_fetch_assoc($result)) {
        $order_id = $row['order_id'];
        $buyer_id = $row['bid'];
        $product_id = $row['pid'];
        $quantity = $row['quantity'];
        $order_date = $row['order_date'];
        $status = $row['status'];

        // Fetch additional details of the order (e.g., buyer name, product details) from related tables
        $buyer_query = mysqli_query($conn, "SELECT * FROM buyers WHERE buyer_id = '$buyer_id'");
        $buyer_row = mysqli_fetch_assoc($buyer_query);
        $buyer_name = $buyer_row['name'];

        $product_query = mysqli_query($conn, "SELECT * FROM fproduct WHERE pid = '$product_id'");
        $product_row = mysqli_fetch_assoc($product_query);
        $product_name = $product_row['product'];

        // Display the order details
        echo "Order ID: $order_id<br>";
        echo "Buyer: $buyer_name<br>";
        echo "Product: $product_name<br>";
        echo "Quantity: $quantity<br>";
        echo "Order Date: $order_date<br>";
        echo "Status: $status<br><br>";
    }
} else {
    echo "No orders found for this farmer.";
}
?>

<?php
// Assuming you have a database connection established
// Replace the placeholders with your actual database credentials
$servername = "your_servername";
$username = "your_username";
$password = "your_password";
$dbname = "your_dbname";

// Retrieve the Lipa na M-Pesa details from the request
$farmer_id = $_POST['farmer_id']; // Assuming farmer_id is sent via POST
$lipa_namba = $_POST['lipa_namba']; // Assuming lipa_namba is sent via POST

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and execute the SQL query to update the farmer's Lipa na M-Pesa details
$sql = "UPDATE farmers SET lipa_namba = '$lipa_namba' WHERE farmer_id = '$farmer_id'";
if ($conn->query($sql) === TRUE) {
    echo "Lipa na M-Pesa details updated successfully for farmer with ID: " . $farmer_id;
} else {
    echo "Error updating Lipa na M-Pesa details: " . $conn->error;
}

// Close the database connection
$conn->close();
?>

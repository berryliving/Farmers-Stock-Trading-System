<?php
    session_start();

    require '../db.php';

    /*if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash']))
    {
        $email = dataFilter($_GET['email']);
        $hash = dataFilter($_GET['hash']);

        $sql = "SELECT * FROM members WHERE Email='$email' AND Hash='$hash' AND Active='0'";
        $result = mysqli_query($conn, $sql) or die($mysqli->error());

        if ( $result->num_rows == 0 )
        {
            $_SESSION['message'] = "Account has already been activated or the URL is invalid!";
            header("location: error.php");
        }
        else
        {
            $_SESSION['message'] = "Your account has been activated!";
            $sql = "UPDATE members SET Active='1' WHERE Email='$email'";
            $result = mysqli_query($conn, $sql) or die($mysqli->error());
            $_SESSION['Active'] = 1;

            header("location: success.php");
        }
    }
     else
    {
        $_SESSION['message'] = "Invalid credentials provided for account verification!";
        header("location: error.php");
    }

    function dataFilter($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    } */

    // Get user's email and generate activation token
    $email = $_POST['email'];
    $activationToken = generateActivationToken();

    // Save email and activation token in the database
    // Here, you would typically insert the email and activation token into your users table

    // Construct the activation link
    $activationLink = "http://example.com/activate.php?token=" . $activationToken;

    // Send the activation email
    $to = $email;
    $subject = "Account Activation";
    $message = "Dear user,\n\nPlease click on the following link to activate your account:\n\n" . $activationLink;
    $headers = "From: your@example.com\r\n" .
            "Reply-To: your@example.com\r\n" .
            "X-Mailer: PHP/" . phpversion();

    if (mail($to, $subject, $message, $headers)) {
        echo "Activation email sent successfully!";
    } else {
        echo "Failed to send activation email.";
    }

    // Function to generate a random activation token
    function generateActivationToken() {
        $length = 32; // Length of the activation token
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $token = '';

        for ($i = 0; $i < $length; $i++) {
            $token .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $token;
    }
?>

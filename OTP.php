<?php

require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Function to generate a random OTP
function generateOTP($length = 4) {
    $otp = '';
    for ($i = 0; $i < $length; $i++) {
        $otp .= mt_rand(0, 9);
    }
    return $otp;
}

// Function to send OTP to email
function sendOTP($email, $otp) {
    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'thehuddlehub1@gmail.com'; // Your Gmail address
        $mail->Password = 'ghhx xuhz hpas rzjk'; // Your Gmail password or app password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('thehuddlehub1@gmail.com', 'The Huddle Hub');
        $mail->addAddress($email); // Add a recipient

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Your OTP Code';
        $mail->Body    = "Your OTP code for verification is: <b>$otp</b>";
        $mail->AltBody = "Your OTP code for verification is: $otp";

        $mail->send();
        echo 'OTP has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

session_start();

if (!isset($_SESSION['email'])) {
    $_SESSION['email'] = "rockeysubedi6@gmail.com"; // Placeholder email, replace with actual session email
}

// Generate and send OTP if not already sent
if (!isset($_SESSION['otp'])) {
    $otp = generateOTP();
    $_SESSION['otp'] = $otp;
    sendOTP($_SESSION['email'], $otp);
}

echo $_SESSION['otp'];

// Verify OTP
if (isset($_POST['otpSubmit'])) {
    $inputOTPArray = $_POST['otp'];
    $inputOTPString = implode('', $inputOTPArray);
    $inputOTP = $inputOTPString;
    if ($inputOTP == $_SESSION['otp']) {
        echo "<script>alert('OTP verified successfully.');</script>";
        // Perform actions after successful OTP verification
        include('connect.php');
        $email = $_SESSION['email'];
        $update_query = "UPDATE USERS SET USER_STATE = 1 WHERE USER_EMAIL = '$email'";
        $update_stmt = oci_parse($conn,$update_query);
        oci_execute($update_stmt);
        session_destroy();
        $target_url = "login_register.php";
        echo '<meta http-equiv="refresh" content="0;url=' . $target_url . '">';
        
    } else {
        echo "<script>alert('Invalid OTP. Please try again.');</script>";
        
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
    <link rel="stylesheet" href="css/OTP.css">
</head>
<body>
   <div class="otp-container">
        <header>
            <img src="images/otp.png" width="auto" height="45px" alt="LOCK">
        </header>
        <h4>Enter OTP Code</h4>
        <p>Enter the OTP you received on:</p>
        <p><?php echo $_SESSION['email']; ?></p>
        <form class="otp-form" method="post" action="#">
            <div class="inputarea">
                <input type="text" name="otp[]" maxlength="1" required>
                <input type="text" name="otp[]" maxlength="1" required disabled>
                <input type="text" name="otp[]" maxlength="1" required disabled>
                <input type="text" name="otp[]" maxlength="1" required disabled>
            </div>
            <button type="submit" name="otpSubmit">Verify OTP</button>
        </form>
   </div>
   <script>
        const inputs = document.querySelectorAll("input"),
        button = document.querySelector("button");

        // Focus on the first input
        window.addEventListener("load", () => inputs[0].focus());

        // Iterate over the inputs
        inputs.forEach((input, index1) => {
            input.addEventListener("keyup", (e) => {
                const currentInput = input,
                nextInput = input.nextElementSibling,
                prevInput = input.previousElementSibling;

                // If more than one number, clear the input
                if (currentInput.value.length > 1) {
                    currentInput.value = "";
                }
                // If one field filled, focus next field
                if (nextInput && nextInput.hasAttribute("disabled") && currentInput.value !== "") {
                    nextInput.removeAttribute("disabled");
                    nextInput.focus();
                }
                // If backspace pressed
                if (e.key === "Backspace") {
                    inputs.forEach((input, index2) => {
                        if (index1 <= index2 && prevInput) {
                            input.setAttribute("disabled", true);
                            currentInput.value = "";
                            prevInput.focus();
                        }
                    });
                }
                if (!inputs[3].disabled && inputs[3].value !== "") {
                    button.classList.add("active");
                    return;
                }
                button.classList.remove('active');
            });
        });
   </script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Customer Profile</title>
<link rel="stylesheet" href="styleCo.css">
</head>
<body>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $firstName = htmlspecialchars($_POST['firstName']);
    $lastName = htmlspecialchars($_POST['lastName']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars($_POST['phone']);
    $address = htmlspecialchars($_POST['address']);

    echo "<p>Profile updated successfully!</p>";
}
?>

<div class="container">
    <div class="profile">
        <div class="profile-section">
            <h1>Your Profile</h1>
        </div>
        <div class="profile-header">
            <img src="profile-pic.jpg" alt="Profile Picture">
            <h2>John Doe</h2>
            <p class="profile-email">johndoe@example.com</p>
        </div>
        <button class="account-info-btn">Account Info</button>
        <div class="change-password">
            <button class="change-password-btn">Change Password</button>
        </div>
    </div>
    <div class="account-info">
        <div class="account-header">
            <h2>Account Info<button class="view-orders-btn">View My Orders</button></h2>
        </div>
       
        <form method="POST" action="">
            <div class="first-name">
                <label for="firstName">First Name</label>
                <input type="text" id="firstName" name="firstName" required>
            </div>
            <div class="last-name">
                <label for="lastName">Last Name</label>
                <input type="text" id="lastName" name="lastName" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="address">Permanent Address</label>
                <input type="text" id="address" name="address" required>
            </div>
            <button type="submit" class="save-btn">Save</button>
        </form>
    </div>
</div>

</body>
</html>

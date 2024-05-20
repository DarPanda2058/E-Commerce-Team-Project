<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Change Password</title>
<link rel="stylesheet" href="styleC.css">
</head>
<body>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $oldPassword = htmlspecialchars($_POST['oldPassword']);
    $newPassword = htmlspecialchars($_POST['newPassword']);
    $confirmNewPassword = htmlspecialchars($_POST['confirmNewPassword']);
    if ($newPassword === $confirmNewPassword) {
        echo "<p>Password changed successfully!</p>";
    } else {
        echo "<p>New passwords do not match. Please try again.</p>";
    }
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
        <div class="manage-shop">
            <button class="manage-shop-btn">Manage Shop</button>
        </div>
        <div class="change-password">
            <button class="change-password-btn">Change Password</button>
        </div>
    </div>

    <div class="change-password">
        <div class="password">
            <h2>Change Password <button class="access-your-dashboard-btn">Access Your Dashboard</button></h2>
        </div>
       
        <form method="POST" action="">
            <div class="old-password">
                <label for="oldPassword">Old Password</label>
                <input type="password" id="oldPassword" name="oldPassword" required>
            </div>
            <div class="new-password">
                <label for="newPassword">New Password</label>
                <input type="password" id="newPassword" name="newPassword" required>
            </div>
            <div class="confirm-new-password">
                <label for="confirmNewPassword">Confirm New Password</label>
                <input type="password" id="confirmNewPassword" name="confirmNewPassword" required>
            </div>
            <button type="submit" class="save-btn">Save</button>
        </form>
    </div>
</div>

</body>
</html>

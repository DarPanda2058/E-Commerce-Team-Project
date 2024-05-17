<!-- <?php
include("login_php.php");
include("register_php.php");
?> -->

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>The Huddle Hub Login & Registration</title>
  <link rel="stylesheet" href="css/login-register.css">
</head>
<body>
  <header>
    <img src="images/logo.png" alt="logo" width="auto" height="120">
  </header>

  <div class="wrapper">
    <div class="form-box login active" id="userLoginForm">
      <h2>User Login</h2>
      <form method="POST" action="you_login.php">
        <div class="input-box">
          <span class="icon"><ion-icon name="mail"></ion-icon></span>
          <input type="email" id="user_email" name="user_email" required>
          <label for="user_email">Email</label>
        </div>
        <div class="input-box">
          <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
          <input type="password" id="user_password" name="user_password" required>
          <label for="user_password">Password</label>
        </div>
        <div class="remember-forgot">
        <label><input type="checkbox" id="remember_me" name="remember_me">Remember me</label>
        </div>
        <button type="submit" class="btn">Login</button>
        <div class="login-register">
          <p>Don't have an account? <a href="#" class="register-link">Register</a></p>
        </div>
        <div class="login-choice">
          <button type="button" class="btn" onclick="showLoginForm('traderLoginForm')">Login As Trader</button>
          <button type="button" class="btn" onclick="showLoginForm('adminLoginForm')">Login As Admin</button>
        </div>
      </form>
    </div>

    <div class="form-box login" id="adminLoginForm">
      <h2>Admin Login</h2>
      <form method="POST" action="you_login.php">
        <div class="input-box">
          <span class="icon"><ion-icon name="mail"></ion-icon></span>
          <input type="email" id="admin_email" name="admin_email" required>
          <label for="admin_email">Email</label>
        </div>
        <div class="input-box">
          <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
          <input type="password" id="admin_password" name="admin_password" required>
          <label for="admin_password">Password</label>
        </div>
        <div class="remember-forgot">
        <label><input type="checkbox" id="remember_me" name="remember_me">Remember me</label>
        </div>
        <button type="submit" class="btn">Login</button>
        <div class="login-register">
          <p>Don't have an account? <a href="#" class="register-link">Register</a></p>
        </div>
        <div class="login-choice">
          <button type="button" class="btn" onclick="showLoginForm('traderLoginForm')">Login As Trader</button>
          <button type="button" class="btn" onclick="showLoginForm('userLoginForm')">Login As User</button>
        </div>
      </form>
    </div>

    <div class="form-box login" id="traderLoginForm">
      <h2>Trader Login</h2>
      <form method="POST" action="you_login.php">
        <div class="input-box">
          <span class="icon"><ion-icon name="mail"></ion-icon></span>
          <input type="email" id="trader_email" name="trader_email" required>
          <label for="trader_email">Email</label>
        </div>
        <div class="input-box">
          <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
          <input type="password" id="trader_password" name="trader_password" required>
          <label for="trader_password">Password</label>
        </div>
        <div class="remember-forgot">
        <label><input type="checkbox" id="remember_me" name="remember_me">Remember me</label>
        </div>
        <button type="submit" class="btn">Login</button>
        <div class="login-register">
          <p>Don't have an account? <a href="#" class="register-link">Register</a></p>
        </div>
        <div class="login-choice">
          <button type="button" class="btn" onclick="showLoginForm('adminLoginForm')">Login As Admin</button>
          <button type="button" class="btn" onclick="showLoginForm('userLoginForm')">Login As User</button>
        </div>
      </form>
    </div>



    <!-- Register form -->
    <div class="form-box register">
      <h2>Register</h2>
      <form action="#">
      <div class="input-box">
        <span class="icon"><ion-icon name="person"></ion-icon></span>
        <input type="text" id="firstName" name="firstName" required>
        <label for="firstName">First Name</label>
      </div>
      <div class="input-box">
        <span class="icon"><ion-icon name="person-add"></ion-icon></span>
        <input type="text" id="lastName" name="lastName" required>
        <label for="lastName">Last Name</label>
      </div>
        <div class="input-box">
          <span class="icon"><ion-icon name="mail"></ion-icon></span>
          <input type="email" id="email" name="email" required>
            <label for="email">Email</label>
        </div>
        <div class="input-box">
          <span class="icon"><ion-icon name="call"></ion-icon></span>
          <input type="tel" id="phone" name="phone" required>
            <label for="phone">Phone Number</label>
        </div>
        <div class="input-box">
          <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
          <input type="password" id="password" name="password" required>
            <label for="password">Password</label>
        </div>
        <div class="input-box">
          <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
          <input type="password" id="confirmPassword" name="confirmPassword" required>
          <label for="confirmPassword">Confirm Password</label>
        </div>
        <div class="input-box">
          <span class="icon"><ion-icon name="people-circle"></ion-icon></span>
          <input type="number" id="age" name="age" required>
          <label for="age">Age</label>
        </div>
            
            <label class="register_text">Gender:</label>

            <div class="gender">
    <label class="radio-inline">
        <input type="radio" name="gender" value="male" id="male" required> 
        Male
    </label>
    <label class="radio-inline">
        <input type="radio" name="gender" value="female" id="female" required>
        Female
    </label>
</div>

<label for="register_role" class="register_text">Register As:</label>
<div class="role">
    <label class="radio-inline">
        <input type="radio" name="role" value="trader_register" id="trader_register" required> 
        Trader
    </label>
    <label class="radio-inline">
        <input type="radio" name="role" value="user_register" id="user_register" required>
        User
    </label>
</div>

            
        <div class="remember-forgot">
        <label><input type="checkbox" id="register_terms" name="register_terms" required>I agree to the terms and conditions</label>
        </div>
        <button type="submit" class="btn">Register</button>
        <div class="login-register">
          <p>Already have an account? <a href="#" class="login-link">Login</a></p>
        </div>
      </form>
    </div>

  </div>

  <script src="js/script.js"></script>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
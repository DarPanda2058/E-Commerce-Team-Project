<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/PaymentOption.css">
</head>
<body>
    <?php 
        include('connect.php'); 
        include('nav.php'); 
        $paypalURL = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
        $paypalID = 'huddlehub@business.example.com'; //Business Email

        if(isset($_GET['error'])){
            echo '<script>alert("Payment Not Processed!");</script>';
        }

    ?>
    <div class="title-row">
        <div class="title-shopping">
            <p>1. Shopping Cart </p>
        </div>
        <div class="title-collection">
            <p>2. Collection Point</p>
        </div>
        <div class="title-payment" id="active">
            <p>3. Payment Option</p>
        </div>
    </div>
    <form action="#">
        <table>
            <tr class="header">
                <th colspan="3">Payment Method</th>
            </tr>
            <tr class="payment-row">
                <td><input type="radio" name="pay-check" id="payment" checked="checked"></td>
                <td class="payment-desc">
                    <b>PayPal</b>
                    <p>Pay securely with PayPal. Checkout in seconds with PayPal.</p>
                </td>
                <td class="date-container" id="col-width">
                    <img src="images/paypal-logo.png" width="200px" height="auto" alt="PayPal">
                </td>
            </tr>
        </table>
    </form>
        <div class="total-container">
            <div class="sub-total">
                <p>Sub-total</p>
                <p>&pound; <?php echo $_SESSION['totalPrice'] ?></p>
            </div>
            <div class="shipping">
                <p>Shipping</p>
                <p>Free</p>
            </div>
            <div class="total">
                <p>TOTAL</p>
                <p>&pound; <?php echo $_SESSION['totalPrice'] ?></p>
            </div>
            <form action="<?php echo $paypalURL; ?>" >
            <input type="hidden" name="business" value="<?php echo $paypalID;?>">

            <!-- Specify a Buy Now button. -->
            <input type="hidden" name="cmd" value="_xclick">
            <input type="hidden" name="item_name" value="Huddle Hub Products">
            <input type="hidden" name="item_number" value="<?php echo $_SESSION['cartQuantity']; ?>">
            <input type="hidden" name="amount" value="<?php echo $_SESSION['totalPrice'];?>">
            <input type="hidden" name="currency_code" value="GBP">
            <!-- <input type="hidden" name="quantity" value="2"> -->

            <!-- Specify URLs -->
            <input type='hidden' name='cancel_return' value='http://localhost/E-commerce-team-project/PaymentOption.php?error=1'>
            <input type='hidden' name='return' value='http://localhost/E-commerce-team-project/AddtoOrder.php'>
            <button type="submit" name="submit">Continue</button>
            </form>
            <button><a href="main.php">Cancel</a></button>
        </div>
</body>
</html>
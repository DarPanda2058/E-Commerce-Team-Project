<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/Shopping-cart.css">
</head>
<body>
    <?php
        include 'connect.php';
        include 'nav.php';


        $cart_id = $_SESSION['cartID']; // Assuming cart_id is stored in session during login

        // Fetch cart products
        $cart_query = "
            SELECT cp.CART_PRODUCT_QUANTITY, p.PRODUCT_ID, p.PRODUCT_NAME, p.PRODUCT_DETAILS, p.PRODUCT_PRICE, p.PRODUCT_IMAGE, p.PRODUCT_MAX_LIMIT 
            FROM cart_product cp 
            JOIN product p ON cp.PRODUCT_ID = p.PRODUCT_ID 
            WHERE cp.CART_ID = :cart_id
        ";
        $stmt = oci_parse($conn, $cart_query);
        oci_bind_by_name($stmt, ':cart_id', $cart_id);
        oci_execute($stmt);

        $cart_items = [];
        $total_price = 0;

        while ($row = oci_fetch_assoc($stmt)) {
            $cart_items[] = $row;
            $total_price += $row['PRODUCT_PRICE'] * $row['CART_PRODUCT_QUANTITY'];
        }
    ?>
    <div class="title-row">
        <div class="title-shopping" id="active">
            <p>1. Shopping Cart </p>
        </div>
        <div class="title-collection">
            <p>2. Collection Point</p>
        </div>
        <div class="title-payment">
            <p>3. Payment Option</p>
        </div>
    </div>
    <table>
        <tr>
            <th colspan="2">Shopping Cart</th>
            <td id="col-width">Price</td>
            <td id="col-width">Quantity</td>
            <td id="col-width">Total</td>
        </tr>
        <form action=""></form>
        <?php foreach ($cart_items as $item): ?>
        <tr class="repeating-row" data-product-id="<?php echo $item['PRODUCT_ID']; ?>" data-max-limit="<?php echo $item['PRODUCT_MAX_LIMIT']; ?>">
            <td class="product-image-cart"><img src="<?php echo $item['PRODUCT_IMAGE']; ?>" alt="Image"></td>
            <td>
                <div class="product-desc-cart">
                    <p><?php echo htmlspecialchars($item['PRODUCT_NAME']); ?></p>    
                </div>
            </td>
            <td class="cart-price" id="col-width">&pound; <?php echo number_format($item['PRODUCT_PRICE'], 2); ?></td>
            <td class="cart-quantity-buttons" id="col-width">
                <button class="quantity-btn" data-action="decrease">-</button>
                <span class="quantity"><?php echo $item['CART_PRODUCT_QUANTITY']; ?></span>
                <button class="quantity-btn" data-action="increase">+</button>
            </td>
            <td class="cart-total-price" id="col-width">&pound; <?php echo number_format($item['PRODUCT_PRICE'] * $item['CART_PRODUCT_QUANTITY'], 2); ?></td>
            <td class="remove-cartitem" id="col-width"><button class="remove-btn"><a href="removeCartProduct.php?id=<?php echo $item['PRODUCT_ID'];?>">Remove</a></button></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <div class="total-container">
        <div class="sub-total">
            <p>Sub-total</p>
            <p>&pound; <span id="subtotal"><?php echo number_format($total_price, 2); ?></span></p>
        </div>
        <div class="shipping">
            <p>Shipping</p>
            <p>Free</p>
        </div>
        <div class="total">
            <p>TOTAL</p>
            <p>&pound; <span id="total"><?php echo number_format($total_price, 2); ?></span></p>
        </div>
        <button><a href="CollectionPoint.html">Continue</a></button>
        <button>Cancel</button>
    </div>
    <script>
        document.querySelectorAll('.quantity-btn').forEach(button => {
            button.addEventListener('click', function() {
                const action = this.getAttribute('data-action');
                const row = this.closest('.repeating-row');
                const maxLimit = parseInt(row.getAttribute('data-max-limit'));
                const productId = row.getAttribute('data-product-id');
                const quantityElement = row.querySelector('.quantity');
                let quantity = parseInt(quantityElement.textContent.trim());
                const priceElement = row.querySelector('.cart-price');
                const totalElement = row.querySelector('.cart-total-price');
                const productPrice = parseFloat(priceElement.textContent.replace('£', '').trim());
                let subtotalElement = document.getElementById('subtotal');
                let totalElementOverall = document.getElementById('total');
                let subtotal = parseFloat(subtotalElement.textContent);
                
                if (action === 'increase' && quantity < maxLimit) {
                    quantity++;
                    
                } else if (action === 'decrease' && quantity > 1) {
                    quantity--;
                }

                quantityElement.textContent = ` ${quantity} `;
                const newTotal = productPrice * quantity;
                totalElement.textContent = `£ ${newTotal.toFixed(2)}`;
                
                // Update subtotal and total
                subtotal = Array.from(document.querySelectorAll('.cart-total-price'))
                    .map(elem => parseFloat(elem.textContent.replace('£', '').trim()))
                    .reduce((acc, curr) => acc + curr, 0);
                
                subtotalElement.textContent = subtotal.toFixed(2);
                totalElementOverall.textContent = subtotal.toFixed(2);

                // Optionally, send an AJAX request to update the quantity in the database
                // Example:
                // fetch(`update_cart.php?product_id=${productId}&quantity=${quantity}`)
                //     .then(response => response.json())
                //     .then(data => {
                //         // handle success
                //     })
                //     .catch(error => {
                //         console.error('Error:', error);
                //     });
            });
        });
    </script>
</body>
</html>
<?php if(!isset($_SESSION)){
    session_start();
} ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/CustomerOrder.css">
    <style>
        * {
            box-sizing: border-box;
        }
    
        html, body {
            
            
            /* background-image: url(http://theartmad.com/wp-content/uploads/Dark-Grey-Texture-Wallpaper-5.jpg); */
            background-size: cover;
            background-position: top center;
            font-family: helvetica neue, helvetica, arial, sans-serif;
            font-weight: 200;
        }
        #closeModalBtn{

            cursor: pointer;
        }
        body.modal-active {
            overflow: hidden;
        }
    
        #modal-container {
            position: fixed;
            display: table;
            height: 100%;
            width: 100%;
            top: 0;
            left: 0;
            transform: scale(0);
            z-index: 1;
        }
    
        #modal-container.one {
            transform: scaleY(.01) scaleX(0);
            animation: unfoldIn 1s cubic-bezier(0.165, 0.840, 0.440, 1.000) forwards;
        }
    
        #modal-container.one.out {
            transform: scale(1);
            animation: unfoldOut 1s .3s cubic-bezier(0.165, 0.840, 0.440, 1.000) forwards;
        }
    
        #modal-container.two {
            transform: scale(1);
        }
    
        #modal-container.two.out {
            animation: quickScaleDown 0s .5s linear forwards;
        }
    
        #modal-container.two .modal-background {
            background: rgba(0,0,0,.0);
            animation: fadeIn .5s cubic-bezier(0.165, 0.840, 0.440, 1.000) forwards;
        }
    
        #modal-container.two .modal-background .modal {
            opacity: 0;
            animation: scaleUp .5s cubic-bezier(0.165, 0.840, 0.440, 1.000) forwards;
        }
    
        #modal-container.two.out .modal-background {
            animation: fadeOut .5s cubic-bezier(0.165, 0.840, 0.440, 1.000) forwards;
        }
    
        #modal-container.two.out .modal-background .modal {
            animation: scaleDown .5s cubic-bezier(0.165, 0.840, 0.440, 1.000) forwards;
        }
    
        #modal-container.three {
            z-index: 0;
            transform: scale(1);
        }
    
        #modal-container.three.out .modal-background .modal {
            animation: moveDown .5s cubic-bezier(0.165, 0.840, 0.440, 1.000) forwards;
        }
    
        #modal-container.four {
            z-index: 0;
            transform: scale(1);
        }
    
        #modal-container.four.out .modal-background .modal {
            animation: blowUpModalTwo .5s cubic-bezier(0.165, 0.840, 0.440, 1.000) forwards;
        }
    
        #modal-container.five {
            transform: scale(1);
        }
    
        #modal-container.five.out {
            animation: quickScaleDown 0s .5s linear forwards;
        }
    
        #modal-container.five .modal-background .modal {
            transform: translateX(-1500px);
            animation: roadRunnerIn .3s cubic-bezier(0.165, 0.840, 0.440, 1.000) forwards;
        }
    
        #modal-container.five.out .modal-background .modal {
            animation: roadRunnerOut .5s cubic-bezier(0.165, 0.840, 0.440, 1.000) forwards;
        }
    
        #modal-container.six {
            transform: scale(1);
        }
    
        #modal-container.six.out {
            animation: quickScaleDown 0s .5s linear forwards;
        }
    
        #modal-container.six .modal-background .modal {
            background-color: transparent;
            animation: modalFadeIn .5s .8s cubic-bezier(0.165, 0.840, 0.440, 1.000) forwards;
        }
    
        #modal-container.six.out .modal-background .modal {
            animation: modalFadeOut .5s cubic-bezier(0.165, 0.840, 0.440, 1.000) forwards;
        }
    
        #modal-container.seven {
            transform: scale(1);
        }
    
        #modal-container.seven.out {
            animation: slowFade .5s 1.5s linear forwards;
        }
    
        #modal-container.seven .modal-background .modal {
            height: 75px;
            width: 75px;
            border-radius: 75px;
            overflow: hidden;
            animation: bondJamesBond 1.5s cubic-bezier(0.165, 0.840, 0.440, 1.000) forwards;
        }
    
        #modal-container.seven.out .modal-background {
            animation: fadeToRed 2s cubic-bezier(0.165, 0.840, 0.440, 1.000) forwards;
        }
    
        #modal-container.seven.out .modal-background .modal {
            border-radius: 3px;
            height: 162px;
            width: 227px;
            animation: killShot 1s cubic-bezier(0.165, 0.840, 0.440, 1.000) forwards;
        }
    
        .modal-background {
            display: table-cell;
            background: rgba(0, 0, 0, .8);
            text-align: center;
            vertical-align: middle;
        }
    
        .modal {
            background: white;
            padding: 50px;
            display: inline-block;
            border-radius: 3px;
            font-weight: 300;
            position: relative;
        }
    
        /* Review form styles */
        .review-container h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }
    
        .review-container p {
            margin-bottom: 20px;
            color: #555;
        }
    
        .stars {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
    
        .stars input {
            display: none;
        }
    
        .stars label {
            font-size: 24px;
            color: #ddd;
            cursor: pointer;
        }
    
        .stars label:hover,
        .stars label:hover ~ label,
        .stars input:checked + label,
        .stars input:checked + label ~ label {
            color: #f39c12;
        }
    
        .review-description {
            margin-bottom: 20px;
        }
    
        .review-description textarea {
            width: 100%;
            height: 100px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
    
        .submit-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #000;
            color: #fff;
            text-align: center;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
    
        @media (max-width: 600px) {
            .stars label {
                font-size: 20px;
            }
    
            .review-description textarea {
                height: 80px;
                font-size: 14px;
            }
    
            .submit-btn {
                padding: 8px 16px;
                font-size: 14px;
            }
        }
    
        .content {
            min-height: 100%;
            height: 100%;
            background: white;
            position: relative;
            z-index: 0;
        }
    
        .content h1 {
            padding: 75px 0 30px 0;
            text-align: center;
            font-size: 30px;
            line-height: 30px;
        }
    
        .content .buttons {
            max-width: 800px;
            margin: 0 auto;
            padding: 0;
            text-align: center;
        }
    
        .button {
            background-color: rgb(192, 192, 192);
            color: white;
            padding: 8px;
            border-radius: 10px;
            border-width: 0.8px;
            transition: 0.2s ease-in;
        }
    
        .button:hover {
            background-color: lightgreen;
            box-shadow: 1px 1px 4px black;;
            margin-bottom: 2px;
        }
    
        @keyframes unfoldIn {
            0% {
                transform: scaleY(.005) scaleX(0);
            }
            50% {
                transform: scaleY(.005) scaleX(1);
            }
            100% {
                transform: scaleY(1) scaleX(1);
            }
        }
    
        @keyframes unfoldOut {
            0% {
                transform: scaleY(1) scaleX(1);
            }
            50% {
                transform: scaleY(.005) scaleX(1);
            }
            100% {
                transform: scaleY(.005) scaleX(0);
            }
        }
    
        @keyframes zoomIn {
            0% {
                transform: scale(0);
            }
            100% {
                transform: scale(1);
            }
        }
    
        @keyframes zoomOut {
            0% {
                transform: scale(1);
            }
            100% {
                transform: scale(0);
            }
        }
    
        @keyframes fadeIn {
            0% {
                background: rgba(0, 0, 0, .0);
            }
            100% {
                background: rgba(0, 0, 0, .7);
            }
        }
    
        @keyframes fadeOut {
            0% {
                background: rgba(0, 0, 0, .7);
            }
            100% {
                background: rgba(0, 0, 0, .0);
            }
        }
    
        @keyframes scaleUp {
            0% {
                transform: scale(.8) translateY(1000px);
                opacity: 0;
            }
            100% {
                transform: scale(1) translateY(0px);
                opacity: 1;
            }
        }
    
        @keyframes scaleDown {
            0% {
                transform: scale(1) translateY(0px);
                opacity: 1;
            }
            100% {
                transform: scale(.8) translateY(1000px);
                opacity: 0;
            }
        }
    
        @keyframes quickScaleDown {
            0% {
                transform: scale(1);
            }
            99.9% {
                transform: scale(1);
            }
            100% {
                transform: scale(0);
            }
        }
    
        @keyframes blowUpContent {
            0% {
                transform: scale(1);
                opacity: 1;
            }
            99.9% {
                transform: scale(2);
                opacity: 0;
            }
            100% {
                transform: scale(0);
            }
        }
    
        @keyframes blowUpModal {
            0% {
                transform: scale(0);
            }
            100% {
                transform: scale(1);
            }
        }
    
        @keyframes blowUpModalTwo {
            0% {
                transform: scale(1);
                opacity: 1;
            }
            100% {
                transform: scale(0);
                opacity: 0;
            }
        }
    
        @keyframes roadRunnerIn {
            0% {
                transform: translateX(-1500px) skewX(30deg) scaleX(1.3);
            }
            70% {
                transform: translateX(30px) skewX(0deg) scaleX(.9);
            }
            100% {
                transform: translateX(0px) skewX(0deg) scaleX(1);
            }
        }
    
        @keyframes roadRunnerOut {
            0% {
                transform: translateX(0px) skewX(0deg) scaleX(1);
            }
            30% {
                transform: translateX(-30px) skewX(-5deg) scaleX(.9);
            }
            100% {
                transform: translateX(1500px) skewX(30deg) scaleX(1.3);
            }
        }
    
        @keyframes sketchIn {
            0% {
                stroke-dashoffset: 778;
            }
            100% {
                stroke-dashoffset: 0;
            }
        }
    
        @keyframes sketchOut {
            0% {
                stroke-dashoffset: 0;
            }
            100% {
                stroke-dashoffset: 778;
            }
        }
    
        @keyframes modalFadeIn {
            0% {
                background-color: transparent;
            }
            100% {
                background-color: white;
            }
        }
    
        @keyframes modalFadeOut {
            0% {
                background-color: white;
            }
            100% {
                background-color: transparent;
            }
        }
    
        @keyframes bondJamesBond {
            0% {
                transform: translateX(1000px);
            }
            80% {
                transform: translateX(0px);
                border-radius: 75px;
                height: 75px;
                width: 75px;
            }
            90% {
                border-radius: 3px;
                height: 182px;
                width: 247px;
            }
            100% {
                border-radius: 3px;
                height: 162px;
                width: 227px;
            }
        }
    
        @keyframes killShot {
            0% {
                transform: translateY(0) rotate(0deg);
                opacity: 1;
            }
            100% {
                transform: translateY(300px) rotate(45deg);
                opacity: 0;
            }
        }
    
        @keyframes fadeToRed {
            0% {
                background-color: rgba(black, .6);
            }
            100% {
                background-color: rgba(red, .8);
            }
        }
    
        @keyframes slowFade {
            0% {
                opacity: 1;
            }
            99.9% {
                opacity: 0;
                transform: scale(1);
            }
            100% {
                transform: scale(0);
            }
        }
    </style>
</head>
    <?php
      include("connect.php");      
    ?>
<body>
    <?php include("nav.php")?>
    <?php 
        include("connect.php");      
        $user_id = $_SESSION['userID'];
        $totalproductquery = "SELECT
                                SUM(o.ORDER_QUANTITY) AS TOTAL_PRODUCT
                                FROM 
                                    ORDERS o
                                JOIN 
                                    USER_ORDER uo on o.ORDER_ID = uo.ORDER_ID
                                JOIN 
                                    USERS u on uo.USER_ID = u.USER_ID
                                WHERE 
                                    u.USER_ID = '$user_id'";
        $totalproductstmt = oci_parse($conn,$totalproductquery);
        oci_execute($totalproductstmt);
        $row = oci_fetch_assoc($totalproductstmt);
    ?>
    <div class="order-header">
        <h2>Your Order History.</h2>

    </div>
    
    <table>
        <tr class="title">
            <th>Image</th>
            <th>Name</th>
            <th>Quantity</th>
            <th>Order-Date</th>
            <th>Collection-Date</th>
            <th>Collection-Time</th>
            <th>Price</th>
            <th>TOTAL</th>
            <th>Paid-By</th>
            <th>&Tab;</th>
        </tr>
            
        <?php
            $selectquery = "SELECT s.COLLECTION_DAY,s.COLLECTION_START_TIME,s.COLLECTION_END_TIME,
                                    o.ORDER_QUANTITY,o.ORDER_DATE,op.ORDER_PRODUCT_QUANTITY,p.PRODUCT_ID,p.PRODUCT_IMAGE,
                                    p.PRODUCT_NAME,p.PRODUCT_PRICE,p.PRODUCT_CATEGORY
                            FROM 
                                Collection_Slot s
                            JOIN 
                                Orders o ON s.Slot_ID = o.Slot_ID
                            JOIN 
                                Order_Product op ON o.Order_ID = op.Order_ID
                            JOIN 
                                PRODUCT p ON op.PRODUCT_ID = p.PRODUCT_ID
                            JOIN 
                                USER_ORDER uo ON o.ORDER_ID=uo.ORDER_ID
                            WHERE uo.USER_ID = '$user_id'";
            $selectstmt = oci_parse($conn,$selectquery);
            oci_execute($selectstmt);

            while($row = oci_fetch_assoc($selectstmt)){
                echo '<tr class="repeating-row">';
                echo '    <td><img src="images/'.$row['PRODUCT_IMAGE'].'" width="100px" height="auto" alt="Image"></td>';
                echo '    <td class="product-name">'.$row['PRODUCT_NAME'].'</td>';
                echo '    <td><div class="product-price">'.$row['ORDER_PRODUCT_QUANTITY'].'</div></td>';
                echo '    <td>'.$row['ORDER_DATE'].'</td>';
                echo '    <td>'.$row['COLLECTION_DAY'].'</td>';
                echo '    <td>'.$row['COLLECTION_START_TIME'].":00-".$row['COLLECTION_END_TIME'].":00".'</td>';
                echo '    <td class="product">&pound; '.$row['PRODUCT_PRICE'].'</td>';
                echo '    <td class="product-price">&pound; '.$row['PRODUCT_PRICE']*$row['ORDER_PRODUCT_QUANTITY'].'</td>';
                echo '    <td><img src="images/paypal-logo.png" height="auto" width="100px" alt="PayPal"></td>';
                echo '    <td><button class="button review-button" data-product-id="'.$row['PRODUCT_ID'].'" data-product-name="'.$row['PRODUCT_NAME'].'" >Review</button></td>';
                echo '</tr>';
            }

            oci_close($conn);
        ?>
    </table>
    
    <div id="modal-container">
        <div class="modal-background">
            <div class="modal">
                <span class="close" id="closeModalBtn">X</span>
                <div class="review-container">
                    <h2 id="review-title">Review Product</h2>
                    <p>Rate the product and share your experience to the world.</p>
                    <form id="review-form" action="review.php" method="post">
                        <div class="stars">
                            <input type="radio" id="star5" name="rating" value="1" aria-label="5 stars"><label for="star5">&#9733;</label>
                            <input type="radio" id="star4" name="rating" value="2" aria-label="4 stars"><label for="star4">&#9733;</label>
                            <input type="radio" id="star3" name="rating" value="3" aria-label="3 stars"><label for="star3">&#9733;</label>
                            <input type="radio" id="star2" name="rating" value="4" aria-label="2 stars"><label for="star2">&#9733;</label>
                            <input type="radio" id="star1" name="rating" value="5" aria-label="1 star"><label for="star1">&#9733;</label>
                        </div>
                        <input type="hidden" name="product_id" id="product_id">
                        <div class="review-description">
                            <textarea name="review" placeholder="Review Description" aria-label="Review Description"></textarea>
                        </div>
                        <button type="submit" name="reviewSubmit" class="submit-btn">Submit Review</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.review-button').forEach(button => {
            button.addEventListener('click', function() {
                var productId = this.getAttribute('data-product-id');
                var productName = this.getAttribute('data-product-name');
                
                document.getElementById('product_id').value = productId;
                document.getElementById('review-title').innerText = 'Review ' + productName;

                document.getElementById('modal-container').className = 'one';  // Ensure the modal container has the correct class for animation
                document.body.classList.add('modal-active');
            });
        });

        document.getElementById('modal-container').addEventListener('click', function() {
            this.classList.add('out');
            document.body.classList.remove('modal-active');
        });

        const modal = document.querySelector('.modal');
        const modalContainer = document.getElementById('modal-container');
        const closeModalBtn = document.getElementById('closeModalBtn');

        // Stop click event from propagating to the modal container
        modal.addEventListener('click', function(event) {
            event.stopPropagation();
        });

        closeModalBtn.onclick = function() {
            modalContainer.classList.add('out');
            document.body.classList.remove('modal-active');
        }

        window.onclick = function(event) {
            if (event.target === modalContainer) {
                modalContainer.classList.add('out');
                document.body.classList.remove('modal-active');
            }
        }

        document.querySelectorAll('.stars label').forEach(label => {
            label.addEventListener('mouseover', () => {
                resetStars();
                label.style.color = '#f39c12';
                let previousSibling = label.previousElementSibling;
                while (previousSibling) {
                    previousSibling.style.color = '#f39c12';
                    previousSibling = previousSibling.previousElementSibling;
                }
            });

            label.addEventListener('mouseout', () => {
                resetStars();
                const checkedInput = document.querySelector('.stars input:checked');
                if (checkedInput) {
                    checkedInput.nextElementSibling.style.color = '#f39c12';
                    let previousSibling = checkedInput.nextElementSibling.previousElementSibling;
                    while (previousSibling) {
                        previousSibling.style.color = '#f39c12';
                        previousSibling = previousSibling.previousElementSibling;
                    }
                }
            });

            label.addEventListener('click', () => {
                resetStars();
                label.style.color = '#f39c12';
                let previousSibling = label.previousElementSibling;
                while (previousSibling) {
                    previousSibling.style.color = '#f39c12';
                    previousSibling = previousSibling.previousElementSibling;
                }
            });
        });

        function resetStars() {
            document.querySelectorAll('.stars label').forEach(label => {
                label.style.color = '#ddd';
            });
        }

        document.getElementById('review-form').addEventListener('submit', function(event) {
            const rating = document.querySelector('input[name="rating"]:checked');
            const review = document.querySelector('textarea[name="review"]').value;
            if (!rating) {
                alert('Please select a rating.');
                event.preventDefault();
                return;
            }
            if (!review.trim()) {
                alert('Please enter a review.');
                event.preventDefault();
                return;
            }
            alert('Review submitted successfully!');
            modalContainer.classList.add('out');
            document.body.classList.remove('modal-active');
        });
    </script>
</body>
</html>
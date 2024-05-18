<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <link rel="stylesheet" href="css/AddEditProduct.css">
</head>
<body>

    <?php include("nav.php")?>

    <?php
        include('connect.php');
        $product_id = $_GET['ID'];

        $product_query = "SELECT * FROM PRODUCT WHERE PRODUCT_ID = '$product_id'";
        $product_stmt = oci_parse($conn,$product_query);

        oci_execute($product_stmt);
        $row = oci_fetch_array($product_stmt);
        $product_name = $row['PRODUCT_NAME'];
        $product_desc = $row['PRODUCT_DETAILS'];
        $product_price = $row['PRODUCT_PRICE'];
        $product_image = $row['PRODUCT_IMAGE'];
        $product_max = $row['PRODUCT_MAX_LIMIT'];
        $product_stock = $row['PRODUCT_QUANTITY'];
        $product_status = $row['PRODUCT_STATUS'];
        $product_allergy = $row['ALLERGY_INFO'];
        $product_category = $row['PRODUCT_CATEGORY'];

    ?>


    <div class="container">
        <form action="EditProductPHP.php" method="post" enctype="multipart/form-data">
            <h1>Edit Product</h1>
            <input name="pid" type="hidden" value="<?php echo($product_id);?>">
            <div class="section">
                <h2>Product Name</h2>
                <input type="text" name="pname" class="description-field" placeholder="Enter product name" value="<?php echo($product_name);?>" hidden>
            </div>
            <div class="section">
                <h2>Product Description</h2>
                <textarea name="pdesc" class="description-field-big" placeholder="Enter description..."><?php echo($product_desc);?></textarea>
            </div>
            <div class="row">
                <div class="input-group">
                    <label for="available-stock">
                        <h2>Available Stock:</h2>
                    </label>
                    <input type="number" name="pstock" id="available-stock" placeholder="Enter available stock" class="styled-input" value="<?php echo($product_stock);?>">

                </div>
                <div class="input-group">
                    <label for="price"><h2>Price:</h2></label>
                    <input type="double" name="pprice" id="price" placeholder="Enter price" class="styled-input" value="<?php echo($product_price);?>">
                </div>
            </div>

            <div class="row">
                <div class="input-group">
                    <label for="category">
                        <h2>Category:</h2>
                    </label>
                    <input type="text" name="pcategory" id="category" placeholder="Enter category" class="styled-input" value="<?php echo($product_category);?>">

                </div>
                <div class="input-group">
                    <label for="order-limit"><h2>Order Limit:</h2></label>
                    <input type="number" name="porderlim" id="order-limit" placeholder="Enter order limit" class="styled-input" value="<?php echo($product_max);?>">
                </div>
            </div>

            <!-- <div class="section">
                <label for="expiry"><h2>Allergy Information</h2></label>
                <input type="date" id="expiry" placeholder="Enter Category" class="styled-input">        
            </div> -->

            <div class="section">
                <h2>Product Image</h2>
            </div>
            <div class="chooseimage-container">
                <div class="right-side">
                    <label class="image-label" for="pimage">
                        <div class="card-row">
                            <div class="card">
                                <div class="icon">+</div>
                            </div>
                        </div>
                    </label>
                    <input type="hidden" name="image-alt" value="<?php echo($product_image);?>">
                    <input name="pimage" id="pimage" type="file">
                </div>
                <div class="imageview">
                    <div id="file-name"><?php echo $product_image; ?></div>
                    <img id="image-preview" width="160px" height="160px" src="images/<?php echo $product_image;?>">
                </div>
            </div>
            <button type="submit" name="submit" class="save-button">Save</button>
        </form>
    </div>
    <script>
        document.getElementById('pimage').addEventListener('change', function() {
            const fileInput = this;
            const fileNameDisplay = document.getElementById('file-name');
            const imagePreview = document.getElementById('image-preview');

            const file = fileInput.files[0];
            if (file) {
                

                // Check if the selected file is an image
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imagePreview.src = e.target.result;
                        imagePreview.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
            } 
            else {
                fileNameDisplay.textContent = '';
                imagePreview.style.display = 'none';
            }
        });
    </script>
</body>
</html>

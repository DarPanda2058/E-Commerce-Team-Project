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

    <div class="container">
        <form action="AddProductPHP.php" method="post" enctype="multipart/form-data">
            <h1>Add New Product</h1>
            <div class="section">
                <h2>Product Name</h2>
                <input type="text" name="pname" class="description-field" placeholder="Enter product name"></textarea>
            </div>
            <div class="section">
                <h2>Product Description</h2>
                <textarea name="pdesc" class="description-field-big" placeholder="Enter description..."></textarea>
            </div>
            <div class="row">
                <div class="input-group">
                    <label for="available-stock">
                        <h2>Available Stock:</h2>
                    </label>
                    <input type="text" name="pstock" id="available-stock" placeholder="Enter available stock" class="styled-input">

                </div>
                <div class="input-group">
                    <label for="price"><h2>Price:</h2></label>
                    <input type="text" name="pprice" id="price" placeholder="Enter price" class="styled-input">
                </div>
            </div>

            <div class="row">
                <div class="input-group">
                    <label for="category">
                        <h2>Category:</h2>
                    </label>
                    <input type="text" name="pcategory" id="category" placeholder="Enter category" class="styled-input" value="<?php echo $_SESSION['shopCategory']; ?>" readonly >

                </div>
                <div class="input-group">
                    <label for="order-limit"><h2>Order Limit:</h2></label>
                    <input type="text" name="porderlim" id="order-limit" placeholder="Enter order limit" class="styled-input">
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
                    <input name="pimage" id="pimage" type="file" required>
                </div>
                <div class="imageview">
                    <div id="file-name"></div>
                    <img id="image-preview" width="160px" height="160px" src="#" alt="Image Preview" style="display: none;">
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
                
                fileNameDisplay.textContent = file.name;
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

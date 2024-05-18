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
        <h1>Edit Product</h1>
        <div class="section">
            <h2>Product Description</h2>
            <textarea class="description-field" placeholder="Enter product description..."></textarea>
        </div>
        <div class="section">
            <h2>Product Description</h2>
            <textarea class="description-field-big" placeholder="Enter description..."></textarea>
        </div>
        <div class="row">
            <div class="input-group">
                <label for="available-stock">                <h2>Available Stock:</h2>
                </label>
                <input type="text" id="available-stock" placeholder="Enter available stock" class="styled-input">

            </div>
            <div class="input-group">
                <label for="price"><h2>Price:</h2></label>
                
                

                <input type="text" id="price" placeholder="Enter price" class="styled-input">
            </div>
       
        </div>

        <div class="section">
            <label for="category"><h2>Category</h2></label>
            
            <input type="text" id="category" placeholder="Enter Category" class="styled-input">        </div>

            <div class="section">
                <label for="expiry"><h2>Expiry Date</h2></label>
                
                <input type="date" id="expiry" placeholder="Enter Category" class="styled-input">        </div>

                <div class="section">
                    <h2>Product Image</h2>
                </div>
            
                <div class="card-row">
                    <div class="card">
                        <div class="icon">+</div>
                    </div>
                    <div class="card">
                        <div class="icon">+</div>
                    </div>
                    <div class="card">
                        <div class="icon">+</div>
                    </div>
                    <div class="card">
                        <div class="icon">+</div>
                    </div>
                </div>
                <button class="save-button">Save</button>

                
    </div>

   



</body>
</html>

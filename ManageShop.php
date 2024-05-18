<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <link rel="stylesheet" href="css/ManageShop.css">
</head>
<body>

<?php include("nav.php")?>

<div class="main-container">
    <div class="other-div">
        <div class="other-div">
            <div style="margin-top: 100px;"> <img src="images/image.jpg" alt="Butcher Image" width="400" height="500" ></div>
           
            <h1>Butcher</h1>
            <h4>All in one shop for meat</h4>
            <div class="buttons">
                <button class="yellow-button">Account Info <span>&rarr;</span></button>
                <button class="blue-button">Manage shop <span>&rarr;</span></button>
                <button class="black-button">Change password <span>&rarr;</span></button>
            </div>
        </div>
    </div>  
    
    <div class="container">
        <h1>Manage Shop</h1>
        <div class="shop-info">
            <h2>Shop info</h2>
            <button class="yellow-button">Manage Your Product</button>
        </div>
        
        <div class="section">
            <h2>Shop Name</h2>
            <textarea class="description-field" placeholder="Enter Shop Name..."></textarea>
        </div>
        <div class="section">
            <h2>Shop Address</h2>
            <textarea class="description-field" placeholder="Enter Shop Address..."></textarea>
        </div>
        

        <div class="section">
            <label for="category"><h2>PAN Number</h2></label>
            
            <input type="text" id="category" placeholder="Enter PAN Number" class="styled-input">        </div>

            <div class="section">
                <label for="expiry"><h2>Short Description</h2></label>
                
                <input type="date" id="expiry" placeholder="Enter Short Description" class="styled-input">        </div>

              
            <div class="section">
                <label for="category"><h2>Category</h2></label>
                
                <input type="date" id="category" placeholder="Enter Category" class="styled-input">        </div>
                <button class="save-button">Save</button>

                
    </div>

    
    

</div>


   



</body>
</html>

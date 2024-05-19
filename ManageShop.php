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
            <div> <img src="images/image.jpg" alt="Butcher Image"></div>
           
            <h1><?php echo($_SESSION['shopName']);?></h1>
            <h4><?php echo($_SESSION['shopDescription']);?></h4>
            <div class="buttons">
                <button class="yellow-button"><a href="#">Account Info</a><span>&rarr;</span></button>
                <button class="yellow-button" id = "active">Manage shop<span>&rarr;</span></button>
                <button class="yellow-button"><a href="#">Change password</a> <span>&rarr;</span></button>
            </div>
        </div>
    </div>  
    
    <div class="container">
        <h1>Manage Shop</h1>
        <div class="shop-info">
            <h2>Shop info</h2>
            <button class="yellow-button"><a href="ManageProduct.php">Manage Your Product</a></button>
        </div>
        
        <div class="section">
            <h2>Shop Name</h2>
            <input type="text" class="description-field" placeholder="Enter Shop Name..." value="<?php echo($_SESSION['shopName']);?>">
        </div>
        <div class="section">
            <h2>Shop Address</h2>
            <input type="text" class="description-field" placeholder="Enter Shop Address..." value="<?php echo($_SESSION['shopAddress']);?>">
        </div>
        

        <div class="section">
            <label for="category"><h2>PAN Number</h2></label>
            
            <input type="text" id="category" placeholder="Enter PAN Number" class="styled-input" value="<?php echo($_SESSION['shopPan']);?>">        
        </div>

            <div class="section">
                <label for="expiry"><h2>Short Description</h2></label>
                
                <textarea id="expiry" placeholder="Enter Short Description" class="styled-input"><?php echo($_SESSION['shopDescription']);?></textarea>       

            </div>

              
            <div class="section">
                <label for="category"><h2>Category</h2></label>
                
                <input type="text" id="category" placeholder="Enter Category" class="styled-input" value="<?php echo($_SESSION['shopCategory']);?>">       
                <div class="right-btn"><button class="save-button">Save</button></div>   
            </div>
    </div>

    
    

</div>


   



</body>
</html>

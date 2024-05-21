<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Shop</title>
    <link rel="stylesheet" href="css/ManageShop.css">
</head>
<body>

<?php include("nav.php")?>

<div class="main-container">
    <div class="other-div">
        <div class="other-div">
            <div> 
                <div>
                    <img id="image-preview" src="images/<?php echo $_SESSION['shopLogo'];?>">
                </div>
                <button class="custom-file-button" type="button">Choose Image</button>
                
                
                
            </div>
            
           
            <h1><?php echo($_SESSION['shopName']);?></h1>
            <h4><?php echo($_SESSION['shopDescription']);?></h4>
            <div class="buttons">
                <button class="yellow-button"><a href="userProfile.php">Account Info</a><span>&rarr;</span></button>
                <button class="yellow-button" id = "active">Manage shop<span>&rarr;</span></button>
                <button class="yellow-button"><a href="changePass.php">Change password</a> <span>&rarr;</span></button>
            </div>
        </div>
    </div>  

        

    <div class="container">
        <h1>Manage Shop</h1>
        <div class="shop-info">
            <h2>Shop info</h2>
            <button class="yellow-button"><a href="ManageProduct.php">Manage Your Product</a></button>
        </div>
        <form action="ManageShopPHP.php" method="post" enctype="multipart/form-data">
            <div class="section">
                <h2>Shop Name</h2>
                <input type="text" name="sname" class="description-field" placeholder="Enter Shop Name..." value="<?php echo($_SESSION['shopName']);?>">
            </div>
            <div class="section">
                <h2>Shop Address</h2>
                <input type="text" name="saddress" class="description-field" placeholder="Enter Shop Address..." value="<?php echo($_SESSION['shopAddress']);?>">
            </div>
            <!-- Input type file the label for which is in a div on line 21 -->
            <input name="simage" id="simage" type="file">
            <input type="hidden" name="image-alt" value="<?php echo $_SESSION['shopLogo'];?>">

            <div class="section">
                <label for="category"><h2>PAN Number</h2></label>
                <input type="text" name="span" id="category" placeholder="Enter PAN Number" class="styled-input" value="<?php echo($_SESSION['shopPan']);?>">        
            </div>

                <div class="section">
                    <label for="expiry"><h2>Short Description</h2></label>
                    <textarea id="expiry" name="sdesc" placeholder="Enter Short Description" class="styled-input"><?php echo($_SESSION['shopDescription']);?></textarea>       

                </div>

                
                <div class="section">
                    <label for="category"><h2>Category</h2></label>
                    <input type="text" name="scategory" id="category" placeholder="Enter Category" class="styled-input" value="<?php echo($_SESSION['shopCategory']);?>">       
                    <div class="right-btn"><button type="submit" class="save-button" name="shopSave" >Save</button></div>   
                </div>
        </form>
    </div>

    
    

</div>


   
<script>
        document.getElementById('simage').addEventListener('change', function() {
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
        // Trigger the file input when the custom button is clicked
        document.querySelector('.custom-file-button').addEventListener('click', function (event) {
            event.preventDefault(); // Prevent default button action
            document.getElementById('simage').click(); 
        });
    </script>


</body>
</html>

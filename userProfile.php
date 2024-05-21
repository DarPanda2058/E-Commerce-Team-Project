<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" href="css/ManageShop.css">
</head>
<body>

<?php include("nav.php")?>

<div class="main-container">
    <div class="other-div">
        <div class="other-div">
            
            <div> 
                <div>
                    <img id="image-preview" src="images/<?php echo $_SESSION['image'];?>">
                </div>
                <button class="custom-file-button" type="button">Choose Image</button>
                
                
                
            </div>
            
           
            <h1><?php echo($_SESSION['fname']." ".$_SESSION['lname']);?></h1>
            <div class="buttons">
                <button class="yellow-button" id = "active">Account Info<span>&rarr;</span></button>
                <?php
                    if($_SESSION['role'] == 'trader'){
                ?>
                <button class="yellow-button" ><a href="ManageShop.php">Manage Shop</a><span>&rarr;</span></button>
                <?php }?>
                <button class="yellow-button" ><a href="changePass.php">Change Password</a> <span>&rarr;</span></button>
            </div>
        </div>
    </div>  

        

    <div class="container">
        <h1>Manage Profile</h1>
        <div class="shop-info">
            <h2>Profile Info</h2>
            <button class="yellow-button"><a href="<?php
                if(($_SESSION['role'] == 'trader') || ($_SESSION['role']=='admin')){
                    echo "#";
                }else{
                    echo "CustomerOrders.php";
                }
            ?>"><?php 
                if(($_SESSION['role'] == 'trader') || ($_SESSION['role']=='admin')){
                    echo "Access Your Dashboard";
                }else{
                    echo "My Orders";
                }
            ?></a></button>
        </div>
        <form action="userProfilePHP.php" method="post" enctype="multipart/form-data">
            <div class="row">
            <div class="input-group">
                    <label for="fname">
                        <h2>First Name:</h2>
                    </label>
                    <input type="text" name="fname" id="fname" placeholder="Enter First Name" class="styled-input" value="<?php echo($_SESSION['fname']);?>">

                </div>
                <div class="input-group">
                    <label for="lname"><h2>Last Name:</h2></label>
                    <input type="text" name="lname" id="lname" placeholder="Enter Last Name" class="styled-input" value="<?php echo($_SESSION['lname']);?>">
                </div>
            </div>
            <div class="section">
                <h2>Email Address*</h2>
                <p class="description-field"><?php echo($_SESSION['email']);?></p>
            </div>
            <!-- Input type file the label for which is in a div on line 21 -->
            <input name="timage" id="timage" type="file">
            <input type="hidden" name="image-alt" value="<?php echo $_SESSION['image'];?>">

            <div class="section">
                <label for="category"><h2>Phone Number</h2></label>
                <input type="tel" name="tphone" id="category" placeholder="Enter Phone Number" class="styled-input" value="<?php echo($_SESSION['phone']);?>">        
            </div>

                <div class="section">
                    <label for="expiry"><h2>Permanent Address</h2></label>
                    <textarea id="expiry" name="taddress" placeholder="Enter Permanent Address" class="styled-input"><?php echo($_SESSION['address']);?></textarea>       

                </div>
                <div class="section">     
                    <div class="right-btn"><button type="submit" class="save-button" name="shopSave" >Save</button></div>   
                </div>
        </form>
    </div>

    
    

</div>


   
<script>
        document.getElementById('timage').addEventListener('change', function() {
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
            document.getElementById('timage').click(); 
        });
    </script>


</body>
</html>

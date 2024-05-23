<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
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

                
                
                
            </div>
            
           
            <h1><?php echo($_SESSION['fname']." ".$_SESSION['lname']);?></h1>
            <div class="buttons">
                <button class="yellow-button" ><a href="userProfile.php">Account Info</a><span>&rarr;</span></button>
                <?php
                    if($_SESSION['role'] == 'trader'){
                ?>
                <button class="yellow-button" ><a href="ManageShop.php">Manage Shop</a><span>&rarr;</span></button>
                <?php }?>
                <button class="yellow-button" id = "active">Change Password<span>&rarr;</span></button>
            </div>
        </div>
    </div>  

        

    <div class="container">
        <h1>Change Password</h1>
        <div class="shop-info">
            <h2>Password Info</h2>
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
        <form action="changePassPHP.php" method="post">
            <div class="section">
                <label for="currentPass"><h2>Current Password</h2></label>
                <input type="password" name="currentPass" id="currentPass" placeholder="Enter Current Password" class="styled-input">  
            </div>

            <div class="section">
                <label for="newPass"><h2>New Password</h2></label>
                <input type="password" name="newPass" id="newPass" placeholder="Enter New Password" class="styled-input">        
            </div>

                <div class="section">
                    <label for="confirmPass"><h2>Confirm Password</h2></label>
                    <input type="password" name="confirmPass" id="confirmPass" placeholder="Confirm New Password" class="styled-input">     

                </div>
                <div class="section">     
                    <div class="right-btn"><button type="submit" class="save-button" name="changePass" >Save</button></div>   
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
    </script>


</body>
</html>

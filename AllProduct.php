<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Butcher Products</title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<?php 
include('connect.php');
session_start();

function applySortOrder($query, $sort_order) {
    if ($sort_order == "asc") {
        return $query . " ORDER BY PRODUCT_PRICE ASC";
    } else if ($sort_order == "desc") {
        return $query . " ORDER BY PRODUCT_PRICE DESC";
    } else {
        return $query;
    }
}

$sort_order = isset($_POST['sort_order']) ? $_POST['sort_order'] : 'asc';
$_SESSION['sort_order'] = $sort_order;

if (isset($_GET['id'])) {
    $shop_id = $_GET['id'];
    $shop_name = $_GET['name'];
    $_SESSION['ALL_SHOP_ID'] = $shop_id;
    $_SESSION['ALL_SHOP_NAME'] = $shop_name;
} else {
    $shop_id = isset($_SESSION['ALL_SHOP_ID']) ? $_SESSION['ALL_SHOP_ID'] : null;
    $shop_name = isset($_SESSION['ALL_SHOP_NAME']) ? $_SESSION['ALL_SHOP_NAME'] : null;
}

$search_content = isset($_POST['search_content']) ? $_POST['search_content'] : (isset($_SESSION['search_content']) ? $_SESSION['search_content'] : null);
$_SESSION['search_content'] = $search_content;

$category = isset($_GET['category']) ? $_GET['category'] : null;

$query = "SELECT * FROM PRODUCT WHERE PRODUCT_STATUS = 1";
if ($shop_id) {
    $query .= " AND SHOP_ID = '$shop_id'";
}
if ($search_content) {
    $query .= " AND UPPER(PRODUCT_NAME) LIKE UPPER('%$search_content%')";
}
if ($category) {
    $query .= " AND UPPER(PRODUCT_CATEGORY) = UPPER('$category')";
}
$query = applySortOrder($query, $sort_order);

$stmt = oci_parse($conn, $query);
oci_execute($stmt);

$_SESSION['ALL_SHOP_ID'] = null;

// Include navigation
include('nav.php');
?>

<center>
    <?php if(isset($_GET['id']) || isset($_SESSION['ALL_SHOP_ID']) ){ ?>
    <h1 class="title"><?php echo $shop_name; ?></h1>
    <?php } ?>
    <h1>Products</h1>
    <?php if($category){
        echo '<p style="font-size=1.4rem;">Search for :'.$category.'</p>';
    } ?>
    <hr width="5%">
</center>
<?php
    if(isset($_SESSION['search_content'])){
        echo "<section>Search Results For : ".$_SESSION['search_content'];
        // Add the radio buttons and filter button
        echo '<form method="post" action="AllProduct.php" style="display: inline-block; margin-left: 20px;">';
        echo '<input type="radio" id="asc" name="sort_order" value="asc"';
        if(((isset($sort_order)) && ($sort_order == "asc")) || !isset($sort_order)) echo ' checked';
        echo '><label for="asc">Ascending</label>';
        echo '<input type="radio" id="desc" name="sort_order" value="desc" style="margin-left: 10px;"';
        if(isset($sort_order) && $sort_order == "desc") echo ' checked';
        echo '><label for="desc">Descending</label>';
        echo '<button type="submit" class="btn btn-primary" style="margin-left: 10px;">';
        echo '<i class="fas fa-filter"></i> Filter';
        echo '</button>';
        echo '</form>';
        echo '</section>';
    }
?>
<div class="headline">
    <div class="l-container">
        <?php 
            while($row = oci_fetch_assoc($stmt)){
        ?>
        <div class="product">
            <div class="product-image" style="background-image: url(images/<?php echo $row['PRODUCT_IMAGE'] ?>);"></div>
            <div class="product-info">
                <h2><?php echo $row['PRODUCT_NAME'] ?></h2>
                <p class="price">&pound;<?php echo $row['PRODUCT_PRICE'] ?></p>
                <p class="descr"><?php echo $row['PRODUCT_DETAILS'] ?></p>
                <div class="product-buttons">
                    <a href="ProductPage.php?id=<?php echo $row['PRODUCT_ID'] ;?>" class="btn buy">Buy</a>
                    <a href="<?php if(isset($_SESSION['role']) && ($_SESSION['role'] == 'customer')){
                               echo 'Cart.php?product_id='.$row['PRODUCT_ID'].'';
                            }else{
                                echo 'login_register.php';
                            } ?>" class="btn add-to-cart">Add to Cart</a>
                </div>
            </div>
        </div>
        <?php } ?>  
    </div>
</div>
<?php include('footer.html');?>
</body>
</html>
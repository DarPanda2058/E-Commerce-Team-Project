<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Customers</title>
    <link rel="stylesheet" href="css/ManageProduct.css">
</head>
<?php
    include("connect.php");
    include("nav.php");
?>
<body>
    <?php
        if(isset($_GET['ID'])){
            $user_id = $_GET['ID'];
            $state = $_GET['state'];
            $query = "UPDATE USERS SET USER_STATE = :state WHERE USER_ID = :user_id AND USER_TYPE = 'customer'";
            $stmt = oci_parse($conn, $query);
            oci_bind_by_name($stmt, ':state', $state);
            oci_bind_by_name($stmt, ':user_id', $user_id);

            if (oci_execute($stmt)) {
                echo '<script>alert("Customer status updated successfully.");</script>';
            } else {
                echo '<script>alert("Error updating customer status.");</script>';
            }
    
            // Redirect to the same page to reflect changes
            header("Location: ManageCustomer.php");
            exit();
        }

        $query_customer_data = "SELECT USER_ID, USER_FIRST_NAME,USER_LAST_NAME,USER_CREATED_TIME,USER_PHONE, USER_EMAIL, USER_STATE FROM USERS WHERE USER_TYPE = 'customer'";
        $query_customer_status = "SELECT 
                                    SUM(CASE WHEN USER_STATE = 1 THEN 1 ELSE 0 END) AS VERIFIED_COUNT,
                                    SUM(CASE WHEN USER_STATE = 0 THEN 1 ELSE 0 END) AS NOT_VERIFIED_COUNT,
                                    COUNT(*) AS TOTAL_CUSTOMERS
                                FROM 
                                    USERS
                                WHERE
                                    USER_TYPE = 'customer'";

        $customer_data_stmt = oci_parse($conn,$query_customer_data);
        $customer_status_stmt = oci_parse($conn,$query_customer_status);

        // Finding verified and not verified customers
        oci_execute($customer_status_stmt);

        // Extracting customer details
        oci_execute($customer_data_stmt);
        
        if($row = oci_fetch_assoc($customer_status_stmt)){
            $verified = $row['VERIFIED_COUNT'];
            $not_verified = $row['NOT_VERIFIED_COUNT'];
            $total_customers = $row['TOTAL_CUSTOMERS'];
            if($verified == null){
                $verified = 0;
            }
            if($not_verified == null){
                $not_verified = 0;
            }
        }
    ?>
    <div class="order-header">
        <h2>Manage Your Customers</h2>
        <div class="status-add">
            <div class="status-row">
                <h3>ALL(<?php echo $total_customers;?>)</h3>
                <h3 class="green">Verified(<?php echo $verified;?>)</h3>
                <h3 class="red">Not Verified(<?php echo $not_verified;?>)</h3>
            </div>
        </div>
    </div>

    <table>
        <tr class="title">
            <th>Username</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Date Of Join</th>
            <th>Status</th>
            <th>&Tab;</th>
            <th>&Tab;</th>
        </tr>
        <?php
            while (($row = oci_fetch_array($customer_data_stmt))){
                $fname = $row['USER_FIRST_NAME'];
                $lname = $row['USER_LAST_NAME'];
                $phone = $row['USER_PHONE'];
                $join_date = date_format(date_create($row['USER_CREATED_TIME']), 'd-M-Y');
                $email = $row['USER_EMAIL'];
                $user_state = $row['USER_STATE'];
                echo '<tr class="repeating-row">';
                echo '    <td class="username">'."$fname"." "."$lname".'</td>';
                echo '    <td class="email">'.$email.'</td>';
                echo '    <td class="phone">'.$phone.'</td>';
                echo '    <td class="join-date">'.$join_date.'</td>';
                
                echo '<td class = "status">';
                    if ($user_state == 0) {
                        echo '<button class="pending-approval">Not Verified</button>';
                    } else {
                        echo '<button class="approved">Verified</button>';
                    }
                echo '</td>';
                echo '    <td><button class="order-delete-button" id="red" ><a href="ManageCustomer.php?ID='.$row['USER_ID'].'&state=0">Disable</a></button></td>';
                echo '    <td><button class="order-modify-button" id="green" ><a href="ManageCustomer.php?ID='.$row['USER_ID'].'&state=1">Verify</a></button></td>';
                echo '</tr>';
            }
        oci_close($conn);
        ?>
    </table>
</body>
</html>
<html>
<head>

    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
<!-- Menu Section Starts -->
<?php 
$page_title = "ManageOrder"; #عنوان للصفحة
include "../layouts/menu.php"
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Order</h1>
        
        <?php
        if(isset($_SESSION['order'])){
            echo $_SESSION['order'];
            unset($_SESSION['order']); #destroys the variable
        }
        ?>
        
        <br/><br/><br/>

        <a href="add-food.php" class="btn-primary">Add Order</a>
        <br><br>

        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Food</th>
                <th>Price</th>
                <th>Qty.</th>
                <th>Total</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Customer Name</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>
            <?php
            $q = "SELECT o.id, f.title, f.price, o.quantity, o.total, o.date, o.status, o.full_name, o.contact, o.email, o.address 
            FROM `orders` AS o
            INNER JOIN `foods` AS f ON o.food_id = f.id";   
            $res = mysqli_query($conn,$q);
            while ($order = $res->fetch_assoc()) {
                $orderId = $order['id'];
                $foodTitle = $order['title'];
                $foodPrice = $order['price'];
                $quantity = $order['quantity'];
                $total = $order['total'];
                $orderDate = $order['date'];
                $status = $order['status'];
                $fullName = $order['full_name'];
                $contact = $order['contact'];
                $email = $order['email'];
                $address = $order['address'];
        
                echo '
            <tr>
            <td>' . $orderId . '</td>
            <td>' . $foodTitle . '</td>
            <td>' . $foodPrice . '</td>
            <td>' . $quantity . '</td>
            <td>' . $total . '</td>
            <td>' . $orderDate . '</td>
            <td>' . $status . '</td>
            <td>' . $fullName . '</td>
            <td>' . $contact . '</td>
            <td>' . $email . '</td>
            <td>' . $address . '</td>
                <td>
                    <a href="update-order.php?id='.$orderId.'" class="btn-secondary">Update Order</a>
                </td>
            </tr>';
            }?>

        </table>
    </div>

</div>

<?php include "../layouts/footer.php"?>

<!-- Footer Section Ends -->

</body>
</html>
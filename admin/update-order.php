<html>
<head>

    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
<!-- Menu Section Starts -->
<?php 
$page_title = "UpdateOrder"; 

include "../layouts/menu.php"
?>
<?php
if(isset($_GET['id'])){
    $curr_id=$_GET['id'];
    $q = "SELECT * FROM orders INNER JOIN `foods` ON orders.food_id = foods.id WHERE orders.id = $curr_id";
    $res = mysqli_query($conn,$q);
    if($res && $res->num_rows==1){ 
        $order = $res->fetch_assoc();
        $title = $order['title'];
        $price = $order['price'];
        $quantity = $order['quantity'];
        $total = $order['total'];
        $full_name = $order['full_name'];
        $address = $order['address'];
        $email = $order['email'];
        $status = $order['status'];
        $date = $order['date'];
        $contact = $order['contact'];
        $Status = $order['status'];


    }else{
        header("location:manage-food.php");
    }
}else{
    header("location:manage-food.php");
}
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>
        <br><br>


        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Food Name</td>
                    <td><b><?php echo $title?></b></td>
                </tr>

                <tr>
                    <td>Price</td>
                    <td>
                        <b><?php echo $price?></b>
                    </td>
                </tr>

                <tr>
                    <td>Qty</td>
                    <td>
                        <input type="number" name="qty" value="<?php echo $quantity?>">
                    </td>
                </tr>

                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status">
                        <?php
                        $orderStatuses = array("Ordered", "On Delivery", "Delivered", "Cancelled");
                        foreach ($orderStatuses as $status) {
                            $selected = ($status === $Status) ? "selected" : "";
                            echo "<option value=\"$status\" $selected> $status </option>";
                        }
                        ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Customer Name:</td>
                    <td>
                        <input type="text" name="customer_name" value="<?php echo $full_name?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer Contact:</td>
                    <td>
                        <input type="text" name="customer_contact" value="<?php echo $contact?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer Email:</td>
                    <td>
                        <input type="text" name="customer_email" value="<?php echo $email?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer Address:</td>
                    <td>
                        <textarea name="customer_address" cols="30" rows="5"><?php echo $address?></textarea>
                    </td>
                </tr>

                <tr>
                    <td clospan="2">
                        <input type="hidden" name="">
                        <input type="hidden" name="price" value="">

                        <input type="submit" name="submit" value="Update Order" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>


    </div>
</div>

<?php include "../layouts/footer.php"?>
<!-- Footer Section Ends -->
<?php
if(isset($_POST['submit'])){
    $qty = $_POST['qty'];
    $status = $_POST['status'];
    $customer_name = $_POST['customer_contact'];
    $customer_email = $_POST['customer_email'];
    $customer_address = $_POST['customer_address'];

    $q="update orders set quantity = '$qty',status = '$status', full_name= '$customer_name',email = '$customer_email',address='$customer_address'where id =$curr_id";
    $res = mysqli_query($conn,$q);

    if($res){
        $_SESSION['order']='<h1 class="success">order is updated!</h1>';
        header("location:manage-order.php");#توجهني من صفحة لـصفحة أخرى
    }
    else{
        $_SESSION['order']='<h1 class="error">order is not updated!</h1>';
        header("location:manage-order.php");
    }
}
?>
</body>
</html>
<!DOCTYPE html>
<html lang="en">

<body>
<?php 
$page_title = "Order";
include "./userLayouts/menu.php";
?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>
            <?php
            if(isset($_GET["id"])){
                $food_id = $_GET["id"]; 
                $q = "select * from foods where id='$food_id' "; 
                $res = mysqli_query($conn,$q);
                while($food = $res->fetch_assoc() ){ 
                    $title=$food['title'];
                    $image_name=$food['image_name'];
                    $image_name=str_replace('../','',$image_name);
                    $price=$food['price'];
                }
            }else{
                header("location:index.php");
            }
            ?>

            <form action="#" class="order" method="post">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <img src="<?php echo $image_name?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title?></h3>
                        <p class="food-price"><?php echo $price?></p>

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Abdullah Ahmed Abudan" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9523xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. abd@outlook.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php
    include "./userLayouts/footer.php"
    ?>

</body>
</html>
<?php
if(isset($_POST['submit'])){
    $quantity=$_POST['qty'];
    $total = $quantity * $price;
    $order_date=date('y:m:d h:m:s');
    $full_name=$_POST['full-name'];
    $contact=$_POST['contact'];
    $email=$_POST['email'];
    $address=$_POST['address'];
    $status = "ordered";
    date_default_timezone_set('Asia/Gaza');
    $q = "insert into orders set quantity='$quantity', total=' $total', date='$order_date',
    full_name='$full_name', contact='$contact',email = '$email',address='$address',status='$status',food_id='$food_id'";
    mysqli_query($conn,$q);
}
?>
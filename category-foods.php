<!DOCTYPE html>
<html lang="en">

<body>
<?php 
$page_title = "Category-Foods";
include "./userLayouts/menu.php";
?>


    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"Category"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
    $id = $_GET['id'];
     $q="select * from foods where cat_id = '$id'";
     $res = mysqli_query($conn,$q);
     if($res && $res->num_rows>0){
         while($food = $res->fetch_assoc() ){ 
             $id=$food['id'];
             $title=$food['title'];
             $description=$food['description'];
             $price=$food['price'];
             $image_name=$food['image_name'];
             $image_name=str_replace("../","",$image_name);
    echo '<div class="food-menu-box">
            <div class="food-menu-img">
                <img src="'.$image_name.'" alt="'.$title.'" class="img-responsive img-curve">
            </div>

            <div class="food-menu-desc">
                <h4>'.$title.'</h4>
                <p class="food-price">'.$price.'</p>
                <p class="food-detail">
                '.$description.'
                </p>
                <br>

                <a href="order.php?id='.$id.'" class="btn btn-primary">Order Now</a>
            </div>
            </div>
';}}
    ?>




            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->


    <?php
    include "./userLayouts/footer.php"
    ?>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<body>
<?php 
$page_title = "Categories";
include "./userLayouts/menu.php";
?>




    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
            $q = "select * from categories where active = 'Yes'";
            $res = mysqli_query($conn,$q);
            if($res && $res->num_rows>0){
                while($category = $res->fetch_assoc() ){ 
                    $id=$category['id'];
                    $title=$category['title'];
                    $image_name=$category['image_name'];
                    $image_name=str_replace('../','',$image_name);
                    echo ' <a href="category-foods.php?id='.$id.'">
                    <div class="box-3 float-container">
                        <img src="'.$image_name.'" alt="'.$title.'" class="img-responsive img-curve">
        
                        <h3 class="float-text text-white">'.$title.'</h3>
                    </div>
                    </a>';
                }
            }
            ?>

           

            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <?php
    include "./userLayouts/footer.php"
    ?>

</body>
</html>
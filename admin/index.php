


<?php 
include "../layouts/menu.php"
?>
        <!-- Main Content Section Starts -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Dashboard</h1>
                <br><br>

                <br><br>

                <div class="col-4 text-center">

                    <?php
                    $q= "select * from categories";
                    $res= mysqli_query($conn,$q);
                    $count= $res->num_rows;
                    ?>

                    <h1> <?php echo $count; ?></h1>
                    <br />

                    Categories
                </div>

                <div class="col-4 text-center">

                    <?php
                    $q= "select * from foods";
                    $res= mysqli_query($conn,$q);
                    $count= $res->num_rows;
                    ?>

                    <h1><?php echo $count; ?></h1>
                    <br />
                    Foods
                </div>

                <div class="col-4 text-center">
                    <?php
                    $q= "select * from orders";
                    $res= mysqli_query($conn,$q);
                    $count= $res->num_rows;
                    ?>

                    <h1><?php echo $count; ?></h1>
                    <br />
                    Total Orders
                </div>

                <div class="col-4 text-center">

                    <?php
                    $q= "select sum(total) as total from orders";
                    $res= mysqli_query($conn,$q);
                    $sum = $res->fetch_assoc();
                    $total = $sum['total'];
                    ?>


                    <h1><?php echo $total; ?> $</h1>
                    <br />
                    Revenue Generated
                </div>

                <div class="clearfix"></div>

            </div>
        </div>
        <!-- Main Content Setion Ends -->
<?php
include "../layouts/footer.php"
?>
<html>
<head>

    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
<!-- Menu Section Starts -->
<?php 
$page_title = "ManageFood"; #عنوان للصفحة
include "../layouts/menu.php";
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Food</h1>

        <br/><br/>
        <?php
        if(isset($_SESSION['food'])){
            echo $_SESSION['food'];
            unset($_SESSION['food']); #destroys the variable
        }
        ?>
        <!-- Button to Add Admin -->
        <a href="add-food.php" class="btn-primary">Add Food</a>

        <br/><br/><br/>


        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>category</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php
            $q="select * from foods";
            $res = mysqli_query($conn,$q);
            if($res && $res->num_rows>0){
                while($food = $res->fetch_assoc() ){ 
                    $id=$food['id'];
                    $title=$food['title'];
                    $description=$food['description'];
                    $price=$food['price'];
                    $active=$food['active'];
                    $featured=$food['featured'];
                    $cat_id=$food['cat_id'];
                    $image_name=$food['image_name'];
                    $q1 = "select * from categories where id = '$cat_id'";
                    $res1= mysqli_query($conn,$q1); # لا داعي ان اعمل وايل لانه سترجع رو واحد
                    $cat = $res1->fetch_assoc();
                    $cat_title= $cat['title'];
            echo '
            <tr>
                <td>'.$id.'</td>
                <td>'.$title.'</td>
                <td>'.$price.'</td>
                <td>
                <img src="'.$image_name.'" width="50px">
                </td>
                <td>'.$featured.'</td>
                <td>'.$cat_title.'</td>
                <td>'.$active.'</td>
                <td>
                    <a href="update-food.php?id='.$id.'" class="btn-secondary">Update Food</a>
                    <a href="delete-food.php?id='.$id.'" class="btn-danger">Delete Food</a>
                </td>
            </tr>';
                }}else{
                    echo "<tr> No foods </tr>";
                }?>


        </table>
    </div>

</div>

<?php include "../layouts/footer.php"?>

<!-- Footer Section Ends -->

</body>
</html>
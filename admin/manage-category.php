<html>
<head>

    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
<!-- Menu Section Starts -->
<?php 
$page_title = "ManageCategory"; #عنوان للصفحة

include "../layouts/menu.php"
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Category</h1>

        <br>
        <?php
        if(isset($_SESSION['category'])){
            echo $_SESSION['category'];
            unset($_SESSION['category']); #destroys the variable
        }
        ?>
        <!-- Button to Add Admin -->
        <a href="add-category.php" class="btn-primary" style="margin: 10px 0;display: inline-block;">Add Category</a>


        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php
            $q="select * from categories";
            $res = mysqli_query($conn,$q);
            if($res && $res->num_rows>0){
                while($category = $res->fetch_assoc() ){ 
                    $id=$category['id'];
                    $title=$category['title'];
                    $featured=$category['featured'];
                    $active=$category['active'];
                    $image_name=$category['image_name'];
            echo '
            
            <tr>
                <td> '.$id.'</td>
                <td> '.$title.'</td>
                <td>
                <img src="'.$image_name.'" width="50px">
                </td>
                <td> '.$featured.'</td>
                <td> '.$active.'</td>

                <td>
                    <a href="update-category.php?id='.$id.'" class="btn-secondary">Update Category</a>
                    <a href="delete-category.php?id='.$id.'" class="btn-danger">Delete Category</a>
                </td>
            </tr>
           
            ';}}
?>
<?php include "../layouts/footer.php"?>

<!-- Footer Section Ends -->

</body>
</html>
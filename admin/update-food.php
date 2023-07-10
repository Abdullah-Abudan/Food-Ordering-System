<html>
<head>

    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
<!-- Menu Section Starts -->
<?php 
$page_title = "UpdateFood"; 

include "../layouts/menu.php"
?>
<?php
if(isset($_GET['id'])){
    $curr_id=$_GET['id'];
    $q="select * from foods where id = '$curr_id'";
    $res = mysqli_query($conn,$q);
    if($res && $res->num_rows==1){ #لأنه حسب الشرط يفترض أصلا يظهر رو واحد
        $food = $res->fetch_assoc();
        $curr_title = $food['title'];
        $description = $food['description'];
        $price = $food['price'];
        $old_image = $food['image_name'];
        $featured = $food['featured'];
        $active	 = $food['active'];


    }else{
        header("location:manage-food.php");
    }
}else{
    header("location:manage-food.php");
}
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">

                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $curr_title?>">
                    </td>
                </tr>

                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" cols="30" rows="5"><?php echo $description?></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image:</td>
                    <td>
                        <img src="<?php echo $old_image?>" alt="">
                    </td>
                </tr>

                <tr>
                    <td>Select New Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category:</td>
                    <td>
                    <select name="category">
                        <?php
                        $q = "SELECT * FROM categories";
                        $res = mysqli_query($conn, $q);
                        if ($res && $res->num_rows > 0) {
                            while ($category = $res->fetch_assoc()) {
                                $id = $category['id'];
                                $title = $category['title'];
                                $selected = ($id == $curr_id) ? 'selected' : '';
                                echo "<option value=\"$id\" $selected>$title</option>";
                            }
                        }
                        else{
                            echo '<option value="0">No Category Found</option>';
                        }
                        ?>
                        </select>
                        
                    </td>
                </tr>

                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes" <?php if($featured=='Yes'){echo 'checked';}?>> Yes
                        <input type="radio" name="featured" value="No"<?php if($featured=='No'){echo 'checked';}?>> No
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes" <?php if($active=='Yes'){echo 'checked';}?>> Yes
                        <input type="radio" name="active" value="No" <?php if($active=='No'){echo 'checked';}?>> No
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="id" value="">
                        <input type="hidden" name="current_image" value="">

                        <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>


    </div>
</div>

<?php include "../layouts/footer.php"?>

<?php
if(isset($_POST['submit'])){
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $cat_id = $_POST['category'];

    $tmpname=$_FILES['image']['tmp_name']; #المسار المؤقت للملف 
    $name=$_FILES['image']['name'];
    if($name){
    $ext = explode('.',$name);
    $ext = end($ext);
    $image_name="../images/foods/".$title.".".$ext;
    move_uploaded_file( $tmpname,$image_name);
    }
    else{
        $image_name = $old_image;   
     }
    $featured = $_POST['featured'];
    $active	 = $_POST['active'];
    
    $q="update foods set title = '$title',description = '$description',price = '$price',cat_id = '$cat_id',image_name='$image_name',featured='$featured',active='$active' where id =$curr_id";
    $res = mysqli_query($conn,$q);

    if($res){
        $_SESSION['food']='<h1 class="success">food is updated!</h1>';
        header("location:manage-food.php");#توجهني من صفحة لـصفحة أخرى
    }
    else{
        $_SESSION['food']='<h1 class="error">food is not updated!</h1>';
        header("location:manage-food.php");
    }
}
?>
<!-- Footer Section Ends -->

</body>
</html>
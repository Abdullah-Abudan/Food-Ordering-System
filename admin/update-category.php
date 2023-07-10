<html>
<head>

    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
<!-- Menu Section Starts -->
<?php 
$page_title = "UpdateCategory"; 

include "../layouts/menu.php"
?>
<?php
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $q="select * from categories where id = $id";
    $res = mysqli_query($conn,$q);
    if($res && $res->num_rows==1){ #لأنه حسب الشرط يفترض أصلا يظهر رو واحد
        $category = $res->fetch_assoc();
        $title = $category['title'];
        $old_image = $category['image_name'];
        $featured = $category['featured'];
        $active	 = $category['active'];
        
    }else{
        header("location:manage-category.php");
    }
}else{
    header("location:manage-category.php");
}
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>

        <br><br>


        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php echo "<img src='$old_image' height='70px' width='70px'>"?>
                    </td>
                </tr>

                <tr>
                    <td>New Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured:</td>
                    <td>
                        
                    <input type="radio" name="featured" value="Yes" <?php if($featured=='Yes'){echo 'checked';}?> > Yes

                    <input type="radio" name="featured" value="No" <?php if($featured=='No'){echo 'checked';}?> > No
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes"<?php if($active=='Yes'){echo 'checked';}?>> Yes

                        <input type="radio" name="active" value="No"<?php if($active=='No'){echo 'checked';}?>> No
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="">
                        <input type="hidden" name="id" value="">
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
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

    $tmpname=$_FILES['image']['tmp_name']; #المسار المؤقت للملف 
    $name=$_FILES['image']['name'];
    if($name){
    $ext = explode('.',$name);
    $ext = end($ext);
    $image_name="../images/categories/".$title.".".$ext;
    move_uploaded_file( $tmpname,$image_name);
    }
    else{
        $image_name = $old_image;   
     }
    $featured = $_POST['featured'];
    $active	 = $_POST['active'];
    
    $q="update categories set title = '$title',image_name='$image_name',featured='$featured',active='$active' where id =$id";
    
    $res = mysqli_query($conn,$q);
    if($res){
        $_SESSION['category']='<h1 class="success">category is updated!</h1>';
        header("location:manage-category.php");#توجهني من صفحة لـصفحة أخرى
    }
    else{
        $_SESSION['category']='<h1 class="error">category is not updated!</h1>';
        header("location:manage-category.php");
    }
}
?>
<!-- Footer Section Ends -->

</body>
</html>
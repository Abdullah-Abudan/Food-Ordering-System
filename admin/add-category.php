    <html>
    <head>
        <title>Food Order Website - Home Page</title>

        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
    <!-- Menu Section Starts -->
    <?php include "../layouts/menu.php"?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>

        <br><br>



        <br><br>

        <!-- Add CAtegory Form Starts -->
        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes" checked> Yes
                        <input type="radio" name="featured" value="No"> No 
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes" checked> Yes
                        <input type="radio" name="active" value="No"> No 
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>
        <!-- Add CAtegory Form Ends -->


    </div>
</div>
<!-- Footer Section Ends -->
<?php include "../layouts/footer.php";
if(isset($_POST['submit'])){
    $title=$_POST['title'];
    $featured=$_POST['featured'];
    $active=$_POST['active'];
    if(isset($_FILES['image']) && $_FILES['image']['name'] !=""){ #تأكدت هيك انه الشخص رافع صورة
        $name=$_FILES['image']['name'];
        $tmpname=$_FILES['image']['tmp_name']; #المسار المؤقت للملف 
        $ext = explode('.',$name);
        $ext = end($ext);
        $image_name="../images/categories/".$title.".".$ext; #المسار الجديد والدائم للملف 
        
        move_uploaded_file( $tmpname,$image_name);#سينقل الملف من المسار المؤقت الى المسار الدائم 
    }else{
        $image_name = "../images/logo.png";
    }
    $q = "insert into categories set title='$title', featured='$featured', active='$active',image_name = '$image_name'";
    $res=mysqli_query($conn,$q);
    if($res){
        $_SESSION['category']='<h1 class="success">category is added!</h1>';
        header("location:manage-category.php");#توجهني من صفحة لـصفحة أخرى
    }
    else{
        $_SESSION['category']='<h1 class="error">category is not added!</h1>';
        header("location:manage-category.php");
    }  
}
?>


    </body>
    </html>
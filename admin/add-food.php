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
        <h1>Add Food</h1>

        <br><br>



        <form action="" method="POST" enctype="multipart/form-data">
        
            <table class="tbl-30">

                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the Food">
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description of the Food."></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">
                            <?php
                                        $q="select * from categories";
                                        $res = mysqli_query($conn,$q);
                                        if($res && $res->num_rows>0){
                                            while($category = $res->fetch_assoc() ){ 
                                                $id=$category['id'];
                                                $title=$category['title'];
                                                echo"<option value=\" $id\"> $title</option>";
                                            }
                                        }else{
                                            echo'<option value="0">No Category Found</option>';
                                        }
                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes 
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes 
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

        


    </div>
</div>

<?php 
include "../layouts/footer.php";

if(isset($_POST['submit'])){
    $title=$_POST['title'];
    $description=$_POST['description'];
    $price=$_POST['price'];
    $active=$_POST['active'];
    $featured=$_POST['featured'];
    $cat_id=$_POST['category'];
    if(isset($_FILES['image']) && $_FILES['image']['name'] !=""){ #تأكدت هيك انه الشخص رافع صورة
        $name=$_FILES['image']['name'];
        $tmpname=$_FILES['image']['tmp_name']; #المسار المؤقت للملف 
        $ext = explode('.',$name);
        $ext = end($ext);
        $image_name="../images/foods/".$title.".".$ext; #المسار الجديد والدائم للملف 
        move_uploaded_file( $tmpname,$image_name);#سينقل الملف من المسار المؤقت الى المسار الدائم 
    }else{
        $image_name = "../images/logo.png";
    }
    $q = "insert into foods set title='$title', description=' $description', price='$price', featured='$featured', active='$active',image_name = '$image_name',cat_id='$cat_id'";
    $res=mysqli_query($conn,$q);
    if($res){
        $_SESSION['food']='<h1 class="success">food is added!</h1>';
        header("location:manage-food.php");#توجهني من صفحة لـصفحة أخرى
    }
    else{
        $_SESSION['food']='<h1 class="error">food is not added!</h1>';
        header("location:manage-food.php");
    }  
}
?>

    <!-- Footer Section Ends -->

    </body>
    </html>
<html>
<head>

    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
<!-- Menu Section Starts -->
<?php 
$page_title = "UpdateAdmin"; 
include "../layouts/menu.php";

?>

<?php
if(isset($_GET['id'])){
    $id=$_GET['id'];
#أي حاجةاليوزر بدخلها وأنا بأخذها وبوديها للكويري يلزمها بريبير ستيتمنت للحماية من هجوم الاس كيو ال انجكشن
    $q="select * from admins where id = ?"; 
    $q = mysqli_prepare($conn, $q);
    mysqli_stmt_bind_param($q, "i", $id);
    mysqli_stmt_execute($q);
    $res= mysqli_stmt_get_result($q);
    if($res && $res->num_rows==1){ #لأنه حسب الشرط يفترض أصلا يظهر رو واحد
        $admin = $res->fetch_assoc();
        $fullname = $admin['fullname'];
        $username = $admin['username'];

    }else{
        header("location:manage-admin.php");
    }
}else{
    header("location:manage-admin.php");
}
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>

        <br><br>


        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $fullname?>">
                    </td>
                </tr>

                <tr>
                    <td>Username:</td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>


    </div>
</div>

<!-- Footer Section Ends -->
<?php include "../layouts/footer.php"?>
<?php
if(isset($_POST['submit'])){
    $username=$_POST['username'];
    $fullname=$_POST['full_name'];
    $q="update admins set username = '$username',fullname='$fullname' where id =$id";
    $res = mysqli_query($conn,$q);
    if($res){
        $_SESSION['admin']='<h1 class="success">admin is updated!</h1>';
        header("location:manage-admin.php");#توجهني من صفحة لـصفحة أخرى
    }
    else{
        $_SESSION['admin']='<h1 class="error">admin is not updated!</h1>';
        header("location:manage-admin.php");
    }
}
?>

</body>
</html>
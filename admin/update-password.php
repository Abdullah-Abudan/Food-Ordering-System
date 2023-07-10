<html>
<head>

    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
<!-- Menu Section Starts -->
<?php 
$page_title = "UpdateOrder"; 
include "../layouts/menu.php"
?>
<?php
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $q="select * from admins where id = '$id'";
    $res = mysqli_query($conn,$q);
    if($res && $res->num_rows==1){
        $admin = $res->fetch_assoc();
        $old_password=$admin["password"];
    }
    else{
        header("location:manage-admin.php");
    }
}else{
    header("location:manage-admin.php");
}
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>


        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Current Password:</td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current Password">
                    </td>
                </tr>

                <tr>
                    <td>New Password:</td>
                    <td>
                        <input type="password" name="new_password" placeholder="New Password">
                    </td>
                </tr>

                <tr>
                    <td>Confirm Password:</td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
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
    $current_password=$_POST['current_password'];
    $new_password=$_POST['new_password'];
    $confirm_password=$_POST['confirm_password'];
if($old_password==md5($current_password)){ #حتى أتأكد انه صاحب الحساب نفسه بده يعدل ولازم اعمل تشفير للكرنت لانه الباسوورد مشفرة
       if($new_password==$confirm_password){
        $new_password = md5($new_password);#لازم أعمل لها تشفير عند تنفيذ الكويري
        $q="update admins set password= '$new_password' where id ='$id'";
        $res = mysqli_query($conn,$q);
    if($res){
        $_SESSION['admin']='<h1 class="success">Password is updated!</h1>';
        header("location:manage-admin.php");#توجهني من صفحة لـصفحة أخرى
    }
    else{
        $_SESSION['admin']='<h1 class="error">password is not updated!</h1>';
        header("location:manage-admin.php");
    }
    }else{
        echo "Password missmatch!";
    }
    }else{
        echo "Incorrect Password!";
        
} 
}
?>

</body>
</html>
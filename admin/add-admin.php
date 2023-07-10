
<html>
<head>
    <title>Food Order Website - Home Page</title>

</head>

<body>
<!-- Menu Section Starts -->
<?php include "../layouts/menu.php"?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>

        <br><br>


        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter Your Name">
                    </td>
                </tr>

                <tr>
                    <td>Username:</td>
                    <td>
                        <input type="text" name="username" placeholder="Your Username">
                    </td>
                </tr>

                <tr>
                    <td>Password:</td>
                    <td>
                        <input type="password" name="password" placeholder="Your Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>


    </div>
</div>
</body>
</html>
<?php
 include "../layouts/footer.php";
 // print_r($conn);
 if(isset($_POST['submit'])){
    $full_name=$_POST['full_name'];
    $username=$_POST['username'];
    $password=md5($_POST['password']);#خوارزمية تشفير
    $q = "insert into admins set fullname='$full_name', username='$username', password='$password'";
    $res=mysqli_query($conn,$q);
    if($res){
        $_SESSION['admin']='<h1 class="success">admin is added!</h1>';
        header("location:manage-admin.php");#توجهني من صفحة لـصفحة أخرى
    }
    else{
        $_SESSION['admin']='<h1 class="error">admin is not added!</h1>';
        header("location:manage-admin.php");
    }
}
 ?>